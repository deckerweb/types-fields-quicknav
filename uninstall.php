<?php
/** Site-scoped optional deletion and shared component cleanup. @package TypesFieldsQuickNav */
defined( 'WP_UNINSTALL_PLUGIN' ) || exit;
$dtfq_updater_class = require __DIR__ . '/includes/deckerweb-github-release-updater-v2.php';
$dtfq_updater_class::clear_repository_cache( 'https://github.com/deckerweb/types-fields-quicknav' );
require_once __DIR__ . '/includes/deckerweb-plugin-library/lifecycle.php';
deckerweb_library_uninstall_v3( __DIR__ . '/types-fields-quicknav.php' );

/**
 * Remove only this website's own settings when its opt-in is enabled.
 * @return void Preserves all provider data and shared component preferences.
 */
function dtfq_delete_site_settings(): void {
	$settings = get_option( 'dtfq_settings', [] );
	if ( is_array( $settings ) && true === ( $settings['delete_data'] ?? false ) ) {
		delete_option( 'dtfq_settings' );
	}
}
if ( is_multisite() ) {
	$dtfq_offset = 0;
	do {
		$dtfq_ids = get_sites( [ 'fields' => 'ids', 'number' => 100, 'offset' => $dtfq_offset ] );
		foreach ( $dtfq_ids as $dtfq_id ) {
			switch_to_blog( (int) $dtfq_id );
			dtfq_delete_site_settings();
			restore_current_blog();
		}
		$dtfq_offset += 100;
	} while ( count( $dtfq_ids ) === 100 );
} else {
	dtfq_delete_site_settings();
}
