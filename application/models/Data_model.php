<?php
class Data_model extends CI_Model {

  public function insert_guest() {
    $this->name = 'Prueba';
    $this->confirmed = false;
    $this->link = 'http://www.localhost.com';
    $this->db->insert('guest', $this);
  }

  public function get_guest() {
    $this->db->where('name', 'Prueb');
    $this->db->where('confirmed', false);
    $query = $this->db->get('guest');
    return $query->result();
  }
}
?>
