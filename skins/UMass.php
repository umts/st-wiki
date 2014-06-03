<?php
/**
* @file
* @ingroup Skins
* @author Matt Moretti
* @license BSD
**/

if ( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

/**
 * SkinTemplate class for Vector skin
 * @ingroup Skins
 */
class SkinUMass extends SkinVector {

	var $skinname = 'umass', $stylename = 'umass',
		$template = 'VectorTemplate', $useHeadElement = true;

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage( OutputPage $out ) {
		global $wgLocalStylePath;

		parent::initPage( $out );
	}

	/**
	 * Loads skin and user CSS files.
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$styles = array( 'skins.umass' );
		$out->addModuleStyles( $styles );
	}
}
