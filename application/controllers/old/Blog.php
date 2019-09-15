<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    function __construct() {

        parent::__construct();
    }
    /*
        Blog listing
    */
    public function index() {
        
        $data = array();
        $data['title'] = 'Our Blogs | shorolafashion.com';
        $join[] = ['table' => 'users u', 'on' => 'b.posted_by = u.id', 'type' => 'left'];
        $data['blogs'] = $this->cm->select('blogs b', ['b.status'=> 1], 'b.*, u.name post_by,u.email,u.phone,(
            select count(c.id) from blog_comments_and_replies c 
            where c.blog_id = b.id and c.comment_parent IS NULL
        ) blog_comment', 'b.id', 'desc', $join);
        
        $this->load->view('frontend/blog/blogs', $data);
    }
    /*
        Blog details
    */
    public function blog_details(){
        $data = array();
        $blog_slug = $this->uri->segment(2);
        if($blog_slug){
            $data['blog_details'] = $this->cm->select_row('blogs', ['slug' => $blog_slug], '');
            $data['title'] = $data['blog_details']['name'].' | shorolafashion.com';
            /*
                Blog comments and replies
            */
            if(!empty($data['blog_details'])){
                $blog_comments = $this->db->query('SELECT c.*, u.name user_name,u.email,u.phone,u.gender
                    FROM blog_comments_and_replies c
                    JOIN users u on c.user_id = u.id
                    WHERE c.blog_id = '.$data['blog_details']['id'].' and c.comment_parent IS NULL')->result_array();
                if($blog_comments){
                    $userComments = array();
                    foreach($blog_comments as $comment){
                        $comment_replies = array();
                        $blog_replies = $this->db->query('SELECT r.*,u.name user_name,u.email,u.gender,u.phone
                            FROM blog_comments_and_replies r
                            JOIN users u on r.user_id = u.id
                            WHERE r.status = 1 AND r.comment_parent = '.$comment['id'])->result_array();
                        if($blog_replies){
                            foreach($blog_replies as $replye){
                                $comment_replies[] = [
                                    'id'=> $replye['id'],
                                    'comment'=> $replye['comment'],
                                    'created_at'=> $replye['created_at'],
                                    'user_name'=> $replye['user_name'],
                                    'gender'=> $replye['gender']
                                ];
                            }
                        }
                        $userComments[] = [
                            'id' => $comment['id'],
                            'comment' => $comment['comment'],
                            'created_at' => $comment['created_at'],
                            'user_name' => $comment['user_name'],
                            'gender' => $comment['gender'],
                            'replies' => $comment_replies
                        ];
                    }
                    $data['blog_comments_and_replyes'] = $userComments;
                }
            }
            /*
                Recent Post
            */
            $join[] = ['table' => 'users u', 'on' => 'b.posted_by = u.id', 'type' => 'left'];
            $data['blogs'] = $this->cm->select('blogs b', ['b.id !='=> $data['blog_details']['id'],'b.status'=> 1], 'b.*, u.name post_by,u.email,u.phone', 'b.id', 'desc', $join, 3, 0);
            $this->load->view('frontend/blog/blog_details', $data);
        }
        
    }
    /*
        Blog Comments and Replies
    */
    public function receive_blog_comment(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if(isset($_COOKIE[LOGIN_COOKIE_NAME]) && !empty($_COOKIE[LOGIN_COOKIE_NAME])){
                
                $blog_id = $this->input->post('blog_id');
                $comment = $this->input->post('comment');
                $comment_id = $this->input->post('comment_id');
                if($blog_id && $comment){
                    $in_array = array();
                    if($comment_id){ //reply
                        $in_array = [
                            'blog_id' => base64_decode($blog_id),
                            'user_id' => GetUserId(),
                            'comment' => addslashes(ucwords($comment)),
                            'comment_parent' => $comment_id
                        ];
                    } else { //comment
                        $in_array = [
                            'blog_id' => base64_decode($blog_id),
                            'user_id' => GetUserId(),
                            'comment' => addslashes(ucwords($comment))
                        ];
                    }
                    
                    $insert_id = $this->cm->insert('blog_comments_and_replies', $in_array);
                    if(!$insert_id){
                        echo json_encode(array('success'=> false, 'message'=> 'Faild to post your comment', 'login'=> true)); die();
                    }
                    //get blog comments
                    $blog_comments = $this->db->query('SELECT c.*, u.name user_name,u.email,u.phone,u.gender
                        FROM blog_comments_and_replies c
                        JOIN users u on c.user_id = u.id
                        WHERE c.blog_id = '.base64_decode($blog_id).' and c.comment_parent IS NULL')->result_array();
                    if($blog_comments){
                        $userComments = array();
                        foreach($blog_comments as $comment){
                            $comment_replies = array();
                            $blog_replies = $this->db->query('SELECT r.*,u.name user_name,u.email,u.gender,u.phone
                                FROM blog_comments_and_replies r
                                JOIN users u on r.user_id = u.id
                                WHERE r.status = 1 AND r.comment_parent = '.$comment['id'])->result_array();
                            if($blog_replies){
                                foreach($blog_replies as $replye){
                                    $comment_replies[] = [
                                        'id'=> $replye['id'],
                                        'comment'=> $replye['comment'],
                                        'created_at'=> $replye['created_at'],
                                        'user_name'=> $replye['user_name'],
                                        'gender'=> $replye['gender']
                                    ];
                                }
                            }
                            $userComments[] = [
                                'id' => $comment['id'],
                                'comment' => $comment['comment'],
                                'created_at' => $comment['created_at'],
                                'user_name' => $comment['user_name'],
                                'gender' => $comment['gender'],
                                'replies' => $comment_replies
                            ];
                        }
                        $data['blog_comments_and_replyes'] = $userComments;
                    }
                    $html = $this->load->view('frontend/blog/blog_comments_ajax', $data, TRUE);
                    echo json_encode(array('success'=> true, 'message'=> '', 'html'=> $html, 'login'=> true)); die();
                } else {
                    echo json_encode(array('success'=> false, 'message'=> 'Comment cannot be blank!', 'login'=> true)); die();
                }
            } else {
                echo json_encode(array('success'=> false, 'message'=> '', 'login'=> false)); die();
            }
        }
    }
    
    
    
    
}

?>