<?php 
 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'db_rentals');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT statement_id, action_date, statement_identifier, tenant_identifier, description, amount, balance, transaction_id FROM tenant_statement;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($statement_id, $action_date, $statement_identifier, $tenant_identifier, $description, $amount, $balance, $transaction_id);
 
 $tenant_statement = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['statement_id'] = $statement_id; 
 $temp['action_date'] = $action_date; 
 $temp['statement_identifier'] = $statement_identifier; 
 $temp['tenant_identifier'] = $tenant_identifier; 
 $temp['description'] = $description; 
 $temp['amount'] = $amount;
 $temp['balance'] = $balance; 
 $temp['transaction_id'] = $transaction_id; 
 array_push($tenant_statement, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($tenant_statement);