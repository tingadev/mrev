<?php

function getCatNews(){
	global $connection;
	$data="";
	$query = "select *from news_cat n, news_cat_desc nd where n.id = nd.cat_id order by n.id ASC";
	$result= mysqli_query($connection,$query);

	$data.="<select class='form-control' name='cat_id' id='cat_id'>";
	$data .= "<option value=0>ROOT</option>";
	if(mysqli_num_rows($result)){
		while($row= mysqli_fetch_assoc($result)){
			$data .= "<option value='{$row['id']}'>{$row['title']}</option>";

		}
	}	
	$data.="</select>";

	return $data;

}

?>