<?php
/** ACPT administration adapter. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;
/** Uses exact ACPT menu registrations; unrelated plugins with similar names are excluded. */
final class ACPT extends Provider {
	public string $id = 'acpt';
	public string $name = 'ACPT';
	/** @return array Live ACPT management destinations. */
	public function targets(): array {
		return $this->available( [
			'post_types' => $this->menu( [ 'acpt-lite', 'advanced-custom-post-type' ], __( 'Manage post types', 'types-fields-quicknav' ), true ),
			'fields' => $this->menu( [ 'acpt-lite#/meta', 'advanced-custom-post-type#/meta' ], __( 'Field groups', 'types-fields-quicknav' ) ),
			'taxonomies' => $this->menu( [ 'acpt-lite#/taxonomies', 'advanced-custom-post-type#/taxonomies' ], __( 'Manage taxonomies', 'types-fields-quicknav' ) ),
			'options' => $this->menu( [ 'advanced-custom-post-type#/option-pages' ], __( 'Manage options pages', 'types-fields-quicknav' ) ),
			'settings' => $this->menu( [ 'acpt-lite#/settings', 'advanced-custom-post-type#/settings' ], __( 'Settings', 'types-fields-quicknav' ) ),
		] );
	}
}
