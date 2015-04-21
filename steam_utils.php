<?php
/**
 * SteamID PHP Conversion Functions
 * @author Paul van der Knaap <paul@vdvo.nl>
 * @modified 21-4-2015
 *
 * LICENSE: Free to use, modify and distribute in any form.df
 * Original Credits for the algoritm to voogru
 * https://forums.alliedmods.net/showthread.php?t=60899?t=60899
 *
 * This function requires the bclib library to be bundled with PHP.
 */

/**
 * Returns a steam64 id from a steamid.
 * @param $steamID a steamid (STEAM_0:x:xxxxxxxx)
 */
function steamIDto64($steamID){
	if(empty($steamID)){
		return 0;
	}

	$expl = explode(':',str_replace('STEAM_','',$steamID));
	if(count($expl) != 3){
		return 0;
	}

	$iServer = intval($expl[1]);
	$iAuthID = intval($expl[2]);

	$steamID64 = bcadd(bcadd(bcmul($iAuthID,2),'76561197960265728'),$iServer,0);

    return $steamID64;
}

/**
 * Returns a steamid from a 64-bit steamid.
 * @param $steam64ID a 64-bit steamid.
 */
function steam64toID($steam64ID){

	if(empty($steam64ID)){
		return 0;
	}

	$iServer = bcmod($steam64ID,2);
	$steamID = bcdiv(bcsub(bcsub($steam64ID,$iServer),'76561197960265728'),2,0);

	return 'STEAM_0:'.$iServer.':'.$steamID;
}

$dta =  steamIDto64('STEAM_0:1:24587308');
$dtaRev = steam64toID($dta);
var_dump($dta);
var_dump($dtaRev);
