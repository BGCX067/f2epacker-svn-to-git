<?php
  
  require ('js/jsmin-1.1.1.php');
  require ('css/class.csstidy.php');
  require ('JSON.php');
  
  
  /**
   * ѹ��css�ļ�
   * 
   * @param mixed $sourceFile
   * @param mixed $targetFile
   * @return void
   */
  function minify_css($sourceFile,$targetFile){
		$css = new csstidy();
		$css->load_template('highest_compression');
	/*	$css->set_cfg('remove_bslash',false);
		$css->set_cfg('compress_colors',false);
		$css->set_cfg('compress_font-weight',false);
		$css->set_cfg('lowercase_s',true);
		$css->set_cfg('optimise_shorthands',$_REQUEST['optimise_shorthands']);
		$css->set_cfg('remove_last_;',true);
		$css->set_cfg('case_properties',$_REQUEST['case_properties']);
		$css->set_cfg('sort_properties',true);
		$css->set_cfg('sort_selectors',true);
		$css->set_cfg('merge_selectors', $_REQUEST['merge_selectors']);
		$css->set_cfg('discard_invalid_properties',true);
		$css->set_cfg('preserve_css',true);
		$css->set_cfg('timestamp',true);
		*/
		$strSourceCSS = file_get_contents($sourceFile);
		$strResult = $css->parse($strSourceCSS);
        $handle = fopen($targetFile,'w');
        if($handle) {
            if(fwrite($handle,$css->print->plain()))
            {
                $file_ok = true;
            }
        }
        fclose($handle);
	}  
    
    
    
    
     /**
      * ѹ��javascript�ļ�
      * 
      * @param mixed $sourceFile
      * @param mixed $targetFile
      * @return void
      */
     function minify_javascript($sourceFile,$targetFile){
		//��ȡ�ļ�������
		$script = file_get_contents($sourceFile);		
		//$myPacker = new JavaScriptPacker($script,'none');
		//$packed = $myPacker->pack();
		$packed = JSMin::minify($script);
		 if($fp=fopen($targetFile,'w')){
	         fwrite($fp,$packed);
	         fclose($fp);	        
	     }
	}
    
    
    
    /**
     * �ϲ�����ļ���һ��ָ��Ŀ¼���ļ�
     * 
     * @param mixed $fileArray
     * @param mixed $targetFile
     * @return void
     */
    function minify_combine($fileArray,$targetFile){
        
        	//	if (!file_exists($combFileDir)) {
       //         mkdir($combFileDir);
  	//	}
    
		$strResultRes = "";		
		//Begin: ��ȡ���е��ļ���һ���ַ�����
		foreach($fileArray as $perFile){			
			$strResultRes .= file_get_contents($perFile);			
		}
		//End ��ȡ���
		//�����Ŀ���ļ���
		 if($fp=fopen($targetFile,'w')){
	         fwrite($fp,$strResultRes);
	         fclose($fp);	        
	     }	
    }
    
    
    function minify_combine_string($fileArray){
    	$strResultRes = "";		
		//Begin: ��ȡ���е��ļ���һ���ַ�����
		foreach($fileArray as $perFile){			
			$strResultRes .= file_get_contents($perFile);			
		}
		
		return $strResultRes;   	
    	
    }

	/**
	 * �����ļ�
	 * 
	 * @param mixed $str
	 * @param string $file
	 * @return void
	 */
	function outFile($str,$file='') {
	
		$fp = fopen($file,"w+");
		fwrite($fp,$str);
		fclose($fp);
	}
	

	/**
	 * ���������JSON�ļ�����
	 * 
	 * @return void
	 */
	 function ToJson($rlsArray,$file=''){
		
		$json = new Services_JSON();		
		$resString = $json->encode($rlsArray);		
		
		outFile($resString,$file);
		
	}
    
    	/**
	 *   JSON��ʽ����
	 * 
	 * @param mixed $file
	 * @return
	 */
	 function FromJson($file){		
		
		
		if (file_exists($file)) {
			$input = file_get_contents($file, 1000000);		
			$json = new Services_JSON();
			return $json->decode($input);
       
	  	}else{
			return null;
		}
	
	}
    
    /**
	 * ����
	 * 
	 * @param mixed $H
	 * @return void
	 */
	function t_s($H){
		echo "<pre>Begin======\n";
		print_r($H);
		echo "\n=======End\n</pre>";	
	}




?>