<?php
/** Native, site-scoped configuration. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;

/** Owns a single small option and a compact WordPress settings screen. */
final class Settings {
	public const OPTION = 'dtfq_settings';
	/** @return void Registers admin hooks and the plugin action link. */
	public static function hooks(): void {
		add_action( 'admin_init', [ self::class, 'register' ] );
		add_action( 'admin_menu', [ self::class, 'menu' ] );
		add_action( 'admin_enqueue_scripts', [ self::class, 'assets' ] );
		add_filter( 'plugin_action_links_' . plugin_basename( DTFQ_FILE ), [ self::class, 'links' ] );
	}
	/** @return array Complete safe default settings. */
	public static function defaults(): array {
		$features = [];
		foreach ( Plugin::names() as $id => $name ) {
			$features[ $id ] = array_fill_keys( Plugin::provider_features( $id ), true );
		}
		return [ 'schema' => 1, 'frontend' => false, 'content' => false, 'delete_data' => false, 'providers' => array_fill_keys( array_keys( Plugin::names() ), true ), 'features' => $features, 'addons' => array_fill_keys( [ 'acfe', 'better_search', 'font_awesome' ], false ), 'excluded_types' => [], 'blocked_roles' => [], 'blocked_users' => [] ];
	}
	/** @return array Normalized stored settings, including defaults for absent fields. */
	public static function get(): array {
		$stored = get_option( self::OPTION, [] );
		return is_array( $stored ) ? array_replace_recursive( self::defaults(), $stored ) : self::defaults();
	}
	/** @return string Website settings URL. */
	public static function url(): string {
		return admin_url( 'options-general.php?page=types-fields-quicknav' );
	}
	/** @return void Registers Settings API sanitation; Core enforces POST nonce and manage_options. */
	public static function register(): void {
		register_setting( 'dtfq', self::OPTION, [ 'type' => 'array', 'sanitize_callback' => [ self::class, 'sanitize' ], 'default' => self::defaults(), 'show_in_rest' => false ] );
	}
	/**
	 * Keep only allowlisted booleans and registered content type exclusions.
	 * @param mixed $input Submitted option value.
	 * @return array Safe complete option; unauthorized calls preserve the stored configuration.
	 */
	public static function sanitize( $input ): array {
		if ( ! current_user_can( 'manage_options' ) || ! is_array( $input ) ) {
			return self::get();
		}
		$out = self::defaults();
		foreach ( [ 'frontend', 'content', 'delete_data' ] as $key ) {
			$out[ $key ] = isset( $input[ $key ] ) && in_array( $input[ $key ], [ true, 1, '1' ], true );
		}
		foreach ( Plugin::names() as $id => $name ) {
			$out['providers'][ $id ] = isset( $input['providers'][ $id ] ) && in_array( $input['providers'][ $id ], [ true, 1, '1' ], true );
			foreach ( Plugin::provider_features( $id ) as $key ) {
				$out['features'][ $id ][ $key ] = isset( $input['features'][ $id ][ $key ] ) && in_array( $input['features'][ $id ][ $key ], [ true, 1, '1' ], true );
			}
		}
		foreach ( array_keys( $out['addons'] ) as $id ) {
			$out['addons'][ $id ] = isset( $input['addons'][ $id ] ) && in_array( $input['addons'][ $id ], [ true, 1, '1' ], true );
		}
		$requested = is_array( $input['excluded_types'] ?? null ) ? $input['excluded_types'] : [];
		$out['excluded_types'] = array_values( array_intersect( array_keys( Plugin::content_types() ), array_filter( $requested, 'is_string' ) ) );
		$roles = is_array( $input['blocked_roles'] ?? null ) ? array_filter( $input['blocked_roles'], 'is_string' ) : [];
		$out['blocked_roles'] = array_values( array_intersect( array_keys( wp_roles()->roles ), $roles ) );
		// Resolve explicit login names on settings save, never on toolbar requests.
		$names = is_string( $input['blocked_user_logins'] ?? null ) ? preg_split( '/[\r\n,]+/', $input['blocked_user_logins'], -1, PREG_SPLIT_NO_EMPTY ) : [];
		$invalid = array_key_exists( 'blocked_user_logins', $input ) && ! is_string( $input['blocked_user_logins'] );
		// WordPress may sanitize a new option twice: validate normalized IDs on the second pass.
		if ( ! array_key_exists( 'blocked_user_logins', $input ) && is_array( $input['blocked_users'] ?? null ) ) {
			foreach ( $input['blocked_users'] as $id ) {
				$valid_id = ( is_int( $id ) || ( is_string( $id ) && ctype_digit( $id ) ) ) && (int) $id > 0;
				$user = $valid_id ? get_userdata( (int) $id ) : false;
				if ( $user ) {
					$names[] = $user->user_login;
				} else {
					$invalid = true;
				}
			}
		}
		foreach ( array_unique( array_map( 'trim', $names ) ) as $login ) {
			if ( '' === $login ) {
				continue;
			}
			$user = get_user_by( 'login', $login );
			if ( ! $user || ( is_multisite() && ! is_user_member_of_blog( $user->ID ) && ! is_super_admin( $user->ID ) ) ) {
				$invalid = true;
				continue;
			}
			$out['blocked_users'][] = (int) $user->ID;
		}
		$out['blocked_users'] = array_values( array_unique( $out['blocked_users'] ) );
		if ( $invalid ) {
			$out['blocked_users'] = self::get()['blocked_users'];
			add_settings_error( self::OPTION, 'dtfq_invalid_users', __( 'Some usernames were not found on this website. The previous user exclusions have been kept.', 'types-fields-quicknav' ), 'error' );
		}
		return $out;
	}
	/** @return void Adds one website-scoped settings page, never a welcome dashboard. */
	public static function menu(): void {
		add_options_page( 'Types & Fields QuickNav', 'Types & Fields QuickNav', 'manage_options', 'types-fields-quicknav', [ self::class, 'render' ] );
	}
	/**
	 * Load the small settings-only stylesheet and native dialog controller.
	 * @param string $hook Current admin page suffix.
	 * @return void Enqueues local assets only on this settings page.
	 */
	public static function assets( string $hook ): void {
		if ( 'settings_page_types-fields-quicknav' !== $hook ) {
			return;
		}
		wp_enqueue_style( 'dtfq-settings', plugins_url( 'assets/settings.css', DTFQ_FILE ), [], DTFQ_VERSION . '.' . filemtime( __DIR__ . '/../assets/settings.css' ) );
		wp_enqueue_script( 'dtfq-dialog', plugins_url( 'assets/dialog.js', DTFQ_FILE ), [], DTFQ_VERSION . '.' . filemtime( __DIR__ . '/../assets/dialog.js' ), true );
	}
	/**
	 * Prepend the settings action only in its website context for authorized users.
	 * @param array $links Existing plugin action links.
	 * @return array Links with an authorized Settings link first.
	 */
	public static function links( array $links ): array {
		if ( current_user_can( 'manage_options' ) && ! is_network_admin() ) {
			array_unshift( $links, '<a href="' . esc_url( self::url() ) . '">' . esc_html__( 'Settings', 'types-fields-quicknav' ) . '</a>' );
		}
		return $links;
	}
	/**
	 * Output a native checkbox with an associated label.
	 * @param string $name Relative option field name.
	 * @param bool $value Current checked state.
	 * @param string $label Translated label.
	 * @param string $field_value Submitted scalar value.
	 * @return void Prints escaped form markup.
	 */
	private static function checkbox( string $name, bool $value, string $label, string $field_value = '1' ): void {
		$id = 'dtfq-' . sanitize_html_class( str_replace( [ '[', ']' ], '-', $name . $field_value ) );
		echo '<label for="' . esc_attr( $id ) . '"><input type="checkbox" id="' . esc_attr( $id ) . '" name="dtfq_settings' . esc_attr( $name ) . '" value="' . esc_attr( $field_value ) . '" ' . checked( $value, true, false ) . '> ' . esc_html( $label ) . '</label>';
	}

