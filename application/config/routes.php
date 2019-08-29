<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['register'] = 'users/register';
$route['users/show/all'] = 'users/list_users';
$route['user/logout'] = 'users/user_logout';
$route['user/browser_logout'] = 'users/browser_logout';
$route['notifications'] = 'users/notifications';
$route['notifications/(:any)'] = 'users/notifications/$1';
$route['login'] = 'users/login';
$route['changelog'] = 'users/changelog';
$route['roadmap'] = 'users/roadmap';

$route['adminpanel/edit/(:any)/(:any)'] = "admin/edit/$1/$2";
$route['adminpanel/update/(:any)/(:any)'] = "admin/update/$1/$2";
$route['adminpanel/show/all'] = 'admin/list_all_user';
$route['adminpanel/app_settings'] = 'admin/app_settings';
$route['adminpanel/beta_accounts/(:any)'] = 'admin/beta_acc/$1';
$route['adminpanel/create_beta'] = 'admin/create_beta';
$route['adminpanel/registrations'] = 'admin/user_registrations';
$route['adminpanel/post/create'] = 'admin/create_post';
$route['adminpanel/post/edit/(:any)'] = 'admin/edit_post/$1';
$route['adminpanel/post/delete/(:any)'] = 'admin/delete_post/$1';
$route['adminpanel/add_changelog'] = 'admin/add_changelog';
$route['adminpanel/codes'] = 'admin/add_codes';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = "pages/view/$1";
$route['translate_uri_dashes'] = FALSE;

$route['request/registration/intro/(:any)'] = "request/show_intro/$1";
$route['request/registration/intro/username/(:any)'] = "request/get_username/$1";
$route['request/registration/set_id'] = "request/set_id";
$route['request/registration/info/(:any)'] = "request/get_info/$1";
