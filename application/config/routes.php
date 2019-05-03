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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['register'] = 'users/register';
$route['users/show/all'] = 'users/list_users';
$route['user/logout'] = 'users/user_logout';
$route['user/browser_logout'] = 'users/browser_logout';
$route['notifications'] = 'users/notifications';
$route['notifications/(:any)'] = 'users/notifications/$1';
$route['login'] = 'users/login';

$route['adminpanel/edit/(:any)/(:any)'] = "admin/edit/$1/$2";
$route['adminpanel/update/(:any)/(:any)'] = "admin/update/$1/$2";
$route['adminpanel/show/all'] = 'admin/list_all_user';
$route['adminpanel/app_settings'] = 'admin/app_settings';
$route['adminpanel/beta_accounts/(:any)'] = 'admin/beta_acc/$1';
$route['adminpanel/create_beta'] = 'admin/create_beta';
$route['adminpanel/registrations'] = 'admin/user_registrations';
$route['adminpanel/post/create'] = 'admin/create_post';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = "pages/view/$1";
$route['translate_uri_dashes'] = FALSE;

$route['request/registration/intro/(:any)'] = "request/show_intro/$1";
$route['request/registration/intro/username/(:any)'] = "request/get_username/$1";
$route['request/registration/set_id'] = "request/set_id";
$route['request/registration/info/(:any)'] = "request/get_info/$1";
