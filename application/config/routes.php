<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard/index';

// $route['country_management'] = 'country/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['spreadsheet'] = 'PhpspreadsheetController';
$route['spreadsheet/import'] = 'PhpspreadsheetController/import';
$route['spreadsheet/export'] = 'PhpspreadsheetController/export';
