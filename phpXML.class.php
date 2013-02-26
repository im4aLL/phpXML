<?php
/**
 * phpXML Class
 * ============ 
 * Export and import mysql data/array into XML (File format Microsoft Excel XML 2003)
 *
 * @author Habib Hadi (me[at]habibhadi.com)
 * @version 1.0
 * @copyright Habib Hadi (me[at]habibhadi.com)
 * @link http://habibhadi.com
 * @example check example files
 */
 
class phpXML{
	
	public $title;
	public $dataAry;
	public $DefaultColumnWidth;
	public $dateTimeZone;
	public $Author;
	public $lastAuthor;
	public $company;
	public $WindowHeight;
	public $WindowWidth;
	public $WindowTopX;
	public $WindowTopY;
	public $ProtectStructure;
	public $ProtectWindows;
	public $FontName;
	public $FontSize;
	public $FontColor;
	public $HeaderBackColor;
	public $HeaderFont;
	public $HeaderFontColor;
	public $HeaderFontWeight;
	
	public $xmlData;
	
	public $xmlFilePath;
	public $xmlFileName;
	public $xmlFileUploadType;		// fly|local
	public $xmlObject;
	
	/**
	 * @Initialization Function
	 *
	 * @title - (STRING) sheet title
	 * @dataAry - (ARRAY) mysql data array
	 * @DefaultColumnWidth - (INT) 
	 * @dateTimeZone - (STRING) - Ex: http://php.net/manual/en/timezones.php and date_default_timezone_set('America/Los_Angeles');
	 * @Author - (STRING) 
	 * @lastAuthor - (STRING)
	 * @company - (STRING)
	 * @WindowHeight - (INT)
	 * @WindowWidth - (INT) 
	 * @WindowTopX - (INT)
	 * @WindowTopY - (INT)
	 * @ProtectStructure - (BOOLEAN) (True) (False)
	 * @ProtectWindows - (BOOLEAN) (True) (False)
	 * @FontName - (STRING)
	 * @FontSize - (INT)
	 * @FontColor - (COLOR HEX CODE) Ex: #000000
	 * @HeaderBackColor - (COLOR HEX CODE) Ex: #000000
	 * @HeaderFont - (STRING)
	 * @HeaderFontColor - (COLOR HEX CODE) Ex: #000000
	 * @HeaderFontWeight - (BOOLEAN) (0) (1) (1=bold)
	 */
	
