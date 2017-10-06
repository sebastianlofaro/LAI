<?php
ini_set( "display_errors", true );
date_default_timezone_set( "America/Chicago" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=lai" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "root" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "password" );
require( CLASS_PATH . "/Article.php" );
require( CLASS_PATH . "/Subcategory.php" );
require( CLASS_PATH . "/Client.php" );

function handleException( $exception ) {
  echo $exception;
  error_log( $exception->getMessage() );
}

set_exception_handler( 'handleException' );
?>
