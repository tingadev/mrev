<?php
	function getPos($pos){
		global $connection;
		$data="";
		$query = "select *from position order by id ASC";
		$result= mysqli_query($connection,$query);
		$data.="<select class='form-control' name='pos' id='pos'>";
		if($result){

			while($row= mysqli_fetch_assoc($result)){
				if($pos==$row['pos']){
					$selected = "selected";
				}
				else{
					$selected ="";
				}
				$data .= "<option value='{$row['pos']}' $selected>{$row['title']}</option>";

			}
		}	
		$data.="</select>";

		return $data;
}

?>