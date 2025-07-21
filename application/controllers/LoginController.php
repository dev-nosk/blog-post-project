<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/google-api-php-client/vendor/autoload.php'; // Adjust path if needed

class LoginController extends CI_Controller {

    private $client;

    public function __construct() {
        parent::__construct();

        $this->client = new Google_Client();
        $this->client->setClientId('YOUR_CLIENT_ID');
        $this->client->setClientSecret('YOUR_CLIENT_SECRET');
        $this->client->setRedirectUri(base_url('login/callback'));
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function index() {
        // Generate a Google login URL
        $login_url = $this->client->createAuthUrl();

        // Pass this URL to your view or redirect directly
        redirect($login_url);
    }

    public function callback() {
        if ($this->input->get('code')) {
            $token = $this->client->fetchAccessTokenWithAuthCode($this->input->get('code'));

            if (!isset($token['error'])) {
                $this->client->setAccessToken($token['access_token']);

                // Get user profile info
                $oauth2 = new Google_Service_Oauth2($this->client);
                $google_account_info = $oauth2->userinfo->get();

                $email = $google_account_info->email;
                $name = $google_account_info->name;
                $google_id = $google_account_info->id;

                // TODO: Check if user exists in your DB
                // If not, register or deny access
                // Log the user in (set session, etc.)

                echo 'Welcome, ' . $name . ' (' . $email . ')';
            } else {
                echo 'Error fetching token';
            }
        } else {
            echo 'No code parameter found';
        }
    }
}
