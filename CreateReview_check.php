<?php
$mysqli = mysqli_connect("localhost", "team06", "team06", "team06");

//한글 깨짐 오류 인코딩
mysqli_query($mysqli, "SET NAMES utf8");			

if(mysqli_connect_errno()){
printf("Connection failed: %s\n", mysqli_connect_error());
exit();
}
session_name('로그인');
session_start(); //세션 시작

//유저 아이디
$User_ID = $_SESSION["SESSION_User_ID"];

//알러지 체크박스 폼 정보
for ($i=0; $i<count($_POST['allergy_form']); $i++) {
    $allergy = $_POST['allergy_form'];
    $allergy_num = $allergy[$i];

    // // 이미 등록되어있으면 패스
    // $sql = "SELECT * FROM user_allergy WHERE User_ID = '".$User_ID."' AND Allergy_ID ='".$allergy_num."'";
    // $result = mysqli_query($mysqli, $sql);
    // $row = mysqli_fetch_row($result);
    // if(in_array($allergy_num, $row)) {
    //     echo $allergy_num;
    //     continue;
    // }
    $sql = "
    INSERT IGNORE INTO user_allergy (Allergy_ID, user_ID) VALUES ('".$allergy_num."','".$User_ID."')
    ";
    mysqli_query($mysqli, $sql);
}
mysqli_close($mysqli);

echo "<script>location.replace('./Mypage.php');</script>";

?>