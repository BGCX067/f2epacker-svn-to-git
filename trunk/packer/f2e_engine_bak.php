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
    
    //配置内容的存储
    private $resRule = array();
    
    private $UpdateTime ;
     
 
    //自动化策略
    private $Idea= array(
        "Version"=>"",//资源版本        
        "Compress"=>""//压缩方案
    );
    
    //资源读取
    private $Resource = array (
        "Common"=>array(),//全局资源
        "Domain"=>array(),//远程调用的资源
        "Module"=>array(),//模块资源
        "Page"=>array()//页面资源
    );
    
    //解析后存储
    public $Rule = array (
        "Common"=>array(),//全局资源
        "Domain"=>array(),//远程调用的资源
        "Module"=>array(),//模块资源
        "Page"=>array()//页面资源
    );
    
    
    private $Site = array(
        "FileType" => "", //格式化参数
        "HttpPath" => "", //http路径
        "Path" => "",    //物理路径
        "Format"=> ""
    );
    
   	/**
	 * 构造函数
	 * 
	 * @return void
	 */
	public function f2e_engine($jsonFile){
	   $this->ConverJson2Rule($jsonFile);	   
	}  
    

    /**
	 * 配置文件的读取 ===============================================================================================
	 * 
	 * @param mixed $jsonFile 从文件中读入的数据String
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
     * 设置策略：压缩策略 更新策略 版本信息
     *  
     * @return void
     */
    private function set_config(){
        foreach ($this->Idea as $k => $v) {            
            $this->Idea[$k]= $this->resRule->$k;           
        }
    }
    
    /**
     * 设置文件具体路径配置内容
     *      
     * @return void
     */
    private function set_resource(){
         //资源内容
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
	 * 生成所有资源的结果文件
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
	 * 初始化页面资源 
	 * @param mixed $pageTag 页面tag
	 * @return
	 */
	public function fillPage($pageTag){
		$pageRule = $this->getRule("Page",$pageTag);
	
		if(!$pageRule){	
            //根据页面参数获取该页的资源资源
         
            $pageArray = $this->getResouce("Page",$pageTag);
         
            
            $rtRes = array("common"=>"", "module"=>"", "page"=>"");
            
            
			//填充全局=====================================================
		
			$arrComm = 	$pageArray->C;
			if($arrComm){
				foreach($arrComm as $commName){  //有多个common
					$rtRes["common"] .=$this->fillCommon($commName);
				}
			}
			
			
            
			//填充模块=====================================================	
			$arrModule = $pageArray->M;		
			if($arrModule){	
				foreach($arrModule as $moduleName){ //多个模块
					$rtRes["module"] .= $this->fillModule($moduleName);			
				}
			}
			//填充页面=====================================================
			$arrPage = 	$pageArray->P;
			if($arrPage){
				$rtRes["page"] = $this->fillResource($arrPage,$pageTag);
			}
			//填充跨域=====================================================	
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
	 * 初始化全站使用的公用资源
	 * 
	 * @return void
	 */
	private function fillCommon($Name){
	   $commArray = $this->getRule("Common",$Name);
        //已解析过的Common资源中，是否存在
		if(!$commArray){
			//不存在，则解析
			$res = $this->getResouce("Common",$Name);
            $retArray = $this->fillResource($res,$Name);            
            $this->setRule("Common",$Name,$retArray);             
			return $retArray;
			
		}else{
			return $commArray;
		}
		
	}
	/**
	 * 初始化模块资源
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
	 * 跨域的资源引用
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
        ==== 文件输出方案策略 ======================================================================================
   */ 
    /**	
	 * 根据：数组["product.css","search.css"]转化成最终引用的方式字符串路径
	 * 
	 * @param mixed $arrRes 原始配置资源数组
	 * @param mixed $arrName 原始配置资源数组tag名称（为了方便合并文件的时候组织名称）
	 * @return 返回该资源的最终引用方式
     * 
     * "Module":{ 
	 *      "module_one":["module/box.css","module/header.css","module/footer.css"],
     *	   "module_two":["module/list.css"]
     *}
     * 如：  
     * ["module/box.css","module/header.css","module/footer.css"] 为 $arrRes
     * mudule_one为$arrName
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
	 * 1 直接引用单个文件依次引入（<link/>、<script/>）
	 * 
	 * @return
	 */
	private function SinglePlan($arrRes){
		return $this->res_format($arrRes);
	}

	/**
	 * 2 按照资源级别合并多个文件为一个文件
	 * 
	 * @param mixed $arrRes 原始资源项
	 * @param mixed $arrName原始资源项名称 
	 * @return
	 */
	private function CombinePlan($arrRes,$arrName){
	   
		$combFilePath = $this->Combine($arrRes,$arrName);
		
        $ResArray = array($combFilePath);
		return $this->res_format($ResArray);
	}
	/**
	 * 3：基于2,进行合并后的文件压缩
	 * 
	 * @param mixed $arrRes
	 * @param mixed $arrName
	 * @return
	 */
	private function CombineCompressPlan($arrRes,$arrName){
		//合并
		$strPackFileName = $this->Combine($arrRes,$arrName);		
		//压缩
		$strPackFileName = $this->Compress($strPackFileName);
        
		$ResArray =array($strPackFileName);
		return $this->res_format($ResArray);	
	}
    
    
    
    
	/////////////// 压缩，合并  实现部分/////////////////////////////////////
	/**
	 * 压缩文件生成 file.pack.js的文件， ============================  压缩的具体实现部分 ======================
     * 并返回改文件的路径
	 * 
	 * @param mixed $filePath  "sys/index.css"  
	 * @return 生成文件的相对路径
	 */
	private function Compress($sourceFile){
		
		
		$strArray 	= split("/",$sourceFile);//=sys/index.css
		$strTemp	= "release/".join("/", array_slice($strArray,1));  //release/index.css
		
		$from_Str 	= ".".$this->Site["FileType"];	//.css	
		$replace_Str 	= ".p.".$this->Site["FileType"]; //.p.css
				
		$packFilePath = str_replace($from_Str,$replace_Str,$strTemp);
		
		//上面是完成这样的一个路径转换
		//sys/index.css	=>	release/index.css	=>	release/index.p.css
		
		$__sourceFile = $this->getPath($sourceFile);
		$__packFilePath = $this->getPath($packFilePath);
	
		
		//Begin:开始压缩
		if($this->Site["FileType"]=="css"){		
			minify_css($__sourceFile,$__packFilePath);
			
		}else if($this->Site["FileType"]=="js"){
			minify_javascript($__sourceFile,$__packFilePath);
		}
        
        
		//End
		return $packFilePath;
	}
    




	/**
	 * 把多个文件合并成一个文件
	 * 
	 * @param mixed $filePathArray
	 * @param mixed $arrName 源文件路径数组
	 * @param mixed $pack
	 * @return 生成文件的相对路径
	 */
	private function Combine($filePathArray,$arrName){
		//注意到这里的文件名称
		//CSS:合并css后的图片引用路径问题
		$targetFilePath = "release/".$arrName.".c.".$this->Site["FileType"];        
       
        $sourceFilePathArray = array();        
        foreach($filePathArray as $perFile){          
            array_push($sourceFilePathArray,$this->getPath($perFile));
        }
    
        minify_combine($sourceFilePathArray,$this->getPath($targetFilePath));
        
		return $targetFilePath;
	}

	/**
	 * 格式化引用方式  ============================================================================================
	 * 
	 * @param mixed $arrRes 引用路径， 如  comm/comm.css,sys/hello.css
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
     * 格式化引用方式（外联引用，资源的http://路径已经自带）
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
     * 获取文件的物理路径
     * 
     * @param mixed $filePath
     * @return
     */
    function getPath($filePath){
        return $this->Site["Path"].$filePath;
    }
    
      /**
     * 取得文件的http访问路径
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