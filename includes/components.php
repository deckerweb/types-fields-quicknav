<?php
/** Pinned shared component integration. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;
// Source: deckerweb Updater 2.2.1, David Decker – DECKERWEB, GPL-2.0-or-later; runtime unchanged.
$dtfq_updater_class = require __DIR__ . '/deckerweb-github-release-updater-v2.php';
$dtfq_translate = require __DIR__ . '/updater-translations.php';
$dtfq_language = str_starts_with( determine_locale(), 'de' ) ? 'de' : 'en';
$dtfq_updater = new $dtfq_updater_class(
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

require_once __DIR__ . '/class-update-package.php';
add_filter( 'upgrader_source_selection', [ UpdatePackage::class, 'validate' ], 30, 4 );
