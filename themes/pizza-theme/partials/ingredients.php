<section class="container">
    <div class="main-text">
        <h2><?php echo esc_html(get_theme_mod('pizza_ingredients_title', 'Съставките, които правят разликата')); ?></h2>
        <p><?php echo esc_html(get_theme_mod('pizza_ingredients_description', 'Съставки, които разказват история. Всяка хапка е пътешествие през вкусовете на юго-запад.')); ?></p>
    </div>

    <div class="container-box">
        <div class="c-mainbox">
            <div class="container-img">
                <img src="<?php echo esc_url(get_theme_mod('pizza_ingredient_1_image', get_template_directory_uri() . '/img/b1.png')); ?>" alt="box1">
            </div>
            <div class="container-text">
                <p><?php echo esc_html(get_theme_mod('pizza_ingredient_1_text', 'Нежно тесто, приготвено от отбрано брашно и кристална вода')); ?></p>
            </div>
        </div>

        <div class="c-mainbox">
            <div class="container-img">
                <img src="<?php echo esc_url(get_theme_mod('pizza_ingredient_2_image', get_template_directory_uri() . '/img/b2.png')); ?>" alt="box2">
            </div>
            <div class="container-text">
                <p><?php echo esc_html(get_theme_mod('pizza_ingredient_2_text', 'Розови домати, от градината на местни фермери, със запазен вкус на българското.')); ?></p>
            </div>
        </div>

        <div class="c-mainbox">
            <div class="container-img">
                <img src="<?php echo esc_url(get_theme_mod('pizza_ingredient_3_image', get_template_directory_uri() . '/img/b3.png')); ?>" alt="box3">
            </div>
            <div class="container-text">
                <p><?php echo esc_html(get_theme_mod('pizza_ingredient_3_text', 'Българско прясно сирене, внимателно обезбактеризирано за вас.')); ?></p>
            </div>
        </div>

        <div class="c-mainbox">
            <div class="container-img">
                <img src="<?php echo esc_url(get_theme_mod('pizza_ingredient_4_image', get_template_directory_uri() . '/img/b4.png')); ?>" alt="box4">
            </div>
            <div class="container-text">
                <p><?php echo esc_html(get_theme_mod('pizza_ingredient_4_text', 'Свинско чоризо, от животни на фермерите в региона подбрано за вас, опитайте и оценете.')); ?></p>
            </div>
        </div>
    </div>

	<div>
	<h3 style="text-align: center; margin-top: 40px">Абонирайте се за бюлетин:</h3>
    <form id="email-form" action="" method="POST">
        <input type="text" id="name" name="name" placeholder="Въведете вашето име" required> <br>
        <input type="email" id="email" name="email" placeholder="Въведете вашия имейл" required><br>
        <button type="submit" class="submit-button"><b>Изпрати</b></button>
        <div id="response-message"></div> 
    </form>
	</div>

    <div>


    
</section>
