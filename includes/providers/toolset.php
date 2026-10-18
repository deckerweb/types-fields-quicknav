<?php
/** Toolset suite navigation. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;

/** Maps only reviewed, registered suite menus to the current user's native capabilities. */
final class Toolset extends Provider {
	public string $id = 'toolset';
	public string $name = 'Toolset';

	/** @return array Available Toolset definition, module and settings destinations; no actions run. */
	public function targets(): array {
		$features = Plugin::features();
		$slugs = [
			'fields' => 'types-custom-fields',
			'post_types' => 'wpcf-cpt',
			'taxonomies' => 'wpcf-ctt',
			'relationships' => 'types-relationships',
			'views' => 'views',
			'templates' => 'view-templates',
			'archives' => 'view-archives',
			'forms' => 'CRED_Forms',
			'user_forms' => 'CRED_User_Forms',
			'relationship_forms' => 'cred_relationship_forms',
			'layouts' => 'dd_layouts',
			'layout_assets' => 'dd_layout_CSS_JS',
			'access' => 'types_access',
			'modules' => 'ModuleManager_Modules',
			'commerce' => 'CRED_Commerce',
			'woocommerce' => 'wpv_wc_views',
			'settings' => 'toolset-settings',
			'export_import' => 'toolset-export-import',
			'layout_migration' => 'dd_layouts_migration',
		];
		$targets = [];
		foreach ( $slugs as $key => $slug ) {
			// Migration 1.0 bundles Twig syntax that cannot run on this plugin's PHP 8.2+ baseline.
			if ( 'layout_migration' === $key && defined( 'TLM_VERSION' ) && '1.0' === (string) TLM_VERSION ) {
				continue;
			}
			$target = $this->menu( [ $slug ], $features[ $key ] );
			if ( $target ) {
				$targets[ $key ] = $target;
			}
		}
		// Maps registers a tab within the native Toolset settings page, not its own menu.
		$sections = isset( $targets['settings'] ) && defined( 'TOOLSET_ADDON_MAPS_VERSION' ) ? apply_filters( 'toolset_filter_toolset_register_settings_section', [] ) : [];
		if ( is_array( $sections ) && isset( $sections['maps'] ) ) {
			$targets['maps'] = [ 'label' => $features['maps'], 'url' => add_query_arg( 'tab', 'maps', $targets['settings']['url'] ) ];
		}
		// Forms Commerce registers its legacy page only on that page's own request.
		if ( ! isset( $targets['commerce'] ) && isset( $targets['settings'] ) && defined( 'CRED_COMMERCE_CAPABILITY' ) && current_user_can( CRED_COMMERCE_CAPABILITY ) && is_callable( [ 'CRED_Commerce', 'CommerceSettingsPage' ] ) && false !== has_filter( 'toolset_filter_register_menu_pages', [ 'CRED_Commerce', 'toolset_register_menu_pages' ] ) ) {
			$targets['commerce'] = [ 'label' => $features['commerce'], 'url' => add_query_arg( 'page', 'CRED_Commerce', admin_url( 'admin.php' ) ) ];
		}
		// WooCommerce Blocks attaches its settings tab only when the settings page loads.
		global $wp_filter;
		$settings_hook = $wp_filter['load-toolset_page_toolset-settings'] ?? null;
		if ( isset( $targets['settings'] ) && defined( 'WC_VIEWS_VERSION' ) && $settings_hook instanceof \WP_Hook ) {
			foreach ( $settings_hook->callbacks as $callbacks ) {
				foreach ( $callbacks as $callback ) {
					$function = $callback['function'];
					if ( is_array( $function ) && isset( $function[0], $function[1] ) && $function[0] instanceof \WooViews\Settings\Frontend && 'build' === $function[1] ) {
						$targets['woocommerce'] = [ 'label' => $features['woocommerce'], 'url' => add_query_arg( 'tab', 'woo-blocks', $targets['settings']['url'] ) ];
					}
				}
			}
		}
		return $targets;
	}
}
