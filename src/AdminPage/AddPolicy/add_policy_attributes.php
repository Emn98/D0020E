<!DOCTYPE html5>
<html lang="en">
  <head>
    <title>Admin NGAC</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="policy_style.css">
  </head>
<script type="text/javascript">

function addRows(element){ 
	var table = document.getElementById(element);
	var rowCount = table.rows.length;
	var cellCount = table.rows[0].cells.length; 
	var row = table.insertRow(rowCount);
	for(var i =0; i <= cellCount; i++){
		var cell = 'cell'+i;
		cell = row.insertCell(i);
		var copycel = document.getElementById('col'+i).innerHTML;
		cell.innerHTML=copycel;
		if(i == 3){ 
			var radioinput = document.getElementById('col3').getElementsByTagName('input'); 
			for(var j = 0; j <= radioinput.length; j++) { 
				if(radioinput[j].type == 'radio') { 
					var rownum = rowCount;
					radioinput[j].name = 'gender['+rownum+']';
				}
			}
		}
	}
}
function deleteRows(element){
	var table = document.getElementById(element);
	var rowCount = table.rows.length;
	if(rowCount > '2'){
		var row = table.deleteRow(rowCount-1);
		rowCount--;
	}
	else{
		alert('There should be atleast one row');
	}
}
</script>
<body>
<form class="dynamic_form" action="#" method="post">  
	<div class="float-container">
                
		<div class="float-child-2">
			<table id="emptbl1">
				<tr>
					<th>User</th>
				</tr> 
				<tr> 
					<td id="col0"><input type="text" name="empname[]" value="" /></td> 
				</tr>  
			</table> 
			<table> 
				<tr> 
					<td><input class="form_button" type="button" value="Add Row" onclick="addRows('emptbl1')" /></td> 
					<td><input class="form_button" type="button" value="Delete Row" onclick="deleteRows('emptbl1')" /></td> 
				</tr>  
			</table> 
		</div>
		<div class="float-child-2">
			<table id="emptbl2">
				<tr>
					<th>Object</th>
				</tr> 
				<tr> 
					<td id="col0"><input type="text" name="empname[]" value="" /></td> 
				</tr>  
			</table> 
			<table> 
				<tr> 
					<td><input class="form_button" type="button" value="Add Row" onclick="addRows('emptbl2')" /></td> 
					<td><input class="form_button" type="button" value="Delete Row" onclick="deleteRows('emptbl2')" /></td> 
				</tr>  
			</table> 
			<input type="submit" class="form_button" value="next">
		</div>
    </div>  
	
 </form> 
</body> 
</html>
