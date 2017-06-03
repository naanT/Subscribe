<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribe extends CI_Controller {

    public function index()
    {
        $this->load->view('subscribe');
    }

    public function submit()
    {
		 $this->form_validation->set_rules('inputName','Name','required|alpha|trim');
		 $this->form_validation->set_rules('inputPhone','Phone','required');
		 $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
		
		if( $this->form_validation->run('subscribe') ) {
			

			$name = $this->input->post('inputName');
			$phone = $this->input->post('inputPhone');

			$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
			try {
				
				$NumberProto = $phoneUtil->parse($phone, "PK");
				 var_dump($NumberProto);
				
				
				 $isValid = $phoneUtil->isValidNumber($NumberProto);
				var_dump($isValid);
			} catch (\libphonenumber\NumberParseException $e) {
				var_dump($e);
				
			}

				if($isValid)
				{
					$phone = $phoneUtil->format($NumberProto, \libphonenumber\PhoneNumberFormat::E164);
					$success_message=$this->Subscribemodel->subscriber($name,$phone);

					if( $success_message ) 
					{
						$this->session->set_flashdata('success_message',$success_message);
						return redirect('subscribe');
					} 
					else 
					{
						$this->session->set_flashdata('failed_message','Invalid Username/Phone.');
						return redirect('subscribe');
					}
				}
				else
				{
					$this->session->set_flashdata('failed_message','Invalid Number');
						return redirect('subscribe');
				}
		} else {
			$this->load->view('subscribe');
		}
        

        
    }
}

/* End of file Subscribe.php */
