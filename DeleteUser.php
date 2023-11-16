<!-- 1976333 임채민 -->

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

    $User_ID = $_SESSION["SESSION_User_ID"];

    //트랜잭션
    $success = true;
    $mysqli->begin_transaction();

   
    try {
        $sql_1 = "
        DELETE FROM Res_review WHERE User_ID = '".$User_ID."';
        ";

        mysqli_query($mysqli, $sql_1);

        $sql_2 = "
            DELETE FROM bookmark WHERE User_ID = '".$User_ID."';
        ";

        mysqli_query($mysqli, $sql_2);

        $sql_3 = "
            DELETE FROM user_allergy WHERE User_ID = '".$User_ID."';
        ";

        mysqli_query($mysqli, $sql_3);

        $sql_4 = "
        DELETE FROM res_rate WHERE User_ID = '".$User_ID."';
        ";

        mysqli_query($mysqli, $sql_4);

        $sql_5 = "
            DELETE FROM user WHERE User_ID = '".$User_ID."';
        ";

        $result = mysqli_query($mysqli, $sql_5);

        if (mysqli_affected_rows($mysqli)>0) {
            session_unset();
            session_destroy();
            echo "<script>alert('회원 탈퇴 완료! 다시 로그인 해주세요.');</script>";
            echo "<script>location.replace('./Login.php');</script>";
        }else if(mysqli_affected_rows($mysqli)<4){
            $success = false;
            echo "<script>alert('회원 탈퇴 처리에 실패했어요.');</script>";
            echo "<script>location.replace('./Mypage.php');</script>";
        }

        $mysqli->commit();

    }  catch (mysqli_sql_exception $exception) {
            $mysqli->rollback();

            throw $exception;
    }

    mysqli_close($mysqli);
?>