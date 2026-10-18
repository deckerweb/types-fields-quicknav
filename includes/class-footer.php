<?php
/** Local admin footer and structured documents. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;

/** Renders the shared deckerweb presentation with host-scoped, escaped document content. */
final class Footer {
	/** @return void Prints one footer and closed native dialogs on the authorized settings page. */
	public static function render(): void {
		$de = str_starts_with( determine_locale(), 'de' );
		$suffix = $de ? '-de' : '';
		$documents = require __DIR__ . '/documents.php';
		$documents = $documents[ 'de_DE_formal' === determine_locale() ? 'de_formal' : ( $de ? 'de' : 'en' ) ];
		$links = [ 'about' => [ __( 'About', 'types-fields-quicknav' ), 'README' . $suffix . '.md' ], 'documentation' => [ __( 'Documentation', 'types-fields-quicknav' ), 'docs/README' . $suffix . '.md' ], 'history' => [ __( 'Changelog', 'types-fields-quicknav' ), 'CHANGELOG' . $suffix . '.md' ] ];
		echo '<footer class="dtfq-footer" aria-label="' . esc_attr__( 'About', 'types-fields-quicknav' ) . '"><div><strong>Types &amp; Fields QuickNav</strong> <span>' . esc_html__( 'Version', 'types-fields-quicknav' ) . ' ' . esc_html( DTFQ_VERSION ) . '</span><nav aria-label="' . esc_attr__( 'Documentation', 'types-fields-quicknav' ) . '">';
		foreach ( $links as $id => [ $label, $file ] ) {
			echo '<a href="' . esc_url( plugins_url( $file, DTFQ_FILE ) ) . '" data-dtfq-dialog="dtfq-' . esc_attr( $id ) . '">' . esc_html( $label ) . '</a>';
		}
		echo '</nav><p>' . esc_html__( 'Short paths to your types and fields.', 'types-fields-quicknav' ) . '</p></div><div><span>© 2026 <a href="https://github.com/deckerweb" target="_blank" rel="noopener noreferrer">David Decker – DECKERWEB</a></span><a href="https://deckerweb.github.io/types-fields-quicknav/" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Website', 'types-fields-quicknav' ) . '</a></div></footer>';
		foreach ( $links as $id => [ $label, $file ] ) {
			echo '<dialog hidden class="dtfq-document-dialog" id="dtfq-' . esc_attr( $id ) . '" aria-labelledby="dtfq-' . esc_attr( $id ) . '-title"><div class="dtfq-document-header"><h2 id="dtfq-' . esc_attr( $id ) . '-title">' . esc_html( $label ) . '</h2><form method="dialog"><button type="submit" class="button" data-dtfq-close>' . esc_html__( 'Close', 'types-fields-quicknav' ) . '</button></form></div><div class="dtfq-document-content" tabindex="0">';
			if ( 'history' === $id ) {
				self::history();
			} else {
				foreach ( $documents[ $id ] as $block ) {
					$tag = 'heading' === $block['type'] ? 'h3' : 'p';
					echo '<' . $tag . '>' . esc_html( $block['text'] ) . '</' . $tag . '>';
				}
				if ( 'documentation' === $id ) {
					echo '<p><a href="https://github.com/deckerweb/types-fields-quicknav/wiki/' . ( $de ? 'Home-de' : 'Home' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Documentation', 'types-fields-quicknav' ) . '</a></p>';
				}
			}
			echo '</div></dialog>';
		}
	}

	/** @return void Prints ordered release headings, dates and escaped entries with category badges. */
	private static function history(): void {
		$categories = [ 'new' => __( 'New:', 'types-fields-quicknav' ), 'improved' => __( 'Improved:', 'types-fields-quicknav' ), 'fixed' => __( 'Fixed:', 'types-fields-quicknav' ), 'misc' => __( 'Misc:', 'types-fields-quicknav' ) ];
		foreach ( require __DIR__ . '/history.php' as $release ) {
			echo '<section class="dtfq-changelog-release"><div class="dtfq-changelog-version"><h3>' . esc_html( $release['version'] ) . '</h3><time datetime="' . esc_attr( $release['date'] ) . '">' . esc_html( wp_date( get_option( 'date_format' ), strtotime( $release['date'] . ' 12:00:00 UTC' ), new \DateTimeZone( 'UTC' ) ) ) . '</time></div><ul class="dtfq-changelog-entries">';
			foreach ( $categories as $key => $label ) {
				foreach ( $release['entries'] as $entry ) {
					if ( $key === $entry['category'] ) {
						echo '<li><span class="dtfq-changelog-badge dtfq-changelog-' . esc_attr( $key ) . '">' . esc_html( $label ) . '</span><span>' . esc_html( translate( $entry['text'], 'types-fields-quicknav' ) ) . '</span></li>';
					}
				}
			}
			echo '</ul></section>';
		}
	}
}
