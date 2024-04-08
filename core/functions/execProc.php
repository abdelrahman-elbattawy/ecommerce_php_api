<?php
function execProc($procName, $params, $values, $json = true)
{
  global $con;

  if ($params != null) {
    $stmt = $con->prepare("CALL $procName ($params)");
  } else {
    $stmt = $con->prepare("CALL $procName");
  }
  $stmt->execute($values);

  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count = $stmt->rowCount();

  if ($json == true) {
    if ($count > 0) {
      printResults(ResultType::Success, $data);
    } else {
      printResults(ResultType::Failure, "No data!");
    }
  } else {
    return $data;
  }
}
