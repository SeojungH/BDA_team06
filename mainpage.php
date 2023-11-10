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
    <div class="w-[1718px] h-[1042px] relative overflow-hidden bg-white">
      <div class="w-[1721px] h-[408px] absolute left-[-3px] top-[58px] bg-[#fff3d9]">
        <p
          class="absolute left-[406px] top-[91px] text-[43px] font-bold text-center text-[#f17228]"
        >
          What food do you want??
        </p>
      </div>
      <div class="w-[1718px] h-[76px]">
        <div class="w-[1718px] h-[76px] absolute left-[-0.5px] top-[-0.5px] bg-[#ffd233]"></div>
        <div class="w-[841.1px] h-[53.2px]">
          <p
            class="w-[95.44px] h-[28.5px] absolute left-[443.82px] top-[22.8px] text-[22px] text-left text-white"
          >
            Account
          </p>
          <div
            class="w-[119.31px] h-[2.85px] absolute left-[431.39px] top-[72.65px] bg-white"
          ></div>
          <p
            class="w-[96.64px] h-[28.5px] absolute left-[660.95px] top-[22.8px] text-[22px] font-light text-left text-[#a0a0a0]"
          >
            Reposts
          </p>
          <p
            class="w-[95.44px] h-[28.5px] absolute left-[876.9px] top-[22.8px] text-[22px] font-light text-left text-[#a0a0a0]"
          >
            Settings
          </p>
          <p
            class="w-[181.34px] h-[28.5px] absolute left-[1091.65px] top-[22.8px] text-[22px] font-light text-left text-[#a0a0a0]"
          >
            Help &#x26; Support
          </p>
        </div>
        <div class="w-[59.65px] h-[23.75px]">
          <div class="w-[59.65px] h-[1.83px] absolute left-[35.29px] top-[25.15px] bg-white"></div>
          <div class="w-[59.65px] h-[1.83px] absolute left-[35.29px] top-[36.11px] bg-white"></div>
          <div class="w-[59.65px] h-[1.83px] absolute left-[35.29px] top-[47.07px] bg-white"></div>
        </div>
      </div>
      <div
        class="flex flex-col justify-start items-start w-[906px] absolute left-[406px] top-[209px] overflow-hidden rounded-2xl"
        style="filter: drop-shadow(0px 5px 10px rgba(255,174,0,0.26)) drop-shadow(0px 20px 40px rgba(255,174,0,0.29));"
      >
        <svg
          width="906"
          height="1"
          viewBox="0 0 906 1"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="self-stretch flex-grow-0 flex-shrink-0"
          preserveAspectRatio="none"
        >
          <path
            d="M0 0.441721C13.144 -0.358279 609.477 0.108388 906 0.441721"
            stroke="#EEEEEE"
          ></path>
        </svg>
        <div
          class="flex flex-col justify-start items-start self-stretch flex-grow-0 flex-shrink-0 gap-2.5 p-6 bg-white"
        >
          <div class="flex justify-start items-center self-stretch flex-grow-0 flex-shrink-0 gap-4">
            <div
              class="flex justify-start items-center flex-grow relative gap-3 pl-4 pt-[7px] pb-2 rounded-lg bg-neutral-100"
            >
              <p class="flex-grow-0 flex-shrink-0 w-[162px] text-lg text-left text-[#9e9e9e]">
                Search
              </p>
            </div>
            <div
              class="flex justify-center items-center flex-grow-0 flex-shrink-0 relative gap-2.5 px-12 py-[21px] rounded-lg"
              style="background: linear-gradient(137.75deg, #ff7a7a -39.37%, #f65900 143.15%);"
            >
              <p class="flex-grow-0 flex-shrink-0 text-lg font-bold text-center text-white">
                Find Restaurant
              </p>
            </div>
          </div>
        </div>
      </div>


      <div
        class="flex flex-col justify-center items-center w-[1718px] h-[575px] absolute left-0 top-[467px] gap-[71px] py-20"
        style="background: linear-gradient(to bottom, rgba(255,206,103,0.5) -42.47%, rgba(253,237,202,0) 100%);"
      >
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
      <div
        class="flex flex-col justify-start items-center w-[1479px] h-[434px] absolute left-[120px] top-[521px] gap-[88px]"
      >
        <div
          class="flex justify-between items-start self-stretch flex-grow-0 flex-shrink-0 relative"
        >
          <p class="flex-grow-0 flex-shrink-0 text-[43px] font-bold text-center text-[#212121]">
            Search by Food
          </p>
          <div
            class="flex justify-end items-center flex-grow-0 flex-shrink-0 gap-[26.5px] pr-[18px]"
          >
            <div class="flex justify-start items-start flex-grow-0 flex-shrink-0 gap-4">
              <div
                class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative gap-2.5 pl-[9px] pr-[11px] py-2.5 rounded-[92px] bg-[#ffb30e] border border-[#faaa01]"
                style="box-shadow: 0px 5px 8px 0 rgba(222,151,0,0.24), 0px 14px 32px 0 rgba(255,178,14,0.29);"
              >
                <p class="flex-grow-0 flex-shrink-0 w-14 h-14 text-[33px] text-center text-white">
                  chevron-left
                </p>
              </div>
              <div
                class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative gap-2.5 pl-[11px] pr-[9px] py-2.5 rounded-[92px] bg-[#ffb30e] border border-[#faaa01]"
                style="box-shadow: 0px 5px 8px 0 rgba(222,151,0,0.24), 0px 14px 32px 0 rgba(255,178,14,0.29);"
              >
                <p class="flex-grow-0 flex-shrink-0 w-14 h-14 text-[33px] text-center text-white">
                  chevron-right
                </p>
              </div>
            </div>
          </div>
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
  </body>
</html>
