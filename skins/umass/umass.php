<?php
/**
 * @file
 * @ingroup Skins
 * @author Matt Moretti
 * @license BSD
 */
if ( !defined( 'MEDIAWIKI' ) ) die( "This is an extension to MediaWiki and cannot be run standalone." );

$wgExtensionCredits['umass'][] = array (
  'path' => __FILE__,
  'name' => "UMass Skin",
  'url' => "http://umass.edu/transit/",
  'author' => "Matt Moretti",
  'descriptionmsg' => 'umass-desc'
);

$wgValidSkinNames['umass'] = "UMass";
$wgAutoloadClasses['SkinUMass'] = dirname(__FILE__).'UMass.skin.php';
$wgExtensionMessagesFiles['UMass'] = dirname(__FILE__).'UMass.i18n.php';

$wgResourceModules['skins.umass'] = array(
  'styles' => array(
    'umass/css/screen.css' => array( 'media' => 'screen' )
  ),
  'remoteBasePath' => &$GLOBALS['wgStylePath'],
  'localBasePath' => &$GLOBALS['wgStyleDirectory']
);
