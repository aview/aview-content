<html><head></head><body><?phpinclude '../../../_logger.php';function ispringconversion_handler($file_path,$file_name){logit("iSPringHandler.php","Welcome To iSpring");	$file_path=str_replace('../../',"",$file_path);		$swffile_folder = realpath(".././".$file_path ).'\_isp__'.$file_name;	logit("iSPringHandler.php","File Path is".$file_path );	logit("iSPringHandler.php","File Name is ".$file_name );	logit("iSPringHandler.php","SWF Folder Path  is ".$swffile_folder );	$swf_file = $file_name.'.swf';	try {	$isprComobj = new COM("iSpring.PresentationConverter");		logit("iSPringHandler.php","SWFFF COM");	$listener =& new CEventListener($file_name,realpath( ".././".$file_path));	com_event_sink($isprComobj, $listener, "_iSpringEvents");  	}	catch(Exception $e)	{				echo $e;	}		//echo "Opening presentation\n";    $isprComobj->Settings->Playback->Player->CorePlugins->AddBuiltInPlugin(1);    $isprComobj->Settings->Navigation->KeyboardEnabled = false;    $isprComobj->Settings->Navigation->AdvanceOnMouseClick = false;	try {	$isprComobj->OpenPresentation(realpath(".././".$file_path."/@@-OriginalDocs-@@/".$file_name));	}	catch(Exception $e)	{					echo $e;	}	try {	//$isprComobj->Presentation->Slides->SaveThumbnails($thum_folder ."/".$file_name.'_files',"thumbnail_",2,140,140,90);	}	catch(Exception $e)	{			//echo $e;	}		try {	$isprComobj->GenerateFlash($swffile_folder,$swf_file,0,"");	}	catch(Exception $e)	{				echo $e;	}	$isprComobj = null;	$thumbname = str_replace(".","_",$file_name);	}class CEventListener{    var $file_name='';	var $org_file_path='';	function __construct($file,$filepath) 	{ 		  $this->file_name=$file; 		  $this->org_file_path=$filepath;	}     function OnStartConversion($mode)    {		    		    }    function OnStartCollectingData()    {            }    function OnFinishCollectingData()    {           }    function OnStartProcessingData()    {         $file=$this->org_file_path."/Log".$this->file_name.".txt";	     $ourFileHandle = fopen($file, 'w') or die("can't open file");         fclose($ourFileHandle);        }    function OnFinishProcessingData()    {        $file=$this->org_file_path."/Log".$this->file_name.".txt";		$str= "Finished processing data\n";	    file_put_contents($file, $str."\n", FILE_APPEND);    }    function OnStartSwfWriting($filePath)    {       $file=$this->org_file_path."/Log".$this->file_name.".txt";		$str= "started swf file writing\n";	    file_put_contents($file, $str."\n", FILE_APPEND);    }    function OnFinishSwfWriting()    {                $file=$this->org_file_path."/Log".$this->file_name.".txt";		$str= "Finished swf file writing\n";	    file_put_contents($file, $str."\n", FILE_APPEND);    }    function OnSlideProgressChanged($slideIndex, $totalSlides)    {            }}?></body></html>