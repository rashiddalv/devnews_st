<?php 
class News_model extends CI_Model{

    public function insert_news($data){
        $this->db->insert('news', $data);
    }
    public function delete_news($id){
        $this->db->where('n_id', $id)->delete('news');
    }
    public function get_all_news(){
       return $this->db
        ->order_by('n_id', 'DESC')
        ->join('admin', 'admin.a_id = news.n_creator_id', 'left')
        ->get('news')->result_array();
    }
}