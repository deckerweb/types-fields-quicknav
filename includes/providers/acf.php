<?php
/** Advanced Custom Fields adapter. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;
/** Uses registered definition types and ACF's configured administration access. */
class ACF extends Provider {
	public string $id = 'acf';
	public string $name = 'ACF';
	/** @return array Available ACF definition destinations; no option-value pages. */
	public function targets(): array {
		if ( ! acf_get_setting( 'show_admin' ) || ! current_user_can( acf_get_setting( 'capability' ) ) ) {
			return [];
		}
		return $this->available( [
			'fields' => $this->definition( 'acf-field-group', __( 'Field groups', 'types-fields-quicknav' ), true ),
			'post_types' => $this->definition( 'acf-post-type', __( 'Manage post types', 'types-fields-quicknav' ), true ),
			'taxonomies' => $this->definition( 'acf-taxonomy', __( 'Manage taxonomies', 'types-fields-quicknav' ), true ),
			'options' => $this->definition( 'acf-ui-options-page', __( 'Manage options pages', 'types-fields-quicknav' ), true ),
		] );
	}
}
