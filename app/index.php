<?php

echo "<html><body>\n";


if ($ver = $_GET['ver']) {

    echo "<h1>Installation Version $ver</h1>\n";

    //passthru("/data/install.sh $ver"); # no stream, just one output at the end :-(

    while (@ ob_end_flush()); // end all output buffers if any

    $proc = popen("/data/install.sh $ver", 'r');
    echo '<pre>';
    while (!feof($proc))
    {
        echo fread($proc, 1024);
        @ flush();
    }
    echo '</pre>';

    echo '<h2>Installation finished! Open your webbrowser and have fun!</h2>';


} else {
    // run list
    $output = null;
    $output = null;

    exec("/data/list.sh", $output, $return);

    var_dump($output);

    if (is_array($output)) {
        echo "<ul>";

        foreach ($output as $ver) {
            echo '<a href="index.php?ver='.$ver.'">Version '.$ver.'</a>';
        }

        echo "</ul>";
    } else {
        echo "Invalid list output";
    }
}



echo "</body></html>";