	/**
	 * Print a text-labelled state badge; color is supplementary.
	 * @param string $label Translated state.
	 * @param string $state Internal visual variant.
	 * @return void Prints escaped status markup.
	 */
	private static function badge( string $label, string $state ): void {
		echo '<span class="dtfq-badge dtfq-badge-' . esc_attr( $state ) . '">' . esc_html( $label ) . '</span>';
	}

	/**
	 * Render provider cards in the configured product order, preserving unavailable preferences.
	 * @param array $options Current website settings.
	 * @return void Prints labelled cards and native expandable navigation options.
	 */
	private static function providers( array $options ): void {
		$active = Plugin::providers();
		echo '<section class="dtfq-section" id="dtfq-providers" tabindex="-1" aria-labelledby="dtfq-providers-title"><h2 id="dtfq-providers-title">' . esc_html__( 'Providers and navigation', 'types-fields-quicknav' ) . '</h2><p>' . esc_html__( 'Only available destinations with sufficient permissions appear in the toolbar. Settings apply to this website.', 'types-fields-quicknav' ) . '</p><p class="description">' . esc_html__( 'Unavailable: the required module or administration page is missing, or permission is insufficient. Saved choices are retained.', 'types-fields-quicknav' ) . '</p><div class="dtfq-provider-list">';
		foreach ( Plugin::names() as $id => $name ) {
			$detected = isset( $active[ $id ] );
			$targets = $detected ? $active[ $id ]->targets() : [];
			echo '<article class="dtfq-card dtfq-provider' . ( $detected ? ' dtfq-card-active' : '' ) . '" id="dtfq-provider-' . esc_attr( $id ) . '" aria-labelledby="dtfq-provider-title-' . esc_attr( $id ) . '"><div class="dtfq-card-heading"><h3 id="dtfq-provider-title-' . esc_attr( $id ) . '">' . esc_html( $name ) . '</h3>';
			self::badge( $detected ? __( 'Active', 'types-fields-quicknav' ) : __( 'Not detected', 'types-fields-quicknav' ), $detected ? 'active' : 'neutral' );
			echo '</div>';
			if ( 'acf' === $id && $detected ) {
				echo '<p class="dtfq-card-context">' . esc_html( defined( 'ACF_PRO' ) && ACF_PRO ? 'Advanced Custom Fields Pro' : 'Advanced Custom Fields Free' ) . '</p>';
			}
			echo '<p class="dtfq-main-choice">';
			self::checkbox( '[providers][' . $id . ']', $options['providers'][ $id ], __( 'Show this provider in the toolbar', 'types-fields-quicknav' ) );
			echo '</p><details class="dtfq-navigation"' . ( $detected ? ' open' : '' ) . '><summary>' . esc_html__( 'Navigation options', 'types-fields-quicknav' ) . '</summary><div class="dtfq-features">';
			foreach ( Plugin::provider_features( $id ) as $key ) {
				echo '<div class="dtfq-feature">';
				self::checkbox( '[features][' . $id . '][' . $key . ']', $options['features'][ $id ][ $key ], Plugin::features()[ $key ] );
				if ( ! isset( $targets[ $key ] ) ) {
					self::badge( __( 'Unavailable', 'types-fields-quicknav' ), 'unavailable' );
				}
				echo '</div>';
			}
			echo '</div></details></article>';
		}
		echo '</div></section>';
	}

