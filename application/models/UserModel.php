<?php

class UserModel extends CI_Model
{
    public $table1 = 'users';
    public $table2 = 'countries';

    # field yang ada di table user
    public $column_order = array(null, 'u.first_name', 'u.email', 'u.phone_number', 'u.gender', 'c.name');
    # field yang diizin untuk pencarian
    public $column_search = array('u.first_name', 'u.last_name', 'u.email', 'u.phone_number', 'u.gender', 'c.name');
    # default order  
    public $order = array('u.id' => 'asc');

    public function getUser($username)
    {
        $data = $this->db
            ->select('*')
            ->get_where($this->table1, array('email' => $username), 1, 0)
            ->result();

        return $data;
    }

    public function getUserByID($uid)
    {
        $data = $this->db
            ->select('*')
            ->get_where($this->table1, array('id' => $uid), 1, 0)
            ->result();

        return $data;
    }

    public function insertUser($data)
    {
        return $this->db->insert($this->table1, $data);
    }

    public function updateUserByID($uid, $data)
    {
        $this->db->where('id', $uid);
        $this->db->update($this->table1, $data);

        return $this->db->affected_rows();
    }

    public function deleteUserByID($uid)
    {
        $this->db->where('id', $uid);
        $this->db->delete($this->table1);

        return $this->db->affected_rows();
    }

    public function getAllUser()
    {
        $data = $this->db
            ->select('u.id, CONCAT(u.first_name, " ", u.last_name) AS fullname, u.email, u.phone_number, IF(u.gender="M", "Male", "Female") AS gender, c.name')
            ->from("$this->table1 AS u")
            ->join("$this->table2 AS c", "c.id = u.id")
            ->get()
            ->result();

        return $data;
    }

    private function _get_datatables_query()
    {
        $this->db->select('u.id, CONCAT(u.first_name, " ", u.last_name) AS fullname, u.email, u.phone_number, IF(u.gender="M", "Male", "Female") AS gender, c.name');
        $this->db->from("$this->table1 AS u");
        $this->db->join("$this->table2 AS c", "c.id = u.id");

        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            $search = (isset($_POST['search']['value'])) ? $_POST['search']['value'] : null;
            if ($search) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                } else {
                    $this->db->or_like($item, $search);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($_page = null, $_length = null)
    {
        $this->_get_datatables_query();
        $length = $this->input->post_get('length');
        $start = $this->input->post('start');

        if ($_length)
            $length = $_length;
        if ($_page)
            $start = $_page;

        if ($length != -1)
            $this->db->limit($length, $start);
        $query = $this->db->get();

        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table1);
        return $this->db->count_all_results();
    }

    public function updateUser($username, $phone_number)
    {

        $data = array(
            'phone_number' => $phone_number
        );

        $this->db->where('email', $username);
        return $this->db->update($this->table1, $data);
    }
}
