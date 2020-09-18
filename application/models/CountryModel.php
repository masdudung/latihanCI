<?php

class CountryModel extends CI_Model
{
    public $table = 'countries';
    # field yang ada di table user
    public $column_order = array(null, 'name', 'alpha2_code', 'alpha3_code', 'calling_code', 'demonym');
    # field yang diizin untuk pencarian
    public $column_search = array('name', 'alpha2_code', 'alpha3_code', 'calling_code', 'demonym');
    # default order  
    public $order = array('id' => 'asc');

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            $search = $this->input->post(array('search', 'value'));
            if ($search) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, (isset($_POST['search']['value']) ? $_POST['search']['value'] : null));
                } else {
                    $this->db->or_like($item, (isset($_POST['search']['value']) ? $_POST['search']['value'] : null));
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
