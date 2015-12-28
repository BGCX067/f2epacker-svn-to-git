<?php
	
	
	require ('../packer/f2e_get.php');
	require ('f2e_config/config.php');
	
	 $f_get = new f2e_get($f2e_config);
	
	$MyPageTag ="f2e_page_tag";	
	
	$MyPage_CSS = $f_get->readCSS($MyPageTag);
	$MyPage_JS = $f_get->readJS($MyPageTag);

	
		



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�°�����ҳ��</title>

<?php
	//��� CSS ��Դ
	echo htmlspecialchars_decode($MyPage_CSS) ;


?>

<?php
	//��� JS ȫ����Դ
	echo htmlspecialchars_decode($MyPage_JS->common);
?>

</head>

<body>
	<div class="header">
    	<div class="info">
    	    
        	<div class="logoBar">			
    			<div class="logo"><a title="�������ҳ" href="http://www.liba.com"><img src="http://home.liba.com/link/Public/img/logo.gif"/></a></div>
    			<div class="areaSite">
    				<p>�̳Ǽ�װ���ķ������ߣ�<span class="phone">400 620 5151</span></p>
    				<ul>
        				<li><em>�Ϻ�</em></li>
				   		<li class="area">
                           	<a href="javascript:void(0);" target="_blank" onmouseover="onMouseOverbox('Citylayer');" onmouseout="onMouseOutbox('Citylayer');" class="other">[��������]</a>				
				            <div id="Citylayer" style="display: none;" onmouseover="onMouseOverbox('Citylayer');" onmouseout="onMouseOutbox('Citylayer');"> 
	            		        <div id="City">  
					                <a href="http://home.bj.liba.com/main/">����</a>            
					                <a href="http://hangzhou.liba.com/index/">����</a>
					                <a href="http://nanjing.liba.com/index/">�Ͼ�</a>
					                <a href="http://bbs.wx.liba.com/">����</a>
					                <br/>
					                <a href="http://suzhou.liba.com/main/">����</a>
					                <a href="http://bbs.nb.liba.com/">����</a>
					                <a href="http://bbs.gz.liba.com/">����</a>
					                <a href="http://bbs.sz.liba.com/">����</a>
	            				</div> 
					        </div> 						
				         </li> 
				   	</ul>	
			    </div>		
			</div>  
			
			<div class="quick-link">
	            <ul class="quick-link-right">
        	        <li>��ӭ����½��<span class="userName">cindylouzhong</span>[<a title="" id="logOut" href="http://home.liba.com/member/member.php?action=logout">�˳�</a>]</li>	                	
			        <li class="my HoverPane">
            	        <a class="h-t" target="_blank" title="" href="http://my.liba.com/"><span>�ҵ����</span><span class="arrow"></span></a>
            	        <ul class="h-c" style="display: none;">
                	        <li><a href="http://my.liba.com/include/order_search/order1/payment_order.php">������ѯ</a></li>
                            <li><a href="http://my.liba.com/include/mark/coupon.php">������ּ�ȯ</a></li>
                            <li><a href="http://my.liba.com/include/qa/home_qa.php">�ҵ�����</a></li>
                            <li><a href="http://my.liba.com/include/favorite/homeFav.php">�ҵ��ղ�</a></li>
                            <li class="last"><a href="http://my.liba.com/include/my_profile/address_list.php">��ַ����</a></li>
                        </ul>
                    </li>
	        	    <li class="card"><a target="_blank" href="http://card.sh.liba.com/">��ʿ�</a></li>
	                <li class="help"><a target="_blank" href="http://help.liba.com/">����</a></li>
	            </ul>    		
	        </div>		
	     		      
	    </div>
	    
	    <div class="navSearch">
	        <ul class="mainNav">
	            <li class="index"><a href="####">��ҳ</a></li>
	            <li class="home"><a href="####" class="now">��װ����</a></li>
	            <li class="deco"><a href="####">���ʩ��</a></li>
	            <li class="marry"><a href="####">żҪ���</a></li>
	            <li class="baby"><a href="####">���豦��</a></li>
	            <li class="car"><a href="####">ѧ���γ�</a></li>
	        </ul>
	        <ul class="sideNav">
	            <li><a href="####">��̳</a></li>
	            <li><a href="####">ѧ��</a></li>	            
	        </ul>
	        <ul class="breadCrumbs">
	            <li><span class="fl">��ǰλ�ã�</span><a href="####">��װ����</a></li>
	            <li class="my HoverPane">
	                <a href="####" class="h-t"><span>ȫ������</span></a>
	                <ul class="h-c" style="display: none;">
	                    <li><a href="?cate_id=1600">��������</a></li>
	                    <li><a href="?cate_id=1643">����</a></li>
	                    <li><a href="?cate_id=1660">��ԡ</a></li>
	                    <li><a href="?cate_id=1684">�ذ�</a></li>
	                    <li><a href="?cate_id=1690">�Ŵ�</a></li>
	                    <li><a href="?cate_id=1711">����ľ����Ʒ</a></li>
	                    <li><a href="?cate_id=1717">����ǽֽ</a></li>
	                    <li><a href="?cate_id=1723">���ܼҾ�</a></li>
	                    <li><a href="?cate_id=1730">�Ҿ�</a></li>
	                    <li><a href="?cate_id=1737">��װ</a></li>
	                    <li><a href="?cate_id=1741">�ҵ�</a></li>
	                    <li class="last"><a href="?cate_id=1752">�Ӽҷ���</a></li>
	                </ul>
	            </li>
	            <li><a href="####">��ԡ</a></li>
	            <li class="now">��ש</li>
	        </ul>
	        <div class="searchbox">
	            <div class="searchboxcon">
	                <div class="searchinput">
	                    <input type="text" value="˹������" />
	                </div>	                    
	                <span class="searchbtn">
	                    <input type="button" value="����" />
	                </span>
	                <div class="clear"></div>	                        
	            </div>	
	            <span class="cr cr_tl">&nbsp;</span>    
	            <span class="cr cr_tr">&nbsp;</span>    
	            <span class="cr cr_bl">&nbsp;</span>    
	            <span class="cr cr_br">&nbsp;</span>                        
	        </div>	                
	    </div>
    </div> 
    
    <div class="content">
        <div class="mainContent">
            <div class="searchContent">
                <div class="c_t">&nbsp;</div>
                <div class="c_b">
                    <div class="hd clearfix">
                        <div class="status">���ҵ�����Ĳ�Ʒ<em>491</em>��</div>
                        <div class="secSearchBox">
                            <input type="text" class="secSearchTxt fl" value="һ��һ��" />
                            <span><input type="button" class="secSearchBtn" value="" /></span>
                        </div>
                    </div>
                    <div class="cn">
                        <div class="filter SinglePane pane clearfix">
                            <label class="txt">���ࣺ</label>
                            <div class="condition s-c pane_css">
                                <div class="s-c-content" sHeight="20">
                                    <a href="####">��ԡ��߹�<span>(1209)</span></a>
                                    <a href="####">��ԡ��<span>(120)</span></a>
                                    <a href="####">��ͷ<span>(12)</span></a>
                                    <a href="####">ԡ�ҹ�<span>(1209)</span></a>
                                    <a href="####">���ɵ��� <span>(1)</span></a>
                                    <a href="####">��� <span>(19)</span></a>
                                    <a href="####">�����ƾ�<span>(120009)</span></a>    
                                </div>                        
                            </div>
                        </div>  
                        
                        <div class="filter clearfix">
                            <label class="txt">״̬��</label>
                            <div class="condition">
                                <a href="####" class="now">����</a>
                                <a href="####">����</a>                          
                            </div>
                        </div> 
                        
                        <div class="filter now SinglePane pane clearfix">
                            <label class="txt">Ʒ�ƣ�</label>
                            <div class="condition s-c pane_css">
                            	<div class="s-c-content" sHeight="20">
                                    <a href="####">����</a>
                                    <a href="####">ŷ��</a>  
                                    <a href="####">������</a>  
                                    <a href="####">��è</a>  
                                    <a href="####" class="now">��ʤ</a>  
                                    <a href="####">TCL</a>  
                                    <a href="####">��˹��</a>
                                    <a href="####">����</a>   
                                    <a href="####">TCL</a>  
                                    <a href="####">��˹��</a>
                                    <a href="####">����</a>  
                                    <a href="####">����</a>
                                    <a href="####">ŷ��</a>  
                                    <a href="####">������</a>  
                                    <a href="####">��è</a>  
                                    <a href="####">����</a>
                                    <a href="####">ŷ��</a>  
                                    <a href="####">������</a>  
                                    <a href="####">��è</a>   
                                </div>                        
                            </div>
                            <span class="more s-t close">&nbsp;</span>
                        </div> 
                        
                        <div class="filter clearfix">
                            <label class="txt">�۸�</label>
                            <div class="condition">
                                <input type="text" class="input_txt" value="" />
                                &nbsp;&nbsp;��&nbsp;&nbsp;
                                <input type="text" class="input_txt" value="" />
                                <input type="button" value="" class="conbtn" />
                            </div>
                        </div>                             
                                           
                    </div>
                </div>
                <div class="c_f">&nbsp;</div>
            </div>
            
            <div class="goods">
                <div class="tabhd">
                    <ul>
                        <li><a href="####" class="now">��Ʒ�б�</a></li>
                        <li><a href="####">�����б�</a></li>
                    </ul>
                    <div class="sortmd">
                        ���з�ʽ��
                        <a href="####">����<img src="../../Public/img/search_beta/ico_pricedown.gif" alt="" style="top:2px;" /><img src="../../Public/img/search_beta/ico_priceup.gif" alt="" style="top:2px; display:none;" /></a><span>|</span>
                        <a href="####">�۸�</a><span>|</span>
                        <a href="####">���̿ڱ�</a><span>|</span>
                        <a href="####">ʱ��</a>&nbsp;&nbsp;
                        <a href="####"><img src="../../Public/img/search_beta/ico_sortlist.gif" alt="����"  style="display:none;"/><img src="../../Public/img/search_beta/ico_sortlisthover.gif" alt="����" /></a>
                        <a href="####"><img src="../../Public/img/search_beta/ico_sortgrid.gif" alt="�б�" /><img src="../../Public/img/search_beta/ico_sortgridhover.gif" alt="�б�" style="display:none;" /></a>
                    </div>
                </div>
                <div class="goodslist">
                    <div class="goodspic">
                        <img src="../../Public/img/search_beta/good2.gif" alt="good2" />
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####" class="keyword"><em>˹������һ��һ��</em>����ȡůԡ�Դ����ײ�</a><img src="../../Public/img/search_beta/ico_renqi.gif" alt="renqi" /></h2>
                        <p class="intro keyword">8ƽ��<em>һ��һ��</em>������ȡů��ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�</p>
                        <p class="state"><a href="####" class="qa">15����ѯ</a></p>
                        <p class="shop">���������������̣�<a href="####" class="keyword">������<em>һ��һ��</em></a><span>(<img src="../../Public/img/search_beta/ico_rank.gif" alt="" />201)</span></p>
                    </div>
                    <div class="goodsprice">
                        <p><span class="price"><label class="fh">��</label><em>5890.00</em><span>/</span>��</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="goodslist promote">
                    <div class="goodspic">
                        <img src="../../Public/img/search_beta/good2.gif" alt="good2" />
                        <div class="promotpic">&nbsp;</div>
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####" class="keyword"><em>˹������һ��һ��</em>����ȡůԡ�Դ����ײ�</a><img src="../../Public/img/search_beta/ico_renqi.gif" alt="renqi" /><img src="../../Public/img/search_beta/ico_xinpin.gif" alt="xinpin" /><img src="../../Public/img/search_beta/ico_tuijian.gif" alt="tuijian" /></h2>
                        <p class="intro keyword">8ƽ��<em>һ��һ��</em>������ȡů��ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�</p>
                        <p class="state"><a href="####" class="qa">15����ѯ</a></p>
                        <p class="shop">���������������̣�<a href="####" class="keyword">������</a><span>(<img src="../../Public/img/search_beta/ico_rank.gif" alt="" />201)</span></p>
                    </div>
                    <div class="goodsprice">
                        <p><span class="price"><label class="fh">��</label><em>0.90</em><span>/</span>Ƭ</span></p>
                        <p class="pricedel"><del>��1.20/Ƭ</del></p>
                        <p><span class="xiajiang">100Ԫ</span></p>
                        <p><span class="jidianlu">������150%</span></p>
                        <p><span class="xianshi">��ʱ����</span></p>
                        <p><span class="jingxi">���о�ϲ</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                
                <div class="goodslist promote">
                    <div class="goodspic">
                        <img src="../../Public/img/search_beta/good2.gif" alt="good2" />
                        <div class="promotpic">&nbsp;</div>
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####" class="keyword"><em>˹������һ��һ��</em>����ȡůԡ�Դ����ײ�����ȡůԡ�Դ����ײ�����ȡůԡ�Դ����ײ�</a><img src="../../Public/img/search_beta/ico_renqi.gif" alt="renqi" /><img src="../../Public/img/search_beta/ico_xinpin.gif" alt="xinpin" /><img src="../../Public/img/search_beta/ico_tuijian.gif" alt="tuijian" /></h2>
                        <p class="intro keyword">8ƽ��<em>һ��һ��</em>������ȡů��ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�</p>
                        <p class="state"><a href="####" class="qa">15����ѯ</a></p>
                        <p class="shop">���������������̣�<a href="####" class="keyword">������<em>һ��һ��</em></a><span>(<img src="../../Public/img/search_beta/ico_rank.gif" alt="" />201)</span></p>
                    </div>
                    <div class="goodsprice">
                        <p><span class="price"><label class="fh">��</label><em>0.90</em><span>/</span>Ƭ</span></p>
                        <p class="pricedel"><del>��1.20/Ƭ</del></p>
                        <p><span class="xiajiang">100Ԫ</span></p>
                        <p><span class="jidianlu">������150%</span></p>                        
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="goodslist">
                    <div class="goodspic">
                        <img src="../../Public/img/search_beta/good2.gif" alt="good2" />
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####" class="keyword"><em>˹������һ��һ��</em>����ȡůԡ�Դ����ײ�����ȡůԡ�Դ����ײ�</a><img src="../../Public/img/search_beta/ico_renqi.gif" alt="renqi" /></h2>
                        <p class="intro keyword">8ƽ��<em>һ��һ��</em>������ȡů��ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�ԡ���ײͣ����Ҳ���������ع��ײͣ������Լ۱�</p>
                        <p class="state"><a href="####" class="qa">15����ѯ</a></p>
                        <p class="shop">���������������̣�<a href="####" class="keyword">������<em>һ��һ��</em></a><span>(<img src="../../Public/img/search_beta/ico_rank.gif" alt="" />201)</span></p>
                    </div>
                    <div class="goodsprice">
                        <p><span class="price"><label class="fh">��</label><em>5890.00</em><span>/</span>��</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="pageTurning">
                    <a href="####">&lt;&lt;��һҳ</a>
                    <a href="####">1</a>
                    <span class="current">2</span>
                    <a href="####">3</a>
                    <a href="####">4</a>
                    <a href="####">5</a>
                    <a href="####">��һҳ&gt;&gt;</a>
                </div>
                
            </div>
        </div>
        <div class="sideContent">
            <div class="box">
                <h3>�Ƽ���Ʒ<a href="####">����&gt;&gt;</a></h3>
                <div class="goodslist">
                    <div class="goodspic fl">
                        <img src="../../Public/img/search_beta/good1.gif" alt="goods" />                        
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####">�ϰ��ײ�6100�̻�+6G22���</a></h2>
                        <p>��ʼۣ�<span class="price"><label class="fh">��</label><em>0.90</em><span>/</span>��</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="goodslist promote">
                    <div class="goodspic fl">
                        <img src="../../Public/img/search_beta/good1.gif" alt="goods" />
                        <div class="promotpic">&nbsp;</div>
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####">�ϰ��ײ�6100�̻�+6G22���</a></h2>
                        <p>��ʼۣ�<span class="price"><label class="fh">��</label><em>0.90</em><span>/</span>��</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="goodslist last">
                    <div class="goodspic fl">
                        <img src="../../Public/img/search_beta/good1.gif" alt="goods" />                        
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####">�ϰ��ײ�6100�̻�+6G22���</a></h2>
                        <p>��ʼۣ�<span class="price"><label class="fh">��</label><em>0.90</em><span>/</span>��</span></p>
                    </div>
                    <div class="clear"></div>
                </div>                
                
            </div>
            
            <div class="box">
                <h3>������Ʒ<a href="####">����&gt;&gt;</a></h3>
                <ul>
                    <li><a href="####">��������PP-Rˮ��</a></li>
                    <li><a href="####">˹������һ��һ������ȡůԡ�Դ����ײ�</a></li>
                    <li><a href="####">LONON���������22W</a></li>
                    <li><a href="####">�·ɼ��ɵ���1��2����ѡ��ɫ������̼��άȡů���ײ�</a></li>
                    <li><a href="####">���߼�ˮ�縨��</a></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="footer">
        <div class="footerSearch secSearchBox">
            <span class="fl">��װ����</span>
            <input class="secSearchTxt fl" type="text" value=""/>
            <span>
                <input class="secSearchBtn" type="button" value=""/>
            </span>
            <div class="clear"></div>
        </div>
        
        <div class="siteMap">
		    <dl>
			    <dt><a href="http://www.liba.com/index/">�����</a></dt>
			    <dd><a target="_blank" title="��������" href="http://help.liba.com/?cat=31">�������</a></dd>
			    <dd><a target="_blank" title="ý�屨��" href="http://help.liba.com/?cat=33">ý�屨��</a></dd>
			    <dd><a target="_blank" title="����ʱ�估��ϵ����" href="http://help.liba.com/?cat=45">��ϵ��ʽ</a></dd>
			    <dd><a target="_blank" title="����ʱ�估��ϵ����" href="####">������</a></dd>			
			    <dd><a target="_blank" title="��������" href="http://www.liba.com/joinus/">��ƸӢ��</a></dd>
			    <dd><a target="_blank" title="�����������ı�����" href="http://bbs.sh.liba.com/t_4_3325129_1.htm">��������</a></dd>
		    </dl>
		    <dl>
			    <dt><a href="http://help.liba.com/?cat=48">����ָ��</a></dt>
			    <dd><a target="_blank" title="���ע��" href="http://help.liba.com/index.php?cate_id=77">���ע��</a></dd>
			    <dd><a target="_blank" title="���ע��" href="###">������֤</a></dd>
			    <dd><a target="_blank" title="��ζ���" href="http://help.liba.com/index.php?cate_id=52">��ζ���</a></dd>
			    <dd><a target="_blank" title="���֧��" href="http://help.liba.com/index.php?cate_id=66">���֧��</a></dd>
			    <dd><a target="_blank" title="�̼ҿڱ�ֵ" href="http://help.liba.com/index.php?cate_id=85">�̼ҿڱ�ֵ</a></dd>
			    <dd><a target="_blank" title="����͵ּ�ȯ" href="http://help.liba.com/index.php?cate_id=54">����͵ּ�ȯ</a></dd>
		    </dl>
		    <dl>
			    <dt><a href="http://help.liba.com/?cat=49">�ۺ����</a></dt>
			    <dd><a target="_blank" title="Ͷ�߽���" href="####">�ٱ�/Ͷ��</a></dd>
			    <dd><a target="_blank" title="��ȫ����" href="http://help.liba.com/index.php?cate_id=68">��ȫ����</a></dd>
			    <dd><a target="_blank" title="������ѯ" href="####">��������</a></dd>			
		    </dl>
	    </div>
	    <div class="copyright">
	        <p>Copyright?2003-2009 liba.com. All Rights Reserved. ����� ��Ȩ����     ��B2-20030160</p>
	        <p>����վ�������ݾ��ܰ�Ȩ������δ����Ȩ������--liba.com��ȷ��������ɣ��κλ����͸��˲������κη�ʽ��ӡ��ת�ػ�������ҵ��;��</p>
	    </div>
    </div>

	<?php
		//��� JS ģ����Դ
		echo htmlspecialchars_decode($MyPage_JS->module);

		//��� JS ҳ����Դ
		echo htmlspecialchars_decode($MyPage_JS->page);
	?>


</body>
</html>
