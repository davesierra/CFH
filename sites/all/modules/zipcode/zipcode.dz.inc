<?php
// $Id: zipcode.dz.inc,v 1.2 2010/05/26 15:02:41 thierrygd Exp $

// Copyright 2010 Thierry GUEGAN http://www.arvoriad.com

/**
 * @file
 * CCK Field for Algerian zipcodes.
 */

/**
 * Verification for Algerian zipcodes.
 *
 * @param string $text
 * @return boolean Returns boolean FALSE if the zipcode is not valid.
 * On success, returns a string containting the zipcode with some formatting.
 */
function valid_dz_zipcode($zipcodestring) {

  $zipcodestring = trim($zipcodestring);

  if (!preg_match("/^[0-9]{5}$/i",$zipcodestring)) {
  	return FALSE;
  }
  //right now just do a quick check ==> has to be improved
  //need to check more precisely by doing a query on a zipcode table, ...
  else
  {
	return TRUE;
  }
}

/**
 * Formatting for zipcode.
 *
 * @param string $zipcodestring
 * @return string Returns a string containting the zipcode with some formatting.
 */
function format_dz_zipcode($zipcodestring) {

  $zipcodestring = trim($zipcodestring);
  //do some formatting
  return $zipcodestring;
}
