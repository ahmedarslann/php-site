<?php




try{

 $database = new PDO("mysql:host=localhost;dbname=nirvana;charset=utf8mb4", "root",""); 
                          # host # dbname # charset # username # pass
}catch(PDOException $mysql_error){

 echo $mysql_error->getMessage(); 
}


foreach ($_GET as $key => $value ) {
	
	$value = htmlentities(strip_tags(trim(urldecode($value))),ENT_QUOTES ) ;


	 $_GET[$key] = $value ;

	 
} 

//-----------------------------------POST-----------------------------------

foreach ($_POST as $key => $value ) {
	
	$value = htmlentities(trim(urldecode($value)),ENT_QUOTES ) ;


	 $_POST[$key] = $value ;

	 
} 


?>