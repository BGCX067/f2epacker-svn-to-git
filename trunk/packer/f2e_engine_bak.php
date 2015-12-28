<?php

require ('lib/minify.php');
/**
 * base_engine
 * 
 * @package f2epacker
 * @author tenero
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class f2e_engine {
    
    //�������ݵĴ洢
    private $resRule = array();
    
    private $UpdateTime ;
     
 
    //�Զ�������
    private $Idea= array(
        "Version"=>"",//��Դ�汾        
        "Compress"=>""//ѹ������
    );
    
    //��Դ��ȡ
    private $Resource = array (
        "Common"=>array(),//ȫ����Դ
        "Domain"=>array(),//Զ�̵��õ���Դ
        "Module"=>array(),//ģ����Դ
        "Page"=>array()//ҳ����Դ
    );
    
    //������洢
    public $Rule = array (
        "Common"=>array(),//ȫ����Դ
        "Domain"=>array(),//Զ�̵��õ���Դ
        "Module"=>array(),//ģ����Դ
        "Page"=>array()//ҳ����Դ
    );
    
    
    private $Site = array(
        "FileType" => "", //��ʽ������
        "HttpPath" => "", //http·��
        "Path" => "",    //����·��
        "Format"=> ""
    );
    
   	/**
	 * ���캯��
	 * 
	 * @return void
	 */
	public function f2e_engine($jsonFile){
	   $this->ConverJson2Rule($jsonFile);	   
	}  
    

    /**
	 * �����ļ��Ķ�ȡ ===============================================================================================
	 * 
	 * @param mixed $jsonFile ���ļ��ж��������String
	 * @return void
	 */
	public function ConverJson2Rule($jsonFile){
	 
		$this->UpdateTime = date("YmdHis");   	
	   	
		$this->resRule =  FromJson($jsonFile);
        
        $this->set_config();
        $this->set_resource();
        $this->set_site();
	
	}
    

    /**
     * ���ò��ԣ�ѹ������ ���²��� �汾��Ϣ
     *  
     * @return void
     */
    private function set_config(){
        foreach ($this->Idea as $k => $v) {            
            $this->Idea[$k]= $this->resRule->$k;           
        }
    }
    
    /**
     * �����ļ�����·����������
     *      
     * @return void
     */
    private function set_resource(){
         //��Դ����
        foreach($this->Resource as $k=>$v){
            $this->Resource[$k] = $this->resRule->$k;            
        } 
        
    }
    
    private function set_site(){
        
        foreach($this->Site as $k=>$v){
            $this->Site[$k] = $this->resRule->$k;            
        } 
        
        $strType = strtolower($this->Site["FileType"]);
        $strFormat ="";
        
        $this->Site["FileType"] = $strType;
		
		if($strType=="css"){						
			$strFormat = '<link type="text/css" href="%res_file%?'.$this->UpdateTime.'" rel="stylesheet" />';
				
		}elseif($strType=="js"){
			$strFormat ='<script type="text/javascript" src="%res_file%?'.$this->UpdateTime.'"> </script>';	
		}
        
        $this->Site["Format"] = htmlspecialchars($strFormat);
        
        
        
    }
    

    

  
 	/**
	 * ����������Դ�Ľ���ļ�
	 * 
	 * @return
	*/ 
	public function Release(){
		foreach($this->Resource["Page"] as $pTag => $pResource){
			$this->fillPage($pTag);
		}
		return $this->Rule;	
	}
    
    
    
    

    
    

	/**
	 * base_engine::fillPage()==========================================================================
	 * ��ʼ��ҳ����Դ 
	 * @param mixed $pageTag ҳ��tag
	 * @return
	 */
	public function fillPage($pageTag){
		$pageRule = $this->getRule("Page",$pageTag);
	
		if(!$pageRule){	
            //����ҳ�������ȡ��ҳ����Դ��Դ
         
            $pageArray = $this->getResouce("Page",$pageTag);
         
            
            $rtRes = array("common"=>"", "module"=>"", "page"=>"");
            
            
			//���ȫ��=====================================================
		
			$arrComm = 	$pageArray->C;
			if($arrComm){
				foreach($arrComm as $commName){  //�ж��common
					$rtRes["common"] .=$this->fillCommon($commName);
				}
			}
			
			
            
			//���ģ��=====================================================	
			$arrModule = $pageArray->M;		
			if($arrModule){	
				foreach($arrModule as $moduleName){ //���ģ��
					$rtRes["module"] .= $this->fillModule($moduleName);			
				}
			}
			//���ҳ��=====================================================
			$arrPage = 	$pageArray->P;
			if($arrPage){
				$rtRes["page"] = $this->fillResource($arrPage,$pageTag);
			}
			//������=====================================================	
			$arrDomain = $pageArray->D;
			if($arrDomain ){					
				foreach($arrDomain as $domainName){
					$rtRes["page"] .= $this->fillDomain($domainName);			
				}
			}
            //=================================================================
            $this->setRule("Page",$pageTag,$rtRes);
			return $rtRes;
            
        }else{
			return $pageRule;
		}
				
	}
    
    
    
      
   	/**	
	 * ��ʼ��ȫվʹ�õĹ�����Դ
	 * 
	 * @return void
	 */
	private function fillCommon($Name){
	   $commArray = $this->getRule("Common",$Name);
        //�ѽ�������Common��Դ�У��Ƿ����
		if(!$commArray){
			//�����ڣ������
			$res = $this->getResouce("Common",$Name);
            $retArray = $this->fillResource($res,$Name);            
            $this->setRule("Common",$Name,$retArray);             
			return $retArray;
			
		}else{
			return $commArray;
		}
		
	}
	/**
	 * ��ʼ��ģ����Դ
	 * 
	 * @param mixed $moduleName
	 * @return
	 */
	private function fillModule($Name){
		$module = $this->getRule("Module",$Name);
		if( !$module){
			$res = $this->getResouce("Module",$Name);
			$retRule = $this->fillResource($res, $Name);
		
			$this->setRule("Module",$Name,$retRule);
			return $retRule;	
		}else{
			return $module; 	
		}				
	}
	/**
	 * �������Դ����
	 * 
	 * @param mixed $resName 
	 * @return
	 */
	private function fillDomain($Name){
	   	$domain = $this->getRule("Domain",$Name);
		if( !$domain ){
        	$res= $this->getResouce("Domain",$Name);			    
			$retRule = $this->res_format2($res);
			$this->setRule("Domain",$Name,$retRule);
			
			return $retRule; 
		}else{
			return $domain;
		}		
	}
	
    
    
    
    
    
 /**
        ==== �ļ������������ ======================================================================================
   */ 
    /**	
	 * ���ݣ�����["product.css","search.css"]ת�����������õķ�ʽ�ַ���·��
	 * 
	 * @param mixed $arrRes ԭʼ������Դ����
	 * @param mixed $arrName ԭʼ������Դ����tag���ƣ�Ϊ�˷���ϲ��ļ���ʱ����֯���ƣ�
	 * @return ���ظ���Դ���������÷�ʽ
     * 
     * "Module":{ 
	 *      "module_one":["module/box.css","module/header.css","module/footer.css"],
     *	   "module_two":["module/list.css"]
     *}
     * �磺  
     * ["module/box.css","module/header.css","module/footer.css"] Ϊ $arrRes
     * mudule_oneΪ$arrName
     * 
     * 
	 */
	private function fillResource($arrRes,$arrName){
		
        $compessType = $this->Idea["Compress"];
        
		if($compessType==2){
		  
			return $this->CombinePlan($arrRes,$arrName);
            
		}elseif($compessType==3){
		  
			return $this->CombineCompressPlan($arrRes,$arrName);
                        
		}else{
			//$compessType==1
			return $this->SinglePlan($arrRes);
		}
	}
	/**
	 * 1 ֱ�����õ����ļ��������루<link/>��<script/>��
	 * 
	 * @return
	 */
	private function SinglePlan($arrRes){
		return $this->res_format($arrRes);
	}

	/**
	 * 2 ������Դ����ϲ�����ļ�Ϊһ���ļ�
	 * 
	 * @param mixed $arrRes ԭʼ��Դ��
	 * @param mixed $arrNameԭʼ��Դ������ 
	 * @return
	 */
	private function CombinePlan($arrRes,$arrName){
	   
		$combFilePath = $this->Combine($arrRes,$arrName);
		
        $ResArray = array($combFilePath);
		return $this->res_format($ResArray);
	}
	/**
	 * 3������2,���кϲ�����ļ�ѹ��
	 * 
	 * @param mixed $arrRes
	 * @param mixed $arrName
	 * @return
	 */
	private function CombineCompressPlan($arrRes,$arrName){
		//�ϲ�
		$strPackFileName = $this->Combine($arrRes,$arrName);		
		//ѹ��
		$strPackFileName = $this->Compress($strPackFileName);
        
		$ResArray =array($strPackFileName);
		return $this->res_format($ResArray);	
	}
    
    
    
    
	/////////////// ѹ�����ϲ�  ʵ�ֲ���/////////////////////////////////////
	/**
	 * ѹ���ļ����� file.pack.js���ļ��� ============================  ѹ���ľ���ʵ�ֲ��� ======================
     * �����ظ��ļ���·��
	 * 
	 * @param mixed $filePath  "sys/index.css"  
	 * @return �����ļ������·��
	 */
	private function Compress($sourceFile){
		
		
		$strArray 	= split("/",$sourceFile);//=sys/index.css
		$strTemp	= "release/".join("/", array_slice($strArray,1));  //release/index.css
		
		$from_Str 	= ".".$this->Site["FileType"];	//.css	
		$replace_Str 	= ".p.".$this->Site["FileType"]; //.p.css
				
		$packFilePath = str_replace($from_Str,$replace_Str,$strTemp);
		
		//���������������һ��·��ת��
		//sys/index.css	=>	release/index.css	=>	release/index.p.css
		
		$__sourceFile = $this->getPath($sourceFile);
		$__packFilePath = $this->getPath($packFilePath);
	
		
		//Begin:��ʼѹ��
		if($this->Site["FileType"]=="css"){		
			minify_css($__sourceFile,$__packFilePath);
			
		}else if($this->Site["FileType"]=="js"){
			minify_javascript($__sourceFile,$__packFilePath);
		}
        
        
		//End
		return $packFilePath;
	}
    




	/**
	 * �Ѷ���ļ��ϲ���һ���ļ�
	 * 
	 * @param mixed $filePathArray
	 * @param mixed $arrName Դ�ļ�·������
	 * @param mixed $pack
	 * @return �����ļ������·��
	 */
	private function Combine($filePathArray,$arrName){
		//ע�⵽������ļ�����
		//CSS:�ϲ�css���ͼƬ����·������
		$targetFilePath = "release/".$arrName.".c.".$this->Site["FileType"];        
       
        $sourceFilePathArray = array();        
        foreach($filePathArray as $perFile){          
            array_push($sourceFilePathArray,$this->getPath($perFile));
        }
    
        minify_combine($sourceFilePathArray,$this->getPath($targetFilePath));
        
		return $targetFilePath;
	}

	/**
	 * ��ʽ�����÷�ʽ  ============================================================================================
	 * 
	 * @param mixed $arrRes ����·���� ��  comm/comm.css,sys/hello.css
	 * @return
	 */
	private function res_format($arrRes){
		$rtString = "";		
		foreach($arrRes as $res){
			$strPath = $this->getHttpPath($res);
			$rtString .=  str_replace("%res_file%",$strPath,$this->Site["Format"]);				
		}
		return $rtString;
                
	}
    
  
    /**
     * ��ʽ�����÷�ʽ���������ã���Դ��http://·���Ѿ��Դ���
     * 
     * @param mixed $arrRes
     * @return
     */
    private function res_format2($arrRes){
   	    $rtString = "";		
		foreach($arrRes as $res){
		
			$rtString .=  str_replace("%res_file%",$res,$this->Site["Format"]);				
		}
		return $rtString;
    }
    
    /**
     * ��ȡ�ļ�������·��
     * 
     * @param mixed $filePath
     * @return
     */
    function getPath($filePath){
        return $this->Site["Path"].$filePath;
    }
    
      /**
     * ȡ���ļ���http����·��
     * 
     * @param mixed $filePath
     * @return
     */
    private function getHttpPath($filePath){
        return $this->Site["HttpPath"].$filePath;
    }
    
    
    
  	/**
     * 
     * 
     * @param mixed $PropName
     * @param mixed $tagetTag
     * @return
     */
    function getRule($PropName,$tagetTag){
    	return $this->Rule[$PropName][$tagetTag];
    }
    function setRule($PropName,$tagetTag,$tagetTagValue){
    	$this->Rule[$PropName][$tagetTag] = $tagetTagValue;
    }
    
    function getResouce($PropName,$tagetTag){
    	
    	return $this->Resource[$PropName]->$tagetTag;
    }
    
    
	
}
?>