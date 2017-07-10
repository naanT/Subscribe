<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unsubscribe extends CI_Controller {
    public function index()
    {
        $this->load->view('unsubscribe');
    }
    public function submit()
    {

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
					$success_message=$this->Subscribemodel->unsubscriber($phone);
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
