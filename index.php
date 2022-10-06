<?php
require_once 'Database.php';

$userz=Database::getInstance()->query('SELECT * FROM userz');

foreach ($userz as $user) {
    echo '<br>'. $user->username;
}
//Database::getInstance()->query("SELECT * FROM users WHERE username=?", ['Sergii']);
//$users=Database::getInstance()->get('users', ['name', '=', 'marlin']);
//
//
//foreach ($users as $user) {
//    echo $user->name;
//}
//

