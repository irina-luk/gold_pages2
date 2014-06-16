<?php defined('GOLD') or exit('Access denied');?>
    
<p class="out">
   <a href="<?php echo SITE_URL; ?>admin">Назад</a>
</p>

<h2>Каталог предприятий Харькова</h2>
<p class="out">Выберите рубрику.</p>
<ul class="mob" >
   <?php foreach($list as $key => $item): ?>
           <h3><li><a href="#"><?php echo $item[0];?></a></li></h3>
           <ul>
       <?php if(isset($item['sub'])): // если есть подкатегория  ?>
               <?php foreach($item['sub'] as $k => $sub): ?>
                   <li>- <a href="<?php echo SITE_URL; ?>editobject/id/<?php echo $k;?>"><?php echo $sub;?></a></li>
               <?php endforeach; ?>
       <?php endif; ?>
           </ul>
   <?php endforeach; ?>    
</ul>