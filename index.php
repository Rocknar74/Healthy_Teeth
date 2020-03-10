<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/HealthyTeeth.css">
	<link rel="shortcut icon" href="img/header/header_logo.png" type="image/x-icon">
	<title>Healthy Teeth</title>
</head>

<body>
<header>
	<div class="container_header">
		<a href="" class="logo_header">
			<img src="img/header/header_logo.png" alt=""> <p>Healthy Teeth</p>
		</a>
		<p class="header_address">
			<a href="#map">г. Челябинск<br> Проспект победы 160</a>
		</p>
		<div class="container_workGraph_header">
			<a href="#contact">
				<span>График работы:</span>
				<div class="container_workTime">
					<span>пн-вс: 09:00-20:00</span>
					<span>обед: 14:00-14:30</span>
				</div>
			</a>
		</div>
		<div class="container_number_header">
			<a href="#contact">
				<span class="number">+7 (800) 00-392-10</span>
				<span class="number">+7 (800) 12-345-67</span>
			</a>
		</div>
	</div>
</header>

<main>

	<nav class="nav_header">
		<ul>
			<li><a href="#about_us">О нас</a></li>
			<li><a href="#personnel">Персонал</a></li>
			<li><a href="#reviews">Отзывы</a></li>
			<li><a href="#record_section">Запись на приём</a></li>
			<li><a href="#contact">Контакты</a></li>
		</ul>
	</nav>

	<section class="about_us_section" id="about_us">
		<div class="position_about_us">
			<div class="cont_about_us cont_text_1">
				<h2 class="about_us_header">О КЛИНИКЕ HEALTHY TEETH</h2>
				<p class="about_us_text">Делаем все, чтобы каждый визит к стоматологу был приятным событием.</p>
			</div>
		</div>
		<div class="position_about_us">
			<div class="cont_about_us cont_text_2">
				<p class="about_us_text">Гарантируем решение самых сложных проблем и внимательное отношение к каждому.</p>
			</div>
		</div>
		<div class="position_about_us">
			<div class="cont_about_us cont_text_3">
				<p class="about_us_text">Наши специалисты проходили обучение в Германии и Италии, поэтому пациенты отмечают не только высокий профессионализм врачей, но по-настоящему домашнюю атмосферу, царящую в стоматологии Healthy Teeth.</p>
			</div>
		</div>
	</section>

	<section class="personnel_section" id="personnel">
		<div class="personnel_header">
				<h2>Наш персонал</h2>
				<p>Все врачи в нашей клинике имеют большой опыт работы, прошли курсы повышения квалификации и являются одними из лучших специалистов в городе.</p>
		</div>
		<div class="personnel_main">
			<figure class="personnel_1 personnel">
					<img src="img/main/personnel/1.jpg" alt="">
					<figcaption>
							<h3>Прохладова<br> Ангелина<br> Витальевна</h3>
							<span>Стоматолог-хирург</span>
							<p>Опыт работы 11 лет, за это время вылечила более 1000 пациентов</p>
					</figcaption>
			</figure>
			<figure class="personnel_2 personnel">
					<img src="img/main/personnel/2.jpg" alt="">
					<figcaption>
							<h3>Воронцов<br> Антон<br> Степанович</h3>
							<span>Стоматолог-терапевт</span>
							<p>Опыт работы 15 лет. Автор уникальных разработок и методик протезирования зубов</p>
					</figcaption>
			</figure>
			<figure class="personnel_3 personnel">
					<img src="img/main/personnel/3.jpg" alt="">
					<figcaption>
							<h3>Зюзько<br> Мария<br> Прохорова</h3>
							<span>Стоматолог</span>
							<p>Опыт работы 12 лет</p>                    
					</figcaption>
			</figure>
		</div>
	</section>

	<section class="reviews_section" id="reviews">
		<div class="cont_reviews_section">
			<div class="reviews_header">
				<h2>Отзывы наших клиентов</h2>
				<button class="review_button">Оставить отзыв</button>
			</div>
