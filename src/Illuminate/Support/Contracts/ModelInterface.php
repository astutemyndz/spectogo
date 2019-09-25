<?php 
namespace Illuminate\Support\Contracts;

interface ModelInterface
{

   //public function find($id);
   public function all();
   public function lastInsertId();
   public function save($attributes);
   public function update($params, $attributes);
   public function remove($params);
   public function find($params, $limit = null, $offset = null);
   //public function find($id);
}