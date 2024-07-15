<?php

    $dsn='mysql:db-host=127.0.0.1,dbname=myshop'; // data source name for the database
    $user='root';
    $pass='';
    $option =array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    try {
        $con=new PDO($dsn,$user,$pass,$option);
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo 'Successfully Connected to database';
    } 
    catch (PDOException $e){
         echo 'Error connecting to database : '.$e->getMessage();
    }