<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kolbrich
 * Date: 30.07.2013
 * Time: 13:45
 */

$file = dirname(__file__)."/../../../composer/autoload_namespaces.php";
$backupfile = dirname(__file__)."/../../../composer/autoload_namespaces.php.bak";

if (!copy($file, $backupfile)) {
    echo "copy $file schlug fehl...\n";
}

$handle_open = fopen($backupfile, "r");
$handle_write = fopen($file, "w");

$tmp_noWrite = false;

$eofPattern = '/^\)\;/';

$externals = scandir('vendor/externals');
$externals_namespaces = array(array());
$externals_namespaces_counter = 0;
// $externals_namespaces[0]['path']
// $externals_namespaces[0]['namespace']
// $externals_namespaces[1]['path']
// $externals_namespaces[1]['namespace']


foreach ($externals as $datei) { // Ausgabeschleife
    if (!($datei == '.' || $datei == '..' || $datei == '...' || $datei == '.svn')) {
        $path = "externals/" . $datei;
        $filename = dirname(__file__)."/../../../" . $path . "/external.json";
        if (file_exists($filename)) {
            $json = file_get_contents($filename);
            $json = utf8_encode($json);
            $json_results = json_decode($json, true);
            $externals_namespaces[$externals_namespaces_counter]['path'] = $path;
            $externals_namespaces[$externals_namespaces_counter]['namespace'] = $json_results['namespace'];
            $externals_namespaces[$externals_namespaces_counter]['written'] = false;
            $externals_namespaces_counter++;
        } else {
            echo "Die Datei $filename existiert nicht für External $datei\r\n";
        }
    }
};

while (!feof($handle_open)) {
    $row = fgets($handle_open);

    foreach ($externals_namespaces as $external) {
        $tmp_regex = "/'".$external['namespace'].'\\\\\\\\\'/';
        if (preg_match($tmp_regex, $row)) {
            $tmp_noWrite = true;
        }
    }

    if (preg_match($eofPattern, $row)) {
        foreach ($externals_namespaces as $external) {
            $newRow = "    '" . $external['namespace'] . "\\\' => array(\$vendorDir . '/" . $external['path'] . "'),\r\n";
            fwrite($handle_write, $newRow);
        }
		fwrite($handle_write, $row);
    }
    if ($tmp_noWrite == false)
    {
        fwrite($handle_write, $row);
    }else{
        $tmp_noWrite = true;
    }

}

echo "Externals added!\r\n";
fclose($handle_open);