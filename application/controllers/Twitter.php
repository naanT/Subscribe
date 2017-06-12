<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Twitter extends CI_Controller {
		
	public function index()
	{
		$this->load->view('twitter');
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


            \Codebird\Codebird::setConsumerKey('S6YYwVp9WhwgegDBePrdZigei', 
            'xC5tPKj8XUcDshxTXZL7bJqPcVtBVTYepW7JDOBy18FxlgfmvD'); // static, see README


            $cb = \Codebird\Codebird::getInstance();

            $cb->setToken('2762909502-dCNbDCUBQNpTf2S3ms7HpkCOLv7Cys8q2UleBL4', 
            '2gDnrYBIuO1jONRoWh6ox0BdzwtahP1da93FKYU8aHdVu');


            $media_files = [
            $image_path
            ];
            // will hold the uploaded IDs
            $media_ids = [];

            foreach ($media_files as $file) {
            // upload all media files
            $reply = $cb->media_upload([
                'media' => $file
            ]);
            // and collect their IDs
            $media_ids[] = $reply->media_id_string;
            }


            $media_ids = implode(',', $media_ids);

            // send Tweet with these medias
            $reply = $cb->statuses_update([
            'status' => $post,
            'media_ids' => $media_ids
            ]);
            // print_r($reply);



            // telegram code
			$post['image_path'] = $image_path;
			return $this->_falshAndRedirect(
					"Article Added Successully.",
					"Article Failed To Add, Please Try Again."
					);
		} else {
			$upload_error = $this->upload->display_errors();
			$this->load->view('twitter',compact('upload_error'));
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
		return redirect('twitter');
	}
}