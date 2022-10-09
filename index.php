<?php
require_once 'Database.php';

// $userz=Database::getInstance()->query('SELECT * FROM userz WHERE username="first user"');//first user
// $userz=Database::getInstance()->query('SELECT * FROM userz WHERE username=?', ['first user']);//first user
// $userz=Database::getInstance()->query('SELECT * FROM userz WHERE username IN (?,?)', ['first user','third user']);//first user third user

// $userz=Database::getInstance()->get0('userz', ['password','=','pass']);
// $userz=Database::getInstance()->delete0('userz', ['password','=','pass4']);
// $userz=Database::getInstance()->delete('userz', ['id','=','3']);
$userz=Database::getInstance()->get('userz', ['password','=','pass9']);
// Database::getInstance()->delete('userz', ['username','=','fiveth user']);


// dump($userz,9);

if($userz->error()){
    echo 'we have an error<br>';
} else {
    foreach ($userz->results() as $user) {
        echo '<br>'. $user->username;
    }

}

echo '<br>';
echo '<br>';

if(Database::getInstance()->get0('userz', ['username','=','first user'])->count()<5){
    foreach ($userz->results() as $user) {
                echo '<br>'. $user->username;
            }
}

echo '<br>';
// dump($userz);




