<?php
mysql_connect("localhost","root","");
mysql_select_db("cdcol");

$query = mysql_query("SELECT * FROM cds");
while($row = mysql_fetch_assoc($query)){
	$data[] = $row;
}


// USE THIS LINE FOR VIEW ONLY OR IE DOWNLOAD
header( "content-type: text/xml" );

// USE THIS TWO LINE FOR FORCE DOWNLOAD
//header('Content-disposition: attachment; filename="newfile.xml"');
//header('Content-type: "text/xml"; charset="utf8"');

require_once('phpXML.class.php');
$XML = new phpXML();
$XML->dataAry = $data;
$XML->generateXML();
echo $XML->getXML();
?>