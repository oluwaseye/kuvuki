<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
//default route
$route['default_controller'] = "home";
//error overrides
$route['404_override'] = "error_404";
$route['500_override'] = "error_500";

//category tag routes
$route['politics'] = "category/allnews/politics";
$route['technology'] = "category/allnews/technology";
$route['weird'] = "category/allnews/weird";
$route['lifestyle'] = "category/allnews/lifestyle";
$route['sports'] = "category/allnews/sports";
$route['gossip'] = "category/allnews/gossip";

//settings index
$route['settings'] = "settings";
//settings add auth accounts 
$route['settings/auth/facebook'] = "settings/add_auth/Facebook";
$route['settings/auth/twitter'] = "settings/add_auth/Twitter";


$route['search'] = "search/nosearchstring_speci";
$route['search/~/(:any)'] = "search/allnews/$1";

/*$route['tranxaction_c'] = "integ/";*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */