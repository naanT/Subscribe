<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telegram extends CI_Controller {
    public function index()
    {
        $this->load->view('telegram');
    }
}

/* End of file Telegram.php */
