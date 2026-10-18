<?php
/** Navigation lifecycle. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;

/** Registers active adapters, toolbar rendering and host integrations. */
final class Plugin {
	/** @var array<string,Provider> Only detected active providers. */
	private static array $providers = [];

	/**
	 * Initialize translations and register callbacks after providers have initialized.
	 * @return void Registers WordPress hooks; does not modify provider data.
	 */
	public static function boot(): void {
		load_plugin_textdomain( 'types-fields-quicknav', false, dirname( plugin_basename( DTFQ_FILE ) ) . '/languages' );
		$acf_id = self::acf_identity();
		$detected = [
			'acf' => [ $acf_id === 'acf', 'acf', ACF::class ],
			'scf' => [ $acf_id === 'scf', 'scf', SCF::class ],
			'meta_box' => [ defined( 'RWMB_VER' ) || defined( 'MB_CPT_VER' ), 'meta-box', MetaBox::class ],
			'jetengine' => [ function_exists( 'jet_engine' ) && class_exists( '\Jet_Engine', false ), 'jetengine', JetEngine::class ],
			'acpt' => [ defined( 'ACPT_PLUGIN_VERSION' ) || defined( 'ACPT_LITE_PLUGIN_VERSION' ), 'acpt', ACPT::class ],
			'pods' => [ defined( 'PODS_VERSION' ) && function_exists( 'pods_is_admin' ), 'pods', Pods::class ],
			'toolset' => [ defined( 'TYPES_VERSION' ) || defined( 'WPV_VERSION' ) || defined( 'CRED_FE_VERSION' ) || defined( 'TACCESS_VERSION' ) || defined( 'WPDDL_VERSION' ) || defined( 'MODMAN_VERSION' ) || defined( 'TOOLSET_ADDON_MAPS_VERSION' ) || defined( 'CRED_COMMERCE_VERSION' ) || defined( 'WC_VIEWS_VERSION' ) || defined( 'TLM_VERSION' ), 'toolset', Toolset::class ],
		];
		foreach ( $detected as $id => [ $active, $file, $class ] ) {
			if ( $active ) {
				require_once __DIR__ . '/providers/' . $file . '.php';
				self::$providers[ $id ] = new $class();
			}
		}
		add_action( 'admin_bar_menu', [ self::class, 'toolbar' ], 200 );
		require_once __DIR__ . '/class-acf-addons.php';
		Settings::hooks();
	}

	/**
	 * Identify the owner of the loaded ACF-compatible API, including renamed plugin folders.
	 * SCF and ACF share identifiers; installed-but-inactive copies do not create duplicate branches.
	 * @return string Active provider identifier, or an empty string when the API is absent.
	 */
	private static function acf_identity(): string {
		if ( ! function_exists( 'acf_get_setting' ) || ! function_exists( 'acf' ) || ! defined( 'ACF_VERSION' ) ) {
			return '';
		}
		$runtime = acf();
		if ( ! is_object( $runtime ) ) {
			return '';
		}
		$file = ( new \ReflectionClass( $runtime ) )->getFileName();
		return is_string( $file ) && basename( $file ) === 'secure-custom-fields.php' ? 'scf' : 'acf';
	}

	/** @return array<string,Provider> Detected provider objects. */
	public static function providers(): array {
		return self::$providers;
	}

	/** @return array<string,string> Supported provider labels, independent of activation. */
	public static function names(): array {
		return [ 'acf' => 'ACF', 'meta_box' => 'Meta Box', 'jetengine' => 'JetEngine', 'acpt' => 'ACPT', 'pods' => 'Pods', 'toolset' => 'Toolset', 'scf' => 'Secure Custom Fields' ];
	}

