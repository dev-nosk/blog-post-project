<?php
defined('BASEPATH') or exit('No direct script access allowed');

# this getAllData_helper is for fetching all data from the database and returning it in a specific format 
# no parameters are required for this function

function getInitial()
{
    return 'initial Helper from getAllData_helper!';
}

function _getAllCategories()
{
    $CI =& get_instance();
    $CI->load->model('BlogPostModel'); // Load the model correctly
    
    $result = $CI->BlogPostModel->getAllCategories(); // Access the model's method properly

    return $result;
}
?>

