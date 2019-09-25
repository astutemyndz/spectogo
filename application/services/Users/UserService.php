<?php 
namespace Services\Users;

use Services\BaseService;
//use Illuminate\Database\Eloquent;


class UserService extends BaseService{
    
    protected $model;
    protected $tittle;
    protected $firstName;
    protected $lastName;
    protected $name;
    protected $email;
    protected $password;
    protected $phone;
    protected $user;
    protected $attributes;

    public function __construct($model) {
       $this->model = $model;
    }

    public function setTitle($title) {
        $this->attributes['title'] = $title;
        return $this;
    }
    public function setFirstName($firstName) {
        $this->attributes['firstName'] = $firstName;
        return $this;
    }
    public function setLastName($lastName) {
        $this->attributes['lastName'] = $lastName;
        return $this;
    }
    public function setName($name) {
        $this->attributes['name'] = $name;
        return $this;
    }
    public function setEmail($email) {
        $this->attributes['email'] = $email;
        return $this;
    }
    public function setPhone($phone) {
        $this->attributes['phone'] = $phone;
        return $this;
    }
    public function setPassword($password) {
        $this->attributes['password'] = $password;
        return $this;
    }


    public function getAttributes() {
        return $this->attributes;
    }
  
    /**
     * @description Get User
     * @return result in array
     */
    public function user($params) {
        return $this->model->find($this->tableName(), $params);
    }

    public function update($attributes) {
        return $this->model->update($attributes);
    }
    
    /**
     * @desc Get Table name from model
     */
    public function tableName() {
        return $this->model->getTable();
    }



}