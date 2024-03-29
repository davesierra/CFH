<?php
// $Id: phone.pk.inc,v 1.5 2010/05/26 13:55:39 thierrygd Exp $

/**
 * @file
 * CCK Field for Pakistanese phone numbers.
 */

function phone_pk_metadata() {
  // These strings are translated using t() on output.
  return array(
    'label' => 'Pakistan Phone Numbers',
    'error' => '"%value" is not a valid Pakistanese mobile phone number<br>Pakistanese phone numbers should only ...',
  );
}

/**
 * Verifies that $phonenumber is valid
 *
 * @param string $phonenumber
 * @return boolean Returns boolean FALSE if the phone number is not valid.
 */
function valid_pk_phone_number($phonenumber) {
  // define regular expression
  $regex = "/^(\+)?([9]{1}[2]{1})?-? ?(\()?([0]{1})?[1-9]{2,4}(\))?-? ??(\()?[1-9]{4,7}(\))?$/i";

  // return true if valid, false otherwise
  return (bool) preg_match($regex, $phonenumber);
}

/**
 * Formatting for Pakistan Phone Numbers.
 *
 * @param string $phonenumber
 * @return string Returns a string containting the phone number with some formatting.
 */
function format_pk_phone_number($phonenumber, $field) {

  //$phonenumber = trim($phonenumber);

   // do some formatting on the phone number

/* ==> to be done ==> add the country code 
   if ($field['phone_country_code']) {
      if ($matches[1] != "+39") {
  	$phonenumber = "+39" . " " . $phonenumber;
      }
   }
*/ 
   return $phonenumber;
}
