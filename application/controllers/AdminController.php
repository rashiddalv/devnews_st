
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
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $name =  $_POST['reg-username'];
        $email =  $_POST['reg-email'];
        $pass = $_POST['reg-password'];
        $terms = $_POST['reg-terms'];

        if (!empty($name) && !empty($email) && !empty($pass) && isset($terms) && $terms == 'Yes') {
            if (preg_match('~^\p{Lu}~u', $name)) {

                $this->form_validation->set_rules('reg-email', 'Email', 'trim|required|valid_email');
                if ($this->form_validation->run() == TRUE) {
                    if (strlen($pass) >= 6 && strlen($pass) <= 15) {





                        //==========================================================CHECK EMAIL REPEAT (WORK)====================================================

                        // $check_email = "SELECT * FROM admin WHERE a_mail LIKE '%".$name."%'"; 
                        // $result = $this->db->$check_email;
                        // if ($result->num_rows == 0) {
                        // } else {
                        //     $this->session->set_flashdata('err', 'Daxil etdiyiniz e-poçt məşğuldur.');
                        //     redirect($_SERVER['HTTP_REFERER']);
                        // }


                        $checkEmailDublicate = $this->db->where("a_mail", $email)->get("admin")->row_array();
                        if ($checkEmailDublicate) {
                            $this->session->set_flashdata('err', 'Daxil etdiyiniz e-poçt məşğuldur.');
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $data = [
                                'a_name' => $name,
                                'a_mail' => $email,
                                'a_password' => md5($pass)
                            ];
                            $this->db->insert('admin', $data);
                            $this->session->set_flashdata('success', 'Hesab uğurla yaradıldı.');
                            redirect($_SERVER['HTTP_REFERER']);
                        }




                        //==========================================================CHECK EMAIL REPEAT (WORK)====================================================









                    } else {
                        $this->session->set_flashdata('err', 'Şifrənin uzunluğu ən azı 6 olmalıdır.');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    $this->session->set_flashdata('err', 'Həqiqi e-poçtu daxil edin.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('err', 'Ad böyük hərflə başlamalıdır.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('err', 'Bütün sahələri doldurun.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function login_act()
    {
        //============================REMEMBER ME============================
        $this->load->helper("cookie");

        $autoLogin = $this->input->post("autologin", true);

        if ($autoLogin == 1) {
            $cookie = array(
                'name'   => 'autologin',
                'value'  => '1',
                'expire' => '31536000',
                'path'   => '/'
            );
            $this->input->set_cookie($cookie);
        } else {
            delete_cookie("autologin");
        }
        //============================REMEMBER ME============================


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
    //=======================Forgot Password=======================
    //=======================DOESNT WORK=======================
    public function pass_forgot(){
        $this->load->view('admin/auth-forgot-password-basic');
    }
    public function pass_forgot_act(){
        $email =  $_POST['email'];
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
    }
    //=======================DOESNT WORK=======================
    //=======================Forgot Password=======================


    // ================================NEWS STARTS========================================
    public function news()
    {
        $data['get_all_news'] = $this->db
        ->order_by('n_id', 'DESC')
        ->join('admin', 'admin.a_id = news.n_creator_id', 'left')
        ->get('news')->result_array();
        $this->load->view('admin/news/news',$data);
    }
    public function news_create()
    {
        $this->load->view('admin/news/create');
    }
    public function news_create_act()
    {
        $title         = $_POST['title'];
        $description   = $_POST['description'];
        $date          = $_POST['date'];
        $category      = $_POST['category'];
        $status        = $_POST['status'];

        if (!empty($title) && !empty($description) && !empty($date) && !empty($category) && !empty($status)) {
            $data = [
                'n_title'       => $title,
                'n_description' => $description,
                'n_date'        => $date,
                'n_category'    => $category,
                'n_status'      => $status,
                // 'n_img'      => '',
                'n_creator_id'  => $_SESSION['admin_login_id'],
                'n_create_date' => date("Y-m-d H:i:s")
            ];

            $this->db->insert('news', $data);
            $this->session->set_flashdata('success', 'Xəbər uğurla yaradıldı.');
            redirect(base_url('admin_news'));
        } else {
            $this->session->set_flashdata('err', 'Bütün sahələri doldurun.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }




    // ================================NEWS ENDS==========================================

}
