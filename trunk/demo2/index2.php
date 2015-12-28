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
<title>新版搜索页面</title>

<?php
	//输出 CSS 资源
	echo htmlspecialchars_decode($MyPage_CSS) ;


?>

<?php
	//输出 JS 全局资源
	echo htmlspecialchars_decode($MyPage_JS->common);
?>

</head>

<body>
	<div class="header">
    	<div class="info">
    	    
        	<div class="logoBar">			
    			<div class="logo"><a title="篱笆网首页" href="http://www.liba.com"><img src="http://home.liba.com/link/Public/img/logo.gif"/></a></div>
    			<div class="areaSite">
    				<p>商城家装建材服务热线：<span class="phone">400 620 5151</span></p>
    				<ul>
        				<li><em>上海</em></li>
				   		<li class="area">
                           	<a href="javascript:void(0);" target="_blank" onmouseover="onMouseOverbox('Citylayer');" onmouseout="onMouseOutbox('Citylayer');" class="other">[其它地区]</a>				
				            <div id="Citylayer" style="display: none;" onmouseover="onMouseOverbox('Citylayer');" onmouseout="onMouseOutbox('Citylayer');"> 
	            		        <div id="City">  
					                <a href="http://home.bj.liba.com/main/">北京</a>            
					                <a href="http://hangzhou.liba.com/index/">杭州</a>
					                <a href="http://nanjing.liba.com/index/">南京</a>
					                <a href="http://bbs.wx.liba.com/">无锡</a>
					                <br/>
					                <a href="http://suzhou.liba.com/main/">苏州</a>
					                <a href="http://bbs.nb.liba.com/">宁波</a>
					                <a href="http://bbs.gz.liba.com/">广州</a>
					                <a href="http://bbs.sz.liba.com/">深圳</a>
	            				</div> 
					        </div> 						
				         </li> 
				   	</ul>	
			    </div>		
			</div>  
			
			<div class="quick-link">
	            <ul class="quick-link-right">
        	        <li>欢迎您登陆！<span class="userName">cindylouzhong</span>[<a title="" id="logOut" href="http://home.liba.com/member/member.php?action=logout">退出</a>]</li>	                	
			        <li class="my HoverPane">
            	        <a class="h-t" target="_blank" title="" href="http://my.liba.com/"><span>我的篱笆</span><span class="arrow"></span></a>
            	        <ul class="h-c" style="display: none;">
                	        <li><a href="http://my.liba.com/include/order_search/order1/payment_order.php">订单查询</a></li>
                            <li><a href="http://my.liba.com/include/mark/coupon.php">积点与抵价券</a></li>
                            <li><a href="http://my.liba.com/include/qa/home_qa.php">我的问题</a></li>
                            <li><a href="http://my.liba.com/include/favorite/homeFav.php">我的收藏</a></li>
                            <li class="last"><a href="http://my.liba.com/include/my_profile/address_list.php">地址管理</a></li>
                        </ul>
                    </li>
	        	    <li class="card"><a target="_blank" href="http://card.sh.liba.com/">篱笆卡</a></li>
	                <li class="help"><a target="_blank" href="http://help.liba.com/">帮助</a></li>
	            </ul>    		
	        </div>		
	     		      
	    </div>
	    
	    <div class="navSearch">
	        <ul class="mainNav">
	            <li class="index"><a href="####">首页</a></li>
	            <li class="home"><a href="####" class="now">家装建材</a></li>
	            <li class="deco"><a href="####">设计施工</a></li>
	            <li class="marry"><a href="####">偶要结婚</a></li>
	            <li class="baby"><a href="####">妈妈宝宝</a></li>
	            <li class="car"><a href="####">学车饰车</a></li>
	        </ul>
	        <ul class="sideNav">
	            <li><a href="####">论坛</a></li>
	            <li><a href="####">学堂</a></li>	            
	        </ul>
	        <ul class="breadCrumbs">
	            <li><span class="fl">当前位置：</span><a href="####">家装建材</a></li>
	            <li class="my HoverPane">
	                <a href="####" class="h-t"><span>全部分类</span></a>
	                <ul class="h-c" style="display: none;">
	                    <li><a href="?cate_id=1600">基础材料</a></li>
	                    <li><a href="?cate_id=1643">橱柜</a></li>
	                    <li><a href="?cate_id=1660">卫浴</a></li>
	                    <li><a href="?cate_id=1684">地板</a></li>
	                    <li><a href="?cate_id=1690">门窗</a></li>
	                    <li><a href="?cate_id=1711">定制木工产品</a></li>
	                    <li><a href="?cate_id=1717">油漆墙纸</a></li>
	                    <li><a href="?cate_id=1723">智能家居</a></li>
	                    <li><a href="?cate_id=1730">家具</a></li>
	                    <li><a href="?cate_id=1737">软装</a></li>
	                    <li><a href="?cate_id=1741">家电</a></li>
	                    <li class="last"><a href="?cate_id=1752">居家服务</a></li>
	                </ul>
	            </li>
	            <li><a href="####">卫浴</a></li>
	            <li class="now">地砖</li>
	        </ul>
	        <div class="searchbox">
	            <div class="searchboxcon">
	                <div class="searchinput">
	                    <input type="text" value="斯普林特" />
	                </div>	                    
	                <span class="searchbtn">
	                    <input type="button" value="搜索" />
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
                        <div class="status">共找到相符的产品<em>491</em>条</div>
                        <div class="secSearchBox">
                            <input type="text" class="secSearchTxt fl" value="一厨一卫" />
                            <span><input type="button" class="secSearchBtn" value="" /></span>
                        </div>
                    </div>
                    <div class="cn">
                        <div class="filter SinglePane pane clearfix">
                            <label class="txt">分类：</label>
                            <div class="condition s-c pane_css">
                                <div class="s-c-content" sHeight="20">
                                    <a href="####">卫浴洁具柜<span>(1209)</span></a>
                                    <a href="####">淋浴房<span>(120)</span></a>
                                    <a href="####">龙头<span>(12)</span></a>
                                    <a href="####">浴室柜<span>(1209)</span></a>
                                    <a href="####">集成吊顶 <span>(1)</span></a>
                                    <a href="####">板材 <span>(19)</span></a>
                                    <a href="####">照明灯具<span>(120009)</span></a>    
                                </div>                        
                            </div>
                        </div>  
                        
                        <div class="filter clearfix">
                            <label class="txt">状态：</label>
                            <div class="condition">
                                <a href="####" class="now">不限</a>
                                <a href="####">促销</a>                          
                            </div>
                        </div> 
                        
                        <div class="filter now SinglePane pane clearfix">
                            <label class="txt">品牌：</label>
                            <div class="condition s-c pane_css">
                            	<div class="s-c-content" sHeight="20">
                                    <a href="####">不限</a>
                                    <a href="####">欧普</a>  
                                    <a href="####">西门子</a>  
                                    <a href="####">熊猫</a>  
                                    <a href="####" class="now">奇胜</a>  
                                    <a href="####">TCL</a>  
                                    <a href="####">美斯克</a>
                                    <a href="####">西蒙</a>   
                                    <a href="####">TCL</a>  
                                    <a href="####">美斯克</a>
                                    <a href="####">西蒙</a>  
                                    <a href="####">不限</a>
                                    <a href="####">欧普</a>  
                                    <a href="####">西门子</a>  
                                    <a href="####">熊猫</a>  
                                    <a href="####">不限</a>
                                    <a href="####">欧普</a>  
                                    <a href="####">西门子</a>  
                                    <a href="####">熊猫</a>   
                                </div>                        
                            </div>
                            <span class="more s-t close">&nbsp;</span>
                        </div> 
                        
                        <div class="filter clearfix">
                            <label class="txt">价格：</label>
                            <div class="condition">
                                <input type="text" class="input_txt" value="" />
                                &nbsp;&nbsp;至&nbsp;&nbsp;
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
                        <li><a href="####" class="now">产品列表</a></li>
                        <li><a href="####">商铺列表</a></li>
                    </ul>
                    <div class="sortmd">
                        排列方式：
                        <a href="####">热销<img src="../../Public/img/search_beta/ico_pricedown.gif" alt="" style="top:2px;" /><img src="../../Public/img/search_beta/ico_priceup.gif" alt="" style="top:2px; display:none;" /></a><span>|</span>
                        <a href="####">价格</a><span>|</span>
                        <a href="####">商铺口碑</a><span>|</span>
                        <a href="####">时间</a>&nbsp;&nbsp;
                        <a href="####"><img src="../../Public/img/search_beta/ico_sortlist.gif" alt="画廊"  style="display:none;"/><img src="../../Public/img/search_beta/ico_sortlisthover.gif" alt="画廊" /></a>
                        <a href="####"><img src="../../Public/img/search_beta/ico_sortgrid.gif" alt="列表" /><img src="../../Public/img/search_beta/ico_sortgridhover.gif" alt="列表" style="display:none;" /></a>
                    </div>
                </div>
                <div class="goodslist">
                    <div class="goodspic">
                        <img src="../../Public/img/search_beta/good2.gif" alt="good2" />
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####" class="keyword"><em>斯普林特一厨一卫</em>三灯取暖浴霸促销套餐</a><img src="../../Public/img/search_beta/ico_renqi.gif" alt="renqi" /></h2>
                        <p class="intro keyword">8平米<em>一厨一卫</em>（三灯取暖）浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比</p>
                        <p class="state"><a href="####" class="qa">15人咨询</a></p>
                        <p class="shop">所在商铺商铺商铺：<a href="####" class="keyword">西门子<em>一厨一卫</em></a><span>(<img src="../../Public/img/search_beta/ico_rank.gif" alt="" />201)</span></p>
                    </div>
                    <div class="goodsprice">
                        <p><span class="price"><label class="fh">￥</label><em>5890.00</em><span>/</span>套</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="goodslist promote">
                    <div class="goodspic">
                        <img src="../../Public/img/search_beta/good2.gif" alt="good2" />
                        <div class="promotpic">&nbsp;</div>
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####" class="keyword"><em>斯普林特一厨一卫</em>三灯取暖浴霸促销套餐</a><img src="../../Public/img/search_beta/ico_renqi.gif" alt="renqi" /><img src="../../Public/img/search_beta/ico_xinpin.gif" alt="xinpin" /><img src="../../Public/img/search_beta/ico_tuijian.gif" alt="tuijian" /></h2>
                        <p class="intro keyword">8平米<em>一厨一卫</em>（三灯取暖）浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比</p>
                        <p class="state"><a href="####" class="qa">15人咨询</a></p>
                        <p class="shop">所在商铺商铺商铺：<a href="####" class="keyword">西门子</a><span>(<img src="../../Public/img/search_beta/ico_rank.gif" alt="" />201)</span></p>
                    </div>
                    <div class="goodsprice">
                        <p><span class="price"><label class="fh">￥</label><em>0.90</em><span>/</span>片</span></p>
                        <p class="pricedel"><del>￥1.20/片</del></p>
                        <p><span class="xiajiang">100元</span></p>
                        <p><span class="jidianlu">积点率150%</span></p>
                        <p><span class="xianshi">限时限量</span></p>
                        <p><span class="jingxi">内有惊喜</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                
                <div class="goodslist promote">
                    <div class="goodspic">
                        <img src="../../Public/img/search_beta/good2.gif" alt="good2" />
                        <div class="promotpic">&nbsp;</div>
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####" class="keyword"><em>斯普林特一厨一卫</em>三灯取暖浴霸促销套餐三灯取暖浴霸促销套餐三灯取暖浴霸促销套餐</a><img src="../../Public/img/search_beta/ico_renqi.gif" alt="renqi" /><img src="../../Public/img/search_beta/ico_xinpin.gif" alt="xinpin" /><img src="../../Public/img/search_beta/ico_tuijian.gif" alt="tuijian" /></h2>
                        <p class="intro keyword">8平米<em>一厨一卫</em>（三灯取暖）浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比</p>
                        <p class="state"><a href="####" class="qa">15人咨询</a></p>
                        <p class="shop">所在商铺商铺商铺：<a href="####" class="keyword">西门子<em>一厨一卫</em></a><span>(<img src="../../Public/img/search_beta/ico_rank.gif" alt="" />201)</span></p>
                    </div>
                    <div class="goodsprice">
                        <p><span class="price"><label class="fh">￥</label><em>0.90</em><span>/</span>片</span></p>
                        <p class="pricedel"><del>￥1.20/片</del></p>
                        <p><span class="xiajiang">100元</span></p>
                        <p><span class="jidianlu">积点率150%</span></p>                        
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="goodslist">
                    <div class="goodspic">
                        <img src="../../Public/img/search_beta/good2.gif" alt="good2" />
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####" class="keyword"><em>斯普林特一厨一卫</em>三灯取暖浴霸促销套餐三灯取暖浴霸促销套餐</a><img src="../../Public/img/search_beta/ico_renqi.gif" alt="renqi" /></h2>
                        <p class="intro keyword">8平米<em>一厨一卫</em>（三灯取暖）浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比浴霸套餐，厂家补贴，篱笆特供套餐，极高性价比</p>
                        <p class="state"><a href="####" class="qa">15人咨询</a></p>
                        <p class="shop">所在商铺商铺商铺：<a href="####" class="keyword">西门子<em>一厨一卫</em></a><span>(<img src="../../Public/img/search_beta/ico_rank.gif" alt="" />201)</span></p>
                    </div>
                    <div class="goodsprice">
                        <p><span class="price"><label class="fh">￥</label><em>5890.00</em><span>/</span>套</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="pageTurning">
                    <a href="####">&lt;&lt;上一页</a>
                    <a href="####">1</a>
                    <span class="current">2</span>
                    <a href="####">3</a>
                    <a href="####">4</a>
                    <a href="####">5</a>
                    <a href="####">下一页&gt;&gt;</a>
                </div>
                
            </div>
        </div>
        <div class="sideContent">
            <div class="box">
                <h3>推荐产品<a href="####">更多&gt;&gt;</a></h3>
                <div class="goodslist">
                    <div class="goodspic fl">
                        <img src="../../Public/img/search_beta/good1.gif" alt="goods" />                        
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####">老板套餐6100烟机+6G22灶具</a></h2>
                        <p>篱笆价：<span class="price"><label class="fh">￥</label><em>0.90</em><span>/</span>套</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="goodslist promote">
                    <div class="goodspic fl">
                        <img src="../../Public/img/search_beta/good1.gif" alt="goods" />
                        <div class="promotpic">&nbsp;</div>
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####">老板套餐6100烟机+6G22灶具</a></h2>
                        <p>篱笆价：<span class="price"><label class="fh">￥</label><em>0.90</em><span>/</span>套</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="goodslist last">
                    <div class="goodspic fl">
                        <img src="../../Public/img/search_beta/good1.gif" alt="goods" />                        
                    </div>
                    <div class="goodsinfo">
                        <h2><a href="####">老板套餐6100烟机+6G22灶具</a></h2>
                        <p>篱笆价：<span class="price"><label class="fh">￥</label><em>0.90</em><span>/</span>套</span></p>
                    </div>
                    <div class="clear"></div>
                </div>                
                
            </div>
            
            <div class="box">
                <h3>热销产品<a href="####">更多&gt;&gt;</a></h3>
                <ul>
                    <li><a href="####">爱康抗菌PP-R水管</a></li>
                    <li><a href="####">斯普林特一厨一卫三灯取暖浴霸促销套餐</a></li>
                    <li><a href="####">LONON照明香榭里22W</a></li>
                    <li><a href="####">新飞集成吊顶1厨2卫精选绿色环保（碳纤维取暖）套餐</a></li>
                    <li><a href="####">电线及水电辅料</a></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="footer">
        <div class="footerSearch secSearchBox">
            <span class="fl">家装建材</span>
            <input class="secSearchTxt fl" type="text" value=""/>
            <span>
                <input class="secSearchBtn" type="button" value=""/>
            </span>
            <div class="clear"></div>
        </div>
        
        <div class="siteMap">
		    <dl>
			    <dt><a href="http://www.liba.com/index/">篱笆网</a></dt>
			    <dd><a target="_blank" title="篱笆网简介" href="http://help.liba.com/?cat=31">关于篱笆</a></dd>
			    <dd><a target="_blank" title="媒体报道" href="http://help.liba.com/?cat=33">媒体报道</a></dd>
			    <dd><a target="_blank" title="工作时间及联系方法" href="http://help.liba.com/?cat=45">联系方式</a></dd>
			    <dd><a target="_blank" title="工作时间及联系方法" href="####">广告服务</a></dd>			
			    <dd><a target="_blank" title="加入我们" href="http://www.liba.com/joinus/">诚聘英才</a></dd>
			    <dd><a target="_blank" title="告诉我们您的宝贵建议" href="http://bbs.sh.liba.com/t_4_3325129_1.htm">反馈中心</a></dd>
		    </dl>
		    <dl>
			    <dt><a href="http://help.liba.com/?cat=48">购物指南</a></dt>
			    <dd><a target="_blank" title="免费注册" href="http://help.liba.com/index.php?cate_id=77">免费注册</a></dd>
			    <dd><a target="_blank" title="免费注册" href="###">邮箱验证</a></dd>
			    <dd><a target="_blank" title="如何订购" href="http://help.liba.com/index.php?cate_id=52">如何订购</a></dd>
			    <dd><a target="_blank" title="如何支付" href="http://help.liba.com/index.php?cate_id=66">如何支付</a></dd>
			    <dd><a target="_blank" title="商家口碑值" href="http://help.liba.com/index.php?cate_id=85">商家口碑值</a></dd>
			    <dd><a target="_blank" title="积点和抵价券" href="http://help.liba.com/index.php?cate_id=54">积点和抵价券</a></dd>
		    </dl>
		    <dl>
			    <dt><a href="http://help.liba.com/?cat=49">售后服务</a></dt>
			    <dd><a target="_blank" title="投诉建议" href="####">举报/投诉</a></dd>
			    <dd><a target="_blank" title="安全保障" href="http://help.liba.com/index.php?cate_id=68">安全保障</a></dd>
			    <dd><a target="_blank" title="订单查询" href="####">常见问题</a></dd>			
		    </dl>
	    </div>
	    <div class="copyright">
	        <p>Copyright?2003-2009 liba.com. All Rights Reserved. 篱笆网 版权所有     沪B2-20030160</p>
	        <p>本网站所有内容均受版权保护。未经版权所有人--liba.com明确的书面许可，任何机构和个人不得心任何方式翻印、转载或用于商业用途。</p>
	    </div>
    </div>

	<?php
		//输出 JS 模块资源
		echo htmlspecialchars_decode($MyPage_JS->module);

		//输出 JS 页面资源
		echo htmlspecialchars_decode($MyPage_JS->page);
	?>


</body>
</html>
