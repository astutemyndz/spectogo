<?php namespace Services\Accounts;

use Contracts\Accounts\AccountInterface;
use Services\BaseService;

class AccountService extends BaseService implements AccountInterface{
    
    protected $model;
  
    protected $billingAddress;
    protected $shippingAddress;

    public function __construct($model) {
       $this->model = $model;
    }
    public function setBillingAddress($billingAddress) {
        $this->billingAddress = $billingAddress;
        return $this;
    }
    public function setShippingAddress($shippingAddress) {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }
    public function updateProfile($attributes)
    {
        return $this->model->update($attributes);
    }
    public function orders()
    {
        
    }
    public function wishlist()
    {
        
    }
    public function prescriptions()
    {
        
    }
    public function reviews()
    {
        return $this->db->select('t1.id as ReviewId, t1.title as ReviewTitle, t1.description as ReviewDescription, t1.rating as ReviewStarRatings, t1.created_at as ReviewDateTime, t2.id as UserId, t2.name as UserName,t3.id as ProductId, t3.name as ProductName, t4.image as ReviewImages')
                        ->from('reviews as t1')
                        ->join('users as t2', 't2.id = t1.id')
                        ->join('products as t3', 't3.id= t1.id_products')
                        ->join('review_images as t4', 't4.id_reviews = t1.id')
                        ->get()
                        ->result_array();
    }
    public function settings()
    {
        
    }

   



}