<?php

session_name('로그인');
session_start();

$mysqli = mysqli_connect("localhost", "team06", "team06", "team06");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$resID = isset($_GET['Res_ID']) ? $_GET['Res_ID'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userID = isset($_SESSION['SESSION_User_ID']) ? $_SESSION['SESSION_User_ID'] : '';

    $selectedRating = isset($_POST['selectedRating']) ? $_POST['selectedRating'] : '';

    $currentDate = date("Y-m-d");


    $insertQuery = "INSERT INTO res_rate (Res_ID, User_ID, Res_rating, Res_rating_date) VALUES ('$resID', '$userID', '$selectedRating', '$currentDate')";

    $checkDuplicateQuery = "SELECT * FROM res_rate WHERE User_ID = '$userID' AND Res_ID = '$resID'";
    $checkDuplicateResult = mysqli_query($mysqli, $checkDuplicateQuery);

    if (mysqli_num_rows($checkDuplicateResult) > 0) {
        echo "<script>alert('이미 별점을 부여하셨습니다.');</script>";
        echo "<script>history.back();</script>";
        exit();
    }

    if (mysqli_query($mysqli, $insertQuery)) {
        echo "<script>alert('별점이 성공적으로 등록되었습니다.');</script>";
        echo "<script>history.back();</script>";
    } else {
        echo "<script>alert('별점 등록 중 오류가 발생했습니다.');</script>";
        echo "<script>history.back();</script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>별점 주기</title>
    <style>
        body {
            background-color: white;
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }


        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 40px;
            border: 1px solid #888;
            width: 80%;
            height: 30%;
        }


        button {
            background-color: #FFD233;
            color: #333;
            padding: 30px 20px;
            font-size: 25px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            text-align: center;
            position: inherit;

        }

        button3 {
            background-color: #FFD233;
            color: #333;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            position: relative;
            top: 100px;
        }

        buttoncl {
            background-color: #FFD233;
            color: #333;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            position: relative;
            top: 200px;
            right: 140px;
        }

        form {
            margin-top: 20px;
        }


        select {
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <button onclick="openModal()">별점 주기</button>
    <div>★★★★★</div>

    <div id="myModal" class="modal">
        <div class="modal-content">

            <form action="" method="post">
                <input type="hidden" name="Res_ID" value="<?php echo $resid; ?>">


                <select name="selectedRating">
                    <option value="1">1점</option>
                    <option value="2">2점</option>
                    <option value="3">3점</option>
                    <option value="4">4점</option>
                    <option value="5">5점</option>
                </select>


                <button type="submit">별점 주기</button>
            </form>


            <button3 onclick="closeModal()">닫기</button3>
        </div>
    </div>


    <script>
        function openModal() {
            document.getElementById('myModal').style.display = 'block';
        }


        function closeModal() {
            document.getElementById('myModal').style.display = 'none';

        }
    </script>

</body>

</html>

<?php
mysqli_close($mysqli);
?>