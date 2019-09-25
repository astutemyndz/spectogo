<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller']                            = 'Home/index';
/*
    This route for frontend
*/
$route['home']                                          = 'Home';
$route['sign-in']                                       = 'AuthController';
$route['sign-up']                                       = 'AuthController/signUp';
$route['sign-out']                                      = 'AuthController/logOut';
$route['do-registration']                               = 'AuthController/doRegistration';
$route['do-login']                                      = 'AuthController/doLogin';
$route['products/(:any)/(:any)']                        = 'Product/index/$1/$2';
// product-details/frames/frame-1/slug
// product-details/category/cat-name/slug
$route['product-details/(:any)/(:any)/(:any)']          = 'Product/productDetails/$1/$2/$3';
$route['filterProductImageByColor']                     = 'ApiController/filterProductImageByColor';
$route['filterLensDetails']                             = 'ApiController/filterLensDetails';
$route['choose-your-lens']                              = 'Product/chooseYourLens';
$route['set-lens-for-product']                          = 'Product/setLensForProduct';
$route['distance']                                      = 'ApiController/distance';
$route['lens/tints']                                      = 'ApiController/lens';
$route['lens/tints/details']                                      = 'ApiController/onLoadLensTintsDetailsEventHandler';
$route['setLensTintToProduct']                                      = 'ApiController/setLensTintToProduct';
$route['setPrescription']                                      = 'ApiController/setPrescription';
$route['attachmentUploadHandler']                                      = 'ApiController/attachmentUploadHandler';


$route['wishlist/add'] = 'WishlistController/save';
$route['wishlist'] = 'WishlistController/index';
$route['products'] = 'ApiController/products';
$route['product/category/(:any)'] = 'Product/getProductCategoryWise/$1';
$route['filterProduct'] = 'Product/filterProduct';
$route['banners'] = "ApiController/banners";




$route['contact-us']                                    = 'Home/contact-us';
$route['wishlist/add']                                  = 'WishlistController/save';
$route['wishlist/remove']                               = 'WishlistController/remove';
$route['wishlist']                                      = 'WishlistController/index';
$route['products']                                      = 'ApiController/products';
$route['product/category/(:any)']                       = 'Product/getProductCategoryWise/$1';
$route['filterProduct']                                 = 'Product/filterProduct';
$route['banners']                                       = "ApiController/banners";
$route['contact-us']                                    = 'Home/contactUs';
$route['info/(:any)']                                   = 'Home/pageInfo/$1';
$route['blogs']                                         = 'Home/blogs';
$route['blog-details/(:any)']                           = 'Home/blogDetails/$1';
$route['post-comment']                                  = 'Home/postComment';
$route['newsletter-subscribe']                          = 'Home/newsletterSubscribe';
$route['testimonial']                                   = 'Home/testimonial';
$route['search-product']                                = 'Home/searchProduct';
$route['cart']                                          = 'Home/cart';
$route['preview']                                          = 'Product/preview';
$route['onLoadPreviewEventHandler']                                          = 'ApiController/onLoadPreviewEventHandler';






$route['reglaze']                                       = 'Home/reglaze';
$route['set-reglaze-frame']                             = 'Home/setReglazeFrame';
$route['contact-us-email']                              = 'Home/contactUsEmail';
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
$route['admin/delete-primary-image']                    = 'Admin/deletePrimaryImage';
$route['admin/add-product-attribute/(:any)']            = 'Admin/addProductAttribute/$1';
$route['admin/save-product-attribute-details']          = 'Admin/saveProductAttributeDetails';
$route['admin/get-attribute-details']                   = 'Admin/getAttributeDetails';
$route['admin/delete-rel-image']                        = 'Admin/deleteRelImage';
$route['admin/lens-management']                         = 'Admin/lensManagement';
$route['admin/add-lens']                                = 'Admin/addLens';
$route['admin/edit-lens/(:any)']                        = 'Admin/addLens/$1';
$route['admin/lens-sub-category-management']            = 'Admin/lensSubCategoryManagement';
$route['admin/add-lens-sub-category']                   = 'Admin/addLensSubCategory';
$route['admin/edit-lens-sub-category/(:any)']           = 'Admin/addLensSubCategory/$1';
$route['admin/pupillary-distance']                      = 'Admin/pupillaryDistance';
$route['admin/add-pupillary-distance']                  = 'Admin/addPupillaryDistance';
$route['admin/edit-pupillary-distance/(:any)']          = 'Admin/addPupillaryDistance/$1';
$route['admin/lenses-and-tints']                        = 'Admin/lensesAndTints';
$route['admin/add-lenses-and-tints']                    = 'Admin/addLensesAndTints';
$route['admin/edit-lenses-and-tints/(:any)']            = 'Admin/addLensesAndTints/$1';
$route['admin/lenses-and-tints-details']                = 'Admin/lensesAndTintsDetails';
$route['admin/add-lenses-and-tints-details']            = 'Admin/addLensesAndTintsDetails';
$route['admin/edit-lenses-and-tints-details/(:any)']    = 'Admin/addLensesAndTintsDetails/$1';
$route['admin/reglaze-management']                      = 'Admin/reglazeManagement';
$route['admin/add-reglaze']                             = 'Admin/addReglaze';
$route['admin/edit-reglaze/(:any)']                     = 'Admin/addReglaze/$1';
$route['admin/website-management']                      = 'Admin/websiteManagement';
$route['admin/page-management']                         = 'Admin/pageManagement';
$route['admin/edit-page/(:any)']                        = 'Admin/editPage/$1';
$route['admin/blog-management']                         = 'Admin/blogManagement';
$route['admin/add-blog']                                = 'Admin/addBlog';
$route['admin/edit-blog/(:any)']                        = 'Admin/addBlog/$1';
$route['admin/testimonial-management']                  = 'Admin/testimonialManagement';
$route['admin/add-testimonial']                         = 'Admin/addTestimonial';
$route['admin/edit-testimonial/(:any)']                 = 'Admin/addTestimonial/$1';
$route['404_override']                                  = '';
$route['translate_uri_dashes']                          = FALSE;
