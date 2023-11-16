<!-- 1976333 임채민 (전체)-->
<!-- 2176278 이원주 (알러지 전체 정보를 배열에 저장, 알러지 정보 삭제) -->

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

//유저 아이디
$User_ID = $_SESSION["SESSION_User_ID"];

$sql = 'SELECT * FROM allergy';

if(mysqli_multi_query($mysqli, $sql)){ 
    if ($result = mysqli_store_result($mysqli)) {
        $allergyIDarray = array();
        while ($row = mysqli_fetch_row($result)) {
            array_push($allergyIDarray, $row[0]);
        }
    }
}

//알러지 체크박스 폼 정보
$allergy = (isset($_POST['allergy_form']))? $allergy = $_POST['allergy_form']: array();

//알러지 전체 반복하면서 i가 체크된 폼 알러지넘버 (예:1,2,3) 배열에 들어있으면 -> 추가
// 안들어있으면 삭제
for ($i=0; $i<count($allergyIDarray); $i++) {
    $allergy_num = $allergyIDarray[$i];

    if(in_array($allergy_num, $allergy)){
        $sql = "INSERT IGNORE INTO user_allergy (Allergy_ID, user_ID) VALUES ('".$allergy_num."','".$User_ID."')";
    }else{
        $sql = "DELETE FROM user_allergy WHERE Allergy_ID='".$allergy_num."' AND user_ID='".$User_ID."'";
    }
    mysqli_query($mysqli, $sql);
}
mysqli_close($mysqli);

echo "<script>location.replace('./Mypage.php');</script>";

?>