<?php
	require_once 'connect.php'; //подключение файла с данными о базе данных
	error_reporting(0);
	if ($dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)) {
		$query = "SELECT * FROM reviews ORDER BY id DESC"
				or die ('Ошибка соединения с базой данных 2');

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
				if ($i < 4) {
					$month_EN = date('n')-1;
					$date = date('j', strtotime($reviews['date'])) . ' ' . $month_RU[$month_EN] . ' ' . date('Y', strtotime($reviews['date']));
					echo '<div class="review_container">
					<div class="container_name_date">
						<h3 class="review_name">' . $reviews['name'] . '</h3>
						<p class="review_date">' . $date . '</p>
					</div>
					<p class="review_text">' . $reviews['text_review'] . '</p>
					</div>';
					$i++;
				}
			}
			mysqli_close($dbc);
		}
	} else {
?>
			<div class="review_container">
				<div class="container_name_date">
					<h3 class="review_name">Александр Кузнецов</h3>
					<p class="review_date">20 Февраля 2020</p>
				</div>
				<p class="review_text">Эта клиника открылась относительно недавно, но удивила низкими ценами, качественной работой. Пару недель назад у меня заболел зуб, в большенстве клиник нашего города очередь на месяц вперед. Я случайно наткнулась на эту новую стоматологию в центре города. я позвонила, мне ответила девушка, которая все подробно рассказала и записала на удобное время. Буквально через сутки я вышла с улыбкой из кабинета, боли больше не было, так еще и сделали скидку на гигиену рта. В целом довольна услугами. Не такое уж и дорогое пломбирование, укол и услуги врача. Все качественно, понятно и удобно. Спасибо.</p>
			</div>
			<div class="review_container">
				<div class="container_name_date">
					<h3 class="review_name">Стручкова Маргарита</h3>
					<p class="review_date">15 Февраля 2020</p>
				</div>
				<p class="review_text">Замечательная клиника. Лечила тут 5 зубов, цены низкие.Также хотелось бы отметить вежливый и понимающий персонал, сразу видно, что профессионалы своего дела. Если возникнут еще проблемы, то буду обращаться еще не раз.</p>
			</div>
			<div class="review_container">
				<div class="container_name_date">
					<h3 class="review_name">Анна</h3>
					<p class="review_date">4 Февраля 2020</p>
				</div>
				<p class="review_text">Всегда считала, что профилактика помогает избежать серьезных проблем со здоровьем зубов. Была на профессиональной чистку зубов у Прохладова Ангелина Витальевна. Профессионал своего дела! Рекомендую.</p>
			</div>
<?php
	};
?>
			<div class='overlay_review'>
				<button class='esc_button'></button>
				<div class='write_review'>
					<form method="POST" action="<?='http://' . $_SERVER['HTTP_HOST'] . '/form_listener.php'?>" class="review_form">
						<label for="name_reviewer">Как вас зовут?</label>
						<input type="text" name="name_reviewer" id="name_reviewer" maxlength="100" placeholder="Ваше имя" required>
						<textarea name="write_text" id="write_text" cols="30" rows="10" maxlength="200" placeholder="Что вы о нас думаете?"></textarea>
						<input type="submit" name="submit_review" value="Оставить отзыв" id="submit_review">
					</form>
				</div>
			</div>
		</div>
	</section>
	
	<section class="record_section" id="record_section">
		<h2 class="record_header">Запишитесь на бесплатную консультацию</h2>
		<form method="POST" action="<?='http://' . $_SERVER['HTTP_HOST'] . '/form_listener.php'?>" class="record_form">
			<label for="name">Как вас зовут?</label>
			<input type="text" name="name" id="name" maxlength="100" placeholder="Ваше имя" required>
			<label for="phone">Контактный телефон</label>
			<input type="tel" name="phone" id="phone" maxlength="18" pattern="[+][7][0-9]{3}[0-9]{3}[0-9]{4}" placeholder="+7" value="+7" required>
			
			<label for="email">Укажите почту, для обратной связи</label>
			<input type="email" name="email" id="email" maxlength="50" placeholder="E-mail">
			<label for="date">Выберите желаемую дату приёма</label>
			<input type="date" name="date" id="date" maxlength="8" required>
			<input type="submit" name="submit_register" value="Записаться" id="submit">
		</form>
	</section>

	<section class="contact_section" id="contact">
		<div class="container_contact_info">
			<h2 class="cont_section_header">Наши контакты</h2>
			<div class="container_info_cont_section">
				<h3>Адрес:</h3>
				<p class="cont_section_address">г. Челябинск, Проспект победы 160</p>
				<div class="container_workTime_cont_section">
					<h3>График работы:</h3>
					<span class="work_time">пн-вс: 09:00-20:00</span><br>
					<span class="break_time">обед: 14:00-14:30</span>
				</div>
				<div class="container_number_cont_section">
					<h3>Контактные телефоны:</h3>
					<span class="number_cont_section">+7 (800) 00-392-10</span><br>
					<span class="number_cont_section">+7 (800) 12-345-67</span>
				</div>
			</div>
		</div>
		<div style="position:relative;overflow:hidden;" id="map"><a href="https://yandex.ru/maps/56/chelyabinsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Челябинск</a><a href="https://yandex.ru/maps/56/chelyabinsk/house/prospekt_pobedy_160/YkgYcgdkQEcCQFtvfX15d3xgYw==/?ll=61.406488%2C55.185966&utm_medium=mapframe&utm_source=maps&z=16.72" style="color:#eee;font-size:12px;position:absolute;top:14px;outline: none;">Проспект Победы, 160 — Яндекс.Карты</a><iframe src="https://yandex.ru/map-widget/v1/-/CKeyQN2j" width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
	</section>
</main>

<footer>
	<div class="container_footer">
		<div class="footer_leftBlock">
			<p>Сайт сделал Гладышев Андрей,<br> 
			Группа - пкс(д)-01-17, 5 курс,<br>
			Челябинский юридический колледж</p>
		</div>
		<a href="" class="footer_logo"><img src="img/header/header_logo.png" alt=""> <p>Healthy Teeth</p></a>
		<div class="footer_rightBlock">
			<div class="content_footer_rightBlock">
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
	</div>
</footer>

<script src="js/HealthyTeeth.js"></script>
</body>

</html>