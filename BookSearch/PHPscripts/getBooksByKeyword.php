<?php

    if (isset($_POST['keyword'])) {
	  
	   $keyword_value = $_POST['keyword'];
	   
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
        $stmt = $dbh->prepare("SELECT title, id, author, genre, price, publish_date, description FROM books WHERE title LIKE '%$keyword_value%'");

        /*** execute the prepared statement ***/
        $stmt->execute();

        $db_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		 echo '<?xml version="1.0"?>' . '<br>';
         echo '<catalog>' . '<br>';	
		if (sizeof($db_data) > 0) {
					
			foreach($db_data as $row) {
             
			   echo '<book id="' . $row['id'] . '">' . '<br>' . '<author>' . $row['author'] . '</author>' . '<br>' . '<title>' . $row['title'] . '</title>' . '<br>' . '<genre>' . $row['genre'] . '</genre>' . '<br>' . '<price>' . $row['price'] . '</price>' . '<br>' . '<publish_date>' . $row['publish_date'] . '</publish_date>' . '<br>' . '<description>' . $row['description'] . '<description>' . '<br>' . '</book>' . '<br>';
			 
			}
			
		}
		
		$stmt1 = $dbh->prepare("SELECT title, id, author, genre, price, publish_date, description FROM books WHERE author LIKE '%$keyword_value%'");

        /*** execute the prepared statement ***/
        $stmt1->execute();

        $db_data1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
		
		
		$stmt2 = $dbh->prepare("SELECT title, id, author, genre, price, publish_date, description FROM books WHERE genre LIKE '%$keyword_value%'");
		
        /*** execute the prepared statement ***/
        $stmt2->execute();

        $db_data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		
		$stmt3 = $dbh->prepare("SELECT title, id, author, genre, price, publish_date, description FROM books WHERE description LIKE '%$keyword_value%'");
		
        /*** execute the prepared statement ***/
        $stmt3->execute();

        $db_data3 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        
		if (sizeof($db_data1) > 0) {
			
           		
			foreach($db_data1 as $row) {
             
			   echo '<book id="' . $row['id'] . '">' . '<br>' . '<author>' . $row['author'] . '</author>' . '<br>' . '<title>' . $row['title'] . '</title>' . '<br>' . '<genre>' . $row['genre'] . '</genre>' . '<br>' . '<price>' . $row['price'] . '</price>' . '<br>' . '<publish_date>' . $row['publish_date'] . '</publish_date>' . '<br>' . '<description>' . $row['description'] . '<description>' . '<br>' . '</book>' . '<br>';
			 
			}

		}
		
		if (sizeof($db_data2) > 0) {
			
           		
			foreach($db_data2 as $row) {
             
			   echo '<book id="' . $row['id'] . '">' . '<br>' . '<author>' . $row['author'] . '</author>' . '<br>' . '<title>' . $row['title'] . '</title>' . '<br>' . '<genre>' . $row['genre'] . '</genre>' . '<br>' . '<price>' . $row['price'] . '</price>' . '<br>' . '<publish_date>' . $row['publish_date'] . '</publish_date>' . '<br>' . '<description>' . $row['description'] . '<description>' . '<br>' . '</book>' . '<br>';
			 
			}

		}
		
		if (sizeof($db_data3) > 0) {
			
           		
			foreach($db_data3 as $row) {
             
			   echo '<book id="' . $row['id'] . '">' . '<br>' . '<author>' . $row['author'] . '</author>' . '<br>' . '<title>' . $row['title'] . '</title>' . '<br>' . '<genre>' . $row['genre'] . '</genre>' . '<br>' . '<price>' . $row['price'] . '</price>' . '<br>' . '<publish_date>' . $row['publish_date'] . '</publish_date>' . '<br>' . '<description>' . $row['description'] . '<description>' . '<br>' . '</book>' . '<br>';
			 
			}

		}
	
       echo '</catalog>' . '<br>';   
	   
    }
    catch(Exception $e)
    {
       $message = 'Cannot connect to database. Please try again later"'.$e;
       echo $message;
	}
	   
	   
	   
	   
    } else {
	   
	   echo "You didn't sent keyword data field in HTTP post data!";
	   
   }







?>