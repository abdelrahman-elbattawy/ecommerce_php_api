<?php

enum ResultType
{
  case Success;
  case Failure;
}

function printResults($type, $data)
{
  if ($type == ResultType::Success) {
    if (is_null($data)) {
      echo json_encode(array("status" => "success"));
    } else {
      echo json_encode(array("status" => "success", "data" => $data));
    }
  } else if ($type == ResultType::Failure) {
    if (is_null($data)) {
      echo json_encode(array("status" => "failure"));
    } else {
      echo json_encode(array("status" => "failure", "message" => $data));
    }
  }
}
