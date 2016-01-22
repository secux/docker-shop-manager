<?php

header('Content-type: text/html; charset=UTF-8');


echo "<html><body>\n";


if ($ver = $_GET['ver']) {

    echo "<h1>Installation Version $ver</h1>\n";

    echo '<pre>';


    // Output of sub command called in scripts are not part of that :-(
    
    $proc = popen("/data/install.sh $ver", 'r');
    while (!feof($proc))
    {
        echo fread($proc, 1024);
        @ flush();
    }

    echo '</pre>';

    echo '<h2>Installation finished! Open your webbrowser and have fun!</h2>';


} else {

    echo "<h1>Select version</h1>\n";

    // run list
    $output = null;
    $output = null;

    exec("/data/list.sh", $output, $return);

    if (is_array($output)) {
        foreach ($output as $ver) {
            echo '<p><a href="index.php?ver='.$ver.'">Version '.$ver.'</a></p>';
        }
    } else {
        echo "Invalid list output";
    }
}



echo "</body></html>";