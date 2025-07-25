<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArticleController extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        // Load any necessary models or libraries here
    }
	public function articleView($id,$title)
	{   
       $data = [
        'title' => $title,
        'id' => $id,
       ];

		$this->load->view('ArticleView', $data);
	}
}
