
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form_listener.css">
	<link rel="shortcut icon" href="img/header/header_logo.png" type="image/x-icon">
	<title>Healthy Teeth</title>
</head>

<body>
<?php
    require_once 'connect.php';

    function back_button($href) {
      return '<a href="index.php' . $href . '" class="back_to_main"> Вернуться на главную страницу</a>';
    };

    if (isset($_POST['submit_review'])) {
        $href = '#reviews';
        $name_reviewer = $_POST['name_reviewer'];
        $write_text = $_POST['write_text'];
        if (!empty($name_reviewer) && !empty($write_text)) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
              or die ('Ошибка соединения с базой данных 1<br>'. back_button($href));

            $query_delete = "DELETE FROM `reviews` WHERE name = '$name_reviewer' AND text_review = '$write_text'"
              or die ('Ошибка соединения с базой данных 2<br>'. back_button($href));
            mysqli_query($dbc, $query_delete);

            $query = "INSERT INTO reviews VALUES (0, NOW(), '$name_reviewer', '$write_text')"
              or die ('Ошибка соединения с базой данных 2<br>'. back_button($href));
            mysqli_query($dbc, $query);
            
            echo '<div class="container">
                    <p class="header_form_listener">Отзыв успешно оставлен!</p>'
                    . back_button($href) .
                  '</div>';
    
            mysqli_close($dbc);
        } else {
          echo '<div class="container">
                  <p class="header_form_listener">Для отправки отзыва необходимо заполнить все поля!<br> 
                  Отзыв не был отправлен!</p>'
                  . back_button($href) .
                '</div>';
        }
        
    } else if (isset($_POST['submit_register'])) {
        $href = '#record_section';
        $date = $_POST['date'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        if (!empty($name) && !empty($date) && !empty($phone)) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
              or die ('Ошибка соединения с базой данных 1<br>'. back_button($href));
            
            $query_delete = "DELETE FROM `registration` WHERE date = '$date' AND name = '$name' AND phone = '$phone'"
              or die ('Ошибка соединения с базой данных 2<br>'. back_button($href));
            mysqli_query($dbc, $query_delete); 

            $query = "INSERT INTO `registration` VALUES (0, '$date', '$name', '$phone', '$email')"
              or die ('Ошибка соединения с базой данных 2<br>'. back_button($href));
            mysqli_query($dbc, $query);
            
            $month_RU = [
              'Января',
              'Февраля',
              'Марта',
              'Апреля',
              'Мая',
              'Июня',
              'Июля',
              'Августа',
              'Сентября',
              'Октября',
              'Ноября',
              'Декабря'
            ];
            $month_EN = date('n')-1;
            $date = date('j', strtotime($reviews['date'])) . ' ' . $month_RU[$month_EN];

            echo '<div class="container">
                    <p class="header_form_listener">Вы зарегестрированы на ' . $date . '!</p>'
                    . back_button($href) .
                  '</div>';
              
            mysqli_close($dbc);
        } else {
            echo '<div class="container">
            <p class="header_form_listener">Запись не была произведена!<br>
            Для успешной записи необходми заполнить имя, контактный телефон и выбрать дату приёма!</p>'
            . back_button($href) .
            '</div>';
        }

    } else {
      echo '<div class="container">
              <p class="header_form_listener">Ошибка!</p>'
              . back_button($href) .
            '</div>';
    }
?>

</body>

</html>