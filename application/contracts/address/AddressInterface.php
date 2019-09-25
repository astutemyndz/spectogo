<?php namespace Contracts\Address;

interface AddressInterface {
  
    public function setAddress1($address1);
    public function setAddress2($address2);
    public function setCountry($country);
    public function setState($state);
    public function setCity($city);
    public function setZipCode($zipCode);
   
}