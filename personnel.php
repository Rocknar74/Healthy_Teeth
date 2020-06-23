<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="img/header/header_logo.png" type="image/x-icon">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/admin.css">
	<title>Healthy Teeth</title>
</head>
<body>
<header class="container_header_personnel">
    <h2 class="header_registraion h2_header"><a href="registrations.php">Заявки</a></h2>  
    <h2 class="header_reviews h2_header"><a href="reviews.php">Отзывы</a></h2>
    <h2 class="header_personnel h2_header"><a href="personnel.php">Персонал</a></h2>
    <h2 class="header_prices h2_header"><a href="services.php">Услуги</a></h2>
    <h2 class="header_news h2_header"><a href="news.php">Новости</a></h2>
</header>
<main class="personnel_main">
<?php
    require_once 'connect.php';
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_POST['submit_personnel'])) {
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $patronymic = $_POST['patronymic'];
        $profession = $_POST['profession'];
        $description = $_POST['description'];
      
      if (!empty($_FILES['photo_file']) && !empty($surname) && !empty($name) && !empty($patronymic) && !empty($profession) && !empty($description)) {

        $photo_file_name = $_FILES['photo_file']['name'];
        $photo_file_tmp = $_FILES['photo_file']['tmp_name'];
        $photo = 'img/main/personnel/' . $photo_file_name;
        move_uploaded_file($photo_file_tmp, "img/main/personnel/$photo_file_name");

        $query_add = "INSERT INTO `personnel` VALUES (0, '$photo', '$surname', '$name', '$patronymic', '$profession', '$description', NULL)";

          mysqli_query($dbc, $query_add);
      } else {
        echo "Заполнены не все поля! Сотрудник не добавлен!";
      }
    }

    if (isset($_POST['remove_db'])) {
        $id = $_POST['id'];
        $query_delete = "DELETE FROM `personnel` WHERE id = '$id'";

        mysqli_query($dbc, $query_delete);
    }
    
    if (isset($_POST['save_button'])) {
        foreach ($_POST['personnel'] as $row) {
            $id = $row['id'];
            $photo = $row['photo'];

            if (!empty($photo_file_name = $_FILES['photo_file']['name'][$id])) {
              $photo_file_tmp = $_FILES['photo_file']['tmp_name'][$id];
              $photo = 'img/main/personnel/' . $photo_file_name;

              move_uploaded_file($photo_file_tmp, "img/main/personnel/$photo_file_name");
            };

            $numeration = $row['numeration'];
            $surname = $row['surname'];
            $name = $row['name'];
            $patronymic = $row['patronymic'];
            $profession = $row['profession'];
            $description = $row['description'];
            

            $query_save = "UPDATE `personnel` SET `photo` =  '$photo', `numeration` = '$numeration', `surname` = '$surname', `name` = '$name', `patronymic` = '$patronymic', `profession` = '$profession', `description` = '$description' WHERE `id` = '$id'";

            mysqli_query($dbc, $query_save);
        }
    }
    $query = "SELECT * FROM personnel ORDER BY 'id' DESC";
    $data = mysqli_query($dbc, $query);

    while ($row = mysqli_fetch_array($data)) {
        $id = $row['id'];
        echo '<form class="form_admin" name="form_admin_' . $id . '" id="form_admin_' . $id . '" method="POST" action="' . $_SERVER["PHP_SELF"] . '" target="_self"></form>';
    }
?>
  <form class="form_admin" id="form_admin" enctype="multipart/form-data" method="POST" action="<?=$_SERVER['PHP_SELF']?>" target="_self"></form>
  <table class="table_admin table_personnel">
    <tr class="row_1 row">
      <th class="col_1">id</th>
      <th class="col_2">Номер</th>
      <th class="col_3">Путь к фото (формата: img/main/personnel/...) в разрешении 300px на 411px</th>
      <th class="col_4">Фамилия</th>
      <th class="col_5">Имя</th>
      <th class="col_6">Отчество</th>
      <th class="col_7">Профессия</th>
      <th class="col_8">Описание</th>
      <th class="col_9">Удалить</th>
    </tr>

