<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hadith extends CI_Controller {

    public function index()
	{
		$info['ahadith']=$this->Messagemodel->get_hadith_info();

        $this->load->view('hadith',$info);

	}

}

