
<?php
	//��� CSS ��Դ
	echo htmlspecialchars_decode($MyPage_CSS["common"]) ;
	echo htmlspecialchars_decode($MyPage_CSS["module"]);
	echo htmlspecialchars_decode($MyPage_CSS["page"]);

	//��� JS ȫ����Դ
	echo htmlspecialchars_decode($MyPage_JS["common"]);
	//��� JS ģ����Դ
	echo htmlspecialchars_decode($MyPage_JS["module"]);
	//��� JS ҳ����Դ
	echo htmlspecialchars_decode($MyPage_JS["page"]);
?>

