<?php defined('GOLD') or exit('Access denied');?>
    
<h2>Каталог предприятий Харькова</h2>

<ul class="mob" id="accordion">
   <?php foreach($list as $key => $item): ?>
           <h3><li><a href="#"><?php echo $item[0];?></a></li></h3>
           <ul>
       <?php if(isset($item['sub'])): // если есть подкатегория  ?>
               <?php foreach($item['sub'] as $k => $sub): ?>
                   <li>- <a href="<?php echo SITE_URL; ?>rubriki/id/<?php echo $k;?>"><?php echo $sub;?></a></li>
               <?php endforeach; ?>
       <?php endif; ?>
           </ul>
   <?php endforeach; ?>    
</ul>