	public function __construct(
									$title					='phpXML Class',
									$dataAry				=array(),
									$DefaultColumnWidth		=100,
									$dateTimeZone			='Asia/Dhaka',
									$Author					='Habib Hadi',
									$lastAuthor				='Habib Hadi',
									$company				='me[at]habibhadi.com',
									$WindowHeight			='7995',
									$WindowWidth			='18195',
									$WindowTopX				='240',
									$WindowTopY				='45',
									$ProtectStructure		='False',
									$ProtectWindows			='False',
									$FontName				='Arial',
									$FontSize				=9,
									$FontColor				='#000000',
									$HeaderBackColor		='#F2F2F2',
									$HeaderFont				='Arial',
									$HeaderFontColor		='#777777',
									$HeaderFontWeight		=1,
									$xmlFilePath			='./'
								)
	{
		$this->title 				= $title;
		$this->dataAry 				= $dataAry;
		$this->DefaultColumnWidth 	= $DefaultColumnWidth;
		$this->dateTimeZone 		= $dateTimeZone;
		$this->Author 				= $Author;
		$this->lastAuthor 			= $lastAuthor;
		$this->company 				= $company;
		$this->WindowHeight 		= $WindowHeight;
		$this->WindowWidth 			= $WindowWidth;
		$this->WindowTopX 			= $WindowTopX;
		$this->WindowTopY 			= $WindowTopY;
		$this->ProtectStructure 	= $ProtectStructure;
		$this->ProtectWindows 		= $ProtectWindows;
		$this->FontName 			= $FontName;
		$this->FontSize 			= $FontSize;
		$this->FontColor 			= $FontColor;
		$this->HeaderBackColor 		= $HeaderBackColor;
		$this->HeaderFont 			= $HeaderFont;
		$this->HeaderFontColor 		= $HeaderFontColor;
		$this->HeaderFontWeight 	= $HeaderFontWeight;	
		$this->xmlFilePath			= $xmlFilePath;
	}
	
	
	/**
	 * @Generate XML using @dataAry
	 *
	 * @return NULL
	 */
	public function generateXML(){
		
		date_default_timezone_set($this->dateTimeZone);
		
		// HEADER
		$this->xmlData  = '<?xml version="1.0"?>';
		
		// MICROSOFT EXCEL HEADER
		$this->xmlData .= '<?mso-application progid="Excel.Sheet"?>';
		$this->xmlData .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
		 xmlns:o="urn:schemas-microsoft-com:office:office"
		 xmlns:x="urn:schemas-microsoft-com:office:excel"
		 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
		 xmlns:html="http://www.w3.org/TR/REC-html40">';
		 
		// AUTHOR INFO
		$this->xmlData .= '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
		  <Author>'.$this->Author.'</Author>
		  <LastAuthor>'.$this->lastAuthor.'</LastAuthor>
		  <Created>'.date('Y-m-d').'T'.date('H:m:s').'Z</Created>
		  <Company>'.$this->company.'</Company>
		  <Version>14.00</Version>
		 </DocumentProperties>';
		 
		// OTHER INFO
		$this->xmlData .= '<OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
		  <AllowPNG/>
		 </OfficeDocumentSettings>';
		
		// DOCUMENT INFO
		$this->xmlData .= '<ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
		  <WindowHeight>'.$this->WindowHeight.'</WindowHeight>
		  <WindowWidth>'.$this->WindowWidth.'</WindowWidth>
		  <WindowTopX>'.$this->WindowTopX.'</WindowTopX>
		  <WindowTopY>'.$this->WindowTopY.'</WindowTopY>
		  <ProtectStructure>'.$this->ProtectStructure.'</ProtectStructure>
		  <ProtectWindows>'.$this->ProtectWindows .'</ProtectWindows>
		 </ExcelWorkbook>';
		
		// STYLE INFO
		$this->xmlData .= '<Styles>
		  <Style ss:ID="Default" ss:Name="Normal">
		   <Alignment ss:Vertical="Bottom"/>
		   <Borders/>
		   <Font ss:FontName="'.$this->FontName.'" x:Family="Swiss" ss:Size="'.$this->FontSize.'" ss:Color="'.$this->FontColor.'"/>
		   <Interior/>
		   <NumberFormat/>
		   <Protection/>
		  </Style>
		  <Style ss:ID="s106">
		   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
		   <Borders/>
		   <Font ss:FontName="'.$this->HeaderFont.'" x:Family="Swiss" ss:Color="'.$this->HeaderBackColor.'" ss:Bold="'.$this->HeaderFontWeight.'"/>
		   <Interior ss:Color="'.$this->HeaderFontColor.'" ss:Pattern="Solid"/>
		  </Style>
		 </Styles>';
		 
		// XML DATA HEADER
		$this->xmlData .= '<Worksheet ss:Name="'.$this->title.'">
		  <Table ss:ExpandedColumnCount="'.count($this->dataAry[0]).'" ss:ExpandedRowCount="'.(count($this->dataAry) + 1).'" x:FullColumns="1"
		   x:FullRows="1" ss:DefaultColumnWidth="'.$this->DefaultColumnWidth.'" ss:DefaultRowHeight="15">';
		   
		// XML DATA ROW HEADER
		$this->xmlData .=  '<Row ss:AutoFitHeight="0">';
		foreach($this->dataAry[0] as $headerKey=>$headerVal){
			$this->xmlData .= '<Cell ss:StyleID="s106"><Data ss:Type="String">'.ucwords($headerKey).'</Data></Cell>';	
		}
		$this->xmlData .= '</Row>';
		
		// XML DATABASE DATA
		foreach($this->dataAry as $rows){
			$this->xmlData .= '<Row ss:AutoFitHeight="0">';
			foreach($rows as $values){
				$this->xmlData .= '<Cell><Data ss:Type="'.((is_numeric($values))?'Number':'String').'">'.$values.'</Data></Cell>';	
			}
			$this->xmlData .= '</Row>';
		}
		
		$this->xmlData .= '</Table>';
		
		// XML SHEET FOOTER
		$this->xmlData .= '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
		   <PageSetup>
			<Header x:Margin="0.3"/>
			<Footer x:Margin="0.3"/>
			<PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
		   </PageSetup>
		   <Unsynced/>
		   <Print>
			<ValidPrinterInfo/>
			<HorizontalResolution>600</HorizontalResolution>
			<VerticalResolution>600</VerticalResolution>
		   </Print>
		   <Selected/>
		   <ProtectObjects>False</ProtectObjects>
		   <ProtectScenarios>False</ProtectScenarios>
		  </WorksheetOptions>
		 </Worksheet>
		</Workbook>';
	
	}
	
