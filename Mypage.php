<!-- 로그인 된 상태에서 유저 정보 받아오기

다음으로 코드로 데이터베이스 연결 후 세션 스타트
session_name('로그인');
session_start(); //세션 시작

유저 아이디 변수
$_SESSION["SESSION_User_ID"]
유저 이름 변수
$_SESSION["SESSION_User_name"]

로 받아오시면 됩니다. -->

<!-- 데이터베이스 연결 -->
<?php
    $mysqli = mysqli_connect("localhost", "team06", "team06", "team06");
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
        <link href="./css/Mypage.css" rel="stylesheet" />
        <title>
          마이페이지
        </title>
    </head>
    <body>
      <div class = "profile-img-box">
        <div class = "profile-background-img"></div>
        <div class = "profile-circle-img-wrap">
          <div class="profile-circle-img">
            <!-- 샘플 프로필 이미지 (추후 데이터베이스에서 받아옴) -->
            <img src = "./img/sample_profile_img.jpg"> 
          </div>
        </div>
      </div>
      <div class = "profile-content-box">
        <div class = "profile-bio">
          <!-- 샘플 프로필 정보 (추후 데이터베이스에서 받아옴) -->
          <?php
          echo '
          <div class = "profile-name">'.$_SESSION["SESSION_User_name"].'</div>
          ';
          ?>
          <div class = "profile-bio-content">
            샘플 자기소개입니다. 안녕하세요?
          </div>
        </div>
        <div class = "profile-allergy">
          <!-- 알러지 입력 폼 -->
          <form action = "user_allergy_update.php" method="POST">
            <div class="container">
              <ul class="ks-cboxtags">
                <?php                  
                  // 알러지 체크박스 구성
                  $sql = 'SELECT Allergy_ID FROM user_profile WHERE User_ID = 1;';
                  $sql .= 'SELECT * FROM allergy';

                  if(mysqli_multi_query($mysqli, $sql)){ 
                    if ($result = mysqli_store_result($mysqli)) {
                      while ($row = mysqli_fetch_row($result)) {
                        $user_allergy_ID = $row[0];
                      }
                    }
                    mysqli_free_result($result);  

                    mysqli_next_result($mysqli);
                    if ($result = mysqli_store_result($mysqli)) {
                      while ($row = mysqli_fetch_row($result)) {
                        $allergyID = $row[0];
                        $allergyName = $row[1];
                        echo '
                        <li><input type="checkbox" id="'.$allergyID.'" value="Rainbow Dash"><label for="'.$allergyID.'">'.$allergyName.'</label></li>
                        ';
                      }
                    }
                  }
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