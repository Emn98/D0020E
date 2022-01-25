<!DOCTYPE html5>
<html lang="en">
  <head>
    <title>Admin NGAC</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="policy_style.css">
  </head>
<script type="text/javascript">
function addRows(){ 
	var table = document.getElementById('emptbl');
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
function deleteRows(){
	var table = document.getElementById('emptbl');
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
<form action="#" method="post">  
    <div class="dynamic_form">
        <table id="emptbl">
            <tr>
                <th>User</th>
            </tr> 
            <tr> 
                <td id="col0"><input type="text" name="empname[]" value="" /></td> 
            </tr>  
        </table> 
        <table> 
            <tr> 
                <td><input class="form_button" type="button" value="Add Row" onclick="addRows()" /></td> 
                <td><input class="form_button" type="button" value="Delete Row" onclick="deleteRows()" /></td> 
                <td><input class="form_button" type="submit" value="Submit" /></td> 
            </tr>  
        </table> 
    </div>  
	
 </form> 
</body> 
</html>
