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

//유저 아이디
$User_ID = $_SESSION["SESSION_User_ID"];

$sql = 'SELECT * FROM allergy';

if(mysqli_multi_query($mysqli, $sql)){ 
    if ($result = mysqli_store_result($mysqli)) {
        while ($row = mysqli_fetch_row($result)) {
        $allergyID = $row[0];
        $allergyName = $row[1];
        }
    }
}

//알러지 갯수를 받아옴 N개
// 이걸로 반복하면서 i가 체크된 폼 알러지넘버 (예:1,2,3) 배열에 들어있으면 -> 1
// 안들어있으면 0

// 0인건 딜리트
// 1인건 추가

//알러지 체크박스 폼 정보
for ($i=0; $i<count($_POST['allergy_form']); $i++) {
    $allergy = $_POST['allergy_form'];
    $allergy_num = $allergy[$i];

    $sql = "
    INSERT IGNORE INTO user_allergy (Allergy_ID, user_ID) VALUES ('".$allergy_num."','".$User_ID."')
    ";
    mysqli_query($mysqli, $sql);
}
mysqli_close($mysqli);

echo "<script>location.replace('./Mypage.php');</script>";

?>