<?php
    $data = mysqli_query($dbc, $query);
    $iter_row = 2; // итерация строк таблицы

    while ($row = mysqli_fetch_array($data)) {
        $id = $row['id'];
        $photo = $row['photo'];
        $numeration = $row['numeration'];
        $surname = $row['surname'];
        $name = $row['name'];
        $patronymic = $row['patronymic'];
        $profession = $row['profession'];
        $description = $row['description'];
?>
    <tr id="<?=$id?>" class="row_<?=$iter_row?> row">
      <td class="col_1"><?=$id?></td>
      <input type="hidden" name="personnel[<?=$id?>][id]" value="<?=$id?>" form="form_admin">
      <input type="hidden" name="id" value="<?=$id?>" form="form_admin_<?=$id?>">
      <td class="col_2 numeration">
        <input type="text" name="personnel[<?=$id?>][numeration]" value="<?=$numeration?>" form="form_admin" maxlength="10">
      </td>
      <td class="col_3 photo">
        <input type="text" name="personnel[<?=$id?>][photo]" value="<?=$photo?>" form="form_admin" maxlength="5000" required>
        <input type="hidden" name="MAX_FILE_SIZE" value="999999" form="form_admin">
        <input type="file" name="photo_file[<?=$id?>]" accept="image/*" form="form_admin">
      </td>
      <td class="col_4 surname">
        <input type="text" name="personnel[<?=$id?>][surname]" value="<?=$surname?>" form="form_admin" maxlength="100" required>
      </td>
      <td class="col_5 name">
        <input type="text" name="personnel[<?=$id?>][name]" value="<?=$name?>" form="form_admin" maxlength="100" required>
      </td>
      <td class="col_6 patronymic">
        <input type="text" name="personnel[<?=$id?>][patronymic]" value="<?=$patronymic?>" form="form_admin" maxlength="100" required>
      </td>
      <td class="col_7 profession">
        <input type="text" name="personnel[<?=$id?>][profession]" value="<?=$profession?>" form="form_admin" maxlength="50" required>
      </td>
      <td class="col_8 description">
        <textarea name="personnel[<?=$id?>][description]" form="form_admin" maxlength="200" rows="3" cols="100" required><?=$description?></textarea>
      </td>
      <td class="col_9 remove">
        <label for="remove_db_<?=$id?>"><img src="img/admin/krestik.png" alt=""></label>
        <input id="remove_db_<?=$id?>" class="remove_db" type="submit" name="remove_db" value="" form="form_admin_<?=$id?>">
      </td>
    </tr>
<?php
        $iter_row ++;
    }
?>
  </table>
  <div class='add_table'>
      <div class="overlay"></div>
      <button class='esc_button'></button>
      <div class='container-add_form'>
          <form class="add_form" enctype="multipart/form-data" method="POST" action="<?='http://' . $_SERVER['HTTP_HOST'] . '/personnel.php'?>">
              <label for="photo_file">Фото сотрудника</label>
              <input type="hidden" name="MAX_FILE_SIZE" value="999999">
              <input type="file" name="photo_file" accept="image/*" required> 

              <label for="surname">Фамилия</label>
              <input type="text" name="surname" id="surname" maxlength="100" required>

              <label for="name">Имя</label>
              <input type="text" name="name" id="name" maxlength="100" required>

              <label for="patronymic">Отчество</label>
              <input type="text" name="patronymic" id="patronymic" maxlength="100" required>

              <label for="profession">Профессия</label>
              <input type="text" name="profession" id="profession" maxlength="50" required>

              <textarea name="description" maxlength="200" placeholder="Описание сотрудника" required></textarea>
              
              <input class="submit_add_form" type="submit" name="submit_personnel" value="Добавить сотрудника">
          </form>
      </div>
  </div>
  <div class="container_buttons">
    <input class="back_button" type="submit" name="save_button" value="Сохранить" form="form_admin">
    <button class="add_button back_button">Добавить сотрудника</button>
    <a class="back_button" href="index.php">На главную</a>
  </div>
</main>
<?php mysqli_close($dbc); ?>
<script src="js/admin.js"></script>
</body> 
</html>