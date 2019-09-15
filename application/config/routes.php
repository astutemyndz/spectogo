<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'Home/index';
/*
    This route for frontend
*/
$route['home']                                          = 'Home';

$route['sign-in']                                       = 'Login';
$route['sign-up']                                       = 'Login/signUp';
$route['sign-out']                                      = 'Login/logOut';
$route['do-registration']                               = 'Login/doRegistration';
$route['do-login']                                      = 'Login/doLogin';
$route['products/(:any)/(:any)']                        = 'Product/index/$1/$2';
$route['product-details/(:any)']                        = 'Product/productDetails/$1';
$route['set-color']                                     = 'Product/setColor';
$route['choose-your-lens']                              = 'Product/chooseYourLens';







$route['contact-us']                                    = 'Home/contact-us';
$route['testimonial']                                   = 'Home/testimonial';
$route['cart']                                          = 'Home/cart';






/*
    This route for admin
*/
$route['admin']                                         = 'Admin';
$route['admin/do-login']                                = 'Admin/doLogin';
$route['admin/dashboard']                               = 'Admin/dashboard';
$route['admin/logout']                                  = 'Admin/doLogout';
$route['admin/change-status']                           = 'Admin/changeStatus';
$route['admin/banner-management']                       = 'Admin/bannerManagement';
$route['admin/add-banner']                              = 'Admin/addBanner';
$route['admin/delete-banner']                           = 'Admin/deleteBanner';
$route['admin/category-management']                     = 'Admin/categoryManagement';
$route['admin/add-category']                            = 'Admin/addCategory';
$route['admin/edit-category/(:any)']                    = 'Admin/addCategory/$1';
$route['admin/specs-management']                        = 'Admin/specsManagement';
$route['admin/add-specs']                               = 'Admin/addSpecs';
$route['admin/edit-specs/(:any)']                       = 'Admin/addSpecs/$1';
$route['admin/frame-management']                        = 'Admin/frameManagement';
$route['admin/add-frame']                               = 'Admin/addFrame';
$route['admin/edit-frame/(:any)']                       = 'Admin/addFrame/$1';
$route['admin/brand-management']                        = 'Admin/brandManagement';
$route['admin/add-brand']                               = 'Admin/addBrand';
$route['admin/edit-brand/(:any)']                       = 'Admin/addBrand/$1';
$route['admin/product-management']                      = 'Admin/productManagement';
$route['admin/add-product']                             = 'Admin/addProduct';
$route['admin/edit-product/(:any)']                     = 'Admin/addProduct/$1';
$route['admin/add-product-attribute/(:any)']            = 'Admin/addProductAttribute/$1';
$route['admin/save-product-attribute-details']          = 'Admin/saveProductAttributeDetails';
$route['admin/get-attribute-details']                   = 'Admin/getAttributeDetails';
$route['admin/delete-rel-image']                        = 'Admin/deleteRelImage';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/**
 * Wishlist 
 */

 $route['wishlist/add'] = 'WishlistController/addProductToWishlist';
 $route['wishlist'] = 'WishlistController/index';