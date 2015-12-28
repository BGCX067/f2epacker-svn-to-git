<?php 
	/* Copyright (c) 2010, All rights reserved. 	MIT Licensed.	 
	 * http://f2epacker.googlecode.com/
	 * f2epacker
	 * @creator nebel08@gmail.com	
	 */

	require ('../lib/f2engine.php');
	


	//当前的页面的Tag标志，与配置文件JSON中填写的一样
	$MyPageTag ="f2e_page_tag";	

	//=  CSS 

	$CSS_Config = "css_config.js";
	$CSS_Path = "resource/css/";
	$CSS_HttpPath ="http://127.0.0.1/f2eRoot/resource/css/";

	$CssEg = new f2engineBase($CSS_Config,"css",$CSS_Path,$CSS_HttpPath);	
	$MyPage_CSS =  $CssEg->fillPageRule($MyPageTag);


	//= JS
	$JS_Config = "js_config.js";
	$JS_Path = "resource/js/";
	$JS_HttpPath ="http://127.0.0.1/f2eRoot/resource/js/";

	$JsEg = new f2engineBase($JS_Config,"js",$JS_Path,$JS_HttpPath);
	$MyPage_JS = $JsEg->fillPageRule($MyPageTag);
    
 ?>
	