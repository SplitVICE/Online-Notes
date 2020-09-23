<?php
require "../memory.php";
require "../app/database/delete.php";
require "../app/database/read.php";
require "../app/tasks.php";

delete_all_sessions_user_request_or_account_delete();

header("Location: ../index.php");
