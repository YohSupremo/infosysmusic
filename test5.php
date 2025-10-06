<?php
 session_start();
 ?>
 <!DOCTYPE html PUBLIC
:   "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html>
 <head>
 <title>Listing 20.5 Accessing Session Elements</title>
 </head>
 <body>
 <div>
 <h1>A Content Page</h1>
 <?php
 if ( is_array( $_SESSION['products'] ) ) {
   print "<b>Your cart:</b><ol>\n";
   foreach ( $_SESSION['products'] as $p ) {
     print "<li>$p</li>";
   }
   print "</ol>";
 }
 ?>
 <a href="test4.php">Back to product choice page</a>
 </div>
 </body>
 </html>