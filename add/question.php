<?php
ini_get('display_errors');
session_start();
$_SESSION['logged'] = "ok";
$_SESSION['UserId'] = 2;
$_SESSION['UserName'] = "Abdu";
$_SESSION['UserName'] = "Abdu";

if ($_SESSION['logged'] != "ok") {
    header("Location: index.php");
}
unset($_SESSION["logged"]);


$language = $_SESSION['language'];

if($language == "") {
    $language = 'tj';
} 

if ($language === 'en') {
    require_once './lang/en.php';
} elseif ($language === 'tj') {
    require_once './lang/tj.php';
} else {
    require_once './lang/ru.php';
}

// Чтение значений из ini файла
$config = parse_ini_file('config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Савол</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style_question.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body id="body">
    <main role="main">
        <div class="form">
            <form class="form_body" id="form" name="form" action="addQ.php" method="POST" enctype="multipart/form-data">
                <h1 class="form_title"><? echo $lang['form_title']?></h1>

                <div class="form_item">
                    <label class="form_label"><? echo $lang['question']?></label>
                    <textarea class="form_input _req" id="mainText" name="mainText"></textarea>
                </div>
                <div class="form_item">
                    <label class="form_label"><? echo $lang['category']?></label>
                    <select class="form-select form_input _req" id="category" name="category">
                        <option selected value=""><? echo $lang['no_select']?></option>
                        <?php
                        // Создание соединения
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Проверка соединения
                        if ($conn->connect_error) {
                            die("Ошибка соединения: " . $conn->connect_error);
                        }

                        $sql = "SELECT name from categories;";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Вывод данных каждой строки
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                            }
                        } else {
                            echo "<option value='error'>Ошибка!</option>";
                        }
                        $conn->close();

                        ?>
                    </select>
                </div>
                <div class="form_item">
                    <div class="input-file-row">
                        <label class="input-file">
                            <input type="file" name="files[]" id='files' accept=".jpg, .png" multiple>
                            <span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3431 4.54362L12.7682 5.94696L6.44995 12.3627C6.13292 12.6863 6.13292 13.2071 6.44995 13.5307C6.7508 13.8377 7.25337 13.8363 7.551 13.529L14.5024 6.46735C15.5172 5.43172 15.5172 3.76851 14.5024 2.73288C13.5342 1.74478 11.821 1.76676 10.872 2.73476L3.28475 10.4369C1.57175 12.1843 1.57175 14.9903 3.28475 16.7377C4.94816 18.4346 7.80565 18.4069 9.44308 16.7362L18.2921 7.74893L19.7172 9.15214L10.8698 18.1377C8.45593 20.6008 4.31029 20.6409 1.85654 18.1378C-0.618847 15.6127 -0.618847 11.562 1.85825 9.03511L9.44554 1.33295C11.169 -0.425118 14.1703 -0.463624 15.9309 1.3331C17.7077 3.14636 17.7077 6.05387 15.9293 7.86877L8.98207 14.9261C7.9074 16.036 6.10955 16.041 5.02135 14.9303C3.94245 13.8291 3.94245 12.0642 5.02315 10.9612L11.3431 4.54362Z" fill="#fff" />
                                </svg>
                                <? echo $lang['attach_photo']?>
                            </span>
                        </label>
                        <div class="input-file-list"></div>
                    </div>
                </div>
                <div class="form_item">
                    <div class="checkbox">
                        <input class="checkbox_input " type="checkbox" name="hide" id="hide">
                        <label class="checkbox_label" for="hide"><span><? echo $lang['hide']?></span></label>
                    </div>
                </div>
                <button id="myButton" class="form_button"><? echo $lang['publish']?></button>
            </form>
        </div>
    </main>
    <script src="./js/script.js"></script>
</body>

</html>