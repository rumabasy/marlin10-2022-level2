<?php

Database::getInstance()->query('SELECT * FROM users');
Database::getInstance()->query("SELECT * FROM users WHERE username=?", ['Sergii']);
$users=Database::getInstance()->get('users', ['name', '=', 'marlin']);


foreach ($users as $user) {
    echo $user->name;
}


