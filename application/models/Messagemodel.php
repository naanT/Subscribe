<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messagemodel extends CI_Model{

private $msgtime=array();
  public function __construct()
  {
    parent::__construct();
  }

  public function add_message($message_id,$text_message,
                              $created_at,$message_status)
  {
    $data = array(
        'message_id' => $message_id,
        'message' => $text_message,
        'message_status'  => $message_status,
        'created_at' => date("Y-m-d H:i:s" , $created_at)
);
    $this->msgtime[]=date("Y-m-d H:i:s" , $created_at);
    $this->db->insert('hadith', $data);
  }


public function get_ids()
{
      $query=$this->db->select('*')
                      ->from('hadith')
                      ->get();
    $array = array();

    foreach($query->result_array() as $row)
    {
      // if ($this->msgtime==$row['created_at']) {
        $array[] = $row['message_id'];
      // }
    }
    return $array;
}

  public function save_status($status,$textstatus)
  {
      for ($i=0; $i < sizeof($status) ; $i++) {
        $this->db->set('message_status', $textstatus[$i])
                  ->update('hadith')
                  ->where('message_id', $status[$i]);
      }
  }

  public function get_contacts()
  {

    $query=$this->db->select(['*'])
              ->from('subscriber')
              ->where('is_subscribed',1)
              ->get();

    return $query->result_array();
  }

  public function get_status()
  {

    $get_contact=$this->db->from('subscriber')->where('is_subscribed',1)->get();
    $count_contact=$get_contact->num_rows();


    $query=$this->db->select(['*'])
                    ->from('hadith')
                    ->order_by('created_at','DESC')
                    ->get();

      $array = array();

        foreach ($query->result_array() as $row ) {
          $array[] = $row['message_status'];
          if(--$count_contact==0)break;
        }
        
      return $array;

  }


}
