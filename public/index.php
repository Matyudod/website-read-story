<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . './../bootstrap.php';

define('APPNAME', 'Story 2T');

session_start();

$router = new \Bramus\Router\Router();

// Auth routes

require_once "./routes/web.php";