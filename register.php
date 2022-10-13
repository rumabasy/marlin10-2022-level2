<?php
require_once 'init.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
    
        $validation = $validate->check($_POST, [
            'username' => [
                'required' => true,//требуется для заполнения обязательно
                'min' => 2,
                'max' => 15,
            ],
            'email' => [
                'required' => true,//требуется для заполнения обязательно
                'email' => true,
                'unique' => 'userz'//должно быть уникальное имя таблицы = 'userz'
            ],
            'password' => [
                'required' => true,
                'min' => 3
            ],
            'password_again' => [
                'required' => true,
                'matches' => 'password'//должен совпадать со значением поля пассворд
            ]
        ]);
    
        if($validation->passed()){
                        
            $user =new User;
            $user->create([
               'username' => Input::get('username'),
               'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
               'email' => Input::get('email'),
            ]);
            Session::flash('success', 'register success');
            // header ('Location: /test.php');
            
        } else {
            foreach($validation->errors() as $error){
                echo $error.'<br>';
            }
        }  

    }
}   
  
echo Session::flash('success');
?>   

<form action="" method="post">
    <?php   ?>
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo Input::get('username')?>">
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo Input::get('email')?>">
    </div>

    <div class="field">
        <label for="">Password</label>
        <input type="text" name="password">
    </div>

    <div class="field">
        <label for="">Password Again</label>
        <input type="text" name="password_again">
    </div>
    
    <input type="hidden" name='token' value="<?php echo Token::generate();  ?>" >

    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>

