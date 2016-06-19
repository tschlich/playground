<?php 
$websFoldername = 'www';
$webs = findWebs( $websFoldername ); 
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Vaprobash Test Suite</title>
    <link rel="stylesheet" href="www/frontend/htdocs/assets/css/mad.dev.css">
  </head>

  <body>

    <div class="container" id="wrapper">
      <header>
        <h1>Vaprobash Playground</h1>
        <h2>on <?php echo $_SERVER['SERVER_ADDR']; ?></h2>
      </header>

      <article>
        <?php
        if( count( $webs ) === 0 ) {
            echo "<p>no webs found!</p>\r\n";
        } else {
            foreach( $webs AS $i => $name ) {
                $address = $name . '.' . $_SERVER['SERVER_ADDR'] . '.xip.io';
                $aTag = '<a href="http://' . $address . '">' . $address . '</a>';
                echo "<p style=\"text-align: center\">$aTag</p>\r\n";
            }
        }
        ?>
      </article>
      <footer><a href="http://www.mad-world.de">2016 mad-world.de</a></footer>
    </div><!-- /#wrapper -->
  </body>
</html>

<?php

/**
 * return a list of found web projects
 */
function findWebs($folder) {
    $webs = array();
    if (is_dir($folder) && $handle = opendir($folder)) {
        while ( false !== ($entry = readdir($handle)) ) {
            $filepath = $folder.'/'.$entry;
            if ( is_dir( $filepath ) && $entry != "." && $entry != "..") {
                $webs[] = $entry;
            }
        }
        closedir($handle);
    }
    return $webs;
}

?>
