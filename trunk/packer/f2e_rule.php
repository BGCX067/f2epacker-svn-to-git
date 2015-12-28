<?php


/*
{
    "Version":"v3",
	"Update":"20091015",
	"Compress":"4",
	"Common":{
		"comm1":["common/global.css"],
		"comm2":["common/global2.css"]
	},
	"Domain":{
		"d1":["http://home.sh.liba.com/a.css"]
	},
	"Module":{ 
	       "m1":["module/service.css"]
	},
	"Page":{
	       "index_php":{
	       		"C":["comm1"],
	       		"M":[],
	       		"D":[],
	       		"P":["sys/index.css"]
	       },
		   "search_php":{
	       		"C":["comm1"],
	       		"M":[],
	       		"D":[],
	       		"P":["product/search.css","product/general.css"]
	       }
	 }
}



*/
	/**
	 * f2e_rule 暂时没有用
	 * 
	 * @package f2epacker
	 * @author 3ddown.com
	 * @copyright 2010
	 * @version $Id$
	 * @access public
	 */
	class f2e_rule{
		public $Version = "";
		public $Update = "";
		public $Compress ="";
		public $FileType="";
		public $HttpPath="";
		public $Path =""; 

		
		public $Common  = new stdClass;
		
		
				
		public $Module;
		
		public $Domain;
		
		public $Page;
		
		
		public $testp;
		
		
		
		public f2e_rule($jsonObj){
			//$this->Commom = $jsonObj		
			$this->$Common ->a ="a";	
			
		}
		
		
	
		
		
		
		
	}



?>