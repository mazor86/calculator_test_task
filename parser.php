<?php
require __DIR__ . '/vendor/autoload.php';
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Net\SFTP;


$user = 'rkornienko';
$host = 'spdev04.stratus.northernlight.com';
//$remoteDir = 'JANBE_HIVEFULL_HIVEFULL_2ML/';

$sshKeyFile = '/Users/rkornienko/.ssh/id_rsa';

$keyContents = file_get_contents($sshKeyFile);

if ($keyContents === false) {
    throw new Exception("Unable to read SSH key file: $sshKeyFile\n");
}

$key = PublicKeyLoader::load($keyContents, 'fktyrf06');

$sftp = new SFTP($host);
if (!$sftp->login($user, $key)) {
    throw new Exception("SFTP login failed\n");
}
var_dump('login');
exit;
if (!$sftp->chdir($remoteDir)) {
    throw new Exception("Unable to change directory to $remoteDir\n");
}

$sftp->setListOrder('mtime', SORT_DESC);
$ls = $sftp->nlist();