	/**
	 * @GETTING ALL XML DATA AT ONCE
	 *
	 * @RETURN XML STRING
	 */
	public function getXML(){
		return $this->xmlData;
	}
	
	
	/**
	 * @READ XML FUNCTION
	 * 
	 * @REQUIRE FILE NAME AND PATH
	 * @RETURN NULL
	 */
	public function readXML(){
		
		/**
		 * @LOCAL FILE
		 */
		 
		// checking whether file is local or not and file name
		if($this->xmlFileUploadType=='local' && $this->xmlFileName!=NULL){
			
			// checking whether file exists
			if(file_exists($this->xmlFilePath.$this->xmlFileName)){
				
				// checking file extention
				if($this->get_file_extension($this->xmlFileName)=='xml'){
					$xmlFile = file_get_contents($this->xmlFilePath.$this->xmlFileName);
					
					// transfering XML string to private function loadXML
					$this->loadXML($xmlFile);
				}
			}
		}
		
		/**
		 * @INPUT TYPE FILE
		 */
		 
		// checking whether file is fly or not and file name
		elseif($this->xmlFileUploadType=='fly' && $this->xmlFileName['name']!=NULL){
			
			// checking file extension and its type and contains any error or not
			if($this->get_file_extension($this->xmlFileName['name'])=='xml' && $this->xmlFileName['type'] == 'text/xml' && $this->xmlFileName['error'] == 0){
				$xmlFile = file_get_contents($this->xmlFileName['tmp_name']);
				
				// transfering XML string to private function loadXML
				$this->loadXML($xmlFile);
			}
			
		}
		
	}
	
	/**
	 * @LOAD XML OBJECT
	 * 
	 * @RETURN NULL
	 */
	private function loadXML($xmlFile){
		
		//checking whether XML string is valid and contain XML excel header
		if($this->is_valid_xml($xmlFile) && strstr($xmlFile, '<?mso-application progid="Excel.Sheet"?>')){
						
			$xmlSheet = simplexml_load_string($xmlFile);
			$workSheet = $xmlSheet->Worksheet->Table;
			
			//convert xml object to stdClass object 
			$workSheetMO = json_decode( json_encode($workSheet));
			
			//just taking cell value array
			$this->xmlObject = $workSheetMO->Row;
				
		}	
	}
	
	
	/**
	 * @GETIING XML OBJECT
	 * 
	 * @RETURN OBJECT
	 */
	public function getXMLObject(){
		
		// if xmlObject is null returning null object
		if($this->xmlObject==NULL){
			$this->xmlObject = new stdClass();
		}
		return $this->xmlObject;	
	}
	
	/**
	 * @VALIDATEING XML FILE USING DOM XML
	 *
	 * You can use any other function to validate, i used simple one
	 * @RETURN BOOLEAN
	 */
	public function is_valid_xml ( $xmlString ) {
		libxml_use_internal_errors( true );
		
		$doc = new DOMDocument('1.0', 'utf-8');
		$doc->loadXML( $xmlString );
		$errors = libxml_get_errors();
	
		return empty($errors);
	}
	
	/**
	 * @MINIMAL CHECK FOR XML EXTENSION
	 *
	 * You can use any other function to validate, i used simple one
	 * @RETURN FILE EXTENSION
	 */
	public function get_file_extension($file_name) {
	  return strtolower(substr(strrchr($file_name,'.'),1));
	}
		
}
?>