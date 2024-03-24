<?php

include "db_config.php";
include "../config/headers.php";
include "../functions/checkAuth.php";

try {
  $con = new PDO($dsn, $username, $password, $option);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // if (!isset($notAuth)) {
  //   checkAuthenticate();
  // }

} catch (PDOException $ex) {
  echo $ex->getMessage();
}
