<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Telegram extends CI_Controller {
		
	public function index()
	{
		$this->load->view('telegram');
	}
	public function send()
	{
		$config = [
			'upload_path'	=>		'./uploads',
			'allowed_types'	=>		'png',
		];

		$this->load->library('upload', $config);
		$this->load->library('form_validation');

		if( $this->upload->do_upload('image') ) {

			$post = $this->input->post('body');

			$data = $this->upload->data();
			$image_path = base_url("uploads/" . $data['raw_name'] . $data['file_ext']);

            // telegram code

                $token='303724118:AAEM1zlVreJQXAxsqrHH95a-TulbHyscuQs';
                $telegram = new TelegramBot\TelegramBot($token);

                // $telegram->sendMessage([
                //     'chat_id' => '@subscribenaan',
                //     'text' => $post
                // ]);
            

                // $img = curl_file_create($image_path,'image/png');
                

                $telegram->sendPhoto([
                    'chat_id' => '@subscribenaan', 
                    'photo' => $image_path,
                    'caption' => $post
                ]);
            



            // telegram code
			$post['image_path'] = $image_path;
			return $this->_falshAndRedirect(
					"Article Added Successully.",
					"Article Failed To Add, Please Try Again."
					);
		} else {
			$upload_error = $this->upload->display_errors();
			$this->load->view('telegram',compact('upload_error'));
		}
	}
	
	private function _falshAndRedirect( $successful, $successMessage, $failureMessage )
	{
		if( $successful ) {
			$this->session->set_flashdata('feedback',$successMessage);
			$this->session->set_flashdata('feedback_class', 'alert-success');
		} else {
			$this->session->set_flashdata('feedback', $failureMessage);
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}
		return redirect('telegram');
	}
}