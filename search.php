<!DOCTYPE html>
<html>
  <head>
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
    <div class="w-[1509px] h-[1452px] relative overflow-hidden bg-white">
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
    
      <!--검색 바-->
      <div class="flex flex-col justify-start items-start w-[856px] absolute left-[359px] top-[135px] overflow-hidden rounded-2xl" style="filter: drop-shadow(0px 5px 10px rgba(255, 174, 0, 0.26)) drop-shadow(0px 20px 40px rgba(255, 174, 0, 0.29))">
        <svg width="856" height="1" viewBox="0 0 856 1" fill="none" xmlns="http://www.w3.org/2000/svg" class="self-stretch flex-grow-0 flex-shrink-0" preserveAspectRatio="none">
          <path d="M0 0.441721C12.4187 -0.358279 575.841 0.108388 856 0.441721" stroke="#EEEEEE"></path>
        </svg>
        <div class="flex flex-col justify-start items-start self-stretch flex-grow-0 flex-shrink-0 gap-2.5 p-6 bg-white">
          <div class="flex justify-start items-center self-stretch flex-grow-0 flex-shrink-0 gap-4">
            <form action="search.php" method="GET"> 
              <?php
                $basicText = '식당 이름을 입력하세요.';
                if(isset($_GET['res_name'])){
                  $basicText = $_GET['res_name'];
                }
                echo '<input type="text" name="res_name" placeholder="'.$basicText.'" size="60" class="justify-start flex-grow relative gap-3 pl-4 pt-[7px] pb-2 rounded-lg bg-neutral-100flex-grow-0 flex-shrink-0 text-lg text-left text-[#9e9e9e] bg-neutral-100">';
              ?>
              <button type="submit" class="flex justify-center items-center flex-grow-0 flex-shrink-0 relative gap-2.5 px-12 py-[21px] rounded-lg" style="background: linear-gradient(137.75deg, #ff7a7a -39.37%, #f65900 143.15%)">
                <img width="14px" src="img/search.png">
                <p class="flex-grow-0 flex-shrink-0 text-lg font-bold text-center text-white">Find Restaurant</p>
              </button>
            </form>
          </div>
        </div>
      </div>
      
      <!--검색 필터, 정렬 드롭다운-->
      <!--CSS, JS 코드-->
      <style>
        .dropdown-content {
            display: none;
            position: absolute;
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
        echo '<form action="'.$_SERVER["PHP_SELF"].'" method="POST">';
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
                          $isChecked = 'checked="checked"';
                          if(isset($_POST['category']) and !in_array($itemID, $_POST['category'])){
                            $isChecked = '';
                          }
                          echo '<label><input type="checkbox" name="category[]" value="'.$itemID.'"'.$isChecked.'class="flex-grow w-[50px] text-base font-semibold text-left text-[#252729]">'.$item.'</label><br>';
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
                $sql = 'SELECT Allergy_ID FROM user_profile WHERE User_ID = 1;'; //원주 (user_ID 값 수정하기)
                $sql .= 'SELECT * FROM allergy';

                if(mysqli_multi_query($link, $sql)){
                  // $user_allergy_ID : 사용자가 프로필에 설정해둔 알러지 정보 구하기 
                  if ($result = mysqli_store_result($link)) {
                    while ($row = mysqli_fetch_row($result)) {
                      $user_allergy_ID = $row[0];
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
                      if($itemID == $user_allergy_ID or (isset($_POST['allergy']) and in_array($itemID, $_POST['allergy']))){
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
          <option value="recent" class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">등록 최신순 (기본)</option>
          <option value="rate_high" class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">별점 높은순</option>
          <option value="rate_low" class="flex-grow w-[110px] text-base font-semibold text-left text-[#252729]">별점 낮은순</option>
        </select>

        <!--필터 및 정렬 적용 버튼-->
        <button type="submit" class="flex justify-center items-center absolute left-[1268px] top-[293px] gap-2.5 px-12 py-[21px] rounded-lg" style="background: linear-gradient(137.75deg, #ff7a7a -39.37%, #f65900 143.15%)">
          <p class="flex-grow-0 flex-shrink-0 text-lg font-bold text-center text-white">필터 및 정렬 적용</p>
        </button>
      </form>

      <!--식당 목록-->
      <div class="flex flex-col justify-center items-center absolute left-[17px] top-[351px] gap-[88px]">
        <div class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 absolute left-0 top-[42px] gap-16">
          <div class="flex justify-start items-start flex-grow-0 flex-shrink-0 gap-4">
          <?php
            $link = mysqli_connect("localhost", "team06", "team06", "team06");
            if($link === false)
                die('연결안됨'.mysqli_connect_error());
            
            $sql = 'SELECT Res_ID, Res_name, Res_img_url, category_ID
                    FROM restaurant join PRODUCT P join SALES S
                    on C.CUSTOMER.ID = S.CUSTOMER.ID and C.PRODUCT_ID = S.PRODUCT_ID
                    WHERE C.CUSTOMER_NAME = ? AND P.PRODUCT_TYPE = ?';
            
            if($stmt = mysqli_prepare($link, $sql)){
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt, $res_img_url, $item);
                    while(mysqli_stmt_fetch($stmt)){
                        echo '<label><input type="checkbox" name="allergy'.$itemID.'" class="flex-grow w-[50px] text-base font-semibold text-left text-[#252729]">'.$item.'</label><br>';
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

            <a href="res_detail.php?res_name=원주" class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative overflow-hidden gap-6 rounded-2xl">
              <!--식당 사진-->
              <div class="flex-grow-0 flex-shrink-0 w-[357px] h-[301px] relative overflow-hidden rounded-2xl bg-white">
                <img src="img/image.png" class="w-[357px] h-[301px] absolute left-[-1px] top-[-1px] object-cover" />
              </div>

              <!--아이콘, 식당 이름, 별점-->
              <div class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 gap-8">
                <div class="flex justify-start items-center flex-grow-0 flex-shrink-0 relative gap-6">
                  <div class="flex-grow-0 flex-shrink-0 w-16 h-16 relative">
                    <img src="img/res_icon.png" class="w-16 h-16 absolute left-[-1px] top-[-1px] object-cover" />
                  </div>
                  <div class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative gap-1">
                    <p class="flex-grow-0 flex-shrink-0 text-[22px] font-bold text-left text-[#424242]">식당이름</p>
                    <div class="flex justify-start items-start flex-grow-0 flex-shrink-0 relative gap-2">
                      <p class="flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]">별점</p>
                      <p class="flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]">46</p>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>
        </div>
      </div>

      <!--끝-->
    </div>
  </body>
</html>
