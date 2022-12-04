<?php
//get session info 
session_start();

//deletes session info
session_unset();
session_destroy();

//go to index page
header('Location: ../index.php');
