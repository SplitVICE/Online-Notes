<?php

require "../../app/tasks.php";
require "../../memory.php";
require "../../app/database/create.php";
require "../../app/database/read.php";

create_new_api_connection_token();

header("Location: ./index.php");