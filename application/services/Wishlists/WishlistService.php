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
        return $this->model->find($params);
    }
    public function getWishlistProducts()
    {
        //return $this->model->all();
        // return $this->db->select('*')
        //                 ->from($this->model->table)
        //                 ->join('users_profiles', 'users.usrID = users_profiles.usrpID');
        //                 ->get()
        //                 ->result();
    }
    public function getWishlistProductById($params)
    {
        return $this->model->find($params);
    }
    public function emptyWishlist()
    {
        
    }


}