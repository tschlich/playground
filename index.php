<?php 
$websFoldername = 'www';
$webs = findWebs( $websFoldername ); 
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Vaprobash Test Suite</title>
    <style>
      *, html, body {
        font-family: Courier New, Courier, monospace;
        font-size: 14px;
        font-weight: bold;
        line-height: 18px;
      }

      html, body {
        margin: 0;
        padding: 0;
      }

      html, body, div.wrapper {
        height: 100%;
      }

      body {
        color: #090;
        background: #010;
        -webkit-font-smoothing: antialiased;
      }

      h1 {
        font-size: 2rem;
        line-height: 2.4rem;
      }
      h2 {
        font-size: 1.6rem;
        line-height: 2rem;
      }
      h3 {
        font-size: 1.4rem;
        line-height: 1.8rem;
      }

      div.wrapper {
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
        margin: 0 auto;
        padding: 3rem 0;
        width: 99%;
        max-width: 600px;
        background: rgba(0,0,0,0.5);
        border: 1px black solid;
        border-top-width: 0;
        border-bottom-width: 0;
      }

      header,
      article {
        margin: 0 2rem;
      }

      header {
        border-bottom: 1px #090 solid;

      }
      header h1 {
        color: #0F0;
        margin: 0;
      }

      a {
        color: #090;
        padding: 0 0.3rem ;
        position: relative;
      }

     a:hover {
        background: #0f0;
        color: #111;
        text-decoration: none;
      }
    </style>
  </head>

  <body>

    <div class="wrapper">
      <header>
        <h1>Vaprobash Test Suite</h1>
        <h2>on <?php echo $_SERVER['SERVER_ADDR']; ?></h2>
      </header>

      <article>
        <ul>
        <?php
        if( count( $webs ) === 0 ) {
            echo "<p>no webs found!</p>\r\n";
        } else {
            foreach( $webs AS $i => $name ) {
                $address = $name . '.' . $_SERVER['SERVER_ADDR'] . '.xip.io';
                $aTag = '<a href="http://' . $address . '">' . $address . '</a>';
                echo "<li>$aTag</li>\r\n";
            }
        }
        ?>
        </ul>
      </article>
    </div><!-- /.wrapper -->
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
