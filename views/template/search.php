<?php defined('GOLD') or exit('Access denied');?>
    
<h2>Поиск</h2>

<?php
	$answer = "Результаты поиска по: "; 
   if ($what != null) {
      $answer .= $what . " | ";
   }
   if ($where != null) {
      $answer .= $where;
   }
   
?>

<p class="note"><?php echo $answer; ?></p>

<?php if (isset($list) && !empty($list) && ($list[0] != null || $list[1] != null)) : ?>
   <ul class="rubriki">
      <?php foreach ($list as $value) : ?>
         <?php if ($value != null) : ?>
            <li>
               <h3>
                  <a href="<?php echo SITE_URL;?>object/id/<?php echo $value['id'];?>">
                     <?php echo $value['title'];?>
                  </a>
               </h3>
               <p><?php echo $value['opis'];?></p>
            </li>
         <?php endif; ?>
      <?php endforeach;?>
   </ul>
<?php else :?>
	<p class="note">Данных для вывода нет</p>
<?php endif;?>