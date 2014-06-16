<?php defined('GOLD') or exit('Access denied');?>

<?php if ($option == 'view') : ?>
   <!-- выводит все объекты конкретной рубрики для админки -->

   <p class="out">
      <a href="<?php echo SITE_URL; ?>foredit">Назад</a>
   </p>
   
   <?php  $_SESSION['url'] = $_SERVER['REQUEST_URI']; ?>
         
   <?php if (isset($list) && !empty($list)) : ?>
      <ul class="rubriki">
         <?php foreach ($list as $value) : ?>
            <li>
               <h3>
                  <a href="<?php echo SITE_URL;?>editobject/option/edit/id/<?php echo $value['id'];?>" class="get_coor">
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
<?php elseif ($option == 'edit') : ?>
   <!-- выводит конкретный объект для редактирования -->
   
   <p class="out">
      <a href="<?php echo $_SESSION['url'];  ?>">Назад</a>
   </p>
   
   <div class="add_object">
   <div id="top">Наверх</div>
      <h2>Редактирование объекта</h2>
      <p><?php if(isset($mes)) echo $mes;?></p>
      <p>*Поля обязательны для заполнения.</p>
      <form action="<?php echo SITE_URL;?>editobject/option/edit" method="post">
         <input type="hidden" name="id" value="<?php echo $one['id']; ?>" />
         <input type="hidden" name="id_rubrika" value="<?php echo $one['rubriki_id']; ?>" />
         <table>
            <tr>
            	<td><label for="name">Название объекта</label></td>
            	<td>
                  <input type="text" required="required" size="60" id="name" name="title" 
                     value="<?php echo $one['title']; ?>" />
               </td>
            </tr>
            <tr>
            	<td><label for="adres">Адрес</label></td>
            	<td>
                  <input type="text" required="required" value="<?php echo $one['adres']; ?>" 
                           size="60" id="adres" name="adres" />
               </td>
            </tr>
            <tr>
            	<td><label for="tel">Телефон</label></td>
            	<td><input type="text" required="required" value="<?php echo $one['tel']; ?>" size="60" id="tel" name="tel"/></td>
            </tr>
            <tr>
            	<td><label for="email">E-mail</label></td>
            	<td><input type="email" required="required" value="<?php echo $one['email']; ?>" size="60" id="email" name="email"/></td>
            </tr>
            <tr>
            	<td><label for="website">Вебсайт</label></td>
            	<td><input type="text" required="required" value="<?php echo $one['website']; ?>" size="60" id="website" name="website"/></td>
            </tr>
            <tr>
            	<td><label for="">Краткое описание</label></td>
            	<td>
                  <textarea cols="48" required="required" rows="5" name="shot_opis" >
                     <?php echo $one['opis']; ?>
                  </textarea>
               </td>
            </tr>
            <tr>
            	<td><label for="">Полное описание</label></td>
            	<td>
                  <textarea cols="48" rows="10" required="required" name="full_opis">
                     <?php echo $one['text']; ?>
                  </textarea>
               </td>
            </tr>
            <tr>
            	<td><label for="keywords">Ключевые слова</label></td>
            	<td>
               <input type="text" required="required" value="<?php echo $one['keywords']; ?>" size="60" id="keywords" name="keywords"/></td>
            </tr>
            <tr>
               <td><input type="submit" name="delete_object" value="Удалить" /></td>
               <td><input type="submit" name="edit_object" value="Изменить" /></td>
            </tr>
         </table>
      </form>
   </div>
<?php endif; ?>