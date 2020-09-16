<?php

include APPPATH . '/third_party/faker/autoload.php';

class Migrate extends CI_Controller
{

    public function index()
    {
        $this->load->library('migration');
        $list = $this->migration->find_migrations();

        foreach ($list as $key => $item) {
            # code...
            $this->migration->version($key);
        }
    }

    public function userSeed()
    {
        $faker = Faker\Factory::create();

        $users = array();
        for ($i = 0; $i < 1; $i++) {

            $user = array(
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'phone_number' => $faker->PhoneNumber,
                'gender' => ($i % 2 == 0) ? "M" : "F",
                'country_id' => rand(0, 50),
                'password' => password_hash($faker->lastName, PASSWORD_DEFAULT),
                'country_id' => rand(0, 50),
                'created_at' => time(),
                'update_at' => time(),
            );

            $users[] = $user;
        }

        $this->db->insert_batch('users', $users);
    }

    public function countrySeed()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://restcountries.eu/rest/v2/all');

        $result = $response->getBody();
        $result = json_decode($result);

        $countries = array();
        foreach ($result as $key => $item) {
            # code...
            $country = array(
                'name' => $item->name,
                'alpha2_code' => $item->alpha2Code,
                'alpha3_code' => $item->alpha3Code,
                'calling_code' => $item->callingCodes[0],
                'demonym' => $item->demonym,
                'flag' => $item->flag,
            );

            $countries[] = $country;
        }

        $this->db->insert_batch('countries', $countries);
    }
}
