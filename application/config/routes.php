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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['register'] = 'home/register';
$route['login'] = 'home/login';
$route['logout'] = 'home/logout';
$route['forgotpassword'] = 'home/forgotpassword';
$route['myaccount'] = 'home/myaccount';
$route['cust_change_password'] = 'home/cust_change_password';
$route['cust_orders'] = 'home/cust_orders';
$route['cust_order_details/(:any)'] = 'home/cust_order_details/$order_id';
$route['cust_address'] = 'home/cust_address';
$route['cust_details'] = 'home/cust_details';
$route['cart'] = 'home/cart';
$route['viewcart'] = 'home/viewcart';
$route['addcart/(:any)'] = 'home/addcart/$product_id';
$route['checkout'] = 'home/checkout';
$route['categories/(:any)/(:any)'] = 'home/categories/$id/$name';
$route['product_details/(:any)/(:any)'] = 'home/product_details/$id/$name';
$route['aboutus'] = 'home/aboutus';
$route['contactus'] = 'home/contactus';
$route['offers'] = 'home/offers';
$route['privacy'] = 'home/privacy';
$route['wishlist'] = 'home/wishlist';

//----------------------------------------------------------------------------------------------//


//------- Admin------------//


//------- Specification Masters------------//

$route['admin/specification'] = 'specification/index';
$route['admin/specification/(:any)'] = 'specification/edit/$id';

//------- Tag Masters------------//

$route['admin/tags'] = 'tagmaster/index';
$route['admin/tag/(:any)'] = 'tagmaster/edit/$id';


//------- Zip code Masters------------//

$route['admin/zipcode'] = 'zipcodemaster/index';
$route['admin/zipcode/(:any)'] = 'zipcodemaster/edit/$id';

//------- Products Masters------------//

$route['admin/products'] = 'productmaster/index';
$route['admin/view_products'] = 'productmaster/view_products';
$route['admin/products/(:any)'] = 'productmaster/edit_product/$id';
$route['admin/edit_combined_products/(:any)'] = 'productmaster/edit_combined_products/$id';
$route['admin/add_sub_product/(:any)'] = 'productmaster/add_sub_product/$id';
$route['admin/add_specification/(:any)'] = 'productmaster/add_specification/$id';
$route['admin/edit_specifcation/(:any)'] = 'productmaster/edit_specifcation/$id';
$route['admin/add_tags/(:any)'] = 'productmaster/add_tags/$id';
$route['admin/product/review/(:any)'] = 'productmaster/view_review/$id';

//------- Tracking modules------------//
$route['admin/tracking'] = 'tracking/index';
$route['admin/check_orders/(:any)'] = 'tracking/check_orders/$id';
$route['admin/invoice/(:any)'] = 'tracking/print_order/$id';
$route['admin/list_of_orders'] = 'tracking/list_of_orders/$id';

//------- sales modules------------//
$route['admin/sales'] = 'salesmaster/index';
$route['admin/day_wise_sales'] = 'salesmaster/day_wise_sales';
$route['admin/month_wise_sales'] = 'salesmaster/month_wise_sales';

//------- Promotional modules------------//
$route['admin/banner'] = 'banner/index';
$route['admin/edit_banner/(:any)'] = 'banner/edit_banner/$id';


//------------Ads----------------//

$route['admin/ads'] = 'adsmaster/index';
$route['admin/edit_ads/(:any)'] = 'adsmaster/edit_ads/$id';

//------------Offers----------------//

$route['admin/offers'] = 'offermaster/index';
$route['admin/edit_offer/(:any)'] = 'offermaster/edit_offer/$id';

//------------Customer----------------//

$route['admin/customers'] = 'customerprofile/index';
$route['admin/customer_details/(:any)'] = 'customerprofile/customer_details/$id';