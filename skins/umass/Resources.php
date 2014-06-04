<?php
/*
 * Definition of resources (CSS and Javascript) required for this skin.
 * This file must be included from LocalSettings.php since that is the only way
 * that this file is included by loader.php
 */
global $wgResourceModules, $wgStylePath, $wgStyleDirectory;
$wgResourceModules['skins.umass'] = array(
   'styles' => array( 'umass/screen.css' => array( 'media' => 'screen') ),
   'remoteBasePath' => $wgStylePath,
   'localBasePath' => $wgStyleDirectory,
 );

$wgResourceModules['skins.umass.js'] = array(
  'scripts' => array( 'umass/headroom.min.js',
                      'umass/custom.js',
                      'umass/jQuery.headroom.min.js' ),
  'remoteBasePath' => $wgStylePath,
  'localBasePath' => $wgStyleDirectory,
 );
