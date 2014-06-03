<?php
# This file was automatically generated by the MediaWiki installer.
# If you make manual changes, please keep track in case you need to
# recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.

# If you customize your file layout, set $IP to the directory that contains
# the other MediaWiki files. It will be used as a base to locate files.
if( defined( 'MW_INSTALL_PATH' ) ) {
	$IP = MW_INSTALL_PATH;
} else {
	$IP = dirname( __FILE__ );
}

$path = array( $IP, "$IP/includes", "$IP/languages" );
set_include_path( implode( PATH_SEPARATOR, $path ) . PATH_SEPARATOR . get_include_path() );

require_once( "includes/DefaultSettings.php" );

# If PHP's memory limit is very low, some operations may fail.
# ini_set( 'memory_limit', '20M' );

if ( $wgCommandLineMode ) {
	if ( isset( $_SERVER ) && array_key_exists( 'REQUEST_METHOD', $_SERVER ) ) {
		die( "This script must be run from the command line\n" );
	}
} elseif ( empty( $wgNoOutputBuffer ) ) {
	## Compress output if the browser supports it
	if( !ini_get( 'zlib.output_compression' ) ) @ob_start( 'ob_gzhandler' );
}

$wgSitename         = "Umass Transit ST Wiki";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
$wgScriptPath = "";         # Path to the actual files. This should already be there
$wgArticlePath = "/$1";  # Virtual path. This directory MUST be different from the one used in $wgScriptPath
$wgUsePathInfo = true;        # Enable use of pretty URLs

## For more information on customizing the URLs please see:
## http://www.mediawiki.org/wiki/Manual:Short_URL

$wgStylePath        = "$wgScriptPath/skins";
$wgStyleDirectory   = "$IP/skins";
//$wgDefaultSkin      = "umass";
$wgLogo             = "$wgStylePath/common/images/st_logo.gif";
$wgAllowUserCss     = true;

//Enable favicon.ico
$wgFavicon = "$wgScriptPath/favicon.ico";

$wgUploadPath       = "$wgScriptPath/images";
$wgUploadDirectory  = "$IP/images";

$wgEnableEmail      = true;
$wgEnableUserEmail  = true;

$wgEmergencyContact = "transit-it@admin.umass.edu";
$wgPasswordSender = "adam@umass.edu";

## For a detailed description of the following switches see
## http://meta.wikimedia.org/Enotif and http://meta.wikimedia.org/Eauthent
## There are many more options for fine tuning available see
## /includes/DefaultSettings.php
## UPO means: this is also a user preference option
$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

# Schemas for Postgres
$wgDBmwschema       = "mediawiki";
$wgDBts2schema      = "public";

# Experimental charset support for MySQL 4.1/5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = array();

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads             = true;
$wgUseImageResize            = true;
//$wgUseImageMagick            = true;
//$wgImageMagickConvertCommand = "/usr/local/bin/convert";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
# $wgHashedUploadDirectory = false;

## If you have the appropriate support software installed
## you can enable inline LaTeX equations:
$wgUseTeX           = false;

$wgLocalInterwiki   = $wgSitename;

$wgLanguageCode = "en";

$wgProxyKey = "50e6ed523cbefd09afb5adfa3d02136ab0b8a2b538fee322ac93706f6cbc02c4";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
# $wgEnableCreativeCommonsRdf = true;
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";
# $wgRightsCode = ""; # Not yet used

$wgDiff3 = "";

# When you make changes to this configuration file, this will make
# sure that cached pages are cleared.
$configdate = gmdate( 'YmdHis', @filemtime( __FILE__ ) );
$wgCacheEpoch = max( $wgCacheEpoch, $configdate );


#---------------------------------------------------------------------
# UMTS Added by Jeff 2006-01-05
#---------------------------------------------------------------------

/*
* Default privilege settings

 * Permission keys given to users in each group.
 * All users are implicitly in the '*' group including anonymous visitors;
 * logged-in users are all implicitly in the 'user' group. These will be
 * combined with the permissions of all groups that a given user is listed
 * in in the user_groups table.
 *
 * Functionality to make pages inaccessible has not been extensively tested
 * for security. Use at your own risk!
 *
 * This replaces wgWhitelistAccount and wgWhitelistEdit
 */
