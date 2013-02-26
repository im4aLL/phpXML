<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file" />
    <button type="submit" name="submit">Read This XML Excel</button>
</form>
<?php
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
?>