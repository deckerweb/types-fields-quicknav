<?php
/** Provider contracts and conservative navigation helpers. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;

/** One independent provider integration; destinations are resolved for the current user. */
abstract class Provider {
	/** @var string Stable provider identifier. */
	public string $id;
	/** @var string Public provider name. */
	public string $name;

	/**
	 * Return permitted, available administration destinations.
	 * @return array<string,array> Destinations keyed by stable feature identifier.
	 */
	abstract public function targets(): array;

	/**
	 * Resolve a registered definition post type using its actual edit capability.
	 * @param string $type Registered definition post type.
	 * @param string $label Translated destination label.
	 * @param bool $manual_menu Provider registers its own administration menu for this type.
	 * @return array|null Navigation target, or null when unavailable or denied.
	 */
	protected function definition( string $type, string $label, bool $manual_menu = false ): ?array {
		$object = get_post_type_object( $type );
		if ( ! $object || ! $object->show_ui || ( ! $object->show_in_menu && ! $manual_menu ) || ! current_user_can( $object->cap->edit_posts ) ) {
			return null;
		}
		$slug = 'edit.php?post_type=' . $type;
		if ( is_admin() && ! $this->menu( [ $slug ], $label ) ) {
			return null;
		}
		return [ 'label' => $label, 'url' => admin_url( $slug ) ];
	}

	/**
	 * Resolve only exact allowlisted registered menu destinations and check their live capability.
	 * Admin globals are never initialized artificially on a frontend request.
	 * @param array $slugs Exact allowed menu slugs, in preference order.
	 * @param string $label Translated label.
	 * @param bool $submenu_only Require an actual feature submenu instead of its provider root.
	 * @return array|null Safe local target or null.
	 */
	protected function menu( array $slugs, string $label, bool $submenu_only = false ): ?array {
		global $menu, $submenu;
		if ( ! is_admin() || is_network_admin() || is_user_admin() ) {
			return null;
		}
		foreach ( $slugs as $slug ) {
			$rows = [];
			foreach ( $submenu_only ? [] : (array) $menu as $item ) {
				$rows[] = [ $item, '' ];
			}
			foreach ( (array) $submenu as $parent => $items ) {
				foreach ( $items as $item ) {
					$rows[] = [ $item, $parent ];
				}
			}
			foreach ( $rows as [ $item, $parent ] ) {
				if ( ( $item[2] ?? '' ) !== $slug || ! is_string( $item[1] ?? null ) || ! current_user_can( $item[1] ) ) {
					continue;
				}
				if ( str_contains( $slug, '.php' ) ) {
					if ( ! preg_match( '~^(?:edit|options-general|admin)\.php(?:\?[a-zA-Z0-9_=&%.-]+)?$~D', $slug ) ) {
						continue;
					}
					$url = admin_url( $slug );
				} else {
					if ( ! preg_match( '~^[a-zA-Z0-9_-]+(?:\#/[a-zA-Z0-9_/-]+)?$~D', $slug ) ) {
						continue;
					}
					$base = 'admin.php';
					if ( preg_match( '~^edit\.php\?post_type=[a-zA-Z0-9_-]+$~D', $parent ) ) {
						$base = $parent;
					}
					if ( preg_match( '~^(?:options-general|tools|themes)\.php$~D', $parent ) ) {
						$base = $parent;
					}
					$parts = explode( '#', $slug, 2 );
					$url = add_query_arg( 'page', $parts[0], admin_url( $base ) );
					if ( isset( $parts[1] ) ) {
						$url .= '#' . $parts[1];
					}
				}
				return [ 'label' => $label, 'url' => $url ];
			}
		}
		return null;
	}

	/**
	 * Remove unavailable targets while retaining stable feature keys.
	 * @param array $targets Candidate destinations.
	 * @return array Available targets only.
	 */
	protected function available( array $targets ): array {
		return array_filter( $targets, 'is_array' );
	}
}
