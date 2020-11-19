<?php

require './vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load('.env');

$dbUrl = $_ENV['DATABASE_URL'];

/**
 * Restoring backup
 */
$dbUrl = explode('/', $dbUrl);
$serverInfos = explode('@', $dbUrl[2]);

$server_name   = $serverInfos[1];
$username      = explode(':', $serverInfos[0])[0];
//$password      = explode(':', $serverInfos[0])[1];
$password = '';
$database_name = explode('?', $dbUrl[3])[0];

$backupFile  = "./releaseBackup/snowtricks.sql";

$cmd = "mysql -h {$server_name} -u {$username} -p{$password} {$database_name} < $backupFile";

var_dump($cmd);

exec($cmd);

echo "------------------------------------";
echo "\n" . "Fin de la copie de la base de données :)" . "\n";
echo "------------------------------------" . "\n" ;

/**
 * Pictures Copy
 */

$origin = "./releaseBackup/pictures/";
$destination = "./public/pictures/";

recursiveDelete($destination);
copyDir($origin, $destination);

echo "------------------------------------";
echo "\n" . "Fin de la copie de images des tricks :)"  . "\n";
echo "------------------------------------" . "\n";

function recursiveDelete($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? recursiveDelete("$dir/$file") : unlink("$dir/$file");
    }

    return rmdir($dir);
}

function copyDir($origin , $destination){
    $dossier = opendir($origin);

    mkdir($destination, fileperms($origin));
    $total = 0;

    while ($fichier = readdir($dossier)) {
        $l = array('.', '..');
        if (!in_array( $fichier, $l)){
            if (is_dir($origin."/".$fichier)){
                $total += copydir("$origin/$fichier", "$destination/$fichier");
            } else {
                if ( $fichier === "release.gitignore") {
                    $newName = substr($fichier, 7);
                    copy("$origin/$fichier", "$destination/$newName");
                    $total++;
                } else {
                    copy("$origin/$fichier", "$destination/$fichier");
                    $total++;
                }
            }
        }
    }
    return $total;
}