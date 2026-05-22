<?php
session_unset();
session_destroy();

header("Location: " . BASEURL . "/index.php?page=login");
exit();
?>