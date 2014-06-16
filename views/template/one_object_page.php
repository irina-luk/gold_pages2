<?php defined('GOLD') or exit('Access denied');?>

<p class="out">
   <a href="<?php echo $_SESSION['url']; ?>">Назад</a>
</p>

<h2><?php echo $one['title']; ?></h2>
<div class="info">
   <strong>Адрес:</strong>&nbsp;<?php echo $one['adres']; ?><br />
   <strong>Телефон:</strong>&nbsp;<?php echo $one['tel']; ?><br />
   <strong>Вебсайт:</strong>&nbsp;<?php echo $one['website']; ?><br />
   <strong>E-mail:</strong>&nbsp;<?php echo $one['email']; ?><br />
</div> 
<div class="full_opis">
   <?php echo $one['text']; ?>
</div>
<div id="map_canvas" ></div>