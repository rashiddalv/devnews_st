
<?php

class UserController extends CI_Controller{

    
    public function index(){
        $this->load->view('user/index');
    }
    public function about_us(){
        $this->load->view('user/about');
    }
    public function blog(){
        $this->load->view('user/blog');
    }
    public function contact(){
        $this->load->view('user/contact');
    }
    public function category(){
        $this->load->view('user/category');
    }

}