	/**
	 * Render independent add-on activity, provider requirements and toolbar switches.
	 * @param array $options Current website settings.
	 * @return void Prints three add-on cards without changing the foreign plugins.
	 */
	private static function addons( array $options ): void {
		$targets = ( new ACFAddons() )->targets();
		$available = array_column( $targets, 'addon' );
		echo '<section class="dtfq-section dtfq-addons-section" id="dtfq-addons" tabindex="-1" aria-labelledby="dtfq-addons-title"><h2 id="dtfq-addons-title">' . esc_html__( 'Add-ons', 'types-fields-quicknav' ) . '</h2><p>' . esc_html__( 'Add-on activity and QuickNav visibility are separate. These switches only control toolbar links; they do not activate or configure the add-ons.', 'types-fields-quicknav' ) . '</p><h3 class="dtfq-addon-group">' . esc_html__( 'Extensions for ACF', 'types-fields-quicknav' ) . '</h3><div class="dtfq-addon-list">';
		foreach ( ACFAddons::catalog() as $id => $addon ) {
			$ready = in_array( $id, $available, true );
			echo '<article class="dtfq-card dtfq-addon' . ( $addon['active'] ? ' dtfq-card-active' : '' ) . '" id="dtfq-addon-' . esc_attr( $id ) . '" aria-labelledby="dtfq-addon-title-' . esc_attr( $id ) . '"><div class="dtfq-card-heading"><h4 id="dtfq-addon-title-' . esc_attr( $id ) . '">' . esc_html( $addon['label'] ) . '</h4>';
			self::badge( $addon['active'] ? __( 'Active', 'types-fields-quicknav' ) : __( 'Not detected', 'types-fields-quicknav' ), $addon['active'] ? 'active' : 'neutral' );
			echo '</div><p class="dtfq-card-context">' . esc_html( sprintf( __( 'Extends: %s', 'types-fields-quicknav' ), $addon['provider'] ) ) . '</p><p class="dtfq-main-choice">';
			self::checkbox( '[addons][' . $id . ']', $options['addons'][ $id ], __( 'Show in the toolbar', 'types-fields-quicknav' ) );
			echo '</p><div class="dtfq-addon-availability">';
			self::badge( $ready ? __( 'Navigation available', 'types-fields-quicknav' ) : __( 'Unavailable', 'types-fields-quicknav' ), $ready ? 'available' : 'unavailable' );
			echo '<p class="description">' . esc_html( $ready ? __( 'Toolbar links follow the switch above and the provider switch.', 'types-fields-quicknav' ) : __( 'No accessible navigation targets. Check the required provider, enabled modules and permissions.', 'types-fields-quicknav' ) ) . '</p></div></article>';
		}
		echo '</div></section>';
	}

