<?php

function response($status, $message, $data = []) {
  echo json_encode(array_merge([
    "status" => $status,
    "message" => $message
  ], $data));
  exit;
}

