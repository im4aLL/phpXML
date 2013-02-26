phpXML
======

Export and import mysql data/array into XML (File format Microsoft Excel XML 2003)


<h3>Export</h3>

=======
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


<h3>Enable download</h3>

<p>Add this two line instead of <pre>header( "content-type: text/xml" );</pre></p>

<pre>
header('Content-disposition: attachment; filename="newfile.xml"');
header('Content-type: "text/xml"; charset="utf8"');
</pre>


<h3>Local XML EXCEL reading</h3>

<pre>
require_once('phpXML.class.php');

$XML = new phpXML();
$XML->xmlFileName = '1.xml';
$XML->xmlFilePath = './';
$XML->xmlFileUploadType = 'local';
$XML->readXML();

echo '<pre>';
print_r($XML->getXMLObject());
echo '</pre>';
</pre>


<h3>Read uploaded XML</h3>

<pre>
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file" />
    <button type="submit" name="submit">Read This XML Excel</button>
</form>

echo '<pre>';
print_r($_FILES);
echo '</pre>';

echo '<hr>';

if(isset($_POST['submit']) && isset($_FILES['file']['name'])!=NULL){
	
	require_once('phpXML.class.php');
	
	$XML = new phpXML();
	$XML->xmlFileUploadType = 'fly';
	$XML->xmlFileName = $_FILES['file'];
	$XML->readXML();
	echo '<pre>';
	print_r($XML->getXMLObject());
	echo '</pre>';
	
}
</pre>
=======
