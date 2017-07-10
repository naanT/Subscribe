<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subscribe extends CI_Controller {
    public function index()
    {
        $this->load->view('subscribe');
    }
    public function submit()
    {

			$name = $this->input->post('name');
			$phone = $this->input->post('phone');
      $isValid=false;
			$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
			try {

				$NumberProto = $phoneUtil->parse($phone, "");
				 $isValid = $phoneUtil->isValidNumber($NumberProto);
			} catch (\libphonenumber\NumberParseException $e) {

			}
				if($isValid)
				{
					$phone = $phoneUtil->format($NumberProto, \libphonenumber\PhoneNumberFormat::E164);
					$success_message=$this->Subscribemodel->subscriber($name,$phone);
					if( $success_message )
					{
            echo $success_message;
					}
					else
					{
            echo "Invalid Username/Phone.";
					}
				}
				else
				{
					echo "Invalid Phone.";
				}
    }
}
