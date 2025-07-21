<?php
defined('BASEPATH') or exit('No direct script access allowed');

# this postdata_helper is for handling post data operations
# with parameters for fetching and processing post data
# allow insert, update, delete operations

function postInitial($id)
{
    return 'initial Helper from postdata_helper with ID: ' . $id;
}

