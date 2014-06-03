<?php
/**
 * Skin file for skin UMass
 *
 * @file
 * @ingroup Skins
 */
require_once( dirname(__FILE__) . '/../Vector.php' );

/**
 * SkinTemplate class for UMass skin
 * @ingroup Skins
 */
class SkinUMass extends SkinVector {
  var $skinname = 'umass', $stylename = 'umass';

  /**
   * @params $out OutputPage object
   */
  function setupSkinUserCss( OutputPage $out ){
    parent::setupSkinUserCss( $out );
    $out->addModuleStyles( 'skins.umass' );
  }
}
