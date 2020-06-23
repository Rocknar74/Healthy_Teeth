<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="shortcut icon" href="img/header/header_logo.png" type="image/x-icon">
	<title>Healthy Teeth</title>
</head>
<body>
<?php
	require_once 'connect.php';
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
		or die ('Ошибка соединения с базой данных 1');
?>
<header id="header">
	<div class="container_header">
		<a class="logo-header" href="index.php">
			<img src="img/header/header_logo.png" alt="">
			<p>Healthy Teeth</p>
		</a>
		<a class="header-address" href="#map">г. Челябинск<br> Проспект победы 160</a>
		<a class="header-workTime" href="#contact">
			<span>График работы:</span>
			<span>пн-вс: 09:00-20:00<br>обед: 14:00-14:30</span>
		</a>
		<a class="header-numbers" href="#contact">+7 (800) 00-392-10<br>+7 (800) 12-345-67</a>
	</div>
</header>
<main id="about_us">
	<nav class="nav_bar">
		<ul>
			<li><a href="#header">О нас</a></li>
			<li><a href="#personnel">Персонал</a></li>
			<li><a href="#price_section">Услуги</a></li>
			<li><a href="#reviews">Отзывы</a></li>
			<li><a href="#record_section">Запись на приём</a></li>
			<li><a href="#contact">Контакты</a></li>
<?php if ($_SERVER[REMOTE_ADDR] == $_SERVER[SERVER_ADDR]) { ?>
			<li class="admin">
				<a href="registrations.php">Админка</a>
				<div class="drop_list">
					<a href="registrations.php">Заявки</a>
					<a href="reviews.php">Отзывы</a>
					<a href="personnel.php">Персонал</a>
					<a href="services.php">Услуги</a>
					<a href="news.php">Новости</a>
				</div>
			</li>
<?php } ?>
		</ul>
	</nav>
	<section class="about_us_section">
		<img class="height_fix" src="img/main/news/news_1.jpg" alt="">
		<div class="container_news about_us active-news">
			<div class="cont_about_us cont_text_1">
				<h2 class="about_us_header">О КЛИНИКЕ HEALTHY TEETH</h2>
				<p class="about_us_text">Делаем все, чтобы каждый визит к стоматологу был приятным событием.</p>
			</div>
			<div class="cont_about_us cont_text_2">
				<p class="about_us_text">Гарантируем решение самых сложных проблем и внимательное отношение к каждому.</p>
			</div>
			<div class="cont_about_us cont_text_3">
				<p class="about_us_text">Наши специалисты проходили обучение в Германии и Италии, поэтому пациенты отмечают не только высокий профессионализм врачей, но по-настоящему домашнюю атмосферу, царящую в стоматологии Healthy Teeth.</p>
			</div>
		</div>
<?php
	$query = "SELECT * FROM `news` ORDER BY 'numeration' ASC"
		or die ('Ошибка соединения с базой данных 2');
	$data = mysqli_query($dbc, $query);

	while ($row = mysqli_fetch_array($data)) {
		$image = $row['image'];
		$numeration = $row['numeration'];
		echo '<div class="container_news"><img class="img_news" src="' . $image . '" alt=""></div>';
	}
?>
	</section>
	<section class="personnel_section" id="personnel">
		<div class="personnel_header">
				<h2>Наш персонал</h2>
				<p>Все врачи в нашей клинике имеют большой опыт работы, прошли курсы повышения квалификации и являются одними из лучших специалистов в городе.</p>
		</div>
		<div class="container_personnel_slides">
			<div class="overlay_personnel"></div>
			<div class="main_personnel_slides">
