<?php
/** JetEngine administration adapter. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;
/** Includes only live registered JetEngine menu destinations with their actual capability. */
final class JetEngine extends Provider {
	public string $id = 'jetengine';
	public string $name = 'JetEngine';
	/** @return array Available JetEngine destinations; menu-dependent links are admin-only. */
	public function targets(): array {
		return $this->available( [
			'fields' => $this->menu( [ 'jet-engine-meta' ], __( 'Field groups', 'types-fields-quicknav' ) ),
			'post_types' => $this->menu( [ 'jet-engine-cpt' ], __( 'Manage post types', 'types-fields-quicknav' ) ),
			'taxonomies' => $this->menu( [ 'jet-engine-cpt-tax' ], __( 'Manage taxonomies', 'types-fields-quicknav' ) ),
			'options' => $this->menu( [ 'jet-engine-options-pages' ], __( 'Manage options pages', 'types-fields-quicknav' ) ),
			'settings' => $this->menu( [ 'jet-engine' ], __( 'Settings and modules', 'types-fields-quicknav' ) ),
		] );
	}
}
