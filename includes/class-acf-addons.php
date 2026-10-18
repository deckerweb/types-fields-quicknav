<?php
/** Selected ACF add-on navigation. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;

/** Resolves audited add-ons through native menus and active module definition types. */
final class ACFAddons extends Provider {
	public string $id = 'acf_addons';
	public string $name = 'ACF add-ons';

	/**
	 * Describe supported add-ons independently of permissions and navigation preferences.
	 * @return array Add-on labels, required provider and loaded runtime state; no filesystem scan.
	 */
	public static function catalog(): array {
		return [
			'acfe' => [ 'label' => 'ACF Extended', 'provider' => 'ACF Pro', 'active' => defined( 'ACFE_VERSION' ) ],
			'better_search' => [ 'label' => 'ACF: Better Search', 'provider' => 'ACF', 'active' => class_exists( '\AcfBetterSearch\AcfBetterSearch', false ) ],
			'font_awesome' => [ 'label' => 'ACF Font Awesome Field', 'provider' => 'ACF', 'active' => defined( 'ACFFA_VERSION' ) ],
		];
	}

	/** @return array Available local add-on destinations with their owning add-on ID. */
	public function targets(): array {
		if ( ! isset( Plugin::providers()['acf'] ) || ! acf_get_setting( 'show_admin' ) || ! current_user_can( acf_get_setting( 'capability' ) ) ) {
			return [];
		}
		$targets = [];
		// Simple integrations share the same native-menu resolver; no duplicate adapter classes.
		$pages = [
			'better_search' => [ class_exists( '\AcfBetterSearch\AcfBetterSearch', false ), 'acfbs_admin_page', 'ACF: Better Search' ],
			'font_awesome' => [ defined( 'ACFFA_VERSION' ) && class_exists( '\ACFFA_Admin', false ), 'fontawesome-settings', 'ACF Font Awesome Field' ],
		];
		foreach ( $pages as $id => [ $loaded, $slug, $label ] ) {
			$target = $loaded ? $this->menu( [ $slug ], $label ) : null;
			if ( $target ) {
				$targets[ 'addon_' . $id ] = $target + [ 'addon' => $id ];
			}
		}
		if ( function_exists( 'acfe_get_modules' ) && defined( 'ACFE_VERSION' ) ) {
			$types = [
				'acfe-form' => __( 'Forms', 'types-fields-quicknav' ),
				'acfe-dbt' => __( 'Block types', 'types-fields-quicknav' ),
				'acfe-dpt' => __( 'Manage post types', 'types-fields-quicknav' ),
				'acfe-dt' => __( 'Manage taxonomies', 'types-fields-quicknav' ),
				'acfe-dop' => __( 'Manage options pages', 'types-fields-quicknav' ),
			];
			foreach ( $types as $type => $label ) {
				$target = $this->definition( $type, $label, true );
				if ( $target ) {
					$targets[ 'addon_' . $type ] = $target + [ 'addon' => 'acfe' ];
				}
			}
			$target = $this->menu( [ 'acfe-settings' ], __( 'Settings', 'types-fields-quicknav' ) );
			if ( $target ) {
				$targets['addon_acfe_settings'] = $target + [ 'addon' => 'acfe' ];
			}
		}
		return $targets;
	}
}
