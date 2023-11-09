<?php
    // 데이터베이스 연결
    $mysqli = mysqli_connect("localhost", "team06", "team06", "team06");
    if(mysqli_connect_errno()){
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
    }

    // 회원정보 입력값
    $user_id_input = trim($_POST['user_id']);
    $user_pw_input = trim($_POST['user_pw']);
    $user_name_input = trim($_POST['user_name']);
    $user_phone_input = trim($_POST['user_phone']);

    // echo '
    // <p>'.$user_id_input.' '.$user_pw_input.'</p>
    // ';
    

    if ()



    mysqli_close($mysqli);
?>