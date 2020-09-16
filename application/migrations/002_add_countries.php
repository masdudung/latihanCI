<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_countries extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'alpha2_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'alpha3_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'calling_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'demonym' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'flag' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('countries');
    }

    public function down()
    {
        $this->dbforge->drop_table('countries');
    }
}
