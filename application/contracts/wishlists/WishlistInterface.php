<?php namespace Contracts\Wishlists;

interface WishlistInterface {
   // Product Add to customer wishlist
   public function addProductToWishlist($data);
   // Product Remove from Customer Wishlist by id
   public function removeProductFromWishlistById($props);
   // Get All Wishlist Products
   public function getWishlistProducts();
   // Get Wish List Product Product By Id
   public function getWishlistProductById($props);
   // Empty Customer Wishlist
   public function emptyWishlist();
}