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

    public function __construct($model) {
       $this->model = $model;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }
    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }
    public function setPassword($password) {
        $this->password = $password;
        return $this;
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