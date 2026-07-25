<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_save_path(sys_get_temp_dir());

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