<?php
	$query_personnel = "SELECT * FROM `personnel` WHERE `numeration` IS NOT NULL ORDER BY `numeration` ASC"
		or die ('Ошибка соединения с базой данных 2');
	$data = mysqli_query($dbc, $query_personnel);

	while ($row = mysqli_fetch_array($data)) {
		$photo = $row['photo'];
		$surname = $row['surname'];
		$name = $row['name'];
		$patronymic = $row['patronymic'];
		$profession = $row['profession'];
		$description = $row['description'];
?>
				<figure class="personnel">
						<img src="<?=$photo?>" alt="Ошибка загрузки фото сотрудника">
						<figcaption>
								<h3><?=$surname?><br> <?=$name?><br> <?=$patronymic?></h3>
								<span><?=$profession?></span>
								<p><?=$description?></p>
						</figcaption>
				</figure>
<?php
	}
?>
			</div>
			<div class="container-personnel_slider_buttons">
				<button class="personnel_left_slider_button personnel_slider_buttons" value="left"><img src="img/main/personnel/slide_button/Rectangle.png" alt=""></button>
				<button class="personnel_right_slider_button personnel_slider_buttons" value="right"><img src="img/main/personnel/slide_button/Rectangle.png" alt=""></button>
			</div>
		</div>
	</section>

	<section class="prices_section" id="price_section">
		<div class="prices_header">
				<h2>Услуги</h2>
		</div>
		<div class="cont_prices_section">
<?php
	$query_prices = "SELECT * FROM `services` ORDER BY `id` ASC"
		or die ('Ошибка соединения с базой данных 2');
	$data = mysqli_query($dbc, $query_prices);

	while ($row = mysqli_fetch_array($data)) {
		$service_name = $row['service_name'];
		$price = $row['price'];
?>
			<div class="container_preice">
				<p><?=$row['service_name']?></p>
				<span><?=$row['price']?> руб.</span>
			</div>
<?php
	}
?>
		</div>
	</section>

	<section class="reviews_section" id="reviews">
		<div class="cont_reviews_section">
			<div class="reviews_header">
				<h2>Отзывы наших клиентов</h2>
				<button class="add_button back_button">Оставить отзыв</button>
			</div>
<?php
	if ($dbc) {
		$query = "SELECT * FROM `reviews` WHERE `numeration` IS NOT NULL ORDER BY `numeration` ASC"
				or die ('Ошибка соединения с базой данных 2');
				
		$reviews_count = 10;

		if ($data = mysqli_query($dbc, $query)) {
			$i = 0;
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
			while ($reviews = mysqli_fetch_array($data)) { 
				if ($i++ < $reviews_count) {
					$name = $reviews['name'];
					$text_review = $reviews['text_review'];
					$numeration = $reviews['numeration'];
					$month_EN = date('n', strtotime($reviews['date'])) - 1;
					$date = date('j', strtotime($reviews['date'])) . ' ' . $month_RU[$month_EN] . ' ' . date('Y', strtotime($reviews['date']));

					echo '<div class="review_container">
					<div class="container_name_date">
						<h3 class="review_name">' . $name . '</h3>
						<p class="review_date">' . $date . '</p>
					</div>
					<p class="review_text">' . $text_review . '</p>
					</div>';
				}
			}
		}
	}
