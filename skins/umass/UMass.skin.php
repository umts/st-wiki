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
    $out->prependHTML( umassHead() );
    $out->addHTML( umassFoot() );
  }

  function umassHead(){
    return <<<HTML
      <div id="topbanner">
        <a href="http://umass.edu/">
          <img id="banner_wordmark" src="http://umass.edu/umhome/identity/top_banner_06/mar-wordmark.gif" alt="UMass Amherst">
        </a>
        <form id="banner_search" action="http://googlebox.oit.umass.edu/search" method="get" name="gs">
          <div>
            <label for="q">
              <input name="q" id="q" size="22" placeholder="Search UMass Amherst" type="text">
            </label>
            <input input="submit" name="sa" value="Go" type="submit">
            <input name="site" value="default_collection" type="hidden">
            <input name="client" value="default_frontend" type="hidden">
            <input name="proxystylesheet" value="default_frontend" type="hidden">
            <input name="output" value="xml_no_dtd" type="hidden">
          </div>
        </form>
      </div>
HTML;
  }

  function umassFoot(){
  return <<<HTML
    <div id='umass-footer'>
      <p>&copy;&nbsp;2014 <a href="http://umass.edu/">University of Massachusetts Amherst</a>
         <span>&bull;</span> <a href="http://umass.edu/umhome/policies/">Site Policies</a>
         <span>&bull;</span> <a href="http://umass.edu/transit/">Site Contact</a>
      </p>
    </div>
HTML;
  }
