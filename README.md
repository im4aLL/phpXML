phpXML
======

Export and import mysql data/array into XML (File format Microsoft Excel XML 2003)


Export
======
<pre>
mysql_connect("localhost","root","");
mysql_select_db("cdcol");

$query = mysql_query("SELECT * FROM cds");
while($row = mysql_fetch_assoc($query)){
	$data[] = $row;
}

header( "content-type: text/xml" );

require_once('phpXML.class.php');
$XML = new phpXML();
$XML->dataAry = $data;
$XML->generateXML();
echo $XML->getXML();
</pre>
