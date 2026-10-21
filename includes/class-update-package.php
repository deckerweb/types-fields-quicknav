<?php
/** Host package identity and compatibility checks. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;

/** Validates the normalized candidate before WordPress replaces this plugin. */
final class UpdatePackage {
	/**
	 * Validate this host's single, automatic or native bulk update source.
	 *
	 * @param string|\WP_Error $source Normalized source directory or earlier failure.
	 * @param string $remote_source Original temporary extraction directory.
	 * @param mixed $upgrader Native upgrader instance.
	 * @param array $context Per-package operation metadata.
	 * @return string|\WP_Error Unchanged source or a localized rejection.
	 */
	public static function validate( $source, string $remote_source, $upgrader, array $context ) {
		if ( is_wp_error( $source ) || ( $context['plugin'] ?? '' ) !== plugin_basename( DTFQ_FILE )
			|| ( isset( $context['type'] ) && 'plugin' !== $context['type'] )
			|| ( isset( $context['action'] ) && 'update' !== $context['action'] ) ) {
			return $source;
		}
		if ( ! isset( $context['type'], $context['action'] )
			&& ! ( $upgrader instanceof \Plugin_Upgrader && true === $upgrader->bulk ) ) {
			return $source;
		}
		$file = is_string( $source ) ? trailingslashit( $source ) . 'types-fields-quicknav.php' : '';
		if ( ! is_string( $source ) || ! is_file( $file ) || is_link( $file ) || ! is_readable( $file ) ) {
			return new \WP_Error( 'dtfq_invalid_update_package', __( 'The update package does not match Types & Fields QuickNav or its requirements.', 'types-fields-quicknav' ) );
		}
		$headers = get_file_data( $file, [ 'name' => 'Plugin Name', 'domain' => 'Text Domain', 'uri' => 'Update URI', 'version' => 'Version', 'wp' => 'Requires at least', 'php' => 'Requires PHP' ] );
		$updates = get_site_transient( 'update_plugins' );
		$offer = is_object( $updates ) ? ( $updates->response[ plugin_basename( DTFQ_FILE ) ] ?? null ) : null;
		$expected = is_object( $offer ) && is_string( $offer->new_version ?? null ) ? $offer->new_version : '';
		$valid = 'Types & Fields QuickNav' === $headers['name'] && 'types-fields-quicknav' === $headers['domain']
			&& 'https://github.com/deckerweb/types-fields-quicknav' === $headers['uri']
			&& '' !== $expected && $expected === $headers['version'] && version_compare( $headers['version'], DTFQ_VERSION, '>' )
			&& '' !== $headers['wp'] && '' !== $headers['php']
			&& is_wp_version_compatible( $headers['wp'] ) && is_php_version_compatible( $headers['php'] );
		return $valid ? $source : new \WP_Error( 'dtfq_invalid_update_package', __( 'The update package does not match Types & Fields QuickNav or its requirements.', 'types-fields-quicknav' ) );
	}
}
