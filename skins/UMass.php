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
		$template = 'UMassTemplate', $useHeadElement = true;

  public function initPage( OutputPage $out ){
    parent::initPage( $out );

    $scripts = array( 'skins.umass.js' );
    $out->addModules( $scripts );
  }

	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$styles = array( 'skins.umass' );
		$out->addModuleStyles( $styles );
	}
}

class UMassTemplate extends VectorTemplate {
  public function execute() {
    parent::execute();
    ?><div id="topbanner">
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
      <div id='umass-footer'>
        <p>&copy;&nbsp;2014 <a href="http://umass.edu/">University of Massachusetts Amherst</a>
           <span>&bull;</span> <a href="http://umass.edu/umhome/policies/">Site Policies</a>
           <span>&bull;</span> <a href="http://umass.edu/transit/">Site Contact</a>
        </p>
      </div><?php
  }
}
