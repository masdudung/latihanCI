<?php

/**
 * Setting validation perController
 */
$config = array();
$config['error_prefix'] = '';
$config['error_suffix'] = '';

/**
 * Setting validation group
 */
$config['login'] = array(
    array(
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'required|valid_email'
    ),
    array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
    )
);

$config['post_users'] = array(
    array(
        'field' => 'first_name',
        'label' => 'First Name',
        'rules' => 'required'
    ),
    array(
        'field' => 'last_name',
        'label' => 'Last Name',
        'rules' => 'required'
    ),
    array(
        'field' => 'phone_number',
        'label' => 'Phone Number',
        'rules' => 'required'
    ),
    array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|is_unique[users.email]'
    ),
    array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
    )
);

$config['put_users'] = array(
    array(
        'field' => 'first_name',
        'label' => 'First Name',
        'rules' => 'required'
    ),
    array(
        'field' => 'last_name',
        'label' => 'Last Name',
        'rules' => 'required'
    ),
    array(
        'field' => 'phone_number',
        'label' => 'Phone Number',
        'rules' => 'required'
    ),
    array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
    )
);