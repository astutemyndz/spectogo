<?php namespace Contracts\Accounts;

interface AccountInterface {
  
    public function profile();
    public function updateProfile($attributes);
    public function orders();
    public function wishlist();
    public function prescriptions();
    public function reviews();
    public function settings();
}