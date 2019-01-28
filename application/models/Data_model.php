<?php
class Data_model extends CI_Model {

  public function insert_guest($guest) {
    $this->db->insert('guest', $guest);
    return $this->db->insert_id();
  }

  public function insert_companion($companion, $id_guest) {
    $this->db->insert('companion', $companion);
    $id_companion = $this->db->insert_id();
    $g_c = array(
      'id_g' => $id_guest,
      'id_c' => $id_companion
    );
    $this->db->insert('guest_companion', $g_c);
  }

  public function get_guests() {
    return $this->db->get('guest')->result();
  }

  public function get_companion($id_g) {
    $query = 'SELECT c.name, c.confirmed FROM companion as c, guest_companion as gc WHERE c.id_c = gc.id_c AND gc.id_g = '.$id_g;
    return $this->db->query($query)->result();
  }

  public function get_total_guests() {
    $query = 'SELECT (g.total + c.total) as total_guests FROM (SELECT COUNT(id_g) as total FROM guest) as g, (SELECT COUNT(id_c) as total FROM companion) as c';
    return $this->db->query($query)->result();
  }

  public function get_total_confirmed() {
    $query = 'SELECT (g.total + c.total) as total_confirmed FROM (SELECT COUNT(id_g) as total FROM guest WHERE confirmed = 1) as g, (SELECT COUNT(id_c) as total FROM companion WHERE confirmed = 1) as c';
    return $this->db->query($query)->result();
  }

  public function get_guest($id_g) {
    $this->db->where('id_g', $id_g);
    return $this->db->get('guest')->result();
  }

  public function get_guest_companion ($id_g) {
    $this->db->select('companion.id_c, companion.name, companion.confirmed');
    $this->db->from('companion');
    $this->db->join('guest_companion', 'companion.id_c = guest_companion.id_c');
    $this->db->where('guest_companion.id_g', $id_g);
    return $this->db->get()->result();
  }

  public function get_guest_confirmed($id_g) {
    $query = 'SELECT (g.total + c.total) as total_confirmed FROM (SELECT COUNT(id_g) as total FROM guest WHERE confirmed = 1 AND id_g = '.$id_g.') as g, (SELECT COUNT(companion.id_c) as total FROM companion, guest_companion WHERE confirmed = 1 AND companion.id_c = guest_companion.id_c AND guest_companion.id_g = '.$id_g.') as c';
    return $this->db->query($query)->result();
  }

  public function set_guest_confirmation ($id_g, $confirmed) {
   $this->db->set('confirmed', $confirmed);
   $this->db->where('id_g', $id_g);
   return $this->db->update('guest');
  }

  public function set_companion_confirmation ($id_c, $confirmed) {
   $this->db->set('confirmed', $confirmed);
   $this->db->where('id_c', $id_c);
   return $this->db->update('companion');
  }

  public function verify_user_has_password($guest_link) {
    $this->db->select('password');
    $this->db->where('link', $guest_link);
    return $this->db->get('guest')->result();
  }

  public function set_guest_password($password, $guest_link) {
    $this->db->set('password', $password);
    $this->db->where('link', $guest_link);
    return $this->db->update('guest');
  }

  public function login_guest($password, $link) {
    $this->db->where('password', $password);
    $this->db->where('link', $link);
    return $this->db->get('guest')->result();
  }
}
?>
