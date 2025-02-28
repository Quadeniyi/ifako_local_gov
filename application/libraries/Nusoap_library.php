<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('EXT', '.php');
class Nusoap_library
{
   function Nusoap_library()
   {
       require_once('lib/nusoap'.EXT);
   }
  /*  function __construct(){
               require_once(str_replace("\","/",APPPATH).'libraries/NuSOAP/lib/nusoap'.EXT); //If we are executing this script on a Windows server
          }*/
}