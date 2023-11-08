<?php
    // 데이터베이스 연결
    $mysqli = mysqli_connect("localhost", "team06", "team06", "team06");
    if(mysqli_connect_errno()){
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
    }

    //세션 사용 로그인
    session_name('로그인');
    session_start();

    // 아이디 비밀번호 입력값
    $user_id_input = trim($_POST['user_id']);
    $user_pw_input = trim($_POST['user_pw']);

    // echo '
    // <p>'.$user_id_input.' '.$user_pw_input.'</p>
    // ';

    $sql = "
        SELECT * FROM User WHERE User_ID ='".$user_id_input."'
    ";
    $result = mysqli_query($mysqli, $sql);

    if ($result) { //아이디가 데이터베이스에 존재
        $row = mysqli_fetch_array($result);
        if ($user_pw_input == $row['User_password']) { // 패스워드가 맞을 때
            // 아이디 & 이름 저장
            $_SESSION["SESSION_User_ID"] = $row['User_ID'];
            $_SESSION["SESSION_User_name"] = $row['User_name'];

            // echo '
            // <p>'.$_SESSION["SESSION_User_ID"].' '.$_SESSION["SESSION_User_name"].'</p>
            // ';

            // 임시로 마이페이지에 연결 중
            echo "<script>location.replace('./Mypage.php');</script>";
        } else { //비밀번호 오류
            echo "<script>alert('아이디 혹은 비밀번호가 틀립니다.');</script>";
            echo "<script>location.replace('./Login.php');</script>";
        }
    } else { //아이디가 존재하지 않음
        echo "<script>alert('아이디가 존재하지 않습니다.');</script>";
        echo "<script>location.replace('./Login.php');</script>";
    }
    
    mysqli_free_result($result);
    mysqli_close($mysqli);
?>