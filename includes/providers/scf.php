<?php
/** Secure Custom Fields integration. @package TypesFieldsQuickNav */
namespace Deckerweb\TypesFieldsQuickNav;
defined( 'ABSPATH' ) || exit;
require_once __DIR__ . '/acf.php';
/** Reuses the compatible API while retaining independent identity and settings. */
final class SCF extends ACF {
	public string $id = 'scf';
	public string $name = 'Secure Custom Fields';
}
