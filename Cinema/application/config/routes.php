<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'BSController';
$route['main'] = 'BSController/main';
$route['login'] = 'BSController/login';
$route['signup'] = 'BSController/signup';
$route['(:any)/logout'] = 'BSController/logout';
$route['(:any)/(:any)/logout'] = 'BSController/logout';
$route['admin'] = 'BSController/admin';
$route['admin/movies'] = 'BSController/adminmovies';
$route['admin/movies/(:num)'] = 'BSController/adminmovies';
$route['admin/movies/view'] = 'BSController/adminviewmovie';
$route['admin/users'] = 'BSController/adminusers';
$route['admin/users/(:num)'] = 'BSController/adminusers';
$route['admin/users/view'] = 'BSController/adminviewuser';
$route['admin/transactions'] = 'BSController/admintransactions';
$route['admin/transactions/(:num)'] = 'BSController/admintransactions';
$route['user'] = 'BSController/user';
$route['user/movies'] = 'BSController/usermovies';
$route['user/movies/(:num)'] = 'BSController/usermovies';
$route['user/buy'] = 'BSController/userbuy';
$route['user/movies/buy'] = 'BSController/userbuy';
$route['user/mytransactions'] = 'BSController/usertransactions';
$route['user/mytransactions/(:num)'] = 'BSController/usertransactions';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
