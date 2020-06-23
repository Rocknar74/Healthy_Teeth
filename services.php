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
<header class="container_header_prices">
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
        $name_service = $_POST['name_service'];
        $price = $_POST['price'];

        if (!empty($name_service) && !empty($price)) {
            $query_add = "INSERT INTO `services` VALUES (0, '$name_service', '$price')";

            mysqli_query($dbc, $query_add);
        }
    }

    if (isset($_POST['remove_db'])) {
        $id = $_POST['id'];
        $query_delete = "DELETE FROM `services` WHERE `id` = '$id'";

        mysqli_query($dbc, $query_delete);
    }

    if (isset($_POST['save_button'])) {
        foreach ($_POST['prices'] as $row) {
            $id = $row['id'];
            $service_name = $row['service_name'];
            $price = $row['price'];

            if (!empty($id) && !empty($service_name) && !empty($price)) {
                $query_save = "UPDATE `services` SET `service_name` = '$service_name',  `price` = '$price' WHERE `id` = '$id'";
                mysqli_query($dbc, $query_save);
            }
        }
    }

  $query = "SELECT * FROM `services` ORDER BY 'id' DESC";
  $data = mysqli_query($dbc, $query);

  while ($row = mysqli_fetch_array($data)) {
      $id = $row['id'];
      echo '<form class="form_admin" name="form_admin_' . $id . '" id="form_admin_' . $id . '" method="POST" action="' . $_SERVER["PHP_SELF"] . '" target="_self"></form>';
  }
?>

  <form class="form_admin" id="form_admin" method="POST" action="<?=$_SERVER['PHP_SELF']?>" target="_self"></form>
  <table class="table_admin table_prices">
    <tr class="row_1 row">
      <th class="col_1">id</th>
      <th class="col_2">Наименование услуги</th>
      <th class="col_3">Цена</th>
      <th class="col_3">Удалить</th>
    </tr>

<?php
  $data = mysqli_query($dbc, $query);
  $iter_row = 2; // итерация строк таблицы

  while ($row = mysqli_fetch_array($data)) {
    $id = $row['id'];
    $service_name = $row['service_name'];
    $price = $row['price'];
?>
    <tr id="<?=$id?>" class="row_<?=$iter_row?> row">
      <td class="col_1"><?=$id?></td>
      <input type="hidden" name="prices[<?=$id?>][id]" value="<?=$id?>" form="form_admin">
      <input type="hidden" name="id" value="<?=$id?>" form="form_admin_<?=$id?>">
      <td class="col_2 service_name">
        <input class="service_name" type="text" name="prices[<?=$id?>][service_name]" value="<?=$service_name?>" form="form_admin" maxlength="100">
      </td>
      <td class="col_3 prices">
        <input class="price" type="text" name="prices[<?=$id?>][price]" value="<?=$price?>" form="form_admin" maxlength="20">
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
      <form class="add_form" method="POST" action="<?='http://' . $_SERVER['HTTP_HOST'] . '/services.php'?>">
        <label for="name_service">Наименование услуги</label>
        <input type="text" name="name_service" id="name_service" maxlength="100" placeholder="Наименование услуги" required>
        <label for="price">Цена</label>
        <input type="text" name="price" id="price" maxlength="100" placeholder="Цена" required>
        <input class="submit_add_form" type="submit" name="submit_service" value="Добавить услугу">
      </form>
    </div>
  </div>
  <div class="container_buttons">
    <input class="back_button" type="submit" name="save_button" value="Сохранить" form="form_admin">
	<button class="add_button back_button">Добавить услугу</button>
    <a class="back_button" href="index.php">На главную</a>
  </div>
</main>
<?php mysqli_close($dbc); ?>
<script src="js/admin.js"></script>
</body> 
</html>