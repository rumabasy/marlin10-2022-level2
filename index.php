<?php

require_once 'init.php';

echo "Hello World!<br>";

var_dump(Session::get(Config::get('session.user_session')));