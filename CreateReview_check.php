<?php
    // 데이터베이스 연결
    $mysqli = mysqli_connect("localhost", "team06", "team06", "team06");
    if(mysqli_connect_errno()){
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
    }

    //한글 깨짐 오류 인코딩
    mysqli_query($mysqli, "SET NAMES utf8");

    //세션 사용 로그인
    session_name('로그인');
    session_start();

    //유저 아이디
    $User_ID = $_SESSION["SESSION_User_ID"];
    $resid = $_GET['Res_ID'];

    // //트랜잭션
    // START TRANSACTION;
    // COMMIT;

    $sql_1 = "
    INSERT IGNORE INTO res_review (User_ID, Res_ID) VALUES ('".$User_ID."','".$resid."')
    ";

    mysqli_query($mysqli, $sql_1);

    $sql_2 = "
    SELECT MAX(Res_review_ID) FROM res_review;
    ";

    $result = mysqli_query($mysqli, $sql_2);
    $row = mysqli_fetch_array($result);
    $review_ID = $row[0];

    echo $review_ID;

    // 사용자가 체크한 리뷰만큼 반복
    for ($i=0; $i<count($_POST['review_form']); $i++) {
        $review = $_POST['review_form'];
        $review_content = $review[$i];
        echo $review_content;

        $sql_3 = "
        INSERT IGNORE INTO res_review_content (Res_review_ID, Res_review_item_ID) VALUES ('".$review_ID."','".$review_content."')
        ";
    
        mysqli_query($mysqli, $sql_3);

    }

    if (mysqli_affected_rows($mysqli)>0) {
        echo "<script>alert('리뷰 작성 완료!');</script>";
        echo "<script>location.replace('Mypage.php');</script>";
        exit;
    }

    mysqli_close($mysqli);

?>
