<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/admin.css">
	<link rel="shortcut icon" href="img/header/header_logo.png" type="image/x-icon">
	<title>Healthy Teeth</title>
</head>
<body>
<header class="container_header_news">
    <h2 class="header_registraion h2_header"><a href="registrations.php">Заявки</a></h2>  
    <h2 class="header_reviews h2_header"><a href="reviews.php">Отзывы</a> </h2>
    <h2 class="header_personnel h2_header"><a href="personnel.php">Персонал</a></h2>
    <h2 class="header_prices h2_header"><a href="services.php">Услуги</a></h2>
    <h2 class="header_news h2_header"><a href="news.php">Новости</a></h2>
</header>
<main>
<?php
    require_once 'connect.php';
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_POST['submit_service'])) {
        if (!empty($image_file_name = $_FILES['image_file']['name'])) {
          $image_file_tmp = $_FILES['image_file']['tmp_name'];
          $image = 'img/main/news/' . $image_file_name;

          move_uploaded_file($image_file_tmp, "img/main/news/$image_file_name");
          
          $query_add = "INSERT INTO `news` VALUES (0, '$image', NULL)";
          mysqli_query($dbc, $query_add);
        } else {
          echo '<p class="error_string">Вы не выбрали фото! Новость не была добавлена</p>';
        };
    };

    if (isset($_POST['remove_db'])) {
        $id = $_POST['id'];
        $query_delete = "DELETE FROM `news` WHERE `id` = '$id'";

        mysqli_query($dbc, $query_delete);
    };

    if (isset($_POST['save_button'])) {
        foreach ($_POST['news'] as $row) {
            $id = $row['id'];
            $numeration = $row['numeration'];
            $image = $row['image'];

            if (!empty($image_file_name = $_FILES['image_file']['name'][$id])) {
              $image_file_tmp = $_FILES['image_file']['tmp_name'][$id];
              $image = 'img/main/news/' . $image_file_name;

              move_uploaded_file($image_file_tmp, "img/main/news/$image_file_name");
            }
            if (!empty($image_file_name = $_FILES['image_file']['name'][$id]) || !empty($image)) {
              if ($numeration == '') {
                  $query_save = "UPDATE `news` SET `image` = '$image', `numeration` = NULL WHERE `id` = '$id'";
              } else {
                  $query_save = "UPDATE `news` SET `image` = '$image',  `numeration` = '$numeration' WHERE `id` = '$id'";
              }

              mysqli_query($dbc, $query_save);
            } else {
              echo '<p class="error_string">Вы заполнили не все поля! данные не сохранены!</p>';
            };
        }
    }

  $query = "SELECT * FROM `news` ORDER BY 'numeration' ASC";
  $data = mysqli_query($dbc, $query);

  while ($row = mysqli_fetch_array($data)) {
      $id = $row['id'];
      echo '<form class="form_admin" name="form_admin_' . $id . '" id="form_admin_' . $id . '" method="POST" action="' . $_SERVER["PHP_SELF"] . '" target="_self"></form>';
  }
?>
  <form class="form_admin" id="form_admin" enctype="multipart/form-data" method="POST" method="POST" action="<?=$_SERVER['PHP_SELF']?>" target="_self"></form>
  <table class="table_admin table_prices">
    <tr class="row_1 row">
      <th class="col_1">id</th>
      <th class="col_2">Номер</th>
      <th class="col_3">Путь к изображению с новостью (формата: img/main/news/...) в разрешении 1200px на 500px</th>
      <th class="col_4">Удалить</th>
    </tr>
<?php
  $data = mysqli_query($dbc, $query);
  $iter_row = 2; // итерация строк таблицы

  while ($row = mysqli_fetch_array($data)) {
    $id = $row['id'];
    $image = $row['image'];
    $numeration = $row['numeration'];
?>
    <tr id="<?=$id?>" class="row_<?=$iter_row?> row">
      <td class="col_1"><?=$id?></td>
      <input type="hidden" name="news[<?=$id?>][id]" value="<?=$id?>" form="form_admin">
      <input type="hidden" name="id" value="<?=$id?>" form="form_admin_<?=$id?>">
      <td class="col_2 numeration">
        <input type="number" name="news[<?=$id?>][numeration]" value="<?=$numeration?>" form="form_admin" min="0" max="999" maxlenght="3">
      </td>
      <td class="col_3 image">
        <input type="text" name="news[<?=$id?>][image]" value="<?=$image?>" form="form_admin" maxlength="500" required>
        <input type="hidden" name="MAX_FILE_SIZE" value="100000000" form="form_admin">
        <input type="file" name="image_file[<?=$id?>]" accept="image/*" form="form_admin">
      </td>
      <td class="col_4 remove">
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
            <form class="add_form" enctype="multipart/form-data" method="POST" method="POST" action="<?='http://' . $_SERVER['HTTP_HOST'] . '/news.php'?>">
                <label for="image_file">Изображение с новостью</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
                <input type="file" name="image_file" accept="image/*" required>
                <input class="submit_add_form" type="submit" name="submit_service" value="Добавить услугу">
            </form>
        </div>
    </div>
    <div class="container_buttons">
        <input class="back_button" type="submit" name="save_button" value="Сохранить" form="form_admin">
        <button class="add_button back_button">Добавить новость</button>
        <a class="back_button" href="index.php">На главную</a>
    </div>
</main>
<?php mysqli_close($dbc); ?>
<script src="js/admin.js"></script>
</body> 
</html>