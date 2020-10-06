<?php

require "../../memory.php";
require "../../app/tasks.php";
require "../../app/database/read.php";
require "../../app/database/delete.php";

delete_api_connection_token();

header("Location: ./index.php");
