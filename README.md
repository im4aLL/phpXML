phpXML
======

Export and import mysql data/array into XML (File format Microsoft Excel XML 2003)


<h3>Export</h3>

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

<p>Add this two line </p>
<pre>
header('Content-disposition: attachment; filename="newfile.xml"');
header('Content-type: "text/xml"; charset="utf8"');
</pre>

<p>instead of <pre>header( "content-type: text/xml" );</pre></p>

<h3>Local XML EXCEL reading</h3>

<pre>
require_once('phpXML.class.php');

$XML = new phpXML();
$XML->xmlFileName = '1.xml';
$XML->xmlFilePath = './';
$XML->xmlFileUploadType = 'local';
$XML->readXML();

print_r($XML->getXMLObject());
</pre>


<h3>Read uploaded XML</h3>

<pre>
&lt;form action=&quot;&quot; method=&quot;post&quot; enctype=&quot;multipart/form-data&quot;&gt;
	&lt;input type=&quot;file&quot; name=&quot;file&quot; /&gt;
    &lt;button type=&quot;submit&quot; name=&quot;submit&quot;&gt;Read This XML Excel&lt;/button&gt;
&lt;/form&gt;

print_r($_FILES);

if(isset($_POST['submit']) &amp;&amp; isset($_FILES['file']['name'])!=NULL){
	
	require_once('phpXML.class.php');
	
	$XML = new phpXML();
	$XML-&gt;xmlFileUploadType = 'fly';
	$XML-&gt;xmlFileName = $_FILES['file'];
	$XML-&gt;readXML();
	print_r($XML-&gt;getXMLObject());
	
}
</pre>
=======
