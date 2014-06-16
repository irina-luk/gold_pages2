<?php defined('GOLD') or exit('Access denied');?>

<p><?php if(isset($mes)) echo $mes;?></p>
<div class="add_object">
   <h3 class="out"><a href="<?php echo SITE_URL; ?>addsection">Добавить раздел или рубрику</a></h3>
   <h3 class="out"><a href="<?php echo SITE_URL; ?>addobject">Добавить объект</a></h3>
   <h3 class="out"><a href="<?php echo SITE_URL; ?>foredit">Изменить объект</a></h3>
   <p class="out"><a href="<?php echo SITE_URL; ?>login/logout/1">Выход</a></p>
</div>