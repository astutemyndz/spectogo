<?php 

// if (!function_exists('loadController'))
// {
//     function load_controller($controller, $method = 'index')
//     {
//         require_once(FCPATH . APPPATH . 'controllers/' . $controller . '.php');

//         $controller = new $controller();

//         return $controller->$method();
//     }
// }


// if(!function_exists('getUserId')) {        
//     function getUserId() {
//       $ci = & get_instance();
//       $ci->load->library('../controllers/AuthController', 'auth');
//       $ci->auth->userId();
//       if($ci->auth->getUserId()) {
//           return $ci->auth->getUserId();
//       }
//       return false;
//     }
// }

