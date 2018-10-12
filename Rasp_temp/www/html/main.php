<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <?php
/**
 * Database functions for a MySQL with PHP tutorial
 * 
 * @copyright Eran Galperin
 * @license MIT License
 * @see http://www.binpress.com/tutorial/using-php-with-mysql-the-right-way/17
 */
 
/**
 * Connect to the database
 * 
 * @return bool false on failure / mysqli MySQLi object instance on success
 */
function db_connect() {
    
    // Define connection as a static variable, to avoid connecting more than once 
    static $connection;
    // Try and connect to the database, if a connection has not been established yet
    if(!isset($connection)) {
		// Load configuration as an array. Use the actual location of your configuration file
		// Put the configuration file outside of the document root
		$config = parse_ini_file('../config.ini'); 
        $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
    }
    // If connection was not successful, handle the error
    if($connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.

    $result = mysqli_query($connection,$query);
    $myfile = fopen("php.shitfuck", "a");
    $txt = $result;
    fwrite($myfile, $txt);
        return mysqli_connect_error(); 
    }
    return $connection;
}
/**
 * Query the database
 *
 * @param $query The query string
 * @return mixed The result of the mysqli::query() function
 */

$result = db_query("SELECT * from batch");
 
if($result === false) {

    $myfile = fopen("php.shitfuck", "a");
    $txt = "Query on berseestä\n";
    fwrite($myfile, $txt);

} else {
    // Fetch all the rows in an array
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
    	$result = mysqli_query($connection,$query);
    	$myfile = fopen("php.shitfuck", "a");
    	$txt = $row;
        $rows[] = $row;
    }
}

function db_query($query) {
    // Connect to the database
    $connection = db_connect();
    // Query the database
    $result = mysqli_query($connection,$query);
    $myfile = fopen("php.shitfuck", "a");
    $txt = $result;
    fwrite($myfile, $txt);
    return $result;
}
/**
 * Fetch rows from the database (SELECT query)
 *
 * @param $query The query string
 * @return bool False on failure / array Database rows on success
 */


function db_select($query) {
    $rows = array();
    $result = db_query($query);
    // If query failed, return `false`
    if($result === false) {
        return false;
    }
    // If query was successful, retrieve all the rows into an array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    $result = mysqli_query($connection,$query);
    $myfile = fopen("php.shitfuck", "a");
    $txt = $rows;
    return $rows;
}
/**
 * Fetch the last error from the database
 * 
 * @return string Database error message
 */
function db_error() {
    $connection = db_connect();
    return mysqli_error($connection);
}
/**
 * Quote and escape value for use in a database query
 *
 * @param string $value The value to be quoted and escaped
 * @return string The quoted and escaped string
 */
function db_quote($value) {
    $connection = db_connect();
    return "'" . mysqli_real_escape_string($connection,$value) . "'";
}

?>

</head>
<body onload="init()">

      <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="http://18.195.162.116/temp_overtime.php">Temperature Chart</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <main role="main" class="container">

     
      <div class="starter-template">
        <h1>Temperature reading Jyväskylä Finland</h1>
    
			<div id="main">
		<div id="updateMe">
		
			            <h1 id="temp_c"></h1>
                        <h1 id="temp_f"></h1>
                        <p>This temperature reading is streamed from Raspberry Pi. It's updated every 10 seconds. Location 40100, Jyväskylä, Finland</p>
                        		</div>
	</div>
		</div>
 </div>	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
