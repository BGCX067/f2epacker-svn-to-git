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
    
    //存储：级别文件的方案
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
	   $this->fillCommon();
       $this->fillModule();
       $this->fillDomain();
       $this->fillPage();
      return $this->Rule;	

	}
    
    
    
   	/**	
	 * 初始化全站使用的公用资源
	 * 
	 * @return void
	 */
	private function fillCommon(){
	   
       	$arrComm = 	$this->getResouce("Common");
		foreach($arrComm as $key=>$commArray){  //有多个common
        
            $retArray = $this->fillResource($commArray,$key);  
                   
            $this->setRule("Common",$key,$retArray);             
		
   		}
		
	}
	/**
	 * 初始化模块资源
	 * 
	 * @param mixed $moduleName
	 * @return
	 */
	private function fillModule(){
		$module = $this->getResouce("Module");
		foreach($module as $key=>$moduleArray){ //多个模块
        		
			$retArray = $this->fillResource($moduleArray, $key);
			$this->setRule("Module",$key,$retArray);
       }		
	}

    	/**
	 * 跨域的资源引用
	 * 
	 * @param mixed $resName 
	 * @return
	 */
	private function fillDomain(){
	   	$domain = $this->getResouce("Domain");
    	foreach($domain as $key=>$domainArray){ //多个模块
			$this->setRule("Domain",$key,$domainArray);
		} 
	
	}
    

	/**
	 * fillPage()==========================================================================
	 * 初始化页面资源 
	 * @param mixed $pageTag 页面tag
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
        
            foreach($pageArray->C as $keyName){  //有多个common
                
			    $_thisPageArray["common"] .= $this->res_format($this->getResouce("Common",$keyName));
			}
            
            foreach($pageArray->M as $keyName){  //有多个common
			    $_thisPageArray["module"] .= $this->res_format($this->getResouce("Module",$keyName));
			}
            
           
			$_thisPageArray["page"] .= $this->res_format($pageArray->P );
			
            
            foreach($pageArray->D as $keyName){  //有多个common
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
           
          
            
            
            foreach($pageArray->C as $key ){  //有多个common
                $curArray = $this->getRule("Common",$key);
            
			    $_thisPageArray["common"] .= $this->res_format($curArray[$strStep]);
			}
            
            foreach($pageArray->M as $key){  //有多个common
                $curArray = $this->getRule("Module",$key);
			    $_thisPageArray["module"] .= $this->res_format($curArray[$strStep]);
			}
            
          
			$_thisPageArray["page"] .= $this->res_format($pageArray->P[$strStep] );
		
            
            foreach($pageArray->D as $key){  //有多个common
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
            
            
            foreach($pageArray->C as $key ){  //有多个common
                $curArray = $this->getRule("Common",$key);
                $toOneArray = array_merge($toOneArray,$curArray["comb"]);
			    
			}
            
            foreach($pageArray->M as $key){  //有多个common
                $curArray = $this->getRule("Module",$key);
			    $toOneArray = array_merge($toOneArray,$curArray["comb"]);
			}
            
           $toOneArray = array_merge($toOneArray,$pageArray->P["comb"]);
		
		
            
            foreach($pageArray->D as $key){  //有多个common
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
		
       
		//合并
		$strCombFileName = $this->Combine($arrRes,$arrName);
        
        $combArray = array ($strCombFileName);		
		//压缩
		$strPackFileName = $this->Compress($strCombFileName);
        
		$packArray =array($strPackFileName);
		return array(
            "comb"=>$combArray,
            "pack"=>$packArray                
        );	
      
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
    
    function getResouce($PropName,$tagetTag=""){
    	if(!$tagetTag){
    	   return $this->Resource[$PropName];
    	}else{
    	   return $this->Resource[$PropName]->$tagetTag;
        }
    }
    
    
	
}
?>