<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogPostController extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('BlogPostModel','b_model');
        $_SESSION['categories'] = _getAllCategories();
    }
	public function index()
	{
        $to = date('Y-m-d',strtotime('+1 days'));
        $from = date('Y-m-d', strtotime('-7 days'));
        $blog_content = $this->b_model->getAllBlogByDate($to,$from);
        $is_high_light = [];
        foreach ($blog_content as $blog) {
            if ($blog->IsHighLight == 1) {
                array_push($is_high_light, $blog);
            }
        }
       
        $data = [
            'categories' => $_SESSION['categories'],
            'hight_lights' =>  $is_high_light,
            'all_post' =>  array_reverse($blog_content),
            'date' => date('Y-m-d H:i:s')
        ];
// var_dump('<pre>',$_SESSION['categories']); // Debugging line to check categories
//         var_dump('<pre>', $blog_content); // Debug
//         die;
		$this->load->view('BlogPostView',$data);
	}
}