	/**
	 * Render site-scoped toolbar exclusions without listing the entire user database.
	 * @param array $options Current website settings.
	 * @return void Prints role choices and an explicit username list.
	 */
	private static function exclusions( array $options ): void {
		echo '<div class="dtfq-exclusions"><fieldset><legend><h3>' . esc_html__( 'Hide QuickNav for roles and users', 'types-fields-quicknav' ) . '</h3></legend><p>' . esc_html__( 'A matching role or username hides the entire Types & Fields QuickNav toolbar entry, including its settings link, in the administration area and frontend. These exclusions apply to this website only.', 'types-fields-quicknav' ) . '</p><p class="description">' . esc_html__( 'Users with several roles are excluded if any role matches. Administrators are not exempt. Authorized administrators can still open this settings page from the WordPress Settings menu.', 'types-fields-quicknav' ) . '</p><h4>' . esc_html__( 'Excluded roles', 'types-fields-quicknav' ) . '</h4><div class="dtfq-role-choices">';
		foreach ( wp_roles()->roles as $slug => $role ) {
			echo '<p>';
			self::checkbox( '[blocked_roles][]', in_array( $slug, $options['blocked_roles'], true ), translate_user_role( $role['name'] ), $slug );
			echo '</p>';
		}
		$names = [];
		foreach ( $options['blocked_users'] as $id ) {
			$user = get_userdata( (int) $id );
			if ( $user ) {
				$names[] = $user->user_login;
			}
		}
		echo '</div><h4><label for="dtfq-blocked-user-logins">' . esc_html__( 'Excluded users', 'types-fields-quicknav' ) . '</label></h4><textarea id="dtfq-blocked-user-logins" name="dtfq_settings[blocked_user_logins]" rows="4" class="large-text" aria-describedby="dtfq-blocked-users-help">' . esc_textarea( implode( "\n", $names ) ) . '</textarea><p class="description" id="dtfq-blocked-users-help">' . esc_html__( 'Enter exact WordPress usernames, one per line or separated by commas. These exclusions also apply when none of the user’s roles are selected above. Leave empty to remove user exclusions.', 'types-fields-quicknav' ) . '</p></fieldset></div>';
	}

