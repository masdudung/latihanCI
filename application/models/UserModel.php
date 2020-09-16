
<?php

class UserModel extends CI_Model
{
    public $table = 'user';
    public $table1 = 'users';
    public $table2 = 'countries';

    public function getUser($username)
    {

        $data = $this->db
            ->select('*')
            ->get_where($this->table, array('username' => $username), 1, 0)
            ->result();

        return $data;
    }

    public function getAllUser()
    {
        $data = $this->db
            ->select('u.first_name, u.last_name, u.email, u.phone_number, IF(u.gender="M", "Male", "Female") AS gender, c.name')
            ->from("$this->table1 AS u")
            ->join("$this->table2 AS c", "c.id = u.id")
            ->get()
            ->result();

        return $data;
    }

    public function getAllCountry()
    {
        $data = $this->db
            ->select('*')
            ->from($this->table2)
            ->get()
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
