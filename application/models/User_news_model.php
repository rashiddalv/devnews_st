<?php
class User_news_model extends CI_Model
{


    public function get_all_news()
    {
        return $this->db
            ->limit(10)
            ->select('n_id, n_title, n_description, n_date, n_category, n_img, n_file_ext, a_name')
            ->order_by('n_id', 'DESC')
            // ->join('admin', 'admin.a_id = news.n_creator_id', 'left')
            ->join('admin', 'admin.a_id = news.n_updater_id', 'left')
            ->get('news')->result_array();
    }
    public function get_limit30_news()
    {
        return $this->db
            ->limit(30, 10)
            ->select('n_id,n_title,n_description,n_date,n_category,n_img,n_file_ext,a_name')
            ->order_by('n_id', 'DESC')
            ->join('admin', 'admin.a_id = news.n_creator_id', 'left')
            ->get('news')->result_array();
    }
    public function get_limit5_news()
    {
        return $this->db
            ->limit(5)
            ->select('n_id,n_title,n_description,n_date,n_category,n_img,n_file_ext,a_name')
            ->order_by('n_id', 'DESC')
            ->join('admin', 'admin.a_id = news.n_creator_id', 'left')
            ->get('news')->result_array();
    }

    public function get_all_categories()
    {
        return $this->db->get('category')->result_array();
    }
    public function insert_contact($data)
    {
        $this->db->insert('contact', $data);

    }

}
