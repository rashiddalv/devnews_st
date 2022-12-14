
<?php
class AdminController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
    }

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
    public function pass_forgot()
    {
        $this->load->view('admin/auth-forgot-password-basic');
    }
    public function pass_forgot_act()
    {
        $email =  $_POST['email'];
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
    }
    //=======================DOESNT WORK=======================
    //=======================Forgot Password=======================



    // ================================NEWS STARTS========================================
    public function news()
    {

        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_news'] = $this->News_model->get_all_news();
        $this->load->view('admin/news/news', $data);
    }
    public function news_create()
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_categories'] = $this->News_model->get_all_categories();
        $this->load->view('admin/news/create', $data);
    }
    public function news_create_act()
    {
        $title         = $_POST['title'];
        $description   = $_POST['description'];
        $date          = $_POST['date'];
        $category      = $_POST['category'];
        $status        = $_POST['status'];

        if (!empty($title) && !empty($description) && !empty($date) && !empty($category) && !empty($status)) {



            $config['upload_path']          = './uploads/news/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['encrypt_name']        = TRUE;
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('news_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');


                $data = [
                    'n_title'       => $title,
                    'n_description' => $description,
                    'n_date'        => $date,
                    'n_category'    => $category,
                    'n_status'      => $status,
                    'n_img'         => $file_name,
                    'n_file_ext'    => $file_ext,
                    'n_creator_id'  => $_SESSION['admin_login_id'],
                    'n_create_date' => date("Y-m-d H:i:s")
                ];
                $this->News_model->insert_news($data);
                $this->session->set_flashdata('success', 'Xəbər uğurla yaradıldı.');
                redirect(base_url('admin_news'));
            } else {
                $data = [
                    'n_title'       => $title,
                    'n_description' => $description,
                    'n_date'        => $date,
                    'n_category'    => $category,
                    'n_status'      => $status,
                    'n_creator_id'  => $_SESSION['admin_login_id'],
                    'n_create_date' => date("Y-m-d H:i:s")
                ];
                $this->News_model->insert_news($data);
                $this->session->set_flashdata('success', 'Xəbər uğurla yaradıldı.');
                redirect(base_url('admin_news'));
            }
        } else {
            $this->session->set_flashdata('err', 'Bütün sahələri doldurun.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function news_delete($id)
    {
        $this->News_model->delete_news($id);
        $this->session->set_flashdata('success', 'Xəbər uğurla silindi.');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // ================================NEWS ENDS==========================================

    public function admin_settings()
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $this->load->view('admin/settings', $data);
    }
    public function admin_settings_act()
    {
        // $profile_pic =  $_POST['profile_pic'];
        $config['upload_path']          = './uploads/admin/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['encrypt_name']         = TRUE;
        // $config['max_size']          = 100;
        // $config['max_width']         = 1024;
        // $config['max_height']        = 768;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('profile_pic')) {
            $file_name = $this->upload->data('file_name');
            $data = [
                'a_img' => $file_name,
            ];
            $this->db->where('a_id', $_SESSION['admin_login_id'])->update('admin', $data);
            $this->session->set_flashdata('success', 'Profil şəkli uğurla yeniləndi.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('err', 'Şəkil uyğun deyil.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function news_detail($id)
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['single_news'] = $this->News_model->get_single_news($id);
        // print_r('<pre>');
        // print_r($data['single_news']);
        // die();
        $this->load->view('admin/news/detail', $data);
    }
    public function news_update($id)
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_categories'] = $this->News_model->get_all_categories();
        $data['get_single_data'] = $this->db->where('n_id', $id)->get('news')->row_array();
        $this->load->view('admin/news/update', $data);
    }
    public function news_update_act($id)
    {
        $title          = $_POST['title'];
        $description    = $_POST['description'];
        $date           = $_POST['date'];
        $category       = $_POST['category'];
        $status         = $_POST['status'];

        if (!empty($title) && !empty($description) && !empty($date) && !empty($category) && !empty($status)) {

            $config['upload_path']          = './uploads/news/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['encrypt_name']         = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('user_img')) {
                $file_name = $this->upload->data('file_name');
                $file_ext = $this->upload->data('file_ext');

                $data = [
                    'n_title'       => $title,
                    'n_description' => $description,
                    'n_date'        => $date,
                    'n_category'    => $category,
                    'n_status'      => $status,
                    'n_img'         => $file_name,
                    'n_file_ext'    => $file_ext,
                    'n_updater_id'  => $_SESSION['admin_login_id'],
                    'n_update_date' => date("Y-m-d H:i:s")
                ];

                $this->News_model->update_news($id, $data);
                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");
                redirect(base_url('admin_news'));
            } else {

                $data = [
                    'n_title'       => $title,
                    'n_description' => $description,
                    'n_date'        => $date,
                    'n_category'    => $category,
                    'n_status'      => $status,
                    'n_updater_id'  => $_SESSION['admin_login_id'],
                    'n_update_date' => date("Y-m-d H:i:s")
                ];

                $this->News_model->update_news($id, $data);
                $this->session->set_flashdata('success', "Xəbər uğurla yeniləndi!");
                redirect(base_url('admin_news'));
            }
        } else {
            $this->session->set_flashdata('err', "Boşluq buraxmayın!");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function delete_news_img($id)
    {
        $data = [
            'n_img' => "",
            'n_file_ext' => "",
        ];
        $this->News_model->update_news($id, $data);
        $this->session->set_flashdata('success', "Şəkil uğurla silindi!");
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function all_messages()
    {
        $data['admin'] = $this->db->where('a_id', $_SESSION['admin_login_id'])->get('admin')->row_array();
        $data['get_all_messages'] = $this->News_model->get_all_messages();
        $this->load->view('admin/messages/all_messages', $data);
    }
}
