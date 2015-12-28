<?php

require ("f2e_engine.php");
require ("lib/map.php");


class f2e_get{
	
	public $Resource = array();
	public $thisConfig = array();

	
	
	//Begin:������Դ����������������������������������������������������������������������������������������������������������������////////////
	
	
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
	   		return true; //Լ���������ɵ�ʱ�䣬�Ѿ���ȥ��������������
	   } else{  
	   		return false;	   //
	   } 
	     //	$bCompare = $this->stamptime($_config["Update"] ,date("Y-m-d H:i:s"));
	}
	
	
	function read($pTag,$type){

		$_config = $this->thisConfig;
	   
       
      
		echo "�Ƿ����ļ�����<BR>";
		$rtArray = FromJson( $_config[$type]["Result"]);
	
	
		
	
		
	  
		if($rtArray){
			#����ļ����ڣ����ȡ
			echo "3-����ļ����ڣ���ȡ�ļ�<BR>";
			$this->Resource[$type] = $rtArray;
         
			return $this->getPage($type,$pTag);
		}else{
			#����ļ������ڣ������������ļ�������ֵ����Դ����
			echo "4-����ļ������ڣ�������������<BR>";
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