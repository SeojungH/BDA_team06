<?php
    // 데이터베이스 연결
    $mysqli = mysqli_connect("localhost", "team06", "team06", "team06");
    if(mysqli_connect_errno()){
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
    }

    //한글 깨짐 오류 인코딩
    mysqli_query($mysqli, "SET NAMES utf8");

    // 회원정보 입력값
    $user_id_input = trim($_POST['user_id']);
    $user_pw_input = trim($_POST['user_pw']);
    $user_name_input = trim($_POST['user_name']);
    $user_phone_input = trim($_POST['user_phone']);

    $user_bio_sample = "기본 바이오 입니다. 새로 설정해 주세요.";

    if ( $mysqli === false ) {
		die("데이터베이스 연결 불가".mysqli_connect_error());
	} else {
        //바이오는 기본 문구로 삽입
        $sql = "
        INSERT IGNORE INTO user (User_ID, User_password, User_name, User_num, User_bio) 
        VALUES ('".$user_id_input."','".$user_pw_input."','".$user_name_input."','".$user_phone_input."','".$user_bio_sample."')
        ";

        mysqli_query($mysqli, $sql);

        if (mysqli_affected_rows($mysqli)>0) {
            echo "<script>alert('회원가입이 완료되었습니다. 로그인 해주세요.');</script>";
            echo "<script>location.replace('./Login.php');</script>";
            exit;
        }else if(mysqli_affected_rows($mysqli)<1){
            echo "<script>alert('중복된 ID입니다.');</script>";
            echo "<script>location.replace('./CreateUser.php');</script>";
            exit;
        }
        // else{
        //     echo "<script>alert('ERROR: Could not execute query');</script>";
        //     echo "<script>location.replace('./makeAccount.php');</script>";
        //     exit;
        // } 
    }

    mysqli_close($mysqli);
?>