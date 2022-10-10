<?php
require_once 'Database.php';

// $userz=Database::getInstance()->query('SELECT * FROM userz WHERE username="first user"');//first user
// $userz=Database::getInstance()->query('SELECT * FROM userz WHERE username=?', ['first user']);//first user
// $userz=Database::getInstance()->query('SELECT * FROM userz WHERE username IN (?,?)', ['first user','third user']);//first user third user

// $userz=Database::getInstance()->get0('userz', ['password','=','pass']);
// $userz=Database::getInstance()->delete0('userz', ['password','=','pass4']);
// $userz=Database::getInstance()->delete('userz', ['id','=','3']);
// $userz=Database::getInstance()->get('userz', ['password','=','pass9']);
// Database::getInstance()->delete('userz', ['username','=','fiveth user']);

// Database::getInstance()->update('userz', 14, [
    //     'username'=>'Serd',
    //     'password' => 'ega1414',
    // ]);
    
    // Database::getInstance()->insert('userz', [
        //     'username'=>'Seregas',
        //     'password' => 'pas',
        //     'email' => 'my@e.mail',
        // ]);
        
        $userz=Database::getInstance()->get('userz', ['id','=','16']);

dump($userz->get_first()->username,8);
dump($userz->get_first()->id,8);
dump($userz->get_first()->password,8);

// if($userz->error()){
//     echo 'we have an error<br>';
// } else {
//     foreach ($userz->results() as $user) {
//         echo '<br>'. $user->username;
//     }

// }

echo '<br>';
// echo '<br>';

// if( $user=Database::getInstance()->get0('userz', ['username','=','first user'])){
//     foreach ($user->results() as $use) {
//                 echo '<br>'. $use->id;
//             }
// }

echo '<br>';
// dump($user);




