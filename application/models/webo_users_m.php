<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Webo_users_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_username($username='')
    {
		$this->db->where('username', $username);
		return $this->db->get('webo_users')->row();
    }

    function insert($params='')
    {
        $this->name   	= $params['name'];
        $this->username = $params['username'];
        $this->email    = $params['email'];
        $this->passwd = $params['passwd'];

        return $this->db->insert('webo_users', $this);
    }

    function update($params='')
    {
        $this->name   	= $params['name'];
        $this->username = $params['username'];
        $this->email    = $params['email'];
        $this->passwd = $params['passwd'];

        return $this->db->update('webo_users', $this, array('id' => $params['id']));
    }

}

/* End of file webo_users_m.php */
/* Location: ./application/models/webo_users_m.php */