<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribe extends CI_Controller {

    public function index()
    {
        $this->load->view('subscribe');
    }

    public function submit()
    {
        // $name=$this->input->post('inputName');
        // $phone=$this->input->post('inputPhone');

        // $success_message=$this->Subscribemodel->subscriber($name,$phone);
        
        // return redirect('subscribe',$success_message);



        $this->load->library('form_validation');
		 $this->form_validation->set_rules('inputName','Name','required|alpha|trim');
		 $this->form_validation->set_rules('inputPhone','Phone','required');
		$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
		
		if( $this->form_validation->run('subscribe') ) { //if validation passes
			//Success
			$name = $this->input->post('inputName');
			$phone = $this->input->post('inputPhone');
			$success_message=$this->Subscribemodel->subscriber($name,$phone);
			if( $success_message ) {
				$this->session->set_flashdata('success_message',$success_message);
				return redirect('subscribe');
			} else {
				$this->session->set_flashdata('failed_message','Invalid Username/Phone.');
				return redirect('subscribe');
			}
		} else {
			//Failed.
			
			$this->load->view('subscribe');
			// echo validation_errors();
		}
        

        
    }
}

/* End of file Subscribe.php */
