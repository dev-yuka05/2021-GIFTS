<?php 
try {
    $db = new PDO("mysql:host=localhost;dbname=myweb;charset=utf8;","root","");
} catch (PDOException $e){
    die("<h1>sorry!!!</h1> 내용 : ". $e ->getMessage());
}