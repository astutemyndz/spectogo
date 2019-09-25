<?php

use Models\Accounts\PrescriptionDetailsModel;
use Models\Accounts\PrescriptionModel;
use Services\Accounts\PrescriptionService;

defined('BASEPATH') OR exit('No direct script access allowed');

class PrescriptionController extends Common_Controller {
    protected $prescription = array();
    public function __construct()
    {
        parent::__construct();
    }  
    public function setAttachment($attachment){
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
            );
        $uploadPath = $config['upload_path'];
        
        $uid = '10'; //create separate folder for each user 
        $upPath = $uploadPath."/".$uid;
        if(!file_exists($upPath)) 
        {
            mkdir($upPath, 0777, true);
        }
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload($attachment))
        {
            $this->response['errors'] = $this->upload->display_errors();
        }
        else
        {
            $this->response['data'] = $this->upload->data();
        }

        return $this->response;
    }
    public function save() 
    {
        if($this->isAjaxRequest()) 
        {
            
            $sessionUserData = $this->userdata();
                if(!empty($sessionUserData)|| isset($sessionUserData)) 
                {    
                    if(!empty($sessionUserData['prescription'])|| isset($sessionUserData['prescription'])) 
                    {
                        if(is_array($sessionUserData) && array_key_exists('prescription', $sessionUserData)) 
                        {
                            $this->unsetSession('prescription');
                            $this->setSession('prescription', $this->prescription);
                            $flag = true;
                        } else {
                            $flag = false;
                        }
                    }             
                   
                }

                if($flag) {
                    $this->response = new Response(
                        array(
                            'data' => $this->prescription,
                            'statusCode' => Response::HTTP_OK,
                            'message' => Response::$statusTexts[200]
                        ),
                        Response::HTTP_OK,
                        ['Content-Type', 'application/json']
                    );
                } else {
                    $this->response = new Response(
                        array(
                            'data' => [],
                            'statusCode' => Response::HTTP_NOT_FOUND,
                            'message' => Response::$statusTexts[404],
                        ),
                        Response::HTTP_OK,
                        ['Content-Type', 'application/json']
                    );
                }
        }
    }
}