$wgGroupPermissions = array();

// Merged the default privs. with what was added later to reduce code.

// Default anon privileges. Implicit group for all visitors 
$wgGroupPermissions['*'    ]['createaccount']   = false;
$wgGroupPermissions['*'    ]['read']            = true;
$wgGroupPermissions['*'    ]['edit']            = true; //Not really, we protect every namespace below
$wgGroupPermissions['*'    ]['createpage']      = false;
$wgGroupPermissions['*'    ]['edittalk']        = true; //Anon users CAN edit talk pages
$wgGroupPermissions['*'    ]['createtalk']      = true;

// Implicit group for all logged-in accounts.
$wgGroupPermissions['user' ]['move']            = false;
$wgGroupPermissions['user' ]['read']            = true;
$wgGroupPermissions['user' ]['createpage']      = false;
$wgGroupPermissions['user' ]['createtalk']      = true;
$wgGroupPermissions['user' ]['upload']          = false;
$wgGroupPermissions['user' ]['reupload']        = false;
$wgGroupPermissions['user' ]['reupload-shared'] = false;
$wgGroupPermissions['user' ]['minoredit']       = false;


//Talk pages need the 'edittalk' permission (everyone has that)
$wgNamespaceProtection[NS_TALK] = array( 'edittalk' );

//Edit templates: allowed for priviliged users
$wgNamespaceProtection[NS_TEMPLATE] = array( 'editmain' );

//Edit most normal pages:  requires 'editpages', not 'edit'
$wgNamespaceProtection[NS_CATEGORY] = $wgNamespaceProtection[NS_PROJECT] =
$wgNamespaceProtection[NS_MAIN] = array( 'editpages' );

//Edit interfaces and special: only bureaucrats
$wgNamespaceProtection[NS_SPECIAL] = $wgNamespaceProtection[NS_MEDIAWIKI] = array( 'editinterface' );

// Implicit group for accounts that pass $wgAutoConfirmAge
//$wgGroupPermissions['autoconfirmed']['autoconfirmed'] = true;

// Implicit group for accounts with confirmed email addresses
// This has little use when email address confirmation is off
# Make it so users with confirmed e-mail addresses are in the group.
$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;
# Hide group from user list. 
$wgImplicitGroups = array( 'emailconfirmed' );
# Finally, set it to true for the desired group.
$wgGroupPermissions['emailconfirmed']['emailconfirmed'] = true;

// Users with bot privilege can have their edits hidden
// from various log pages by default
$wgGroupPermissions['bot'  ]['bot']             = true;
$wgGroupPermissions['bot'  ]['autoconfirmed']   = true;

// Most extra permission abilities go to sysops
$wgGroupPermissions['sysop']['block']           = true;
$wgGroupPermissions['sysop']['createaccount']   = true;
$wgGroupPermissions['sysop']['delete']          = true;
$wgGroupPermissions['sysop']['editinterface'] = true;

// can view deleted history entries, but not see or restore the text
$wgGroupPermissions['sysop']['deletedhistory']  = true;
$wgGroupPermissions['sysop']['move']            = true;
$wgGroupPermissions['sysop']['protect']         = true;
$wgGroupPermissions['sysop']['rollback']        = true;
$wgGroupPermissions['sysop']['upload']          = true;
$wgGroupPermissions['sysop']['reupload']        = true;
$wgGroupPermissions['sysop']['reupload-shared'] = true;
$wgGroupPermissions['sysop']['unwatchedpages']  = true;
$wgGroupPermissions['sysop']['autoconfirmed']   = true;

// To hide usernames from users and Sysops
// Added in 1.10.0, but not added into DefaultSettings.php until 1.13.0
$wgGroupPermissions['suppress']['hideuser'] = true;

// Permission to change users' group assignments
$wgGroupPermissions['bureaucrat']['userrights'] = true;

