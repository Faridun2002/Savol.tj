<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
session_start();
$_SESSION['logged'] = "ok";
if ($_SESSION['logged'] != "ok") {
    header("Location: index.php");
}
unset($_SESSION["logged"]);

function validate($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sesUserName = $_SESSION['UserName'];
$sesUserId = $_SESSION['UserId'];

// Чтение значений из поля POST
$mainText = validate($_POST['mainText']);
$category = $_POST['category'];

if($_POST['hide'] == "on"){
  $hide = 'true';
} else {
  $hide = 'false';
}

// Чтение значений из ini файла
$config = parse_ini_file('config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

// Проверяем, были ли выбраны файлы
if(isset($_FILES['files'])) {
  $AllUploadRenamePath = '';
  $currentDateTime = '';
  $files = $_FILES['files'];
  // Перебираем массив файлов
  for ($i = 0; $i < count($files['name']); $i++) {
    $fileName = $files['name'][$i];
    $fileTmp = $files['tmp_name'][$i];
    $fileSize = $files['size'][$i];

    // Определяем путь для сохранения файла
    $uploadPath = '../uploads/' . $fileName;

    // Перемещаем загруженный файл в указанное место
    move_uploaded_file($fileTmp, $uploadPath);

    // Новое имя файла
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFilename = uniqid() . '.' . $fileExtension;
    $uploadRenamePath = '../uploads/' . $newFilename;
    rename($uploadPath, $uploadRenamePath);
    $AllUploadRenamePath .= $newFilename . ';';
    
  }
  // Устанавливаем соединение с базой данных
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Проверяем соединение на ошибки
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $currentDateTime = date("Y-m-d H:i:s");
  $sql = "INSERT INTO questions (MainText, Category, DateCreate,  Status, UserId, HideUser, PhotoPath) VALUES ('$mainText', '$category', '$currentDateTime',  1, '$sesUserId', $hide, '$AllUploadRenamePath;');";
  
  // Выполняем SQL-запрос
  if ($conn->query($sql) === false) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Закрываем соединение с базой данных
  $conn->close();
} else {
  // Устанавливаем соединение с базой данных
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Проверяем соединение на ошибки
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO questions (MainText, Category, Status, UserId, HideUser) VALUES ('".$mainText."', '".$category."', 1, ".$sesUserId.", ".$hide.");";

  // Выполняем SQL-запрос
  if ($conn->query($sql) === false) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Закрываем соединение с базой данных
  $conn->close();
}
$result = [
  'message' => 'Вопрос отправлен на обработку',
  'mainText' => $mainText,
  'status' => '1',
  'userId' => $sesUserId
];

header('Content-type: application/json');
echo json_encode($result);
} else {
  // Если запрос не является методом POST, возвращаем ошибку
  header('HTTP/1.1 405 Method Not Allowed');
  echo 'Метод не разрешен';
}
?>