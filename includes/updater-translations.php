<?php
/** Copy into the host adapter and replace the types-fields-quicknav textdomain with its literal domain. */
defined( 'ABSPATH' ) || exit;
/**
 * Resolve an updater source string in the host textdomain.
 * @param string $message English updater message.
 * @return string Translated host message, or original source text.
 */
return static function ( string $message ): string {
    // Literal calls let the host's normal translation extractor collect every source string.
    switch ( $message ) {
        case 'Private mode must be boolean.':
            return __( 'Private mode must be boolean.', 'types-fields-quicknav' );
        case 'Invalid authentication provider.':
            return __( 'Invalid authentication provider.', 'types-fields-quicknav' );
        case 'The plugin must be installed in a stable slug directory.':
            return __( 'The plugin must be installed in a stable slug directory.', 'types-fields-quicknav' );
        case 'Invalid GitHub repository URL.':
            return __( 'Invalid GitHub repository URL.', 'types-fields-quicknav' );
        case 'The private update could not be authorized. Check the repository credentials and refresh updates.':
            return __( 'The private update could not be authorized. Check the repository credentials and refresh updates.', 'types-fields-quicknav' );
        case 'Could not create the update download file.':
            return __( 'Could not create the update download file.', 'types-fields-quicknav' );
        case 'The private update download failed. Check credentials and try again.':
            return __( 'The private update download failed. Check credentials and try again.', 'types-fields-quicknav' );
        case 'Could not access the update filesystem.':
            return __( 'Could not access the update filesystem.', 'types-fields-quicknav' );
        case 'GitHub release does not contain the plugin main file.':
            return __( 'GitHub release does not contain the plugin main file.', 'types-fields-quicknav' );
        case 'Could not prepare the GitHub release package.':
            return __( 'Could not prepare the GitHub release package.', 'types-fields-quicknav' );
        case 'See the release on GitHub.':
            return __( 'See the release on GitHub.', 'types-fields-quicknav' );
        case 'Git Updater is active. If a deckerweb installation or update fails, temporarily deactivate Git Updater and retry. Reactivate it afterwards if other plugins or themes need it. Only leave it disabled when those extensions have another reliable update provider.':
            return __( 'Git Updater is active. If a deckerweb installation or update fails, temporarily deactivate Git Updater and retry. Reactivate it afterwards if other plugins or themes need it. Only leave it disabled when those extensions have another reliable update provider.', 'types-fields-quicknav' );
        case 'Manage installed plugins':
            return __( 'Manage installed plugins', 'types-fields-quicknav' );
        case 'Dismiss this notice':
            return __( 'Dismiss this notice', 'types-fields-quicknav' );
        case 'Permission denied.':
            return __( 'Permission denied.', 'types-fields-quicknav' );
        case 'Public catalog callbacks require both providers and cannot be used in private mode.':
            return __( 'Public catalog callbacks require both providers and cannot be used in private mode.', 'types-fields-quicknav' );
        case 'The approved release could not be verified.':
            return __( 'The approved release could not be verified.', 'types-fields-quicknav' );
        case 'The approved release changed. Refresh updates first.':
            return __( 'The approved release changed. Refresh updates first.', 'types-fields-quicknav' );
        default:
            return $message;
    }
};
