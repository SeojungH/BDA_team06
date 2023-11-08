<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/Login.css" />
    <title>
        Login
    </title>
  </head>
  <body>
    <div class = "content">
        <div class="Left-box">

        </div>
        <div class="Login-box">
            <h1>로그인</h1>
            <!-- 로그인 폼 -->
            <form action = "login.php">
                <div class="Login-input-box">
                    <div class="form__group field__id">
                        <input type="text" class="form__field__id" placeholder="user_id" name="user_id" id='user_id' required />
                        <label for="ID" class="form__label__id">Email</label>
                    </div>
                    <div class="form__group field__pw">
                        <input type="text" class="form__field__pw" placeholder="user_pwd" name = "user_pwd" id = "user_pwd" required />
                        <label for="Password" class="form__label__pw">Password</label>
                    </div>
                </div>
                    <div class="btn-wrap-login">
                        <button class="btn-Login">Login</button>
                    </div>
            </form>
            <div class = "register-box">
                <p>아직 회원이 아니신가요?</p>
                <div class="btn-wrap-register">
                    <button class="btn-Register">Register</button>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>