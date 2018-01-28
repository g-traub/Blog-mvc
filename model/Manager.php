<?php
class Manager 
{
    protected function dbconnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=Blog2;charset=utf8','root','');
        return $db;
    }
}