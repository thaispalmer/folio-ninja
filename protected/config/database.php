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
        'connectionString' => 'mysql:host=localhost;dbname=folioninja_db',
        'emulatePrepare' => true,
        'username' => 'folioninja_usr',
        'password' => 'TrcFoHWOyr',
        'charset' => 'utf8',
    );
}
