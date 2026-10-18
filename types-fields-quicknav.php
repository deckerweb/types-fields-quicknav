<?php
/**
 * Plugin Name: Types & Fields QuickNav
 * Plugin URI: https://github.com/deckerweb/types-fields-quicknav
 * Description: Quick toolbar access to available content type and custom field administration.
 * Version: 1.0.0
 * Requires at least: 7.1.2
 * Requires PHP: 8.2
 * Author: David Decker – DECKERWEB
 * Author URI: https://github.com/deckerweb
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: types-fields-quicknav
 * Domain Path: /languages/
 * Update URI: https://github.com/deckerweb/types-fields-quicknav
 * GitHub Plugin URI: https://github.com/deckerweb/types-fields-quicknav
 *
 * Copyright © 2026 David Decker – DECKERWEB.
 * SPDX-License-Identifier: GPL-2.0-or-later
 */

defined( 'ABSPATH' ) || exit;
define( 'DTFQ_FILE', __FILE__ );
define( 'DTFQ_VERSION', '1.0.0' );
require_once __DIR__ . '/includes/deckerweb-plugin-library/bootstrap.php';
deckerweb_library_register_v2( __FILE__, [], __DIR__ . '/includes/deckerweb-plugin-library' );
if ( is_admin() || wp_doing_cron() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once __DIR__ . '/includes/components.php';
}
require_once __DIR__ . '/includes/class-provider.php';
require_once __DIR__ . '/includes/class-plugin.php';
require_once __DIR__ . '/includes/class-settings.php';
add_action( 'init', [ '\Deckerweb\TypesFieldsQuickNav\Plugin', 'boot' ], 30 );
