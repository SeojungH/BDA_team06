<!-- 데이터베이스 연결 -->
<?php
    $mysqli = mysqli_connect("localhost", "team06", "team06", "team06");
    if(mysqli_connect_errno()){
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/CreateUser.css" />
    <title>
        회원가입
    </title>
  </head>
  <body>
    <div class = "content">
        <div class="Left-box">
            <!-- 뒤로가기 버튼 -->
            <button onclick="history.back()">Go Back</button>
        </div>
        <div class="Login-box">
            <h1>회원가입</h1>
            <!-- 회원가입 폼 -->
            <form action = "./CreateUser_check.php" method="POST">
                <div class="Register-input-box">
                    <div class="form__group field__id">
                        <input type="text" class="form__field__id" placeholder="user_id" name="user_id" id='user_id' required />
                        <label for="ID" class="form__label__id">이메일(아이디)</label>
                    </div>
                    <div class="form__group field__pw">
                        <input type="text" class="form__field__pw" placeholder="user_pwd" name = "user_pwd" id = "user_pwd" required />
                        <label for="Password" class="form__label__pw">비밀번호</label>
                    </div>
                    <div class="form__group field__name">
                        <input type="text" class="form__field__name" placeholder="user_name" name = "user_name" id = "user_name" required />
                        <label for="user_name" class="form__label__name">이름</label>
                    </div>
                    <div class="form__group field__phone">
                        <input type="text" class="form__field__phone" placeholder="user_phone" name = "user_phone" id = "user_phone" required />
                        <label for="user_phone" class="form__label__phone">전화번호</label>
                    </div>
                </div>
                <div class = "register-box">
                    <div class="btn-wrap-register">
                        <button class="btn-Register">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    mysqli_close($mysqli); 
    ?>
    
  </body>
</html>