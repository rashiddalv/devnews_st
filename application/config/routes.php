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
// ====================== User Start ========================================

$route['default_controller'] = 'UserController';
$route['index']              = 'UserController/index';
$route['about_us']           = 'UserController/about_us';
$route['blog']               = 'UserController/blog';
$route['contact']            = 'UserController/contact';
$route['category']           = 'UserController/category';

// ====================== User End ==========================================


// ====================== Admin Start =======================================

$route['login_dashboard']                       = 'AdminController/index';
$route['register']                              = 'AdminController/register';
$route['admin_settings']                        = 'AdminController/admin_settings';
$route['admin_settings_act']                    = 'AdminController/admin_settings_act';
$route['login_act']                             = 'AdminController/login_act';
$route['log_out']                               = 'AdminController/log_out';
$route['register_act']                          = 'AdminController/register_act';

$route['admin_dashboard']                       = 'AdminController/dashboard';
$route['admin_news']                            = 'AdminController/news';
$route['admin_news_create']                     = 'AdminController/news_create';
$route['admin_news_create_act']                 = 'AdminController/news_create_act';
$route['admin_news_delete/(.*)']                = 'AdminController/news_delete/$1';
$route['admin_news_detail/(.*)']                = 'AdminController/news_detail/$1';

$route['admin_news_update/(.*)']                = 'AdminController/news_update/$1';


$route['pass_forgot']                           = 'AdminController/pass_forgot';
$route['pass_forgot_act']                       = 'AdminController/pass_forgot_act';


// ====================== Admin End   =======================================

// $route['contact'] = 'UserController/contact';





$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
