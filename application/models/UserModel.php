
<?php

class UserModel extends CI_Model
{
    public $table = 'user';

    public function getUser($username)
    {

        $data = $this->db
            ->select('*')
            ->get_where($this->table, array('username' => $username), 1, 0)
            ->result();

        return $data;
    }

    public function updateUser($username, $about)
    {

        $data = array(
            'about' => $about
        );

        $this->db->where('username', $username);
        return $this->db->update($this->table, $data);
    }
}
