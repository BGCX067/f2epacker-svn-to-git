<?php

require ("f2e_engine.php");
require ("lib/map.php");


class f2e_get{
	
	public $Resource = array();
	public $thisConfig = array();

	
	
	//Begin:生成资源————————————————————————————————————————————————————————////////////
	
	
	public function f2e_get($_config){
	  	$this->thisConfig = $_config;
	}  

	function readCSS($pTag){
		$retObj =  $this->read($pTag,"CSS");
        
        return 	$retObj->common.
				$retObj->module.
				$retObj->page.
				$retObj->domain;			
	}

	function readJS($pTag){
		return $this->read($pTag,"JS");			
	}
	
	function stamptime($time1,$time2){
	   $stamptime1=strtotime("$time1");

	   $stamptime2=strtotime("$time2");

	   
	   $stamptime=$stamptime2-$stamptime1;
	   
	   if($stamptime >0 ){
	   		return true; //约定重新生成的时间，已经过去，不用重新生成
	   } else{  
	   		return false;	   //
	   } 
	     //	$bCompare = $this->stamptime($_config["Update"] ,date("Y-m-d H:i:s"));
	}
	
	
	function read($pTag,$type){

		$_config = $this->thisConfig;
	   
       
      
		echo "是否结果文件存在<BR>";
		$rtArray = FromJson( $_config[$type]["Result"]);
	
	
		
	
		
	  
		if($rtArray){
			#结果文件存在，则读取
			echo "3-结果文件存在，读取文件<BR>";
			$this->Resource[$type] = $rtArray;
         
			return $this->getPage($type,$pTag);
		}else{
			#结果文件不存在，则重新生成文件，并赋值给资源变量
			echo "4-结果文件不存在，调用重新生成<BR>";
			$this->release($type);
			
			return $this->getPage($type,$pTag);
		}
        
      
			
			
	
		
	}
	

	
	function release($type){
		$_config = $this->thisConfig;
	
		$f2eEg = new f2e_engine($_config[$type]["Resource"]);	
		
		//$f2eEg.
		
			
		$f2eEg->Release();
        $rule = $f2eEg->result_plan();
      
     
		
		$rule = new map($rule);
   
        ToJson($rule,$_config[$type]["Result"]);
		
		$this->Resource[$type] = $rule;
        
    
        
       
		
	}
	
	
	function getPage($type,$pTag){
	
	
		return $this->Resource[$type]->$pTag;
		
	}
	
	
	
}



?>