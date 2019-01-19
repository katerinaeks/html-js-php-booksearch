<?php

    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'kate';

    /*** mysql password ***/
    $mysql_password = 'localhost';

    /*** database name ***/
    $mysql_dbname = 'kate';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       /*** prepare the select statement ***/
        $stmt = $dbh->prepare("SELECT title FROM books");

        

        /*** execute the prepared statement ***/
        $stmt->execute();

		$db_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (sizeof($db_data) > 0) {
				
             $titles = array();
			 
			 foreach($db_data as $row) {
				 
				 array_push($titles,$row['title']); //to $row einai grammi eggrafis pou epistrefei ston pinaka $db_data,exei ta idia onomata stilwn me ton pinaka sti vasi 
			 }

				
			  echo implode(",",$titles);
		}
		else {
			$message="No books are available in the database";
			echo $message;
		}
        
    }
    catch(Exception $e)
    {
       $message = 'Cannot connect to database. Please try again later"'.$e;
       echo $message;
	}

?>