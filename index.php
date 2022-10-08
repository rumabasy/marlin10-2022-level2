<?php
require_once 'Database.php';

// $userz=Database::getInstance()->query('SELECT * FROM userz WHERE username="first user"');//first user
// $userz=Database::getInstance()->query('SELECT * FROM userz WHERE username=?', ['first user']);//first user
$userz=Database::getInstance()->query('SELECT * FROM userz WHERE username IN (?,?)', ['first user','third user']);//first user third user

Database::getInstance()->get('userz', ['username','=','first user']);
// Database::getInstance()=>delete('userz', ['username','=','first user']);


dump($userz->count(),9);

if($userz->error()){
    echo 'we have an error<br>';
} else {
    // echo 'we have no error<br>'; //die;
    foreach ($userz->results() as $user) {
        echo '<br>'. $user->username;
    }

}

echo '<br>';
echo '<br>';
// dump($userz);

//Database::getInstance()->query("SELECT * FROM users WHERE username=?", ['Sergii']);
//$users=Database::getInstance()->get('users', ['name', '=', 'marlin']);
//
//
//foreach ($users as $user) {
//    echo $user->name;
//}
//

