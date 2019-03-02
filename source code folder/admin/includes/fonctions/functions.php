<?php

//create function to display title 
function getTitle(){
	global $pageTitle;
	if(isset($pageTitle)){
		echo $pageTitle;

	}else{
		echo 'Default';
	}
}

//function to count number of items
function countItems($item, $table){
     global $con;
     $stmt2 = $con->prepare("SELECT COUNT($item) FROM PFE_DB. $table");
     $stmt2->execute();
    return $stmt2->fetchColumn();
}
