<?php defined('GOLD') or exit('Access denied');?>

<p class="out">
   <a href="<?php echo SITE_URL; ?>admin">Назад</a>&nbsp;&nbsp;&nbsp;
   <a href="<?php echo SITE_URL; ?>login/logout/1">Выход</a>
</p>

<div class="add_object">
   <div id="top">Наверх</div>
<h2>Добавление объекта</h2>
<p>Все поля обязательны для заполнения.</p>
<p><?php if(isset($mes)) echo $mes;?></p>
<form action="<?php echo SITE_URL;?>addobject" method="post">
   <table>
         <tr>
         	<td>Разделы:</td>
         	<td>
               <select id="section_add_object" name="id_section">
                   <?php
                       if (isset($list)) {
				              echo "<option value='0'>- выберите раздел -</option>";
                          foreach ($list as $value) {
                             $selected = $value["id"] == $default_nav ? " selected " : ""; // Текущая ли рубрика?
                             echo "<option value='$value[id]' $selected>$value[title_navigator]</option>";
                          }
                       }
                   ?>
               </select>
            </td>
         </tr>
         <tr>
         	<td>Рубрики:</td>
         	<td>               
               <select id='rubrika' name="id_rubrika">
                   <?php 
                       if (isset($rubriki)) {
				              echo "<option value='0'>- выберите рубрику -</option>";
                          foreach ($rubriki as $rub) {
                              echo "<option value='$rub[id_rubrika]'>$rub[title_rubrika]</option>";
                          }
                       }
                   ?>
               </select>
            </td>
         </tr>
      <tr>
      	<td><label for="name">Название объекта</label></td>
      	<td><input type="text" required="required" placeholder="ООО 'Ориентир'" size="60" id="name" name="title" /></td>
      </tr>
      <tr>
      	<td><label for="adres">Адрес</label></td>
      	<td><input type="text" required="required" placeholder="61023, г. Харьков, ул. Сумская, 81" 
                     size="60" id="adres" name="adres" /></td>
      </tr>
      <tr>
      	<td><label for="tel">Телефон</label></td>
      	<td><input type="text" required="required" placeholder="(057) 7252779" size="60" id="tel" name="tel"/></td>
      </tr>
      <tr>
      	<td><label for="email">E-mail</label></td>
      	<td><input type="email" required="required" placeholder="belka.park@gmail.com" size="60" id="email" name="email"/></td>
      </tr>
      <tr>
      	<td><label for="website">Вебсайт</label></td>
      	<td><input type="text" required="required" placeholder="centralpark.kh.ua" size="60" id="website" name="website"/></td>
      </tr>
      <tr>
      	<td><label for="">Краткое описание</label></td>
      	<td><textarea cols="48" required="required" rows="5" name="shot_opis" ></textarea></td>
      </tr>
      <tr>
      	<td><label for="">Полное описание</label></td>
      	<td><textarea cols="48" rows="10" required="required" name="full_opis"></textarea></td>
      </tr>
      <tr>
      	<td><label for="keywords">Ключевые слова</label></td>
      	<td>
			<input type="text" required="required" placeholder="keywords" size="60" id="keywords" name="keywords"/>
                    <br />
					<span id="charsLeft"></span>&nbsp;знаков осталось.
		</td>
      </tr>
      <tr>
         <td><input type="reset" value="Сбросить" /></td>
         <td><input type="submit" name="add_object" value="Добавить" /></td>
      </tr>
   </table>
</form>
</div>