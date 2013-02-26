<?php
require_once('phpXML.class.php');

$XML = new phpXML();
$XML->xmlFileName = '1.xml';
$XML->xmlFilePath = './';
$XML->xmlFileUploadType = 'local';
$XML->readXML();

echo '<pre>';
print_r($XML->getXMLObject());
echo '</pre>';
?>