<h1>Hello world!</h1>
<p>This is a Docker test application for a PHP website with database connection.</p>

<?php
// Create connection
$mysqli = new mysqli('db', 'root', 'example');

/* close connection */
$mysqli->close();
?>

<ul>
<li>PHP version: <?=phpversion();?></li>
<li>Database connection: <?=mysqli_connect_errno() ? 'failed' : 'succeeded';?></li>
</ul>