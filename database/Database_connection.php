<?php

//Database_connection.php

class Database_connection
{
	function connect()
	{
		$connect = new PDO("mysql:host=localhost; dbname=chat", "root", "");
		return $connect;
		// $link=mysqli_connect("localhost","root","") or die ("khong the ket noi CSDL");
		// $db_selected =mysqli_select_db($link, 'chat');
		// return $db_selected;
	}
}

?>