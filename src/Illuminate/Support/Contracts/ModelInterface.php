<?php 
namespace Illuminate\Support\Contracts;

interface ModelInterface
{

   //public function find($id);
   public function all();
   public function lastInsertId();
   public function save(array $attributes);
   public function update(array $attributes);
   //public function get($params, $limit = null, $offset = null);

//   public function findOrFail($id, array $columns = ['*']);
//   public function find($id, array $columns = ['*']);
   public function remove($params);
}