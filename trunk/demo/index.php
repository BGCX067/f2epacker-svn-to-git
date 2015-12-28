
<?php
	//输出 CSS 资源
	echo htmlspecialchars_decode($MyPage_CSS["common"]) ;
	echo htmlspecialchars_decode($MyPage_CSS["module"]);
	echo htmlspecialchars_decode($MyPage_CSS["page"]);

	//输出 JS 全局资源
	echo htmlspecialchars_decode($MyPage_JS["common"]);
	//输出 JS 模块资源
	echo htmlspecialchars_decode($MyPage_JS["module"]);
	//输出 JS 页面资源
	echo htmlspecialchars_decode($MyPage_JS["page"]);
?>