	/** @return void Renders the authorized settings form and local changelog; no provider data is changed. */
	public static function render(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to manage these settings.', 'types-fields-quicknav' ) );
		}
		$options = self::get();
		echo '<div class="wrap dtfq-settings"><h1><img class="dtfq-brand-icon" src="' . esc_url( plugins_url( 'assets/brand/icon.svg', DTFQ_FILE ) ) . '" width="64" height="64" alt=""><span>Types &amp; Fields QuickNav<small class="dtfq-tagline">' . esc_html__( 'Short paths to your types and fields.', 'types-fields-quicknav' ) . '</small></span></h1><hr>';
		echo '<form method="post" action="' . esc_url( admin_url( 'options.php' ) ) . '">';
		settings_fields( 'dtfq' );
echo '<nav class="dtfq-jump-links" aria-label="' . esc_attr__( 'Settings sections', 'types-fields-quicknav' ) . '"><a href="#dtfq-providers">' . esc_html__( 'Providers and navigation', 'types-fields-quicknav' ) . '</a><span aria-hidden="true">|</span><a href="#dtfq-addons">' . esc_html__( 'Add-ons', 'types-fields-quicknav' ) . '</a><span aria-hidden="true">|</span><a href="#dtfq-general">' . esc_html__( 'General', 'types-fields-quicknav' ) . '</a></nav>';
		self::providers( $options );
		self::addons( $options );
		echo '<section class="dtfq-section dtfq-general-section" id="dtfq-general" tabindex="-1" aria-labelledby="dtfq-general-title"><h2 id="dtfq-general-title">' . esc_html__( 'General', 'types-fields-quicknav' ) . '</h2><h3>' . esc_html__( 'Toolbar display', 'types-fields-quicknav' ) . '</h3><p>';
		self::checkbox( '[frontend]', $options['frontend'], __( 'Also show navigation in the frontend toolbar', 'types-fields-quicknav' ) );
		echo '</p><p class="description">' . esc_html__( 'Menu-based provider destinations are shown in the administration area only. Frontend navigation includes verified definition post types and optional content lists.', 'types-fields-quicknav' ) . '</p><h3>' . esc_html__( 'Content lists', 'types-fields-quicknav' ) . '</h3><p>';
		self::checkbox( '[content]', $options['content'], __( 'Enable separate navigation to custom post type content lists', 'types-fields-quicknav' ) );
		echo '</p><p class="description">' . esc_html__( 'Off by default. These links open content lists, not type definitions.', 'types-fields-quicknav' ) . '</p>';
		foreach ( Plugin::content_types() as $key => $type ) {
			echo '<p>';
			self::checkbox( '[excluded_types][]', in_array( $key, $options['excluded_types'], true ), sprintf( __( 'Hide content list: %s', 'types-fields-quicknav' ), $type->labels->name ), $key );
			echo '</p>';
		}
		self::exclusions( $options );
		echo '<h3>' . esc_html__( 'Data', 'types-fields-quicknav' ) . '</h3><p>';
		self::checkbox( '[delete_data]', $options['delete_data'], __( 'Delete this website’s QuickNav settings when uninstalling', 'types-fields-quicknav' ) );
		echo '</p><p class="description">' . esc_html__( 'Off by default. Provider data and content are never deleted. Shared Library data follow the Library’s own settings.', 'types-fields-quicknav' ) . '</p>';
		echo '</section>';
		submit_button();
		echo '</form>';
		require_once __DIR__ . '/class-footer.php';
		Footer::render();
		echo '</div>';
	}
}
