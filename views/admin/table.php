<?php
$title = "Список задач";
include "views/header.php"; ?>
<title>Календарь </title>
<form method="POST" action="">
  <div class = "left">
	<a href = "./index.php" class = "c">Новая задача</a> 
  <input type="submit" class = "abutton" name = "all"   value = "ВСЕ">
  <input type="submit" class = "abutton" name = "today" value = "Сегодня">
  <input type="submit" class = "abutton" name = "tomm"  value = "Завтра">
  <input type="submit" class = "abutton" name = "this"  value = "На этой неделе">
  <input type="submit" class = "abutton" name = "next"  value = "На след неделе">
	
  </div>
  
  <div class = "right">
  <input type="date"  name = "datdat">
  <input type="submit" class = "abutton" name = "main"   value = "OK"><br>
  <div class = "radio">
  <input type = "radio" name = "issue" value = "now" > Текущие<br>
  <input type = "radio" name = "issue" value = "done" > Выполненные<br>
  <input type = "radio" name = "issue" value = "pastcase"  > Просроченные<br>
	
  </div>  
  </div>	
  <center>
	<table class = "table3" border=0>  
  	<tr >
      
    	<th class ="th1" width=20>№</th>
    	<th class ="th1"  width=100>Тип</th>
    	<th  class ="th1" width=500>Задача</th>
    	<th  class ="th1"width=300>Место</th>
    	<th  class ="th1"width=300>Дата</th>
    	<th class ="th1" width=300>Время</th>
    	<th class ="th1" >Длительность</th>
    	<th class ="th1" >Комментарий</th>
      <th class ="th1" width=5></th>              
    </tr>
  <?php 
		foreach ($records as $num => $record)
			{ ?>
      		<tr class = "tr1">          
          <td class ="td1"><?=htmlspecialchars($record->id)?></td>
        	<td class ="td1"><?= $record->get_types()?></td>          
        	<td class ="td1"><?= htmlspecialchars($record->theme)?></td>
        	<td class ="td1"><?= htmlspecialchars($record->place)?></td>        
        	<td class ="td1"><?= $record->date?></td>
        	<td class ="td1"><?= $record->time?></td>
        	<td class ="td1"><?= $record->get_cases()?></td>
        	<td class ="td1"><?= htmlspecialchars($record->comm)?></td >
          <td class ="td1"><input type = "hidden" name = "<?=htmlspecialchars($record->id)?>" value = "0">
          <input type = "checkbox" name = "<?=htmlspecialchars($record->id)?>" value = "1"></td></tr>
          <?php }?>     
    			
    			<tr>
          <td>          
           <input type = "submit" class = "addbutton" name = "do" value = "Выполнено">          
         	<input type = "submit" class = "addbutton" name = "delete" value = "Удалить"></td> 
    			</tr>     
          	
  </table>
  </center>
</form>