<?php

session_name('로그인');
session_start(); 

$mysqli = mysqli_connect("localhost", "team06", "team06", "team06");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    
    $userID = isset($_SESSION['SESSION_User_ID']) ? $_SESSION['SESSION_User_ID'] : '';

    $resid = isset($_GET['Res_ID']) ? $_GET['Res_ID'] : ''; 

    $insertQuery = "INSERT INTO bookmark (User_ID, Res_ID) VALUES ('$userID', '$resid')";

    $checkQuery = "SELECT * FROM bookmark WHERE User_ID = '$userID' AND Res_ID = '$resid'";
    $checkResult = mysqli_query($mysqli, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('이 리소스는 이미 북마크되었습니다.');</script>";
        echo "<script>history.back();</script>";
    } else {
        if (mysqli_query($mysqli, $insertQuery)) {
            echo "<script>alert('북마크 성공');</script>";
            echo "<script>history.back();</script>";
        } else {

            error_log("북마크 실패: " . mysqli_error($mysqli));

            echo "<script>alert('북마크 실패');</script>";
            echo "<script>history.back();</script>";
        }
    }
}
