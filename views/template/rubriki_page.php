<?php defined('GOLD') or exit('Access denied');?>
<!-- выводит все объекты конкретной рубрики -->

<p class="out">
   <a href="<?php echo SITE_URL; ?>">Назад</a>
</p>

<?php  $_SESSION['url'] = $_SERVER['REQUEST_URI']; ?>

<?php if (isset($list) && !empty($list)) : ?>
   <ul class="rubriki">
      <?php foreach ($list as $value) : ?>
         <li>
            <h3>
               <a href="<?php echo SITE_URL;?>object/id/<?php echo $value['id'];?>" class="get_coor">
                  <?php echo $value['title'];?>
               </a>
            </h3>
            <p><?php echo $value['opis'];?></p>
         </li>
      <?php endforeach;?>
   </ul>
<?php else : ?>
   <p class="note">В этом разделе ничего нет.</p>
<?php endif;?>