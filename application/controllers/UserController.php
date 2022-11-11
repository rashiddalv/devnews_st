
<?php

class UserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_news_model');
    }
    public function index()
    {
        $data['get_all_news'] = $this->User_news_model->get_all_news();
        $data['get_limit30_news'] = $this->User_news_model->get_limit30_news();
        $data['get_limit5_news'] = $this->User_news_model->get_limit5_news();
        $data['get_all_categories'] = $this->User_news_model->get_all_categories();
        $this->load->view('user/index', $data);
    }
    public function about_us()
    {
        $this->load->view('user/about');
    }
    public function blog()
    {
        $this->load->view('user/blog');
    }
    public function contact()
    {
        $this->load->view('user/contact');
    }
    public function contact_act()
    {
        $u_name             = $_POST['u-name'];
        $u_email            = $_POST['u-email'];
        $u_subject          = $_POST['u-subject'];
        $u_message          = $_POST['u-message'];
        if (!empty($u_name) && !empty($u_email) && !empty($u_subject) && !empty($u_message)) {

            // if (preg_match('~^\p{Lu}~u', $u_name)) {
                $data = [
                    'u_name'           => $u_name,
                    'u_email'          => $u_email,
                    'u_subject'        => $u_subject,
                    'u_message'        => $u_message,
                ];
                $this->User_news_model->insert_contact($data);
                $this->session->set_flashdata('success', 'Mesaj uğurla göndərildi.');
                redirect($_SERVER['HTTP_REFERER']);
            // } else {
            //     $this->session->set_flashdata('err', 'Ad böyük hərflə başlamalıdır.');
            //     redirect($_SERVER['HTTP_REFERER']);
            // }
        } else {
            $this->session->set_flashdata('err', 'Bütün sahələri doldurun.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function category()
    {
        $this->load->view('user/category');
    }
}