	/** @return array<string,string> Configurable feature categories. */
	public static function features(): array {
		return [
			'fields' => __( 'Field groups', 'types-fields-quicknav' ),
			'post_types' => __( 'Manage post types', 'types-fields-quicknav' ),
			'taxonomies' => __( 'Manage taxonomies', 'types-fields-quicknav' ),
			'options' => __( 'Manage options pages', 'types-fields-quicknav' ),
			'definitions' => __( 'Manage Pods and fields', 'types-fields-quicknav' ),
			'settings' => __( 'Provider settings', 'types-fields-quicknav' ),
			'relationships' => __( 'Relationships', 'types-fields-quicknav' ),
			'models' => __( 'Models', 'types-fields-quicknav' ),
			'views' => __( 'Views', 'types-fields-quicknav' ),
			'extensions' => __( 'Extensions', 'types-fields-quicknav' ),
			'license' => __( 'License settings', 'types-fields-quicknav' ),
			'template' => __( 'Template configuration', 'types-fields-quicknav' ),
			'tools' => __( 'Tools', 'types-fields-quicknav' ),
			'templates' => __( 'Content templates', 'types-fields-quicknav' ),
			'archives' => __( 'WordPress archives', 'types-fields-quicknav' ),
			'forms' => __( 'Post forms', 'types-fields-quicknav' ),
			'user_forms' => __( 'User forms', 'types-fields-quicknav' ),
			'relationship_forms' => __( 'Relationship forms', 'types-fields-quicknav' ),
			'layouts' => __( 'Layouts', 'types-fields-quicknav' ),
			'layout_assets' => __( 'Layouts CSS and JS', 'types-fields-quicknav' ),
			'access' => __( 'Access control', 'types-fields-quicknav' ),
			'modules' => __( 'Module manager', 'types-fields-quicknav' ),
			'maps' => __( 'Maps settings', 'types-fields-quicknav' ),
			'commerce' => __( 'Forms Commerce settings', 'types-fields-quicknav' ),
			'woocommerce' => __( 'WooCommerce Blocks settings', 'types-fields-quicknav' ),
			'export_import' => __( 'Export / Import', 'types-fields-quicknav' ),
			'layout_migration' => __( 'Layouts migration', 'types-fields-quicknav' ),
			'migrate_acf' => __( 'ACF migration', 'types-fields-quicknav' ),
			'migrate_toolset' => __( 'Toolset migration', 'types-fields-quicknav' ),
		];
	}

	/**
	 * List meaningful configurable feature keys for a supported provider.
	 * @param string $id Provider identifier.
	 * @return array Ordered feature keys; availability and permissions are resolved separately.
	 */
	public static function provider_features( string $id ): array {
		return match ( $id ) {
			'pods' => [ 'definitions', 'settings' ],
			'toolset' => [ 'fields', 'post_types', 'taxonomies', 'relationships', 'views', 'templates', 'archives', 'forms', 'user_forms', 'relationship_forms', 'layouts', 'layout_assets', 'access', 'modules', 'maps', 'commerce', 'woocommerce', 'settings', 'export_import', 'layout_migration' ],
			'acf', 'scf' => [ 'fields', 'post_types', 'taxonomies', 'options' ],
			'meta_box' => [ 'fields', 'post_types', 'taxonomies', 'options', 'relationships', 'models', 'views', 'template', 'extensions', 'license', 'tools', 'migrate_acf', 'migrate_toolset' ],
			default => [ 'fields', 'post_types', 'taxonomies', 'options', 'settings' ],
		};
	}

	/**
	 * Get eligible content post types; provider definitions never appear as content.
	 * @return array<string,\WP_Post_Type> Visible custom content types, regardless of current user's rights.
	 */
	public static function content_types(): array {
		$internal = [ 'acf-field-group', 'acf-field', 'acf-post-type', 'acf-taxonomy', 'acf-ui-options-page', 'mb-post-type', 'mb-taxonomy', 'mb-settings-page', 'mb-relationship', 'mb-model', 'mb-views', 'meta-box', '_pods_pod', '_pods_field', '_pods_template', 'acpt_content_type', 'acfe-form', 'acfe-dbt', 'acfe-dpt', 'acfe-dt', 'acfe-dop' ];
		foreach ( [
			'TYPES_VERSION' => [ 'wp-types-group', 'wp-types-user-group', 'wp-types-term-group' ],
			'WPV_VERSION' => [ 'view', 'view-template', 'wpa-helper' ],
			'CRED_FE_VERSION' => [ 'cred-form', 'cred-user-form', 'cred_rel_form' ],
			'WPDDL_VERSION' => [ 'dd_layouts', 'widget-area' ],
		] as $constant => $definitions ) {
			if ( defined( $constant ) ) {
				$internal = array_merge( $internal, $definitions );
			}
		}
		$types = get_post_types( [ '_builtin' => false, 'show_ui' => true ], 'objects' );
		foreach ( $types as $key => $object ) {
			if ( ! $object->show_in_menu || in_array( $key, $internal, true ) ) {
				unset( $types[ $key ] );
			}
		}
		return $types;
	}

