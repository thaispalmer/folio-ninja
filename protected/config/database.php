<?php

// This is the database connection configuration.

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    return array(
        'connectionString' => 'mysql:host=localhost;dbname=folio-ninja',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    );
}
else {
    return array(
        'connectionString' => 'mysql:host=mysql15.000webhost.com;dbname=a6303249_beta',
        'emulatePrepare' => true,
        'username' => 'a6303249_beta',
        'password' => '0la3y284W854Wxt',
        'charset' => 'utf8',
    );
}