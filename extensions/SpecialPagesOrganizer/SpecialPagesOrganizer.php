<?php
/* SpecialPagesOrganizer 0.2.2 - a special pages organizer for MediaWiki
 * Copyright (C) 2007  Artem Kaznatcheev
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
 
# Not a valid entry point, skip unless MEDIAWIKI is defined
if (!defined('MEDIAWIKI')) {exit( 1 );}
 
$wgExtensionCredits['other'][] = array(
        'name' => 'Specialpages Organizer',
        'version' => '0.4',
        'author' => 'Artem Kaznatcheev, Schneelocke',
        'description' => 'reorders the special pages on the specialpages page',
        'url' => 'http://www.mediawiki.org/wiki/Extension:SpecialPagesOrganizer'
);
 
$egDisplayNCSP = True; //default value
 
/* 
 * This function effectively replaces wfSpecialSpecialpages. It should be called by the 
 * 'SpecialPageExecuteBeforePage' hook. As data, this page will need an array of arrays 
 * to show how the categorization breaks down. The outer array is assosiative and should 
 * be indexed by the desired names of the section. The data each index holds is an array 
 * of all the items in that section, listed by their proper name (which can be found at 
 * the start of SpecialPages.php)
*/
function efReorderSpecial($order, $specialpage, $par, $func){
    // The if statement is to check for being on the right page. 
    // If on the wrong page, execution continues as normal
    if (($specialpage->getName()) != 'Specialpages'){
        return true;
        }
 
    global $wgOut, $wgUser, $egDisplayNCSP;
    $wgOut->setRobotpolicy( 'index,nofollow' );
    $sk = $wgUser->getSkin();
 
    //get the list of all Regular Special Pages
    $fullList = SpecialPage::getRegularPages(); 
 
    //for each section, populate the Special Pages
    foreach ($order as $head => $members) {
        $subList = array();
        foreach ($members as $member){
            $subList[$member] = $fullList[$member];
            unset($fullList[$member]); //remove the item from the fullList array
            }
        efReorderSpecialpages_gen($subList, $head, $sk);
        }
    wfSpecialSpecialpages_gen( SpecialPage::getRestrictedPages(), 'restrictedpheading', $sk );
    if ($egDisplayNCSP) efReorderSpecialpages_gen($fullList, 'Non-Categorized Specialpages', $sk); //generate the "Others" section
 
    return false;
    }
 
/* 
 * This function is made to output the ordered arrays, with the proper titles. Most of this 
 * function is copied from wfSpecialSpecialpages_gen in SpecialSpecialpages.php
 */
function efReorderSpecialpages_gen($pages,$heading,$sk) {
    global $wgOut, $wgSortSpecialPages;
 
    if( count( $pages ) == 0 ) {
        return;
    }
 
    $sortedPages = array();
    foreach ( $pages as $page ) {
        if ( $page && $page->isListed() ) {
            $sortedPages[$page->getDescription()] = $page->getTitle();
        }
    }
    if ( $wgSortSpecialPages ) {
        ksort( $sortedPages );
    }
 
    /* 
     *Now output the HTML
     * This section is modified to take the titles straight from the array, without "wfMsgHtml"
    */
    $wgOut->addHTML('<h2>'.$heading."</h2>\n<ul>");
    foreach ( $sortedPages as $desc => $title ) {
        $link = $sk->makeKnownLinkObj( $title , htmlspecialchars( $desc ) );
        $wgOut->addHTML( "<li>{$link}</li>\n" );
    }
    $wgOut->addHTML( "</ul>\n" );
}
 
//below is the hook that actually brings the array into the wiki
$wgHooks['SpecialPageExecuteBeforePage'][] = array('efReorderSpecial', $egOrderArray);
 
?>