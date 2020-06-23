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
<header class="container_header_reviews">
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

	if (isset($_POST['remove_db'])) {
		$id = $_POST['id'];
		$query_delete = "DELETE FROM reviews WHERE id = '$id'";

	  	mysqli_query($dbc, $query_delete);
	}

	if (isset($_POST['save_button'])) {
		foreach ($_POST['reviews'] as $row) {
			$id = $row['id'];
			$name = $row['name'];
			$text_review = $row['text_review'];
			$numeration = $row['numeration'];
			if (!empty($id) && !empty($name) && !empty($text_review)) {
				if ($numeration == '') {
					$query_save = "UPDATE reviews SET `name` = '$name',  `text_review` = '$text_review', `numeration` = NULL WHERE `id` = '$id'";
				} else {
					$query_save = "UPDATE reviews SET `name` = '$name',  `text_review` = '$text_review', `numeration` = '$numeration' WHERE `id` = '$id'";
				}
				mysqli_query($dbc, $query_save);
			}
		}
	}

  $query = "SELECT * FROM reviews ORDER BY 'date' DESC, 'id' DESC";
  $data = mysqli_query($dbc, $query);

  while ($row = mysqli_fetch_array($data)) {
	  $id = $row['id'];
	  echo '<form class="form_admin" name="form_admin_' . $id . '" id="form_admin_' . $id . '" method="POST" action="' . $_SERVER["PHP_SELF"] . '" target="_self"></form>';
  }
?>
  	<form class="form_admin" id="form_admin" method="POST" action="<?=$_SERVER['PHP_SELF']?>" target="_self"></form>
  	<table class="table_admin table_reviews">
		<tr class="row_1 row">
			<th class="col_1">id</th>
			<th class="col_2">Дата</th>
			<th class="col_3">Номер</th>
			<th class="col_4">Имя</th>
			<th class="col_5">Текст</th>
			<th class="col_6">Удалить</th>
		</tr>
<?php
	$data = mysqli_query($dbc, $query);
	$iter_row = 2; // итерация строк таблицы

	function transform_month($month_db) {
		return date('d.m.y', strtotime($month_db));
	}

	while ($row = mysqli_fetch_array($data)) {
		$id = $row['id'];
		$name = $row['name'];
		$text_review = $row['text_review'];
		$numeration = $row['numeration'];
?>
	<tr id="<?=$id?>" class="row_<?=$iter_row?> row">
	  <td class="col_1"><?=$id?></td>
	  <input type="hidden" name="reviews[<?=$id?>][id]" value="<?=$id?>" form="form_admin">
	  <input type="hidden" name="id" value="<?=$id?>" form="form_admin_<?=$id?>" readonly>
	  <td class="col_2 date_reviews" readonly><?=transform_month($row['date'])?></td>
	  <td class="col_3 numeration">
		<input type="number" name="reviews[<?=$id?>][numeration]" value="<?=$numeration?>" form="form_admin" min="0" max="999" maxlenght="3">
	  </td>
	  <td class="col_4 name_reviews">
		<input type="text" name="reviews[<?=$id?>][name]" value="<?=$name?>" form="form_admin" maxlength="50" required>
	  </td>
	  <td class="col_5 text_reviews">
		<textarea name="reviews[<?=$id?>][text_review]" form="form_admin" maxlength="600" rows="5" cols="65"><?=$text_review?></textarea>
	  </td>
	  <td class="col_6 remove">
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