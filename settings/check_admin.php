<?php
session_start();
if ($_SESSION['user_role'] != 1)  {header("Location: ../view/user_dash.php");}
?>