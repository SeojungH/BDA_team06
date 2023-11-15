<!-- 2076456 황서정 -->

<?php

session_name('로그인');
session_start(); 

$mysqli = mysqli_connect("localhost", "team06", "team06", "team06");


$resid = isset($_GET['Res_ID']) ? $_GET['Res_ID'] : '';


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {

    $queries = "SELECT * FROM res_menu WHERE Res_ID = '$resid';";
    $queries .= "SELECT rrc.Res_review_item_ID, rri.Res_review_template, rr.User_ID FROM res_review_content rrc JOIN res_review rr ON rrc.Res_review_ID = rr.Res_review_ID JOIN res_review_item rri ON rrc.Res_review_item_ID = rri.Res_review_item_ID WHERE rr.Res_ID = '$resid';";
    $queries .= "SELECT Res_ID, AVG(Res_rating) AS avg_rating FROM res_rate WHERE Res_ID = '$resid' GROUP BY Res_ID;";
    $queries .= "SELECT Res_ID, AVG(Res_menu_price) AS avg_price FROM res_menu WHERE Res_ID = '$resid' GROUP BY Res_ID;";


    $newArray = array();

    if (mysqli_multi_query($mysqli, $queries)) {
        do {
            if ($result = mysqli_store_result($mysqli)) {
                $tempArray = array();

                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $tempArray[] = $row;
                }

                mysqli_free_result($result);

                $newArray[] = $tempArray;
            }
        } while (mysqli_next_result($mysqli));
    } else {
        echo "Multi Query Error";
    }

    $sql = "SELECT * FROM restaurant WHERE Res_ID = '$resid'";
    $res = mysqli_query($mysqli, $sql);

    if ($res) {
        $restaurantData = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $resImgUrl = $restaurantData['Res_img_url'];
        $resname = $restaurantData['Res_name'];
        if ($restaurantData !== null) {
        } else {
            echo "Can't find the records";
        }
    } else {
        echo "Query Error";
    }
}
?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <link rel="stylesheet" href="css/resdetail_globals.css" />
    <link rel="stylesheet" href="css/resdetail_styleguide.css" />
    <link rel="stylesheet" href="css/res_detail.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="screen">
        <div class="div">
        <button class="back-button" onclick="history.back()"><< back</button>
            <div class="res-info">
                <div class="frame">
                    <img class="rectangle" src="<?php echo $resImgUrl ?>" width="400" height="250" />
                    <div class="div-wrapper">
                        <div class="text-wrapper">
                            <?php echo $resname ?> </div>
                        <div class="frame-wrapper">
                            <div class="frame-2">
                                <div class="frame-3">
                                    <img class="vector" src="img/vector-8.svg" />
                                    <div class="text-wrapper-2">
                                        <?php if (isset($newArray[2][0]['avg_rating'])) {
                                            $formattedAvgRat = number_format($newArray[2][0]['avg_rating'], 1);
                                            echo "<p>" . $formattedAvgRat . " star</p>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-wrapper-3">
                            <?php if (isset($newArray[3][0]['avg_price'])) {
                                $formattedAvgPrice = number_format($newArray[3][0]['avg_price'], 0);
                                echo "<p> avg: " . $formattedAvgPrice . " won</p>";
                            } ?>
                        </div>

                        <form action="addBookmark.php?Res_ID=<?php echo urlencode($resid); ?>" method="post">
                            <input type="hidden" name="Res_ID" value="<?php echo $resid; ?>">
                            <button type="submit" class="bookmark-btn">
                                <img class="vector-bookmark" src="img/vector-8.svg" />
                                <div class="text-wrapper-4">Bookmark</div>


                            </button>
                        </form>
                    </div>
                    <div class="review-btn">

                        <div class="text"><a href="CreateReview.php?Res_ID=<?php echo urlencode($resid); ?>">Write Review</a></div>
                    </div>
                    <div class="rate-btn">
                        <div class="text-2">
                            <a href="#" onclick="openPopup()">Star Rate</a>
                        </div>

                    </div>

                    <script>
                        function openPopup() {
                            var pageURL = "rating/rating.php?Res_ID=<?php echo urlencode($resid); ?>";
                       
                            var left = (screen.width - 600) / 2;
                            var top = (screen.height - 400) / 2;

                            window.open(pageURL, "_blank", "width=600, height=400, left=" + left + ", top=" + top + ", toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no");
                        }
                    </script>


                </div>
                <h1 class="menu-2">
                    <div class="frame-4">
                        <?php
                        $resid = isset($_GET['Res_ID']) ? $_GET['Res_ID'] : '';

                        $sql = "SELECT Res_menu_name, Res_menu_price FROM res_menu WHERE Res_ID = '$resid' order by Res_ID";
                        $res = mysqli_query($mysqli, $sql);

                        if ($res) {
                            while ($menuData = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                $menuName = $menuData['Res_menu_name'];
                                $menuPrice = $menuData['Res_menu_price'];

                                echo "<img class='menu-icon' src='img/res_icon.png' alt='Food Icon' />";
                                echo "<p class='p'>&nbsp;&nbsp;&nbsp;$menuName</p>";
                                echo "<div class='frame-6'>";
                                echo "<div class='frame-7'>";
                                echo "<img class='vector-2' src='img/vector-4.svg' />";
                                echo "<div class='text-wrapper-6'>$menuPrice won</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                        ?>
                    </div>

                    <div class="discount">
                        <div class="text-3">
                            <?php

                            $sql = "SELECT Res_menu_ID FROM res_menu WHERE Res_ID = '$resid'";
                            $res = mysqli_query($mysqli, $sql);

                            if ($res) {

                                $allergies = array();

                                while ($menuIDData = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                    $menuID = $menuIDData['Res_menu_ID'];



                                    $classAllergy = '';



                                    $sql = "SELECT Allergy_ID FROM menu_allergy WHERE Res_menu_ID = '$menuID'";
                                    $res2 = mysqli_query($mysqli, $sql);

                                    if ($res2) {
                                        while ($allergyIDData = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
                                            $allergyID = $allergyIDData['Allergy_ID'];


                                            $sql = "SELECT Allergy_name FROM allergy WHERE Allergy_ID = '$allergyID'";
                                            $res3 = mysqli_query($mysqli, $sql);

                                            if ($res3) {
                                                while ($allergyData = mysqli_fetch_array($res3, MYSQLI_ASSOC)) {
                                                    $classAllergy = $allergyData['Allergy_name'];
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    $allergies[] = $classAllergy;
                                }

                                foreach ($allergies as $allergy) {
                                    echo "<div class='allergy'><div class='icon'>tag</div>  $allergy  </div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </h1>
            </div>
        </div>

        <div class="text-wrapper-reviews">review</div>

        <div class="overlap">
            <div class="review-group">
                <div class="overlap-group">

                    <?php
                    $resid = isset($_GET['Res_ID']) ? $_GET['Res_ID'] : '';

                    $sql = "SELECT rr.Res_review_ID, rr.User_ID, u.User_name
                        FROM res_review rr
                        LEFT JOIN user u ON rr.User_ID = u.User_ID
                        WHERE rr.Res_ID = '$resid'
                        ORDER BY Res_ID";

                    $res = mysqli_query($mysqli, $sql);

                    if ($res) {

                        while ($reviewData = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                            $resReviewID = $reviewData['Res_review_ID'];
                            $userID = $reviewData['User_ID'];
                            $userName = $reviewData['User_name'];

                            $sqlReviewContent = "SELECT Res_review_item_ID
                                            FROM res_review_content
                                            WHERE Res_review_ID = '$resReviewID'";
                            $resReviewContent = mysqli_query($mysqli, $sqlReviewContent);

                            if ($resReviewContent) {
                                while ($reviewContentData = mysqli_fetch_array($resReviewContent, MYSQLI_ASSOC)) {
                                    $resReviewItemID = $reviewContentData['Res_review_item_ID'];

                                    $sqlReviewItem = "SELECT Res_review_template FROM res_review_item WHERE Res_review_item_ID = '$resReviewItemID'";
                                    $resReviewItem = mysqli_query($mysqli, $sqlReviewItem);

                                    if ($resReviewItem) {
                                        while ($reviewItemData = mysqli_fetch_array($resReviewItem, MYSQLI_ASSOC)) {
                                            $resReviewTemplate = $reviewItemData['Res_review_template'];

                                            echo "<div class='review-set'>";
                                            echo "<div class='text-wrapper-7'>$userName</div>";

                                            $sqlResRate = "SELECT Res_rating FROM res_rate WHERE Res_ID = '$resid' AND User_ID = '$userID'";
                                            $resResRate = mysqli_query($mysqli, $sqlResRate);

                                            if ($resResRate) {
                                                while ($resRateData = mysqli_fetch_array($resResRate, MYSQLI_ASSOC)) {
                                                    $resRating = $resRateData['Res_rating'];

                                                    echo "<div class='img-container'>";
                                                    for ($i = 1; $i <= $resRating; $i++) {
                                                        echo "<img class='star' src='img/star-6.svg' />";
                                                    }
                                                    echo "</div>";
                                                    echo "<div class='flexcontainer'>";
                                                    echo "<p class='span-wrapper'>";
                                                    echo "<span class='span'>$resReviewTemplate<br /></span>";
                                                    echo "</p>";
                                                    echo "</div>";
                                                }
                                            }
                                            echo "</div>"; 
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        echo "Query Error";
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php

        $resid = isset($_GET['Res_ID']) ? $_GET['Res_ID'] : '';

        $sql = "SELECT h.Hos_name, h.Hos_num
                            FROM restaurant r
                            LEFT JOIN hospital h ON SUBSTRING_INDEX(r.Res_address, ' ', -1) = SUBSTRING_INDEX(h.Hos_address, ' ', -1)
                            WHERE r.Res_ID = '$resid'";

        $res = mysqli_query($mysqli, $sql);

        if ($res) {
            $hospitalData = mysqli_fetch_array($res, MYSQLI_ASSOC);
            if ($hospitalData) {
                $hosName = $hospitalData['Hos_name'];
                $hosNum = $hospitalData['Hos_num'];
                echo "<div class='hos'>
                    <div class='text-4'>
                        <div class='content'>
                            <div class='div-wrapper-2'>
                                <div class='div-wrapper-2'>
                                    <div class='text-wrapper-9'>$hosName</div>
                                </div>
                            </div>
                        </div>
                        <div class='address'>
                            <div class='element'>
                                <div class='vector-wrapper'><img class='vector-3' src='img/vector-4.svg' /></div>
                                <div class='text-5'>
                                    <div class='text-wrapper-10'>CALL NOW:</div>
                                    <p class='text-wrapper-11'> $hosNum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class='image' src='img/image-1.png' />
                    </div>";
            } else {

                echo "<div class='hos'>
                        <div class='text-4'>
                            <div class='content'>
                                <div class='div-wrapper-2'>
                                    <div class='div-wrapper-2'>
                                        <div class='text-wrapper-9'>No data</div>
                                    </div>
                                </div>
                            </div>
                        <div class='address'>
                            <div class='element'>
                                <div class='vector-wrapper'><img class='vector-3' src='img/vector-4.svg' /></div>
                                <div class='text-5'>
                                    <div class='text-wrapper-10'>CALL NOW:</div>
                                    <p class='text-wrapper-11'>No data</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class='image' src='img/image-1.png' />
                    </div>";
            }
        } else {

            echo "Query Error";

        }
        ?>

    

        <?php
        $resid = isset($_GET['Res_ID']) ? $_GET['Res_ID'] : '';

        $sql = "SELECT p.Drug_name, p.Drug_num
                            FROM restaurant r
                            LEFT JOIN pharmacy p ON SUBSTRING_INDEX(r.Res_address, ' ', -1) = SUBSTRING_INDEX(p.Drug_address, ' ', -1)
                            WHERE r.Res_ID = '$resid'";

        $res = mysqli_query($mysqli, $sql);

        if ($res) {
            $pharmacyData = mysqli_fetch_array($res, MYSQLI_ASSOC);

            if ($pharmacyData) {
                $drugName = $pharmacyData['Drug_name'];
                $drugNum = $pharmacyData['Drug_num'];
                echo "<div class='drug'>
                        <div class='text-4'>
                            <div class='heading-wrapper'>
                                <div class='div-wrapper-2'>
                                    <div class='div-wrapper-2'>
                                        <div class='text-wrapper-9'>$drugName</div>
                                    </div>
                                </div>
                            </div>
                        <div class='address'>
                            <div class='element'>
                                <div class='vector-wrapper'><img class='vector-3' src='img/vector-4.svg' /></div>
                                <div class='text-5'>
                                    <div class='text-wrapper-10'>CALL NOW:</div>
                                    <p class='text-wrapper-11'>$drugNum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class='image-2' src='img/drug-1img.png' />
                </div>";
            } else {

                echo "<div class='drug'>
                            <div class='text-4'>
                            <div class='heading-wrapper'>
                                <div class='div-wrapper-2'>
                                    <div class='div-wrapper-2'>
                                        <div class='text-wrapper-9'>No data</div>
                                    </div>
                                </div>
                            </div>
                        <div class='address'>
                            <div class='element'>
                                <div class='vector-wrapper'><img class='vector-3' src='img/vector-4.svg' /></div>
                                <div class='text-5'>
                                    <div class='text-wrapper-10'>CALL NOW:</div>
                                    <p class='text-wrapper-11'>No data</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class='image-2' src='img/drug-1img.png' />
                </div>";
            }
        } else {
            echo "Query Error";
        }
        ?>
        <div class="text-wrapper-12">Close hospital and pharmacy</div>
        <div class="banner"></div>
    </div>
    </div>
</body>

</html>
<?php
mysqli_close($mysqli);
?>