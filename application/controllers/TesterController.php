<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TesterController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        echo initialHelper();
        echo '<br>';
        echo postInitial(1);
        echo '<br>';
        echo getInitial();
    }
    public function dump()
    {
        echo "This is a test method in TesterController.";
    }
    public function die_session()
    {
        $this->load->view('SessionView');
    }
}
