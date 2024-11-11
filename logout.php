<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['nama_pengguna']);

session_destroy();

header("Location: index.php");
