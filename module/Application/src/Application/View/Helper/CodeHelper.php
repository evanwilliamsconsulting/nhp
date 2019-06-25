<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\PictureService as PictureService;  
 
class CodeHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected static $state;
    protected $fileid;
    protected $codeObject;
    protected $code;
    protected $language;
    protected $title;
    protected $username;
    protected $id;
    protected $first_line;
    protected $last_line;
    protected $fileContents;
    protected $fileArray;
    protected $origArray;
    protected $styleArray;
    protected $styleOrig;
    protected $noCommentsArray;
    

    /** 
     * Set the service locator. 
     * 
     * @ param ServiceLocatorInterface $serviceLocator 
     * @ return CustomHelper 
     */ 
    public function __construct()
    {
    }
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)  
    {  
        $this->serviceLocator = $serviceLocator;  
        return $this;  
    } 
    /** 
     * Get the service locator. 
     * 
     * @ return \Zend\ServiceManager\ServiceLocatorInterface 
     */  
    public function getServiceLocator()  
    {  
        return $this->serviceLocator;  
    }  
    public function setViewModel(ViewModel $viewmodel)
    {
        $this->viewmodel = $viewmodel;
    }
    public function getViewModel()
    {
        return $this->viewmodel;
    }
    public function setCodeObject($codeObject)
    {
        $this->codeObject = $codeObject;
        $this->first_line = $codeObject->getFirstLine();
        $this->last_line = $codeObject->getLastLine();
        $this->title = $codeObject->getTitle();
        $this->code = $codeObject->getCode();
        $this->language = $codeObject->getLanguage();
        $username = $this->getUsername();


	$webRoot = "https://www.evtechnote.us/";
	$fileDirectory = "filestore/Arduino/Blink/";
	$fileRelative = "/usr/local/apache2/htdocs/evtechnote/public/" . $fileDirectory . "Blink.ino";

	$this->fileContents = file_get_contents($fileRelative);

	$fileContents = $this->fileContents;

	$charptr = 0;
	$someString = "";
	$someChar = "";
	$fileArray = explode("\r\n",$fileContents);
	$this->origArray = $fileArray;


	// Highlight Comments in Orange

	$arrayLength =count($fileArray);

	$styleArray = array_fill(0,$arrayLength,'color:black;');
	$this->styleOrig = $styleArray;

	$i = 0;

	while ($i<$arrayLength)
	{
		$fileLine = $fileArray[$i];
		$styleArray[$i] = 'color:black;';
		// Test to see if $fileLine contains //
		if (0 != ($pos = strpos($fileLine,"//")))
		{
			// Insert a line into the array
			

			$firstPartOfLine = substr($fileLine,1,$pos-1);
			$secondPartOfLine = substr($fileLine,$pos);
			$insertLine1 = $firstPartOfLine;
			$insertLine2 = $secondPartOfLine . "<br/>";

			$insertLine = $fileLine;
			$insertArray = Array();
			$insertArray2 = Array();
			$insertArray[] = $insertLine1;
			$insertArray2[] = $insertLine2;
			$arrayLength++;
			$arrayLength++;
			$firstArray = array_slice($fileArray,0,$i-1,true);
			$secondArray = array_slice($fileArray,$i,$arrayLength - $i-1,true);
			$fileArray = array_merge($firstArray,$insertArray,$insertArray2,$secondArray);
			$firstArray = array_slice($styleArray,0,$i-1,true);
			$secondArray = array_slice($styleArray,$i,$arrayLength - $i+1, true);
			$insertArray3[] = 'color:black;';	
			$insertArray4[] = 'color:orange;';	
			$styleArray = array_merge($firstArray,$insertArray3,$insertArray4,$secondArray);
			$styleArray[$i] = 'color:orange;';
			$i++;

			$styleArray[$i] = 'color:black;';
			$i++;

		}
		else
		{
			$fileLine .= "<br/>";
			$fileArray[$i] = $fileLine;
			$styleArray[$i] = 'color:black;';
			$i++;
		}
	}

/*
	$length = count($fileArray);
	$this->fileArray = array();
	for ($i=0;$i<$length;$i++)
	{
		$someChar = $fileArray[$i];
		if ($someChar == '\n')
		{
			$this->fileArray[] = $someString;
			$someString = "";
		}
		else
		{
			$someString .= $someChar;
		}
	}
*/
/* good enough, anyway! */
	$this->fileArray = $fileArray;
	$this->styleArray = $styleArray;
/* Now loop through the fileArray and remove the comments! */
	$j = 0;
	$noComment = array();
	for ($i = 0;$i < $arrayLength; $i++)
        {
		$style = $styleArray[$i];
		if (0==(strcmp($style,'color:black;')))
		{
			$noComment[] = $fileArray[$i];	
		}
        }
	$this->noCommentsArray = $noComment;
	/* good enough! I guess you could call this approximate coding */
	/* now let's move on to syntax highlighting!! */
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
    }
    public function getRenderer()
    {
        return $this->renderer;
    }
    public function __invoke()
    {
        $viewRender = $this->getServiceLocator()->get('ViewRenderer');
    	
    	$view = $this->getViewModel();
		
	$view->bcolor = "#ffffff";
	$view->language = $this->language;
	$view->title = $this->title;
	$view->fileArray = $this->fileArray;
	$view->styleArray = $this->styleArray;
	$view->noCommentsArray = $this->noCommentsArray;

	$view->setTemplate('items/codesample.phtml');
		
	return $viewRender->render($view);
    }
}
