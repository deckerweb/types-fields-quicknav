<?php
/** Pods administration adapter. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;
/** Respects Pods' additional access checks; fields/types share the native Pod editor. */
final class Pods extends Provider {
	public string $id = 'pods';
	public string $name = 'Pods';
	/** @return array Available and authorized Pods administration links. */
	public function targets(): array {
		$targets = [];
		if ( defined( 'PODS_DISABLE_ADMIN_MENU' ) && PODS_DISABLE_ADMIN_MENU ) {
			return [];
		}
		foreach ( [ 'definitions' => [ 'pods', 'pods', __( 'Manage Pods and fields', 'types-fields-quicknav' ) ], 'settings' => [ 'pods-settings', 'pods_settings', __( 'Settings', 'types-fields-quicknav' ) ] ] as $id => [ $slug, $cap, $label ] ) {
			if ( ! pods_is_admin( $cap ) ) {
				continue;
			}
			$target = is_admin() ? $this->menu( [ $slug ], $label ) : null;
			if ( $target ) {
				$targets[ $id ] = $target;
			}
		}
		return $targets;
	}
}
