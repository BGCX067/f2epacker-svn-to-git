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
    
    //�洢�������ļ��ķ���
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
	   $this->fillCommon();
       $this->fillModule();
       $this->fillDomain();
       $this->fillPage();
      return $this->Rule;	

	}
    
    
    
   	/**	
	 * ��ʼ��ȫվʹ�õĹ�����Դ
	 * 
	 * @return void
	 */
	private function fillCommon(){
	   
       	$arrComm = 	$this->getResouce("Common");
		foreach($arrComm as $key=>$commArray){  //�ж��common
        
            $retArray = $this->fillResource($commArray,$key);  
                   
            $this->setRule("Common",$key,$retArray);             
		
   		}
		
	}
	/**
	 * ��ʼ��ģ����Դ
	 * 
	 * @param mixed $moduleName
	 * @return
	 */
	private function fillModule(){
		$module = $this->getResouce("Module");
		foreach($module as $key=>$moduleArray){ //���ģ��
        		
			$retArray = $this->fillResource($moduleArray, $key);
			$this->setRule("Module",$key,$retArray);
       }		
	}

    	/**
	 * �������Դ����
	 * 
	 * @param mixed $resName 
	 * @return
	 */
	private function fillDomain(){
	   	$domain = $this->getResouce("Domain");
    	foreach($domain as $key=>$domainArray){ //���ģ��
			$this->setRule("Domain",$key,$domainArray);
		} 
	
	}
    

	/**
	 * fillPage()==========================================================================
	 * ��ʼ��ҳ����Դ 
	 * @param mixed $pageTag ҳ��tag
	 * @return
	 */
	public function fillPage(){
		foreach($this->Resource["Page"] as $pTag => $pageArray){
            
            $retStdclass= new stdClass;
            
            $retStdclass->C = $pageArray->C;
            $retStdclass->D = $pageArray->D;
            $retStdclass->M = $pageArray->M;
            $retStdclass->P = $this->fillResource($pageArray->P,$pTag);
        
            $this->setRule("Page",$pTag,$retStdclass);
        
        }
				
	}
    
    
    public function result_plan($CompressTypeSet=0){
        $CompressType = $this->Idea["Compress"];
        
        if($CompressTypeSet!=0){
            
            $CompressType = $CompressTypeSet;
        }
        
        
        if($CompressType==2){
            return  $this->CombineCompressPlan("comb");
        }else if($CompressType==3){
            return $this->CombineCompressPlan("pack");
        }else if($CompressType==4){
           return $this->BestPlan();
        }else{ //
            return $this->SinglePlan();
            
        }
        
        
        
    }
    
    
    
    function SinglePlan (){
        
        $retPlan = array();          
        $_tmpArray = $this->Resource["Page"];
        
        foreach($_tmpArray as $pTag => $pageArray){
        
            $_thisPageArray =  array("common"=>"", "module"=>"","domain"=>"", "page"=>"");
        
            foreach($pageArray->C as $keyName){  //�ж��common
                
			    $_thisPageArray["common"] .= $this->res_format($this->getResouce("Common",$keyName));
			}
            
            foreach($pageArray->M as $keyName){  //�ж��common
			    $_thisPageArray["module"] .= $this->res_format($this->getResouce("Module",$keyName));
			}
            
           
			$_thisPageArray["page"] .= $this->res_format($pageArray->P );
			
            
            foreach($pageArray->D as $keyName){  //�ж��common
			    $_thisPageArray["domain"] .= $this->res_format2($this->getResouce("Domain",$keyName));
			}
            
            $retPlan[$pTag] = $_thisPageArray;               
           
         
            
            
        }
        return $retPlan;
        
        
    }
    
    
    function CombineCompressPlan($strStep){
  
         $_tmpArray = $this->Rule["Page"];
       
            
        $retPlan = array();          
 
        foreach($_tmpArray as $pTag=>$pageArray){
        
            $_thisPageArray =  array("common"=>"", "module"=>"","domain"=>"", "page"=>"");
           
          
            
            
            foreach($pageArray->C as $key ){  //�ж��common
                $curArray = $this->getRule("Common",$key);
            
			    $_thisPageArray["common"] .= $this->res_format($curArray[$strStep]);
			}
            
            foreach($pageArray->M as $key){  //�ж��common
                $curArray = $this->getRule("Module",$key);
			    $_thisPageArray["module"] .= $this->res_format($curArray[$strStep]);
			}
            
          
			$_thisPageArray["page"] .= $this->res_format($pageArray->P[$strStep] );
		
            
            foreach($pageArray->D as $key){  //�ж��common
			    $_thisPageArray["domain"] .= $this->res_format2($this->getRule("Domain",$key));
			}
            
            $retPlan[$pTag] = $_thisPageArray;               
           
           //array_merge 
            
            
        }
        return $retPlan;
        
        
    }
    
    function BestPlan(){
  
         $_tmpArray = $this->Rule["Page"];
       
            
        $retPlan = array();          
 
        foreach($_tmpArray as $pTag=>$pageArray){
        
            $toOneArray =  array();
           
            $_thisPageArray =  array("common"=>"", "module"=>"","domain"=>"", "page"=>"");
            
            
            foreach($pageArray->C as $key ){  //�ж��common
                $curArray = $this->getRule("Common",$key);
                $toOneArray = array_merge($toOneArray,$curArray["comb"]);
			    
			}
            
            foreach($pageArray->M as $key){  //�ж��common
                $curArray = $this->getRule("Module",$key);
			    $toOneArray = array_merge($toOneArray,$curArray["comb"]);
			}
            
           $toOneArray = array_merge($toOneArray,$pageArray->P["comb"]);
		
		
            
            foreach($pageArray->D as $key){  //�ж��common
			    $_thisPageArray["domain"] .= $this->res_format2($this->getRule("Domain",$key));
			}
            
            $oneFileName = $this->fillResource($toOneArray,$pTag.".all");
            
            $_thisPageArray["page"] .= $this->res_format($oneFileName["pack"]);
            
            
            $retPlan[$pTag] = $_thisPageArray;               
           
           //array_merge 
            
            
        }
        return $retPlan;
        
        
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
		
       
		//�ϲ�
		$strCombFileName = $this->Combine($arrRes,$arrName);
        
        $combArray = array ($strCombFileName);		
		//ѹ��
		$strPackFileName = $this->Compress($strCombFileName);
        
		$packArray =array($strPackFileName);
		return array(
            "comb"=>$combArray,
            "pack"=>$packArray                
        );	
      
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
    
    function getResouce($PropName,$tagetTag=""){
    	if(!$tagetTag){
    	   return $this->Resource[$PropName];
    	}else{
    	   return $this->Resource[$PropName]->$tagetTag;
        }
    }
    
    
	
}
?>