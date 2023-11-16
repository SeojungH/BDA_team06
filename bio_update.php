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

    //한글 깨짐 오류 인코딩
    mysqli_query($mysqli, "SET NAMES utf8");

    $User_ID = $_SESSION["SESSION_User_ID"];
    $new_bio = trim($_POST['bio']);

    $sql = "
    UPDATE user SET User_bio = '".$new_bio."' WHERE User_ID = '".$User_ID."';
    ";
    mysqli_query($mysqli, $sql);

    if (mysqli_affected_rows($mysqli)>0) {
        echo "<script>alert('바이오가 변경되었어요!');</script>";
        echo "<script>location.replace('./Mypage.php');</script>";
        exit;
    }else if(mysqli_affected_rows($mysqli)<1){
        echo "<script>alert('바이오 변경에 실패했어요.');</script>";
        echo "<script>location.replace('./Mypage.php');</script>";
        exit;
    }
    
    mysqli_close($mysqli);
?>