// The following are default to sysops, but given to bureacrats instead.
$wgGroupPermissions['bureaucrat']['editinterface']   = true;
$wgGroupPermissions['bureaucrat']['import']          = true;
$wgGroupPermissions['bureaucrat']['importupload']    = true;
$wgGroupPermissions['bureaucrat']['upload_by_url']   = true;
$wgGroupPermissions['bureaucrat']['trackback']       = true;
$wgGroupPermissions['bureaucrat']['proxyunbannable'] = true;
$wgGroupPermissions['bureaucrat']['patrol']          = true;

#----------------------------------------------------------------
#  Added Groups
#----------------------------------------------------------------

//create a special user group --> most access
$wgGroupPermissions['privileged' ]['move']            = true;
$wgGroupPermissions['privileged' ]['read']            = true;
$wgGroupPermissions['privileged' ]['edit']            = true;
$wgGroupPermissions['privileged' ]['createpage']      = true;
$wgGroupPermissions['privileged' ]['createtalk']      = true;
$wgGroupPermissions['privileged' ]['upload']          = true;
$wgGroupPermissions['privileged' ]['reupload']        = true;
$wgGroupPermissions['privileged' ]['reupload-shared'] = true;
$wgGroupPermissions['privileged' ]['minoredit']       = true;
$wgGroupPermissions['privileged' ]['rollback']        = true;
$wgGroupPermissions['privileged' ]['editmain'] 	      = true;

//group of users who have editing access
$wgGroupPermissions['editors' ]['move']            = false;
$wgGroupPermissions['editors' ]['read']            = true;
$wgGroupPermissions['editors' ]['edit']            = true;
$wgGroupPermissions['editors' ]['createpage']      = true;
$wgGroupPermissions['editors' ]['createtalk']      = true;
$wgGroupPermissions['editors' ]['minoredit']       = true;
$wgGroupPermissions['editors']['editpages'] 	   = true;

//groups of users who can upload
$wgGroupPermissions['uploaders' ]['upload']          = true;
$wgGroupPermissions['uploaders' ]['reupload']        = true;
$wgGroupPermissions['uploaders' ]['reupload-shared'] = true;

//Will change lookupcreds to bureaucrat if extension will still work.
$wgGroupPermissions['sysop' ]['lookupcredentials'] 	= true;

//removes talk page link for non-logged-in users
$wgShowIPinHeader = false; 

//Added to support additional file types - adam 2007.01.18
$wgFileExtensions = array( 'png', 'gif', 'emf', 'wmf', 'jpg', 'jpeg', 'pdf', 'svg');

require_once $IP.'/extensions/cite/Cite.php' ;	
require_once( $IP.'/extensions/cite/SpecialCite.php' );
require_once( "$IP/extensions/ParserFunctions/ParserFunctions.php" );

// Confirm account extension disables direct account creation and requires approval of accounts by bureaucrats. FROZEN UNTIL WM 1.11 UPDATE
include_once( $IP.'/extensions/ConfirmAccount/SpecialConfirmAccount.php' );
#$wgAccountRequestTypes = array( 'readers', 'editors', 'users' );
$wgAccountRequestTypes = array( 0 => array( 'Drivers', 'editors' ),
                                1 => array( 'Passengers', 'users' ),
                                2 => array( 'Staff', 'bureaucrat' ) );
$wgConfirmAccountSaveInfo = true;
$wgUseRealNamesOnly = false;
$wgAccountRequestToS = false;
$wgAccountRequestExtraInfo = false;
$wgAccountRequestMinWords = 0;
$wgGroupPermissions['sysop' ]['confirmaccount']		= true;
$wgGroupPermissions['bureaucrat' ]['requestips'] 	= true;

//To enable Captchas/Confirm Edit extensions. -1/3/08 LB2
//Keys are in the Sensitive file.
require_once( "$IP/extensions/ConfirmEdit/ConfirmEdit.php" );
require_once("$IP/extensions/ConfirmEdit/ReCaptcha.php");
$wgCaptchaClass = 'ReCaptcha';

$wgUseAjax = true;
require_once("{$IP}/extensions/CategoryTree/CategoryTree.php");

require_once ( "$IP/extensions/SecurePages/SecurePages.php" );
$wgSecurePages = array(-1 => array( 'UserLogin', 'Preferences', 'ChangePassword'),);

include 'Sensitive.php';
?>
