
<?php

class AdminController extends CI_Controller
{


    public function index()
    {
        $this->load->view('admin/auth-login-basic');
    }
    public function register()
    {
        $this->load->view('admin/auth-register-basic');
    }
    public function register_act()
    {
        $name =  $_POST['reg-username'];
        $email =  $_POST['reg-email'];
        $pass = $_POST['reg-password'];
        $terms = $_POST['terms'];

        if (!empty($name) && !empty($email) && !empty($pass) && $terms == 0){
            $data = [
                'a_name' => $name,
                'a_mail' => $email,
                'a_password' => md5($pass),
            ];
            $this->db->insert('admin', $data);
            $this->session->set_flashdata('success', 'Hesab uğurla yaradıldı.');
            redirect($_SERVER['HTTP_REFERER']);

        } else {
            $this->session->set_flashdata('err', 'Bütün sahələri doldurun.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function login_act()
    {
        $email =  $_POST['email'];
        $pass = $_POST['password'];

        if (!empty($email) && !empty($pass)) {
            $data = [
                'a_mail' => $email,
                'a_password' => md5($pass),
            ];
            // print_r('<pre>');
            // print_r($data);
            // die();
            $check_admin = $this->db->where($data)->get('admin')->row_array();
            if ($check_admin) {
                $_SESSION['admin_login_id'] = $check_admin['a_id'];
                redirect(base_url('admin_dashboard'));
            } else {
                $this->session->set_flashdata('err', 'E-poçt və ya parol səhv daxil edilib.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('err', 'Bütün sahələri doldurun.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function log_out()
    {
        $this->session->set_flashdata('success', 'Tezliklə qayıdın!');
        unset($_SESSION['admin_login_id']);
        redirect(base_url('login_dashboard'));
    }
    public function dashboard()
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $this->load->view('admin/index', $data);
    }
    public function news()
    {
        $this->load->view('admin/news/news');
    }
}
