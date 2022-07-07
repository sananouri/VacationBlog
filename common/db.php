<?php
    $sname = 'localhost';
    $id = 'root';
    $password = '';
    $db = 'ie';
    $connection = mysqli_connect($sname, $id, $password, $db);

    $posts_table = 'posts';
    $users_table = 'users';

    if(!$connection) {
        echo 'connection failed';
    }
?>