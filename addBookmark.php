<?php
session_start(); // 세션 시작

$mysqli = mysqli_connect("localhost", "team06", "team06", "team06");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    
    $userID = isset($_SESSION['User_ID']) ? $_SESSION['User_ID'] : '';

    $resID = isset($_POST['Res_ID']) ? $_POST['Res_ID'] : '';

    $insertQuery = "INSERT INTO bookmark (User_ID, Res_ID) VALUES ('$userID', '$resID')";

    if (mysqli_query($mysqli, $insertQuery)) {
        echo '북마크 성공';
    } else {
        echo '북마크 실패 ' . mysqli_error($mysqli);
    }
}
?>
