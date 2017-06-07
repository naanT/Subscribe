<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
      $smsGateway = new SmsGateway('raohannan1@gmail.com', 'hannan123');
      $deviceID = 48750;
  }

public function index()
{
  $this->load->view('message');
}
  public function submit()
  {
    // $smsGateway = new SmsGateway('raohannan1@gmail.com', 'hannan123');
    // $deviceID = 48750;

    $message=$this->input->post('text_message');
    $numbers=json_decode($this->input->post('phone'));


    $result = $smsGateway->sendMessageToManyNumbers($numbers, $message, $deviceID);

      for ($i=0; $i <sizeof($result); $i++)
      {
          // don't forget to implement send_at logic here

        $message_id=$result["response"]["result"]["success"][$i]["id"];
        $text_message=$result["response"]["result"]["success"][$i]["message"];
        $message_created_at=$result["response"]["result"]["success"][$i]["created_at"];
        $message_status=$result["response"]["result"]["success"][$i]["status"];
        // $message_send_at=$result["response"]["result"]["success"][$i]["send_at"];

        $this->Messagemodel->add_message($message_id,$text_message,$message_created_at,
                    $message_status);
      }
  }

  public function savestatus()
  {
    

      $ids=$this->Messagemodel->get_ids();

      $re=array();

      for ($i=0; $i < sizeof($ids); $i++) {
        $re[] = $smsGateway->getMessage($ids[$i]);

      }
        $statusText=array();
      for ($j=0; $j < sizeof($re); $j++) {
        $statusText[]= $re[$j]["response"]["result"]["status"];
      }

      $this->Messagemodel->save_status($ids,$statusText);
      echo json_encode($statusText);
  }

  public function getcontacts()
  {
    $contacts=$this->Messagemodel->get_contacts();
     echo json_encode($contacts);
  }

  public function getstatus()
  {
    $stat=$this->Messagemodel->get_status();
     echo json_encode($stat);
  }

  public function incoming()
  {
      
      
  }

}

    class SmsGateway {

        static $baseUrl = "https://smsgateway.me";


        function __construct($email,$password) {
            $this->email = $email;
            $this->password = $password;
        }

        function createContact ($name,$number) {
            return $this->makeRequest('/api/v3/contacts/create','POST',['name' => $name, 'number' => $number]);
        }

        function getContacts ($page=1) {
           return $this->makeRequest('/api/v3/contacts','GET',['page' => $page]);
        }

        function getContact ($id) {
            return $this->makeRequest('/api/v3/contacts/view/'.$id,'GET');
        }


        function getDevices ($page=1)
        {
            return $this->makeRequest('/api/v3/devices','GET',['page' => $page]);
        }

        function getDevice ($id)
        {
            return $this->makeRequest('/api/v3/devices/view/'.$id,'GET');
        }

        function getMessages($page=1)
        {
            return $this->makeRequest('/api/v3/messages','GET',['page' => $page]);
        }

        function getMessage($id)
        {
            return $this->makeRequest('/api/v3/messages/view/'.$id,'GET');
        }

        function sendMessageToNumber($to, $message, $device, $options=[]) {
            $query = array_merge(['number'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST',$query);
        }

        function sendMessageToManyNumbers ($to, $message, $device, $options=[]) {
            $query = array_merge(['number'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendMessageToContact ($to, $message, $device, $options=[]) {
            $query = array_merge(['contact'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendMessageToManyContacts ($to, $message, $device, $options=[]) {
            $query = array_merge(['contact'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendManyMessages ($data) {
            $query['data'] = $data;
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        private function makeRequest ($url, $method, $fields=[]) {

            $fields['email'] = $this->email;
            $fields['password'] = $this->password;

            $url = smsGateway::$baseUrl.$url;

            $fieldsString = http_build_query($fields);


            $ch = curl_init();

            if($method == 'POST')
            {
                curl_setopt($ch,CURLOPT_POST, count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsString);
            }
            else
            {
                $url .= '?'.$fieldsString;
            }

            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HEADER , false);  // we want headers
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $result = curl_exec ($ch);

            $return['response'] = json_decode($result,true);

            if($return['response'] == false)
                $return['response'] = $result;

            $return['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close ($ch);

            return $return;
        }
    }
