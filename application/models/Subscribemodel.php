<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribemodel extends CI_Model {

    public function subscriber($name,$phone)
    {
        $this->db->set('name', $name);
        $this->db->set('phone', $phone);
        $this->db->set('is_subscribed', 1);
        $this->db->insert('subscriber');
        return "JazakhAllah! You are Now Subscribed!";
    }

    public function unsubscriber($phone)
    {
        $this->db->where('phone', $phone);
        $this->db->update('subscriber', ['is_subscribed'=>0]);
        return "You are Now Unsubscribed!";

    }

}

/* End of file SubscribeModel.php */
