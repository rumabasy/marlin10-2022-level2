<?php

require_once 'init.php';

echo "Hello World!<br>";

// var_dump(Session::get(Config::get('session.user_session')));

$user = new User;
$user31 = new User(2);

if($user->isLoggedIn()){
    echo "Hi, <a href='#'>{$user->data()->username} </a>";
    echo "<p><a href='logout.php'>Logout</a></p>";
} else {
    echo "<a href='login.php'>Login {$user->data()->username}</a> or <a href='register.php'>Registration</a>";
                   
}

// echo $user->data()->username;
// echo "<br>";
// echo $user31->data()->username;