<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageLoader
{
   function initialize() {
       $ci =& get_instance();
       $ci->load->helper('language');
       $siteLang = get_cookie('site_lang');
       if ($siteLang) {
           $ci->lang->load('content',$siteLang);
       } else {
           $ci->lang->load('content','english');
       }
   }
}
