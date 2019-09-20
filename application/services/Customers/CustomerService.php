<?php 
namespace Services\Customers;

use Services\BaseService;
//use Illuminate\Database\Eloquent;


class CustomerService extends BaseService{
    
    protected $model;

    public function __construct($model) {
       $this->model = $model;
    }

    public function test() {
        echo "test";
    }

    /**
     * @description Direct access DB class
     */
    public function getCustomers() {
        return $this->db->get('customers')->result();
    }
     /**
     * @description Direct access DB class
     */
    public function getCustomers2() {
        return $this->model->all();
    }

    /**
     * @desc Get Table name from model
     */
    public function table() {
        return $this->model->getTable();
    }

    // public function search($name) {
    //     return $this->model->search($name);
    // }


   
    
    //public function 
}