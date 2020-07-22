<?php

// API to see if the app is working.
// Returns status:up if so.

$response_raw = array("status"=>"up");

echo json_encode($response_raw);
