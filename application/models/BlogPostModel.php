<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BlogPostModel extends CI_Model
{
    protected $tblCategories = 'tblcategories';
    protected $tblBlogPost = 'tblblogpost';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getPosts($limit = 10, $offset = 0)
    {
        $query = $this->db->get('blog_posts', $limit, $offset);
        return $query->result_array();
    }

    public function getAllCategories($id = null){
        $this->db->select('*');
        $this->db->from($this->tblCategories);
        if ($id !== null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $result = [];
            foreach ($query->result_array() as $row) {
            $result[$row['id']] = (object)$row;
            }
            return $result;
        } else {
            return [];
        }
    }

    public function getAllBlogByDate($to, $from)
    {
        $this->db->select('*');
        $this->db->from($this->tblBlogPost);
        $this->db->where("CreatedDate >=", $from);
        $this->db->where("CreatedDate <=", $to);
        $query = $this->db->get();
           
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return [];
        }
    }

  
}