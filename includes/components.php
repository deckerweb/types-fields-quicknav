<?php
/** Pinned shared component integration. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;
// Source: David Decker's deckerweb Updater 2.1.0, GPL-2.0-or-later; included unchanged.
if ( ! class_exists( '\Deckerweb\GitHubReleaseUpdater\V2\Updater' ) ) {
	require_once __DIR__ . '/deckerweb-github-release-updater-v2.php';
}
/**
 * Translate updater messages through the host catalog.
 * @param string $message Original component message.
 * @return string Localized host-domain message.
 */
$dtfq_translate = static function ( string $message ): string {
	return translate( $message, 'types-fields-quicknav' );
};
$dtfq_language = str_starts_with( determine_locale(), 'de' ) ? 'de' : 'en';
$dtfq_updater = new \Deckerweb\GitHubReleaseUpdater\V2\Updater(
	DTFQ_FILE,
	'https://github.com/deckerweb/types-fields-quicknav',
	'Types & Fields QuickNav',
	'Quick toolbar access to available content type and custom field administration.',
	[
		'icons' => [
			'svg' => plugins_url( 'assets/brand/icon.svg', DTFQ_FILE ),
			'1x' => plugins_url( 'assets/brand/icon-128x128.png', DTFQ_FILE ),
			'2x' => plugins_url( 'assets/brand/icon-256x256.png', DTFQ_FILE ),
		],
		'banners' => [
			'low' => plugins_url( 'assets/brand/wordpress-banner-' . $dtfq_language . '-772x250.png', DTFQ_FILE ),
			'high' => plugins_url( 'assets/brand/wordpress-banner-' . $dtfq_language . '-1544x500.png', DTFQ_FILE ),
		],
	],
	[ 'translate' => $dtfq_translate ]
);
$dtfq_updater->register();
