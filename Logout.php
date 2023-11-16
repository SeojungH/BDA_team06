<!-- 1976333 임채민 -->

<?php

session_start();
session_destroy();

echo "<script>alert('로그아웃이 완료되었습니다.');</script>";
echo "<script>location.replace('./Login.php');</script>";

?>
