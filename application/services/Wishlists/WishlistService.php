<?php namespace Services\Wishlists;

use Contracts\Wishlists\WishlistInterface;
use Services\BaseService;

class WishlistService extends BaseService implements WishlistInterface{
    
    protected $model;

    public function __construct($model) {
       $this->model = $model;
    }
    public function addProductToWishlist($data)
    {
        return $this->model->save($data);
    }
    public function removeProductFromWishlistById($params)
    {
        return $this->model->remove($params);
    }
    public function getWishlistProducts()
    {
        
    }
    public function getWishlistProductById($params)
    {
        return $this->model->find($params);
    }
    public function emptyWishlist()
    {
        
    }

    public function getLastInsertId() {
        return $this->model->getLastInsertId();
    }


}