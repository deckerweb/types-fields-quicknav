<?php
/** Meta Box feature adapter. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;
/** Detects actual Builder/CPT/settings definition types instead of a premium flag. */
final class MetaBox extends Provider {
	public string $id = 'meta_box';
	public string $name = 'Meta Box';
	/** @return array Available Meta Box definition destinations. */
	public function targets(): array {
		return $this->available( [
			'fields' => $this->definition( 'meta-box', __( 'Field groups', 'types-fields-quicknav' ) ),
			'post_types' => $this->definition( 'mb-post-type', __( 'Manage post types', 'types-fields-quicknav' ) ),
			'taxonomies' => $this->definition( 'mb-taxonomy', __( 'Manage taxonomies', 'types-fields-quicknav' ) ),
			'options' => $this->definition( 'mb-settings-page', __( 'Manage options pages', 'types-fields-quicknav' ) ),

			'relationships' => $this->definition( 'mb-relationship', __( 'Relationships', 'types-fields-quicknav' ) ),
			'models' => $this->definition( 'mb-model', __( 'Models', 'types-fields-quicknav' ) ),
			'views' => $this->definition( 'mb-views', __( 'Views', 'types-fields-quicknav' ) ),
			'template' => $this->menu( [ 'meta-box-template' ], __( 'Template configuration', 'types-fields-quicknav' ) ),
			'extensions' => $this->menu( [ 'meta-box-aio' ], __( 'Extensions', 'types-fields-quicknav' ) ),
			'license' => $this->menu( [ 'meta-box-updater' ], __( 'License settings', 'types-fields-quicknav' ) ),
			'tools' => $this->menu( [ 'meta-box-tools' ], __( 'Tools', 'types-fields-quicknav' ) ),
			'migrate_acf' => $this->menu( [ 'mb-acf-migration' ], __( 'ACF migration', 'types-fields-quicknav' ) ),
			'migrate_toolset' => $this->menu( [ 'mb-toolset-migration' ], __( 'Toolset migration', 'types-fields-quicknav' ) ),
		] );
	}
}
