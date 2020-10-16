<?php
//Route: onlinenotes.vice/api/isup
//JSON template:
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

echo json_encode(
    array("status" => "up"),
    JSON_PRETTY_PRINT
);
