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
        echo '북마크를 추가하는 중에 오류가 발생했습니다.';
    }
    $userID = isset($_SESSION['User_ID']) ? $_SESSION['User_ID'] : '';
    $checkQuery = "SELECT * FROM bookmark WHERE User_ID = '$userID' AND Res_ID = '$resID'";
    $checkResult = mysqli_query($mysqli, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        echo '이 리소스는 이미 북마크되었습니다.';
    } else {
        if (mysqli_query($mysqli, $insertQuery)) {
            echo '북마크 성공';
        } else {

            error_log("북마크 실패: " . mysqli_error($mysqli));

            echo '북마크를 추가하는 중에 오류가 발생했습니다.';
        }
    }
}
