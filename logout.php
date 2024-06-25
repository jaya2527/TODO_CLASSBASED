<?php
session_start();
require_once 'auto_loader.php';
use utils\Util;

session_destroy();

Util::redirect('login');

