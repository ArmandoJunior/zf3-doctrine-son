<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 30/12/2018
 * Time: 17:43
 */

$db = new PDO('sqlite:' . realpath(__DIR__) . '/blog.db');
$fh = fopen(__DIR__ . '/schema.sql', 'r');
while ($line = fread($fh, 4096)) {
    $db->exec($line);
}
fclose($fh);