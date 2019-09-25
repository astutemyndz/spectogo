<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_model {
    public function get_all($table, $condition = NULL, $limit = NULL, $offset = NULL){
        $this->db->select('*');
        $this->db->from($table);
        if($condition != NULL){
            $this->db->where($condition);
        }
        if($limit != NULL && $offset != NULL){
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result();
    }
    public function get_specific($table, $condition = NULL){
        $this->db->select('*');
        $this->db->from($table);
        if($condition != NULL){
            $this->db->where($condition);
        }
        return $this->db->get()->result();
    }
    public function select_row($from, $where=array(), $select='', $join=array()){
        if($select){
            $this->db->select($select);
        }else{
            $this->db->select('*');
        }
        $this->db->from($from);
        if(!empty($join)){
            foreach($join as $qry){
                $this->db->join($qry['table'], $qry['on'], $qry['type']);
            }
        } 
        if(!empty($where)){
            $this->db->where($where);
        }  
        return $this->db->get()->row_array();
    }
    // Return All data
    public function select($from, $where=array(), $select='', $order_by='', $mode='', $join=array(), $limit='', $offset=0, $group_by = '', $row = false){
        if($select){
            $this->db->select($select);
        }else{
            $this->db->select('*');
        }
        $this->db->from($from);
        if(!empty($join)){
            foreach($join as $qry){
                $this->db->join($qry['table'], $qry['on'], $qry['type']);
            }
        }
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($group_by)){
            $this->db->group_by($group_by);
        }      
        if($order_by && $mode){
            $this->db->order_by($order_by, $mode);
        } else {
            $this->db->order_by($order_by);
        }
        if($limit){
            $this->db->limit($limit, $offset);
        }
        // if($row) {
        //     return $this->db->get()->row_array();
        // }
        return $this->db->get()->result_array();
    }
    public function insert($table, $data = array()){
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function update($table, $where=array(), $data=array()){
        $this->db->where($where);  
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }
    public function delete($table, $where=array()){
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    public function changeStatus($table, $where){
        $this->db->select('status');        
        $this->db->from($table);
        $this->db->where($where);                
        $curnt_status = $this->db->get()->row_array();
        $status = $curnt_status['status']?0:1;
        $this->db->where($where);  
        $this->db->update($table, array('status' => $status));
        if($this->db->affected_rows()){
            return $status;
        }
    }
    public function sendMail($eml, $sub, $msg, $file = '') {
        include_once APPPATH.'third_party/Mail/class.phpmailer.php';
        $mail = new PHPMailer;
        $mail -> CharSet = 'UTF-8';
        $mail -> IsSMTP();
        //Reverese for attachment
        //$mail -> IsSMTP();
        //$mail -> CharSet = 'UTF-8';
        $mail -> Host = 'localhost';
        $mail -> SMTPAuth = true;
        $mail -> Port = 587;
        //Reverese for attachment
        //$mail -> Port = 587;
        //$mail -> SMTPAuth = true;
        $mail -> Username = 'no-reply@spec2go.com';
        $mail -> Password = 'sC7LC2BW5hqv';
        $mail -> SMTPSecure = 'none';
        $mail -> From = 'no-reply@spec2go.com';
        $mail -> FromName = 'Spec2Go';
        $mail -> addAddress($eml);
        $mail -> addBcc('asd@mail.com');
        $mail -> WordWrap = 5000;
        $mail -> Subject = $sub;
        $mail -> Body = $msg;
        $mail -> isHTML(true);
        if ($file != '')
            $mail -> AddAttachment($file);
        if (!$mail -> send()){
            //print $mail->ErrorInfo;
            return "notok";
        }
        else{
            return "ok";
        }
    }
}
