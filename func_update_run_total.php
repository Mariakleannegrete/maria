<?php 
	//How to use this... 
	// require("../functions/func_save_audit_trail.php");	
	// $arr_appt = func_get_appt_var($actionTaken, $tableName, $recid); //NO RETURN  
	
	function func_update_run_total($item_id){   
		mysql_query("UPDATE bin_tb a 
					INNER JOIN ( SELECT 
									@runtot:=0, 
									bin_id 
								 FROM bin_tb 
								 WHERE bin_item_id = '$item_id' AND bin_status = '2'
								 ORDER BY bin_date, bin_id ASC
								) openbal ON openbal.bin_id = a.bin_id 
						SET a.bin_run_total = (@runtot := @runtot + a.bin_qty) 
					WHERE a.bin_item_id = '$item_id' ") or die(mysql_error());
					
		mysql_query("UPDATE bin_tb SET bin_run_total = 0 WHERE bin_item_id = '$item_id' AND bin_status <> '2'") or die(mysql_error());
	}
?>
