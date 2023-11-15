<!-- 2176278 이원주 -->
<!DOCTYPE html>
<html>
  <head>
    <?php
      session_name('로그인');
      session_start();
    ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Preview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      html,
      body {
        display: block;
        flex-direction: column;
        flex: 1;
        width: 100%;
        height: 100%;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
    </style>
  </head>
  <body>
    <div class="w-[1509px] h-[1452px] relative bg-white">
      <!--네비게이션 바-->
      <div class="w-[1509px] h-[83.83px]">
        <div class="w-[1509px] h-[83.83px] absolute left-[-0.5px] top-[-0.5px] bg-[#ffd233]"></div>
        <div class="w-[738.78px] h-[58.68px]">
          <p class="w-[83.83px] h-[31.44px] absolute left-[389.82px] top-[25.15px] text-[22px] text-left text-white">Account</p>
          <div class="w-[104.79px] h-[3.14px] absolute left-[378.85px] top-[80.19px] bg-white"></div>
          <p class="w-[84.88px] h-[31.44px] absolute left-[580.55px] top-[25.15px] text-[22px] font-light text-left text-[#a0a0a0]">Reposts</p>
          <p class="w-[83.83px] h-[31.44px] absolute left-[770.22px] top-[25.15px] text-[22px] font-light text-left text-[#a0a0a0]">Settings</p>
          <p class="w-[159.28px] h-[31.44px] absolute left-[958.84px] top-[25.15px] text-[22px] font-light text-left text-[#a0a0a0]">Help &#x26; Support</p>
        </div>
        <div class="w-[52.4px] h-[26.2px]">
          <div class="w-[52.4px] h-[2.02px] absolute left-[30.94px] top-[27.79px] bg-white"></div>
          <div class="w-[52.4px] h-[2.02px] absolute left-[30.94px] top-[39.89px] bg-white"></div>
          <div class="w-[52.4px] h-[2.02px] absolute left-[30.94px] top-[51.98px] bg-white"></div>
        </div>
      </div>
    
      <!--검색 필터, 정렬 드롭다운-->
      <!--CSS, JS 코드-->
      <style>
        .dropdown-content {
            display: none;
            flex-wrap:wrap;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            top: 100%; /* 드롭다운을 버튼 아래에 표시 */
            left: 0;
        }

        .dropdown-content a {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
      </style>

      <script>
        function toggleDropdown(kind) {
            var dropdown = document.getElementById(kind+"Dropdown");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }
      </script>
      
      <!--form 태그-->
      <?php
        echo '<form action="" method="POST">';
      ?>
        <!--필터: 카테고리-->
        <div class="dropdown">
          <div class="dropbtn flex justify-start items-center w-[150px] absolute left-[357px] top-[282px] px-4 py-2.5 rounded-[10px] bg-[#fefefe]" style="box-shadow: 0px 4px 20px 0 rgba(255, 214, 0, 0.3)" onclick="toggleDropdown('category')">
            <p class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">카테고리</p>
            
            <div class="dropdown-content" id="categoryDropdown">
              <?php
                $link = mysqli_connect("localhost", "team06", "team06", "team06");
                if($link === false)
                    die('연결안됨'.mysqli_connect_error());
                
                $sql = 'SELECT * FROM category';
                
                if($stmt = mysqli_prepare($link, $sql)){
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_bind_result($stmt, $itemID, $item);
                        while(mysqli_stmt_fetch($stmt)){
                          $isChecked = '';
                          if(isset($_POST['category'])){ // 검색 결과 페이지에서 필터 및 정렬 적용 버튼을 눌렀을 경우
                            if(in_array($itemID, $_POST['category'])){ // 체크된 카테고리 모두
                              $isChecked = 'checked="checked"';
                            }
                          } else if (isset($_GET['category_id'])){ // 메인 페이지에서 카테고리를 선택한 경우
                            if($itemID == $_GET['category_id']){ // 해당 카테고리만
                              $isChecked = 'checked="checked"';
                            }
                          }
                          echo '<label><input type="checkbox" name="category[]" value="'.$itemID.'" '.$isChecked.' class="flex-grow w-[50px] text-base font-semibold text-left text-[#252729]">'.$item.'</label><br>';
                            }
                    } else {
                    echo "쿼리실행안됨".mysqli_error($link);
                    }
                }
                else{
                    echo "쿼리 준비 불가". mysqli_error($link);
                }
                
                mysqli_stmt_close($stmt);
                mysqli_close($link);
              ?>
            </div>
          </div>
        </div>

        <!--필터: 알러지-->
        <div class="dropdown">
          <div class="dropbtn flex justify-start items-center w-[150px] absolute left-[546px] top-[282px] px-4 py-2.5 rounded-[10px] bg-[#fefefe]" style="box-shadow: 0px 4px 20px 0 rgba(255, 214, 0, 0.3)" onclick="toggleDropdown('allergy')">
            <p class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">알러지</p>
            
            <div class="dropdown-content" id="allergyDropdown">
              <?php
                $link = mysqli_connect("localhost", "team06", "team06", "team06");
                if($link === false)
                    die('연결안됨'.mysqli_connect_error());

                // 쿼리 여러 개 넣는 법 참고 : https://www.phpschool.com/gnuboard4/bbs/board.php?bo_table=qna_db&wr_id=95165
                $sql = 'SELECT Allergy_ID FROM user_allergy WHERE User_ID = '.$_SESSION["SESSION_User_ID"].';';
                $sql .= 'SELECT * FROM allergy';

                if(mysqli_multi_query($link, $sql)){
                  // $user_allergy_ID : 사용자가 프로필에 설정해둔 알러지 정보 구하기 
                  if ($result = mysqli_store_result($link)) {
                    $user_allergy_ID = array();
                    while ($row = mysqli_fetch_row($result)) {
                      array_push($user_allergy_ID, $row[0]);
                    }
                  }
                  mysqli_free_result($result);                    
                  
                  // 드롭다운 선택지 만들기
                  mysqli_next_result($link);
                  if ($result = mysqli_store_result($link)) {
                    while ($row = mysqli_fetch_row($result)) {
                      $itemID = $row[0];
                      $item = $row[1];

                      $isChecked = '';
                      if((!isset($_POST['allergy']) and !isset($_POST['category']) and in_array($itemID, $user_allergy_ID)) // 메인페이지에서 카테고리 선택해서 넘어온 경우 --> 기본값 : 사용자가 프로필에 설정한 알러지 정보 모두
                          or (isset($_POST['allergy']) and in_array($itemID, $_POST['allergy']))){ // 검색 결과 페이지에서 필터 및 정렬 적용 버튼을 누른 경우 --> 체크된 알러지 값 모두
                        $isChecked = 'checked="checked"';
                      }
                      echo '<label><input type="checkbox" name="allergy[]" value="'.$itemID.'" '.$isChecked.' class="flex-grow w-[50px] text-base font-semibold text-left text-[#252729]">'.$item.'</label><br>';
                    }
                  }
                }

                mysqli_close($link);
              ?>
            </div>
          </div>
        </div>

        <!--정렬-->
        <select name="sort" class="flex justify-start items-center w-[150px] absolute left-[728px] top-[282px] px-4 py-2.5 rounded-[10px] bg-[#fefefe]" style="box-shadow: 0px 4px 20px 0 rgba(255, 214, 0, 0.3)">
          <option selected disabled hidden class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">정렬 기준</option>
          <?php
            $isSelected = array("","","");
            if(isset($_POST["sort"])){ // 검색 결과 페이지에서 (정렬 기준을 선택한 후) 필터 및 정렬 버튼을 눌렀을 때
              switch($_POST["sort"]){ // 이전에 선택된 값이 선택된 것으로 보여줌
                case("recent"):
                  $isSelected[0] = "selected";
                  break;
                case("rate_high"):
                  $isSelected[1] = "selected";
                  break;
                case("rate_low"):
                  $isSelected[2] = "selected";
                  break;
              }
            }

            echo '<option value="recent" '.$isSelected[0].' class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">등록 최신순 (기본)</option>';
            echo '<option value="rate_high" '.$isSelected[1].' class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">별점 높은순</option>';
            echo '<option value="rate_low" '.$isSelected[2].' class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">별점 낮은순</option>';
          ?>
        </select>

        <!--필터 및 정렬 적용 버튼-->
        <button type="submit" class="flex justify-center items-center absolute left-[1268px] top-[293px] gap-2.5 px-12 py-[21px] rounded-lg" style="background: linear-gradient(137.75deg, #ff7a7a -39.37%, #f65900 143.15%)">
          <p class="flex-grow-0 flex-shrink-0 text-lg font-bold text-center text-white">필터 및 정렬 적용</p>
        </button>
      </form>

      <!--식당 목록-->
      <div style="width:100%;" class="flex flex-wrap:wrap;flex-col justify-center items-center absolute left-[17px] top-[351px] gap-[88px]">
        <div style="width:100%;" class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 absolute left-0 top-[42px] gap-16">
          <div style="width:100%; flex-wrap:wrap" class="flex justify-start items-start flex-grow-0 flex-shrink-0 gap-4">
          <?php
            $link = mysqli_connect("localhost", "team06", "team06", "team06");
            if($link === false)
                die('연결안됨'.mysqli_connect_error());
            
            // DB에서 식당별 찜 개수 가져오는 SQL문
            $sql = 'SELECT Res_ID, COUNT(User_ID) AS bookmark_count
                    FROM Bookmark
                    GROUP BY Res_ID;';

            // DB에서 필터, 정렬에 맞게 식당 목록 가져오는 SQL문
            $sql .= 'SELECT R.Res_ID, R.Res_name, R.Res_img_url, R.Category_ID, AVG_RATE.Avg_rating
                     FROM restaurant R
                      join (SELECT Res_ID, round(AVG(Res_rating), 2) AS Avg_rating FROM res_rate GROUP BY Res_ID) AVG_RATE
                      on R.Res_ID = AVG_RATE.Res_ID
                     WHERE ';
            
            
            // 필터 (카테고리)
            if(isset($_POST['category'])){ // POST로 전달된 값이 있으면 (사용자가 필터 적용 버튼을 눌렀으면)
              $sql .= 'R.Category_ID IN ('.implode(', ', $_POST['category']).')'; // [1, 2, 3] 식의 배열을 1, 2, 3이라는 문자열로 변환
            } else if(isset($_GET['category_id'])){ // GET으로 전달된 값이 있으면 (사용자가 메인페이지에서 카테고리를 선택해서 넘어온 거라면)
              $sql .= 'R.Category_ID = '.$_GET['category_id'].'';
            }

            // 필터 (알러지)
            if(isset($_POST['allergy'])){
              $temp = implode(', ', $_POST['allergy']); // [1, 2, 3] 식의 배열을 1, 2, 3이라는 문자열로 변환
              $sql .= ' AND R.Res_ID NOT IN (SELECT M.Res_ID
                                              FROM res_menu M join menu_allergy A on M.Res_menu_ID = A.Res_menu_ID
                                              WHERE A.Allergy_ID IN ('.$temp.'))';
            } else if(!isset($_POST['category'])){ //메인페이지에서 카테고리 선택해서 넘어왔을 때 --> 알러지 필터 초기값 : 해당 사용자의 프로필에 설정된 알러지
              $temp = 'SELECT Allergy_ID FROM user_allergy WHERE User_ID = '.$_SESSION["SESSION_User_ID"];
              $sql .= ' AND R.Res_ID NOT IN (SELECT M.Res_ID
                                              FROM res_menu M join menu_allergy A on M.Res_menu_ID = A.Res_menu_ID
                                              WHERE A.Allergy_ID IN ('.$temp.'))';
            } else{ // 알러지 필터 모두 선택 해제 --> 조건 추가할 필요 없음.
            }
            

            // 정렬
            $sort = 'recent'; // 기본값
            if(isset($_POST['sort'])){ // POST로 넘어온 값이 있으면
              $sort = $_POST['sort'];
            } 
            switch($sort){
              case('rate_high'):
                $sql .= ' ORDER BY AVG_RATE.Avg_rating DESC';
                break;
              case('rate_low'):
                $sql .= ' ORDER BY AVG_RATE.Avg_rating';
                break;
              default:
                $sql .= ' ORDER BY R.Res_ID DESC';
            }
            
            // 쿼리 실행
            if(mysqli_multi_query($link, $sql)){
              // 찜 개수 저장
              if ($result = mysqli_store_result($link)) {
                $Bookmark_count_array = array();
                while ($row = mysqli_fetch_row($result)) {
                  $Res_ID = $row[0];
                  $Bookmark_count = $row[1];

                  $Bookmark_count_array[$Res_ID] = $Bookmark_count;
                }
              }
              mysqli_free_result($result);                    

              // 식당 목록 보여주기
              mysqli_next_result($link);
              if ($result = mysqli_store_result($link)) {
                $searchCheck = false;

                while ($row = mysqli_fetch_row($result)) {
                  $searchCheck = true;

                  $Res_ID = $row[0];
                  $Res_name = $row[1];
                  $Res_img_url = $row[2];
                  $Category_ID = $row[3];
                  $Avg_rating = $row[4];

                  $Bookmark_count = 0;
                  if(isset($Bookmark_count_array[$Res_ID])){ // 찜 개수가 있으면
                    $Bookmark_count = $Bookmark_count_array[$Res_ID];
                  }

                  // 식당 정보 출력
                  echo '<a href="res_detail.php?res_name='.$Res_ID.'" class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative gap-6 rounded-2xl">';
                  
                  // 식당 사진
                  echo '<div class="flex-grow-0 flex-shrink-0 w-[357px] h-[301px] relative rounded-2xl bg-white">';
                  echo '  <img src="'.$Res_img_url.'" class="w-[357px] h-[301px] absolute left-[-1px] top-[-1px] object-cover" />';
                  echo '</div>';

                  // 아이콘, 식당 이름, 별점
                  echo '<div class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 gap-8">';
                  echo '  <div class="flex justify-start items-center flex-grow-0 flex-shrink-0 relative gap-6">';
                  echo '    <div class="flex-grow-0 flex-shrink-0 w-16 h-16 relative">';
                  echo '      <img src="img/res_icon.png" class="w-16 h-16 absolute left-[-1px] top-[-1px] object-cover" />'; // 아이콘
                  echo '    </div>';
                  echo '    <div class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative gap-1">';
                  echo '      <p class="flex-grow-0 flex-shrink-0 text-[22px] font-bold text-left text-[#424242]">'.$Res_name.'</p>';
                  echo '      <div class="flex justify-start items-start flex-grow-0 flex-shrink-0 relative gap-2">';
                  echo '        <p class="flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]">별점</p>';
                  echo '        <p class="flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]">'.$Avg_rating.' / </p>';
                  echo '        <p class="flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]">북마크</p>';
                  echo '        <p class="flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]">'.$Bookmark_count.'</p>'; // 찜 개수 기본값 : 0개
                  echo '      </div>';
                  echo '    </div>';                    
                  echo '  </div>';                    
                  echo '</div>';                    
                  echo '</a>';                    
                }

                if(!$searchCheck) // 검색결과 없음
                  echo '검색 결과가 없습니다.';
              }
            }
            
            mysqli_close($link);
          ?>
          </div>
        </div>
      </div>

      <!--끝-->
    </div>
  </body>
</html>
