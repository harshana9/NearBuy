<?php
//sql_query, combo name, combo_value_colomn name, combo text column name,  combo selected, combo css class, true if requred
function dbCombo($c_sql,$c_name,$c_value,$c_text,$c_selected="",$c_required=true,$c_style="form-control")
{
	global $conn;
	echo "<select name=\"$c_name\" id=\"$c_name\" class=\"$c_style\"";
	if($c_required){
		echo " required>";
	}
	else{
		echo ">";
	}
	
	echo "<option></option>";
	$sql = $conn->prepare($c_sql);
	$sql->execute();			
	$numRows = $sql->fetchAll();
	if(count($numRows)>0){
		foreach($numRows as $row){
			if($row[$c_value]==$c_selected){
				echo "<option selected value=".$row[$c_value].">".$row[$c_text]."</option>";
			}
			else{
				echo "<option value=".$row[$c_value].">".$row[$c_text]."</option>";
			}
		}
	}
	echo"</select>";
}




//samplearr=array(12=>"LK",12=>"JP")
function arrayCombo($c_arr,$c_name,$c_selected="",$c_required=true,$c_style="form-control")
{
	global $conn;
	echo "<select name=\"$c_name\" id=\"$c_name\" class=\"$c_style\"";
	if($c_required){
		echo " required>";
	}
	else{
		echo ">";
	}
	
	if($c_selected==""){
		echo "<option selected></option>";
	}
	else{
		echo "<option></option>";
	}
	foreach($c_arr as $val => $txt){
		if($val==$c_selected){
			echo "<option selected value=".$val.">".$txt."</option>";
		}
		else{
			echo "<option value=".$val.">".$txt."</option>";
		}
	}
	echo"</select>";
}

?>