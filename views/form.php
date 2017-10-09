<form action="" method="POST">
<div class = "main">
  <a href = "./admin.php" class = "c">к списку задач</a>
</div>

 <table class = "table1" border = "1"> 
 <tr><td>
	<table class = "table2" >
	<caption >НОВАЯ ЗАДАЧА</caption>
	<tr>
	<td width ="50px" align="right">
    <p>Тема:</p></td>
    <td  width ="30px"> <input name="theme" type="text" size="40" value="<?=htmlspecialchars($record->theme)?>"></td>
    
    	</tr>    
			<tr> 
			<td  width ="50px" align="right"><p>Место</p></td>
			<td  width ="30px"> <input name="place" type="text" size="40" value="<?=htmlspecialchars($record->place)?>"></td></tr>
			<tr>
			<td  width ="50px"  align="right"><p>Длительность:</p></td>
			<td width ="30px">        
			<select name="case" >
        <?php foreach (record::$cases as $key => $case ) { ?>
      	<option value="<?=$key?>" <?=$order->case == $key ? ' selected' : ''?>> <?=$case?> </option>
      	<?php } ?>
    	</select></td></tr>
      <tr>
      <td width ="50px"  align="right"><p>Дата и время</p></td>
      <td width ="30px">       		
			<input type="date" name = "date" value = "<?=htmlspecialchars($record->date)?>">			
			<input type="time" name="time" value = "<?=htmlspecialchars($record->time)?>"></td>
			</tr>
			<tr>
			<td  width ="50px" align="right" ><p>Тип:</p></td>
			<td width ="30px">
        <select name="type" >
        <?php foreach (record::$types as $key => $type ) { ?>
      	<option value="<?=$key?>" <?=$record->type == $key ? ' selected' : ''?>> <?=$type?> </option>
      	<?php } ?>
    		</select>
        </td></tr>
      	<tr> 
     		<td align="right" valign="top"><p>Комментарий:</p></td>
     		<td><textarea name="comm" cols="45" rows="10" value = "<?=htmlspecialchars($record->comm)?>"></textarea></td>
    		</tr>
    		<tr> 
    		<td width ="50px"  align="right" ></td>
    		<td>
				<button type="submit" name = "save" class = "addbutton">Добавить</button>
			</td></tr>	
	</table>
	</td></tr>
	</table>
</form>