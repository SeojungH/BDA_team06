<?php
    $mysqli = mysqli_connect("localhost", "team06", "team06", "team06");

    //한글 깨짐 오류 인코딩
    mysqli_query($mysqli, "SET NAMES utf8");			

    if(mysqli_connect_errno()){
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
    }

    // session_name('로그인');
    session_start(); //세션 시작
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/CreateReview.css" />
    <title>
    리뷰 작성
    </title>
    </head>
    <body>
        <div class ="container">
            <form class = "review-box" action = "CreateReview_check.php" method="POST">
                <div class="container">
                    <div class = "create-review-desc"> 남길 리뷰 코멘트를 모두 선택하세요! </div>
                    <ul class="ks-cboxtags">
                        <?php
                            //유저 아이디 필요함?
                            // echo '
                            // <div class = "profile-name">'.$_SESSION["SESSION_User_name"].'</div>
                            // ';                  
                            // 리뷰 체크박스 구성
                            // 리뷰 템플릿 테이블 받아옴
                            $sql = 'SELECT * FROM res_review_item';
                            $result = mysqli_query($mysqli, $sql);
                            if(mysqli_multi_query($mysqli, $sql)){
                                if($result = mysqli_store_result($mysqli)){ 
                                    while($row = mysqli_fetch_array($result)){
                                        $Res_review_item_ID = $row[0];
                                        $Res_review_template = $row[1];
                                        echo '
                                        <li><input type="checkbox" id="'.$Res_review_item_ID.'" value="Rainbow Dash"><label for="'.$Res_review_item_ID.'">'.$Res_review_template.'</label></li>
                                        ';
                                    }
                                }
                            }

                            mysqli_close($mysqli);
                        ?>
                    </ul>
                </div>
                <div class="btn-wrap-create-review">
                        <button class="btn-create-review" onclick = "location.href='User_allergy_update.php'">리뷰 등록</button>
                </div>
            </form>
        </div>
        

    </body>
</html>