<!-- 1976180 백승민 -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Preview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      html, body {
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
    <div class="w-[1718px] h-[1389px] relative overflow-hidden bg-white">
      <div class="w-[1721px] h-[714px] absolute left-0 top-[51px] bg-[#fff3d9]">
        <div
          class="flex flex-col justify-start items-center absolute left-[120px] top-[78px] gap-[88px]"
        >
          <p class="flex-grow-0 flex-shrink-0 text-[43px] font-bold text-center text-[#f17228]">
            Best Restaurants
          </p>
          <div class="flex justify-start items-start flex-grow-0 flex-shrink-0 w-[1481px] gap-4">
            <!-- 상위 5개 별점 높은 식당 보여주기 -->
            <?php
            // MySQL 데이터베이스 접속 정보 설정
            $servername = "localhost"; // MySQL 서버 주소
            $username = "team06"; // MySQL 사용자 이름
            $password = "team06"; // MySQL 비밀번호
            $dbname = "team06"; // 사용할 데이터베이스 이름

            // MySQL 데이터베이스에 연결
            $conn = new mysqli($servername, $username, $password, $dbname);

            $counter = 0;

            // 연결 확인
            if ($conn->connect_error) {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            // SQL 쿼리 작성
            $sql = "
                SELECT 
                    r.Res_ID, r.Res_name, r.Res_address, r.Res_img_url,avg_rating
                FROM (
                    SELECT 
                        R.Res_ID, R.Res_name, R.Res_address, R.Res_img_url, AVG(RR.Res_rating) AS avg_rating,
                        RANK() OVER (ORDER BY AVG(RR.Res_rating) DESC) AS ranking
                    FROM Restaurant R
                    INNER JOIN Res_rate RR ON R.Res_ID = RR.Res_ID
                    GROUP BY R.Res_ID, R.Res_name, R.Res_address
                ) r
                WHERE r.ranking <= 5;
            ";

            // 쿼리 실행 및 결과 가져오기
            $result = $conn->query($sql);

            // 결과 출력
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  if ($counter < 5){
                    $counter++;

                    echo '<div class="flex flex-col justify-center items-start flex-grow gap-4">  <!-- 식당 하나 보여주기 -->
                    <div
                      class="flex flex-col justify-start items-start self-stretch flex-grow-0 flex-shrink-0 relative gap-4"
                    >
                      <div
                        class="self-stretch flex-grow-0 flex-shrink-0 h-[283px] relative overflow-hidden rounded-2xl"
                      >';
                      echo '<a href="res_detail.php?Res_ID=' . $row["Res_ID"] . '">';
                        echo '<img
                          src="'.$row["Res_img_url"].'"
                          class="w-[282.79px] h-[283px] absolute left-[-1px] top-[-1px] object-cover"
                        />';
                      echo '</a>';
                      echo'</div>
                      <div
                        class="flex flex-col justify-start items-start self-stretch flex-grow-0 flex-shrink-0 gap-2"
                      >
                        <div
                          class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative gap-2"
                        >
                          <p
                            class="flex-grow-0 flex-shrink-0 text-[22px] font-bold text-left text-[#424242]"
                          >';
                          echo $row['Res_name'];
                          echo '</p>
                          <div
                            class="flex justify-start items-center flex-grow-0 flex-shrink-0 relative gap-2"
                          >
                            <p class="flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]">';
                            echo $row['Res_address'];
                            echo '</p>
                          </div>
                        </div>
                        <div
                          class="flex justify-start items-start flex-grow-0 flex-shrink-0 relative gap-2"
                        >
                          <p
                            class="flex-grow-0 flex-shrink-0 text-[22px] font-bold text-left text-[#212121]"
                          >';
                          echo round($row['avg_rating'], 2);
                          echo '
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>';
                    
                  }    
                  else{
                    break;
                  }
                }
            } else {
                echo "결과가 없습니다.";
            }
              
            // MySQL 연결 종료
            $conn->close();
            ?>
          
          </div>
        </div>
      </div>

      <!-- 네비게이션 바 -->
      <div class="w-[1718px] h-[76px]">
        <div class="w-[1718px] h-[76px] absolute left-[-0.5px] top-[-0.5px] bg-[#ffd233]"></div>
        <div class="w-[841.1px] h-[53.2px]">
          <div  onclick = "location.href='mainpage.php'">
          <p
            class="w-[95.44px] h-[28.5px] absolute left-[443.82px] top-[22.8px] text-[22px] text-left text-white"
          >
            Main
          </p>
          </div>
          <div onclick = "location.href='Mypage.php'">
          <p
            class="w-[96.64px] h-[28.5px] absolute left-[660.95px] top-[22.8px] text-[22px] font-light text-left text-[#a0a0a0]"
          >
          Mypage
          </p>
          </div>
          <div onclick = "location.href='bookmark.php'">
          <p
            class="w-[95.44px] h-[28.5px] absolute left-[876.9px] top-[22.8px] text-[22px] font-light text-left text-[#a0a0a0]"
          >
          Bookmark
          </p>
          </div>
          <div onclick = "location.href='Logout.php'">
          <p
            class="w-[181.34px] h-[28.5px] absolute left-[1091.65px] top-[22.8px] text-[22px] font-light text-left text-[#a0a0a0]"
          >
           Logout
          </p>
          </div>
        </div>
      </div>


      <div
        class="flex flex-col justify-center items-center w-[1718px] absolute left-0 top-[765px] gap-[71px] py-20"
        style="background: linear-gradient(to bottom, rgba(255,206,103,0.5) -42.47%, rgba(253,237,202,0) 100%);"
      >
        <div
          class="flex flex-col justify-start items-center flex-grow-0 flex-shrink-0 w-[1479px] relative gap-[88px]"
        >
          <div
            class="flex justify-between items-start self-stretch flex-grow-0 flex-shrink-0 relative"
          >
            <p class="flex-grow-0 flex-shrink-0 text-[43px] font-bold text-center text-[#212121]">
              Search by Category
            </p>
          </div>
          <?php
          $categories = array(
              array("id" => 1, "name" => "분식", "image" => "./img/분식.png"),
              array("id" => 2, "name" => "중식", "image" => "./img/중식.png"),
              array("id" => 3, "name" => "파스타", "image" => "./img/pasta.png"),
              array("id" => 4, "name" => "한식", "image" => "./img/한식.png"),
              array("id" => 5, "name" => "일식", "image" => "./img/일식.png"),
              array("id" => 6, "name" => "피자", "image" => "./img/pizza.png"),
          );

          echo '<div class="flex justify-between items-start flex-grow-0 flex-shrink-0 w-[1479px] absolute left-0 top-[164px]">';
          foreach ($categories as $category) {
              echo '<div class="flex flex-col justify-start items-center flex-grow-0 flex-shrink-0 relative gap-[26px]">';
              echo '<div class="flex-grow-0 flex-shrink-0 w-[218px] h-[218px] relative overflow-hidden rounded-[144px]">';
              echo '<a href="search.php?category_id=' . $category["id"] . '">';
              echo '<img src="' . $category["image"] . '" class="w-[218px] h-[218px] absolute left-[-1px] top-[-1px] object-cover" />';
              echo '</a>';
              echo '</div>';
              echo '<p class="flex-grow-0 flex-shrink-0 text-[22px] font-bold text-left text-[#424242]">' . $category["name"] . '</p>';
              echo '</div>';
          }
          echo '</div>';
          ?>
        </div>
        <div class="flex-grow-0 flex-shrink-0 w-[1583px] h-[94px] relative"></div>
        <div class="flex-grow-0 flex-shrink-0 w-[175px] h-[33px]">
          <img
            src="./img/dollar.png"
            class="w-[43px] h-[33px] absolute left-[160.5px] top-[515.5px] object-cover"
          />
          <p
            class="w-[132px] h-[26px] absolute left-[204px] top-[523px] text-[17px] text-left text-black"
          >
          <?php
            // MySQL 데이터베이스 연결 설정
            $servername = "localhost";
            $username = "team06";
            $password = "team06";
            $dbname = "team06";

            // 데이터베이스 연결
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 데이터베이스 연결 확인
            if ($conn->connect_error) {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            $Category_ID = 1;

            // ROLLUP을 사용하여 'restaurant'의 카테고리 별 음식 가격의 총합과 평균을 계산
            $sql = "SELECT c.Category_name, 
                            SUM(m.Res_menu_price) AS total_price,
                            ROUND(AVG(m.Res_menu_price)) AS avg_price
                        FROM Restaurant r
                        INNER JOIN Res_menu m ON r.Res_ID = m.Res_ID
                        INNER JOIN Category c ON r.Category_ID = c.Category_ID
                        WHERE r.Category_ID = $Category_ID
                        GROUP BY c.Category_name WITH ROLLUP";

            $result = $conn->query($sql);

            $avgPrinted = false; // 평균값을 한 번만 출력하기 위한 플래그

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // 결과 출력
                    $category = $row["Category_name"];
                    $totalPrice = $row["total_price"];
                    $avgPrice = $row["avg_price"];

                    if ($avgPrice !== null && !$avgPrinted) {
                        echo "평균 가격: $avgPrice"."원 <br>";
                        $avgPrinted = true;
                    } else {
                        echo "<br>";
                    }
                }
            } else {
                echo "해당 Category_ID에 대한 결과가 없습니다.";
            }

            // 데이터베이스 연결 닫기
            $conn->close();
            ?>
          </p>
        </div>
        <div class="flex-grow-0 flex-shrink-0 w-[175px] h-[33px]">
          <img
            src="./img/dollar.png"
            class="w-[43px] h-[33px] absolute left-[662.5px] top-[515.5px] object-cover"
          />
          <p
            class="w-[132px] h-[26px] absolute left-[706px] top-[523px] text-[17px] text-left text-black"
          >
          <?php
            // MySQL 데이터베이스 연결 설정
            $servername = "localhost";
            $username = "team06";
            $password = "team06";
            $dbname = "team06";

            // 데이터베이스 연결
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 데이터베이스 연결 확인
            if ($conn->connect_error) {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            $Category_ID = 2;

            // ROLLUP을 사용하여 'restaurant'의 카테고리 별 음식 가격의 총합과 평균을 계산
            $sql = "SELECT c.Category_name, 
                            SUM(m.Res_menu_price) AS total_price,
                            ROUND(AVG(m.Res_menu_price)) AS avg_price
                        FROM Restaurant r
                        INNER JOIN Res_menu m ON r.Res_ID = m.Res_ID
                        INNER JOIN Category c ON r.Category_ID = c.Category_ID
                        WHERE r.Category_ID = $Category_ID
                        GROUP BY c.Category_name WITH ROLLUP";

            $result = $conn->query($sql);

            $avgPrinted = false; // 평균값을 한 번만 출력하기 위한 플래그

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // 결과 출력
                    $category = $row["Category_name"];
                    $totalPrice = $row["total_price"];
                    $avgPrice = $row["avg_price"];

                    if ($avgPrice !== null && !$avgPrinted) {
                        echo "평균 가격: $avgPrice"."원 <br>";
                        $avgPrinted = true;
                    } else {
                        echo "<br>";
                    }
                }
            } else {
                echo "해당 Category_ID에 대한 결과가 없습니다.";
            }

            // 데이터베이스 연결 닫기
            $conn->close();
            ?>
          </p>
        </div>
        <div class="flex-grow-0 flex-shrink-0 w-[175px] h-[33px]">
          <img
            src="./img/dollar.png"
            class="w-[43px] h-[33px] absolute left-[913.5px] top-[515.5px] object-cover"
          />
          <p
            class="w-[132px] h-[26px] absolute left-[957px] top-[523px] text-[17px] text-left text-black"
          >
          <?php
            // MySQL 데이터베이스 연결 설정
            $servername = "localhost";
            $username = "team06";
            $password = "team06";
            $dbname = "team06";

            // 데이터베이스 연결
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 데이터베이스 연결 확인
            if ($conn->connect_error) {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            $Category_ID = 3;

            // ROLLUP을 사용하여 'restaurant'의 카테고리 별 음식 가격의 총합과 평균을 계산
            $sql = "SELECT c.Category_name, 
                            SUM(m.Res_menu_price) AS total_price,
                            ROUND(AVG(m.Res_menu_price)) AS avg_price
                        FROM Restaurant r
                        INNER JOIN Res_menu m ON r.Res_ID = m.Res_ID
                        INNER JOIN Category c ON r.Category_ID = c.Category_ID
                        WHERE r.Category_ID = $Category_ID
                        GROUP BY c.Category_name WITH ROLLUP";

            $result = $conn->query($sql);

            $avgPrinted = false; // 평균값을 한 번만 출력하기 위한 플래그

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // 결과 출력
                    $category = $row["Category_name"];
                    $totalPrice = $row["total_price"];
                    $avgPrice = $row["avg_price"];

                    if ($avgPrice !== null && !$avgPrinted) {
                        echo "평균 가격: $avgPrice"."원 <br>";
                        $avgPrinted = true;
                    } else {
                        echo "<br>";
                    }
                }
            } else {
                echo "해당 Category_ID에 대한 결과가 없습니다.";
            }

            // 데이터베이스 연결 닫기
            $conn->close();
            ?>
          </p>
        </div>
        <div class="flex-grow-0 flex-shrink-0 w-[175px] h-[33px]">
          <img
            src="./img/dollar.png"
            class="w-[43px] h-[33px] absolute left-[1164.5px] top-[515.5px] object-cover"
          />
          <p
            class="w-[132px] h-[26px] absolute left-[1208px] top-[523px] text-[17px] text-left text-black"
          >
          <?php
            // MySQL 데이터베이스 연결 설정
            $servername = "localhost";
            $username = "team06";
            $password = "team06";
            $dbname = "team06";

            // 데이터베이스 연결
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 데이터베이스 연결 확인
            if ($conn->connect_error) {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            $Category_ID = 4;

            // ROLLUP을 사용하여 'restaurant'의 카테고리 별 음식 가격의 총합과 평균을 계산
            $sql = "SELECT c.Category_name, 
                            SUM(m.Res_menu_price) AS total_price,
                            ROUND(AVG(m.Res_menu_price)) AS avg_price
                        FROM Restaurant r
                        INNER JOIN Res_menu m ON r.Res_ID = m.Res_ID
                        INNER JOIN Category c ON r.Category_ID = c.Category_ID
                        WHERE r.Category_ID = $Category_ID
                        GROUP BY c.Category_name WITH ROLLUP";

            $result = $conn->query($sql);

            $avgPrinted = false; // 평균값을 한 번만 출력하기 위한 플래그

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // 결과 출력
                    $category = $row["Category_name"];
                    $totalPrice = $row["total_price"];
                    $avgPrice = $row["avg_price"];

                    if ($avgPrice !== null && !$avgPrinted) {
                        echo "평균 가격: $avgPrice"."원 <br>";
                        $avgPrinted = true;
                    } else {
                        echo "<br>";
                    }
                }
            } else {
                echo "해당 Category_ID에 대한 결과가 없습니다.";
            }

            // 데이터베이스 연결 닫기
            $conn->close();
            ?>
          </p>
        </div>
        <div class="flex-grow-0 flex-shrink-0 w-[175px] h-[33px]">
          <img
            src="./img/dollar.png"
            class="w-[43px] h-[33px] absolute left-[1415.5px] top-[515.5px] object-cover"
          />
          <p
            class="w-[132px] h-[26px] absolute left-[1459px] top-[523px] text-[17px] text-left text-black"
          >
          <?php
            // MySQL 데이터베이스 연결 설정
            $servername = "localhost";
            $username = "team06";
            $password = "team06";
            $dbname = "team06";

            // 데이터베이스 연결
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 데이터베이스 연결 확인
            if ($conn->connect_error) {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            $Category_ID = 5;

            // ROLLUP을 사용하여 'restaurant'의 카테고리 별 음식 가격의 총합과 평균을 계산
            $sql = "SELECT c.Category_name, 
                            SUM(m.Res_menu_price) AS total_price,
                            ROUND(AVG(m.Res_menu_price)) AS avg_price
                        FROM Restaurant r
                        INNER JOIN Res_menu m ON r.Res_ID = m.Res_ID
                        INNER JOIN Category c ON r.Category_ID = c.Category_ID
                        WHERE r.Category_ID = $Category_ID
                        GROUP BY c.Category_name WITH ROLLUP";

            $result = $conn->query($sql);

            $avgPrinted = false; // 평균값을 한 번만 출력하기 위한 플래그

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // 결과 출력
                    $category = $row["Category_name"];
                    $totalPrice = $row["total_price"];
                    $avgPrice = $row["avg_price"];

                    if ($avgPrice !== null && !$avgPrinted) {
                        echo "평균 가격: $avgPrice"."원 <br>";
                        $avgPrinted = true;
                    } else {
                        echo "<br>";
                    }
                }
            } else {
                echo "해당 Category_ID에 대한 결과가 없습니다.";
            }

            // 데이터베이스 연결 닫기
            $conn->close();
            ?>
          </p>
        </div>
        <div class="flex-grow-0 flex-shrink-0 w-[175px] h-[33px]">
          <img
            src="./img/dollar.png"
            class="w-[43px] h-[33px] absolute left-[411.5px] top-[515.5px] object-cover"
          />
          <p
            class="w-[132px] h-[26px] absolute left-[455px] top-[523px] text-[17px] text-left text-black"
          >
          <?php
            // MySQL 데이터베이스 연결 설정
            $servername = "localhost";
            $username = "team06";
            $password = "team06";
            $dbname = "team06";

            // 데이터베이스 연결
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 데이터베이스 연결 확인
            if ($conn->connect_error) {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            $Category_ID = 6;

            // ROLLUP을 사용하여 'restaurant'의 카테고리 별 음식 가격의 총합과 평균을 계산
            $sql = "SELECT c.Category_name, 
                            SUM(m.Res_menu_price) AS total_price,
                            ROUND(AVG(m.Res_menu_price)) AS avg_price
                        FROM Restaurant r
                        INNER JOIN Res_menu m ON r.Res_ID = m.Res_ID
                        INNER JOIN Category c ON r.Category_ID = c.Category_ID
                        WHERE r.Category_ID = $Category_ID
                        GROUP BY c.Category_name WITH ROLLUP";

            $result = $conn->query($sql);

            $avgPrinted = false; // 평균값을 한 번만 출력하기 위한 플래그

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // 결과 출력
                    $category = $row["Category_name"];
                    $totalPrice = $row["total_price"];
                    $avgPrice = $row["avg_price"];

                    if ($avgPrice !== null && !$avgPrinted) {
                        echo "평균 가격: $avgPrice"."원 <br>";
                        $avgPrinted = true;
                    } else {
                        echo "<br>";
                    }
                }
            } else {
                echo "해당 Category_ID에 대한 결과가 없습니다.";
            }

            // 데이터베이스 연결 닫기
            $conn->close();
            ?>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
