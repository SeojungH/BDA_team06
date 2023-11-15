<?php
session_start();

$mysqli = mysqli_connect("localhost", "team06", "team06", "team06");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userID = isset($_SESSION['User_ID']) ? $_SESSION['User_ID'] : '';


    $resID = isset($_POST['Res_ID']) ? $_POST['Res_ID'] : '';


    $selectedRating = isset($_POST['selectedRating']) ? $_POST['selectedRating'] : '';

  
    $currentDate = date("Y-m-d");

 
    $insertQuery = "INSERT INTO res_rate (Res_ID, User_ID, Res_rating, Res_rating_date) VALUES ('$resID', '$userID', '$selectedRating', '$currentDate')";

    if (mysqli_query($mysqli, $insertQuery)) {
        echo '별점이 성공적으로 등록되었습니다.';
    } else {
        echo '별점 등록 중 오류가 발생했습니다: ' . mysqli_error($mysqli);
    }
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>별점 매기기</title>
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

        button-3 {
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

   
    <button onclick="openModal()">별점 매기기</button>

 
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

               
                <button type="submit">별점</button>
            </form>

      
            <button-3 onclick="closeModal()">닫기</button-3>
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


<!-- <!DOCTYPE html>
<html lang="KO">

<head>
    <link rel="stylesheet" href="rating.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>별점</title>
</head>
<form class="mb-3" name="myform" id="myform" method="post">
    <fieldset>
        <span class="text-bold">별</span>
        <input type="radio" name="reviewStar" value="5" id="rate1"><label for="rate1">★</label>
        <input type="radio" name="reviewStar" value="4" id="rate2"><label for="rate2">★</label>
        <input type="radio" name="reviewStar" value="3" id="rate3"><label for="rate3">★</label>
        <input type="radio" name="reviewStar" value="2" id="rate4"><label for="rate4">★</label>
        <input type="radio" name="reviewStar" value="1" id="rate5"><label for="rate5">★</label>
    </fieldset>
</form>

</html> -->