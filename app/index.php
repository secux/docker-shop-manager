<?php

require_once("functions.php");

header('Content-type: text/html; charset=UTF-8');

// needs to be taken from http_host since server_name is not set here in the manager
// remove the manager port and pass it below using $_GET to the installation page
$srv = str_replace(":6080", "", $_SERVER['HTTP_HOST']);

echo "<html>

    <head><!-- Latest compiled and minified CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>

    <!-- Latest compiled and minified JavaScript -->
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>

    </head>

    <body>\n";

    echo "<div class='container-fluid'>\n";

if (($ver = $_GET['ver']) && ($srv = $_GET['srv'])) {

    echo "<div class='row'>\n";
    echo "<h1>Installation Version $ver</h1>\n";

    echo '<pre>';


    // Output of sub command called in scripts are not part of that :-(
    
    $proc = popen("/data/install.sh $ver $srv", 'r');
    while (!feof($proc))
    {
        echo fread($proc, 1024);
        @ flush();
    }

    echo '</pre>';

    echo '<h2>Installation finished! Open your webbrowser and have fun!</h2>';

    echo "</div>";

} else {

    echo "<div class='row'>\n";
    echo "<div class='col-xs-12'>\n";
    echo "<h1>Select version</h1>\n";
    echo "</div>";


    // run list
    $output = null;
    $output = null;

    exec("/data/list.sh", $output, $return);

    if (is_array($output)) {
        $tags = array_reverse($output);
        foreach ($tags as $tag) {
            $ver = cleanTag($tag);
            echo '<div class="col-xs-12 col-sm-6 col-md-3"><p><a class="btn btn-primary" href="index.php?ver='.$ver.'&srv='.$srv.'">Version '.$ver.'</a></p></div>';
        }
    } else {
        echo "Invalid list output";
    }

    echo "</div>";
}



    echo "</div>";
echo "</body></html>";