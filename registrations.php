
<?php if ($_SERVER[REMOTE_ADDR] == $_SERVER[SERVER_ADDR]) { ?>
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
<header class="container_header_registration">
    <h2 class="header_registraion h2_header"><a href="registrations.php">Заявки</a></h2>  
    <h2 class="header_reviews h2_header"><a href="reviews.php">Отзывы</a> </h2>
    <h2 class="header_personnel h2_header"><a href="personnel.php">Персонал</a></h2>
    <h2 class="header_prices h2_header"><a href="services.php">Услуги</a></h2>
    <h2 class="header_news h2_header"><a href="news.php">Новости</a></h2>
</header>
<main class="registration">
<?php
  require_once 'connect.php';
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['remove_db'])) {
    $id = $_POST['id'];
    $query_delete = "DELETE FROM registration WHERE id = '$id'";

    mysqli_query($dbc, $query_delete);
  }

  if (isset($_POST['save_button'])) {
    foreach ($_POST['registration'] as $row) {
      $id = $row['id'];
      $date = $row['date'];
      $name = $row['name'];
      $phone = $row['phone'];
      $email = $row['email'];
      $status = $row['status'];

      $query_save = "UPDATE registration SET `name` = '$name', `date` = '$date',  `phone` = '$phone', `email` = '$email', `status` = '$status' WHERE `id` = '$id'";
  
      mysqli_query($dbc, $query_save);
    }
  }

  $query = "SELECT * FROM registration ORDER BY 'date' DESC, 'id' DESC";
  $data = mysqli_query($dbc, $query);

  while ($row = mysqli_fetch_array($data)) {
      $id = $row['id'];
      echo '<form class="form_admin" name="form_admin_' . $id . '" id="form_admin_' . $id . '" method="POST" action="' . $_SERVER["PHP_SELF"] . '" target="_self"></form>';
  }
?>
  <form class="form_admin" id="form_admin" method="POST" action="<?=$_SERVER['PHP_SELF']?>" target="_self"></form>
  <table class="table_admin table_registration">
    <tr class="row_1 row">
      <th class="col_1">id</th>
      <th class="col_2">Дата</th>
      <th class="col_3">Имя</th>
      <th class="col_4">Телефон</th>
      <th class="col_5">E-mail</th>
      <th class="col_6">Статус</th>
      <th class="col_7">Удалить</th>
    </tr>
<?php
  $data = mysqli_query($dbc, $query);
  $iter_row = 2; // итерация строк таблицы

  function transform_date($date_db) { //функция трансформации даты в привычный вид
    return date('d.m.y', strtotime($date_db));
  }

  while ($row = mysqli_fetch_array($data)) {
    $id = $row['id'];
    $date = $row['date'];
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $status = $row['status'];
?>
    <tr id="<?=$id?>" class="row_<?=$iter_row?> row">
      <td class="col_1"><?=$id?></td>
      <input type="hidden" name="registration[<?=$id?>][id]" value="<?=$id?>" form="form_admin">
      <input type="hidden" name="id" value="<?=$id?>" form="form_admin_<?=$id?>">
      <td class="col_2 date_order">
        <input type="date" name="registration[<?=$id?>][date]" value="<?=$date?>" form="form_admin">
      </td>
      <td class="col_3 name_order">
        <input type="text" name="registration[<?=$id?>][name]" value="<?=$name?>" form="form_admin" maxlength="50" required>
      </td>
      <td class="col_4">
        <input type="text" name="registration[<?=$id?>][phone]" value="<?=$phone?>" form="form_admin" maxlength="18" pattern="[+][7][0-9]{3}[0-9]{3}[0-9]{4}" placeholder="+7" value="+7" required>
      </td>
      <td class="col_5">
        <input type="email" name="registration[<?=$id?>][email]" value="<?=$email?>" form="form_admin" maxlength="50">
      </td>
      <td class="col_6 status">
        <select name="registration[<?=$id?>][status]" form="form_admin" maxlength="50">
          <option value="непросмотренно"<?php if ($status == 'непросмотренно'){echo ' selected';}?>>непросмотренно</option>
          <option value="рассматривается"<?php if ($status == 'рассматривается'){echo ' selected';}?>>рассматривается</option>
          <option value="принят"<?php if ($status == 'принят'){echo ' selected';}?>>принят</option>
          <option value="завершён"<?php if ($status == 'завершён'){echo ' selected';}?>>завершён</option>
        </select>
      </td>
      <td class="col_7 remove">
        <label for="remove_db_<?=$id?>"><img src="img/admin/krestik.png" alt=""></label>
        <input id="remove_db_<?=$id?>" class="remove_db" type="submit" name="remove_db" value="" form="form_admin_<?=$id?>">
      </td>
    </tr>
<?php
    $iter_row ++;
  }
?>
  </table>
  <div class="container_buttons">
    <input class="save_button back_button" type="submit" name="save_button" value="Сохранить" form="form_admin">
    <a class="back_button" href="index.php">На главную</a>
  </div>
</main>
<?php mysqli_close($dbc); ?>
</body> 
</html>

<?php } ?>