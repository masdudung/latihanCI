<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration
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
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'phone_number' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'gender' => array(
                'type' => 'ENUM("F", "M")',
            ),
            'country_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
            ),
            'created_at' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'update_at' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}
