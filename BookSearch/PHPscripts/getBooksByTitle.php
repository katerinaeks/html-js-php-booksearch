<?php
    
  if (isset($_POST['title'])) {
	  
	 $bookTitle = $_POST['title'];
	  
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
        $stmt = $dbh->prepare("SELECT title, id, author, genre, price, publish_date, description FROM books WHERE title = :book_title");

        /*** bind the parameters ***/
        $stmt->bindParam(':book_title', $bookTitle, PDO::PARAM_STR, 40);

        /*** execute the prepared statement ***/
        $stmt->execute();

        $db_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (sizeof($db_data) > 0) {
			echo '<?xml version="1.0"?>' . '<br>';	
			foreach($db_data as $row) {
             
			   echo '<book id="' . $row['id'] . '">' . '<br>' . '<author>' . $row['author'] . '</author>' . '<br>' . '<title>' . $row['title'] . '</title>' . '<br>' . '<genre>' . $row['genre'] . '</genre>' . '<br>' . '<price>' . $row['price'] . '</price>' . '<br>' . '<publish_date>' . $row['publish_date'] . '</publish_date>' . '<br>' . '<description>' . $row['description'] . '<description>' . '<br>' . '</book>' . '<br>';
			 
			}
			 

		}
		else {
			$message="No books are available in the database with that title";
			echo $message;
		}
        
    }
    catch(Exception $e)
    {
       $message = 'Cannot connect to database. Please try again later"'.$e;
       echo $message;
	}
	  
	  
	  
	  
	  
  } else
	 echo "You didn't sent book title data";









?>