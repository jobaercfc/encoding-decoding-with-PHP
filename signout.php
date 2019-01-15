<?php
/**
 * Created by PhpStorm.
 * User: surid
 * Date: 1/16/2019
 * Time: 3:07 AM
 */
session_start();
session_destroy();
header("location: login.php");