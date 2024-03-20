<?php
function insertData($table, $data, $json = true)
{
  global $con;
  foreach ($data as $field => $v)
    $ins[] = ':' . $field;
  $ins = implode(',', $ins);
  $fields = implode(',', array_keys($data));
  $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

  $stmt = $con->prepare($sql);
  foreach ($data as $f => $v) {
    $stmt->bindValue(':' . $f, $v);
  }
  $stmt->execute();
  $count = $stmt->rowCount();
  if ($json == true) {
    if ($count > 0) {
      printResults(ResultType::Success, null);
      // echo json_encode(array("status" => "success"));
    } else {
      printResults(ResultType::Failure, "failure to insert data");
      // echo json_encode(array("status" => "failure"));
    }
  }
  return $count;
}
