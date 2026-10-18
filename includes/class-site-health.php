<?php
/** Read-only Site Health information. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;

/** Adds a compact website-scoped diagnostic summary without user identities or health tests. */
final class SiteHealth {
	/**
	 * Add plugin information for accounts permitted to inspect WordPress Site Health.
	 * @param array $info Existing Core and plugin diagnostic sections.
	 * @return array Existing sections plus this plugin's plain-text information, when authorized.
	 */
	public static function information( array $info ): array {
		if ( ! current_user_can( 'view_site_health_checks' ) ) {
			return $info;
		}
		$options = Settings::get();
		$names = Plugin::names();
		$detected = array_intersect_key( $names, Plugin::providers() );
		$enabled = array_filter( $names, static fn( $id ) => ! empty( $options['providers'][ $id ] ), ARRAY_FILTER_USE_KEY );
		$addons = [];
		foreach ( ACFAddons::catalog() as $id => $addon ) {
			if ( ! empty( $options['addons'][ $id ] ) ) {
				$addons[] = $addon['label'];
			}
		}
		$none = __( 'None', 'types-fields-quicknav' );
		$fields = [
			'version' => [ 'label' => __( 'Version', 'types-fields-quicknav' ), 'value' => DTFQ_VERSION ],
			'detected-providers' => [ 'label' => __( 'Detected providers', 'types-fields-quicknav' ), 'value' => $detected ? implode( ', ', $detected ) : $none, 'debug' => $detected ? implode( ', ', $detected ) : 'none' ],
			'enabled-providers' => [ 'label' => __( 'Providers enabled in QuickNav', 'types-fields-quicknav' ), 'value' => $enabled ? implode( ', ', $enabled ) : $none, 'debug' => $enabled ? implode( ', ', $enabled ) : 'none' ],
			'enabled-addons' => [ 'label' => __( 'Add-ons enabled in QuickNav', 'types-fields-quicknav' ), 'value' => $addons ? implode( ', ', $addons ) : $none, 'debug' => $addons ? implode( ', ', $addons ) : 'none' ],
		];
		$flags = [
			'frontend-navigation' => [ __( 'Frontend toolbar navigation enabled', 'types-fields-quicknav' ), ! empty( $options['frontend'] ) ],
			'content-lists' => [ __( 'Separate content lists enabled', 'types-fields-quicknav' ), ! empty( $options['content'] ) ],
			'role-exclusions' => [ __( 'Role exclusions configured', 'types-fields-quicknav' ), ! empty( $options['blocked_roles'] ) ],
			'user-exclusions' => [ __( 'User exclusions configured', 'types-fields-quicknav' ), ! empty( $options['blocked_users'] ) ],
		];
		foreach ( $flags as $id => [ $label, $enabled ] ) {
			$fields[ $id ] = [ 'label' => $label, 'value' => $enabled ? __( 'Yes', 'types-fields-quicknav' ) : __( 'No', 'types-fields-quicknav' ), 'debug' => $enabled ? 'yes' : 'no' ];
		}
		$info['types-fields-quicknav'] = [
			'label' => 'Types & Fields QuickNav',
			'description' => __( 'Settings apply to this website. Enabled switches do not imply that a provider or navigation destination is available. Exclusions are reported without role names, usernames or user IDs.', 'types-fields-quicknav' ),
			'fields' => $fields,
		];
		return $info;
	}
}
