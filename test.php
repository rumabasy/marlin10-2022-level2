<?php
require_once 'Session.php';
session_start();
echo 'You at test.php<br>';
echo Session::flash('success');
