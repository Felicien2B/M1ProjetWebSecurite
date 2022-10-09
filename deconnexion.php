<?php
session_start();
unset ($_SESSION["mail_user"]);
echo "<script language='javascript'>";
echo "window.parent.document.location.href = 'authentification.php';";
echo "</script>";
?>
