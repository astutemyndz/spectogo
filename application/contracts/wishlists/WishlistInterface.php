<?php namespace Contracts\Wishlists;

interface WishlistInterface {
   // Product Add to customer wishlist
   public function addProductToWishlist(array $data);
   // Product Remove from Customer Wishlist by id
   public function removeProductFromWishlistById(array $props);
   // Get All Wishlist Products
   public function getWishlistProducts();
   // Get Wish List Product Product By Id
   public function getWishlistProductById(array $props);
   // Empty Customer Wishlist
   public function emptyWishlist();
}