?>
			<div class='add_table'>
				<div class="overlay"></div>
				<button class='esc_button'></button>
				<div class='container-add_form'>
					<form class="add_form" method="POST" action="<?='http://' . $_SERVER['HTTP_HOST'] . '/form_listener.php'?>">
						<label for="name_reviewer">Как вас зовут?</label>
						<input type="text" name="name_reviewer" id="name_reviewer" maxlength="100" placeholder="Ваше имя" required>
						<textarea name="text_review" id="text_review" cols="30" rows="10" maxlength="600" placeholder="Что вы о нас думаете?"></textarea>
						<input class="submit_add_form" type="submit" name="submit_review" value="Оставить отзыв" id="submit_review">
					</form>
				</div>
			</div>
		</div>
	</section>
	
	<section class="record_section" id="record_section">
		<div class="record_header">
			<h2>Оставьте заявку на бесплатную консультацию</h2>
			<p>Оствтья заявку и мы перезвоним вам в ближайшее время, для уточнения даты приёма</p>
		</div>
		<form method="POST" action="<?='http://' . $_SERVER['HTTP_HOST'] . '/form_listener.php'?>" class="record_form">
			<label for="name">Как вас зовут?*</label>
			<input type="text" name="name" id="name" maxlength="100" placeholder="Ваше имя" required>
			<label for="phone">Контактный телефон*</label>
			<input type="tel" name="phone" id="phone" maxlength="18" pattern="[+][7][0-9]{3}[0-9]{3}[0-9]{4}" placeholder="+7" value="+7" required>
			<label for="email">Укажите почту, для обратной связи</label>
			<input type="email" name="email" id="email" maxlength="50" placeholder="E-mail">
			<label for="date">Выберите желаемую дату приёма*</label>
			<input type="date" name="date" id="date" maxlength="8" required>
			<input class="record_form_submit" type="submit" name="submit_register" value="Записаться" id="submit">
		</form>
	</section>

	<section class="contact_section" id="contact">
		<div class="container_contact_section">
			<h2 class="contanct_section_header">Наши контакты</h2>
			<div class="container_info_contact_section">
				<div class="container_address_contact_section">
					<h3>Адрес:</h3>
					<p class="cont_section_address">г. Челябинск, Проспект победы 160</p>
				</div>
				<div class="container_workTime_contact_section">
					<h3>График работы:</h3>
					<span class="work_time">пн-вс: 09:00-20:00</span>
					<span class="break_time">обед: 14:00-14:30</span>
				</div>
				<div class="container_number_contact_section">
					<h3>Контактные телефоны:</h3>
					<span class="number_cont_section">+7 (800) 00-392-10</span>
					<span class="number_cont_section">+7 (800) 12-345-67</span>
				</div>
				<div class="container_requisites_contact_section">
					<h3>Реквизиты компании:</h3>
					<p class="requisites">
						Общество с ограниченной ответственностью «Альтаир»<br>
						Юридический адрес: 454138, Челябинская область, город Челябинск, проспект Победы, дом 288<br>
						Фактический адрес: 454138, Челябинская область, город Челябинск, проспект Победы, дом 288<br>
						Тел +7 (800) 00-392-10<br>
						Директор - Галькин Никита Сергеевич
					</p>
				</div>
			</div>
		</div>
		<div style="position:relative;overflow:hidden;" id="map"><a href="https://yandex.ru/maps/56/chelyabinsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Челябинск</a><a href="https://yandex.ru/maps/56/chelyabinsk/house/prospekt_pobedy_288/YkgYdQJnSkAHQFtvfX15eHViZg==/?ll=61.356519%2C55.189920&utm_medium=mapframe&utm_source=maps&z=18.25" style="color:#eee;font-size:12px;position:absolute;top:14px;">Проспект Победы, 288 — Яндекс.Карты</a><iframe src="https://yandex.ru/map-widget/v1/-/CCQ7FQwMdB" width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
	</section>
</main>

<footer>
	<div class="container_footer">
		<a href="" class="footer_logo"><img src="img/header/header_logo.png" alt=""> <p>Healthy Teeth</p></a>
		<p>ООО Альтаир</p>
		<div>
			<div>Наши социальные сети</div>
			<div class="socialNet">
				<div class="socialNet_containerImg"><a class="vkontakte" href="https://vk.com/" target="_blank"><img
							src="img/footer/vk.png" alt=""></a></div>
				<div class="socialNet_containerImg"><a class="facebook" href="https://facebook.com/" target="_blank"><img
							src="img/footer/fb.png" alt=""></a></div>
				<div class="socialNet_containerImg"><a class="google" href="https://mail.google.com/" target="_blank"><img
							src="img/footer/google.png" alt=""></a></div>
				<div class="socialNet_containerImg"><a class="twitter" href="https://twitter.com/" target="_blank"><img
							src="img/footer/twitter.png" alt=""></a></div>
				<div class="socialNet_containerImg"><a class="mail" href="https://mail.ru/" target="_blank"><img
							src="img/footer/mail.png" alt=""></a></div>
			</div>
		</div>
	</div>
</footer>
<?php mysqli_close($dbc); ?>
<script src="js/index.js"></script>
</body>
</html>