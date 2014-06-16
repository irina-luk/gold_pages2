<?php defined('GOLD') or exit('Access denied');?>

<p class="out">
   <a href="<?php echo SITE_URL; ?>admin">Назад</a>&nbsp;&nbsp;&nbsp;
   <a href="<?php echo SITE_URL; ?>login/logout/1">Выход</a>
</p>

<div class="add_object">
<h2>Добавление объекта</h2>
<p><?php if(isset($mes)) echo $mes;?></p>
<form action="<?php echo SITE_URL;?>addsection" method="post">
   <table>
         <tr>
         	<td>Разделы:</td>
         	<td>
               <select id="section" name="old_section">
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
         	<td>Добавить раздел:</td>
         	<td><input type="text" name="new_section" size="60" /></td>
         </tr>
         <tr>
         	<td>Рубрики:</td>
         	<td>               
               <select id='rubrika' name="old_rubrika">
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
         	<td>Добавить рубрику:</td>
         	<td><input type="text" name="new_rubrika" size="60" /></td>
         </tr>
      <tr>
         <td><input type="reset" value="Сбросить" /></td>
         <td><input type="submit" name="add_secton" value="Добавить" /></td>
      </tr>
      </table>
   </form>