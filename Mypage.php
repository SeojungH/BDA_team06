<!-- 로그인 된 상태에서 유저 정보 받아오기

다음으로 코드로 데이터베이스 연결 후 세션 스타트
session_start(); //세션 시작

유저 아이디 변수
$_SESSION["SESSION_User_ID"]
유저 이름 변수
$_SESSION["SESSION_User_name"]

로 받아오시면 됩니다. -->

<!-- 데이터베이스 연결 -->

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
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      />
      <link href="./css/Mypage.css" rel="stylesheet" />
      <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
      <script type="text/javascript">   
      $(document).ready( function() {
      $("#nav").load("html/nav.html");
      });
      </script>
      <title>
        마이페이지
      </title>
    </head>
    <div id="nav"></div>
    <body>
      <div class = "profile-img-box">
        <div class = "profile-background-img"></div>
        <div class = "profile-circle-img-wrap">
          <div class="profile-circle-img" onclick = "location.href='bookmark.php'">
            <!-- 샘플 프로필 이미지 (추후 데이터베이스에서 받아옴) -->
            <img src = "./img/sample_profile_img.jpg"> 
          </div>
        </div>
      </div>
      <div class = "profile-content-box">
        <div class = "profile-bio">
          <!-- 프로필 정보 (이름/바이오) -->
          <div class = "profile-bio-content">
            <?php

            echo '
            <div class = "profile-name">'.$_SESSION["SESSION_User_name"].'</div>
            ';

            $User_ID = $_SESSION["SESSION_User_ID"];

            $sql = "
            SELECT * FROM User WHERE User_ID ='".$User_ID."'
            ";

            $result = mysqli_query($mysqli, $sql);
            if ($result) {
              $row = mysqli_fetch_array($result);
              $User_bio = $row['User_bio'];
              // $User_
              echo ''
              .$User_bio.
              '';
            }

            mysqli_free_result($result);

            ?>
          </div>
        </div>
        <div class = "profile-allergy">
          <!-- 알러지 입력 폼 -->
          <form action = "user_allergy_update.php" method="POST">
            <div class="container">
              <ul class="ks-cboxtags">
                <?php
                                  
                  // 알러지 체크박스 구성
                  $sql = 'SELECT * FROM allergy';

                  if(mysqli_multi_query($mysqli, $sql)){ 
                    if ($result = mysqli_store_result($mysqli)) {
                      while ($row = mysqli_fetch_row($result)) {
                        $allergyID = $row[0];
                        $allergyName = $row[1];

                        // 아직 작동 안됨
                        // $sql_2 = "
                        // SELECT * FROM User_Allergy WHERE User_ID ='".$User_ID."'
                        // ";
                        // echo $sql_2;
                        // $row_2 = mysqli_query($mysqli, $sql_2);
                        // $allergyCheck = mysqli_fetch_row($row_2);
                        // if (in_array($allergyID,$allergyCheck)) { //사용자가 이 알러지를 이미 체크해두었음
                        //   $CHECK = "on";
                        // } else {
                        //   $CHECK = "off";
                        // }

                        // $allergyCheck
                        echo '
                        <li><input type="checkbox" name="allergy_form[]" checked="off" id="'.$allergyID.'" value="'.$allergyID.'"><label for="'.$allergyID.'">'.$allergyName.'</label></li>
                        ';
                      }
                    }
                  }
                mysqli_free_result($result);
                mysqli_close($mysqli);
              ?>
              </ul>
            </div>
            <div class="btn-wrap-allergy-update">
                    <button class="btn-allergy-update" onclick = "location.href='User_allergy_update.php'">알러지 정보 업데이트</button>
            </div>
          </form>
        </div>
      </div>
    </body>
</html>