<?php
session_start();
$location = dirname(__DIR__);
if(isset($_SESSION['user']))
    header('Location:../');