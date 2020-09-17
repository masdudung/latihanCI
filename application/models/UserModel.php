<?php

class UserModel extends CI_Model
{
    public $table = 'user';
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
            ->get_where($this->table, array('username' => $username), 1, 0)
            ->result();

        return $data;
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

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
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

    public function updateUser($username, $about)
    {

        $data = array(
            'about' => $about
        );

        $this->db->where('username', $username);
        return $this->db->update($this->table, $data);
    }
}