	/**
	 * Render nonempty provider branches and the separately enabled content navigation.
	 * @param \WP_Admin_Bar $bar Current WordPress toolbar.
	 * @return void Adds only targets authorized for the current user and site.
	 */
	public static function toolbar( \WP_Admin_Bar $bar ): void {
		if ( ! is_user_logged_in() || ! is_admin_bar_showing() || is_network_admin() || is_user_admin() ) {
			return;
		}
		$options = Settings::get();
		$user = wp_get_current_user();
		if ( in_array( (int) $user->ID, $options['blocked_users'], true ) || array_intersect( $user->roles, $options['blocked_roles'] ) ) {
			return;
		}
		if ( ! is_admin() && ! $options['frontend'] ) {
			return;
		}
		$branches = [];
		foreach ( self::$providers as $id => $provider ) {
			if ( ! $options['providers'][ $id ] ) {
				continue;
			}
			$targets = $provider->targets();
			if ( 'acf' === $id ) {
				$targets = array_merge( $targets, ( new ACFAddons() )->targets() );
			}
			$seen = [];
			foreach ( $targets as $feature => $target ) {
				if ( ( isset( $target['addon'] ) ? empty( $options['addons'][ $target['addon'] ] ) : empty( $options['features'][ $id ][ $feature ] ) ) || isset( $seen[ $target['url'] ] ) ) {
					unset( $targets[ $feature ] );
				} else {
					$seen[ $target['url'] ] = true;
				}
			}
			if ( $targets ) {
				$branches[ $id ] = [ 'label' => $provider->name, 'targets' => $targets ];
			}
		}
		$contents = [];
		if ( $options['content'] ) {
			foreach ( self::content_types() as $key => $object ) {
				if ( ! in_array( $key, $options['excluded_types'], true ) && current_user_can( $object->cap->edit_posts ) ) {
					$contents[ $key ] = [ 'label' => $object->labels->name, 'url' => admin_url( 'edit.php?post_type=' . $key ) ];
				}
			}
		}
		$can_settings = current_user_can( 'manage_options' );
		if ( ! $branches && ! $contents && ! $can_settings ) {
			return;
		}
		$bar->add_node( [ 'id' => 'dtfq', 'title' => esc_html__( 'Types & Fields', 'types-fields-quicknav' ), 'href' => $can_settings ? Settings::url() : false ] );
		foreach ( $branches as $id => $branch ) {
			$parent = 'dtfq-' . $id;
			$bar->add_node( [ 'id' => $parent, 'parent' => 'dtfq', 'title' => esc_html( $branch['label'] ), 'href' => reset( $branch['targets'] )['url'] ] );
			$groups = [];
			foreach ( $branch['targets'] as $feature => $target ) {
				$target_parent = $parent;
				if ( isset( $target['addon'] ) ) {
					$extensions = $parent . '-addons';
					if ( ! isset( $groups['root'] ) ) {
						$bar->add_node( [ 'id' => $extensions, 'parent' => $parent, 'title' => esc_html__( 'Add-ons', 'types-fields-quicknav' ) ] );
						$groups['root'] = true;
					}
					$target_parent = $extensions;
					if ( 'acfe' === $target['addon'] ) {
						$target_parent = $extensions . '-acfe';
						if ( ! isset( $groups['acfe'] ) ) {
							$bar->add_node( [ 'id' => $target_parent, 'parent' => $extensions, 'title' => 'ACF Extended', 'href' => esc_url( $target['url'] ) ] );
							$groups['acfe'] = true;
						}
					}
				}
				$bar->add_node( [ 'id' => $parent . '-' . $feature, 'parent' => $target_parent, 'title' => esc_html( $target['label'] ), 'href' => esc_url( $target['url'] ) ] );
			}
		}
		if ( $contents ) {
			$bar->add_node( [ 'id' => 'dtfq-content', 'parent' => 'dtfq', 'title' => esc_html__( 'Content lists', 'types-fields-quicknav' ) ] );
			foreach ( $contents as $id => $target ) {
				$bar->add_node( [ 'id' => 'dtfq-content-' . $id, 'parent' => 'dtfq-content', 'title' => esc_html( $target['label'] ), 'href' => esc_url( $target['url'] ) ] );
			}
		}
		if ( $can_settings ) {
			$bar->add_node( [ 'id' => 'dtfq-settings', 'parent' => 'dtfq', 'title' => esc_html__( 'QuickNav Settings', 'types-fields-quicknav' ), 'href' => Settings::url() ] );
		}
	}
}
