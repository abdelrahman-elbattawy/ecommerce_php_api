<?php

function getAllDataByCount($table, $where = null, $values = null, $count, $json = true)
{
  global $con;
  $data = array();

  if ($where == null) {
    if ($count == "All") {
      $stmt = $con->prepare("SELECT * FROM $table ORDER BY RAND()");
    } else {
      $stmt = $con->prepare("SELECT * FROM $table ORDER BY RAND() LIMIT $count");
    }
  } else {
    if ($count == "All") {
      $stmt = $con->prepare("SELECT * FROM $table WHERE $where ORDER BY RAND()");
    } else {
      $stmt = $con->prepare("SELECT * FROM $table WHERE $where ORDER BY RAND() LIMIT $count");
    }
  }

  $stmt->execute($values);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count  = $stmt->rowCount();

  if ($json == true) {
    if ($count > 0) {
      printResults(ResultType::Success, $data);
    } else {
      printResults(ResultType::Failure, "No data!");
    }
  }

  return $data;
}
