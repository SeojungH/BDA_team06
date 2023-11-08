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
    <link rel="stylesheet" href="./css/Login.css" />
    <title>
        로그인
    </title>
  </head>
  <body>
    <div class = "content">
        <div class="Left-box">
        </div>
        <div class="Login-box">
            <h1>로그인</h1>
            <!-- 로그인 폼 -->
            <form action = "./Login_check.php" method="POST">
                <div class="Login-input-box">
                    <div class="form__group field__id">
                        <input type="text" class="form__field__id" placeholder="user_id" name="user_id" id='user_id' required />
                        <label for="ID" class="form__label__id">ID</label>
                    </div>
                    <div class="form__group field__pw">
                        <input type="text" class="form__field__pw" placeholder="user_pw" name = "user_pw" id = 'user_pw' required />
                        <label for="Password" class="form__label__pw">Password</label>
                    </div>
                </div>
                    <div class="btn-wrap-login">
                        <button class="btn-Login">Login</button>
                    </div>
            </form>
            <!-- 회원가입 -->
            <div class = "register-box">
                <p>아직 회원이 아니신가요?</p>
                <div class="btn-wrap-register">
                    <button class="btn-Register" onclick = "location.href='CreateUser.php'">Register</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    mysqli_close($mysqli); 
    ?>

  </body>
</html>