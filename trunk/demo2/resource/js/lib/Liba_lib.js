var LB = {
    version:"0.1",
	isIE6 :$.browser.msie && $.browser.version=="6.0",
	pageMode:(document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
};




var SDA = {};

SDA.Float = function(floatId,xPx,yPx,isLeft) {
	var curFloat = this;
	var floatObj = $("#"+floatId)	

	var locCss={};	

	$(floatObj).find(".close").click(function(){
		$(floatObj).hide();
	});		
	
	this.supportFixed=function(){
			locCss.bottom= yPx+"px";
			$(floatObj).css(locCss);
			$(floatObj).css("position","fixed");
	}
	
	this.supportIE6 = function(){
		var topHeight= LB.pageMode.scrollTop + LB.pageMode.clientHeight - document.getElementById(floatId).offsetHeight- yPx;
		locCss.top = topHeight+"px";			
		$(floatObj).css(locCss);		
		setTimeout(function(){
			curFloat.supportIE6();
		},80);			
	}

	if(isLeft){
		locCss.left = xPx+"px";			
	}else{
		locCss.right= xPx+"px";
	}

	if(LB.isIE6){
		curFloat.supportIE6();
	}else{
		curFloat.supportFixed();
	}

}

$.Float = function(floatId,xPx,yPx,isLeft){
	new SDA.Float(floatId,xPx,yPx,isLeft);	
}

SDA.Win = function(floatId,xPx,isLeft,autoHideTime){
	var curWin = this;
	var parentArea = $("#"+floatId);
	
	
	this.show = function(){
		parentArea.show(1500);
		parentArea.slideDown(1500);
	}
	
	this.close=function(){
		//关闭
		parentArea.hide(1500);
	}	
	
	this.ToMin=function(){
		///最小化		
		parentArea.find(".sw_content").slideUp(1500);
		parentArea.find(".toMax").show();
		parentArea.find(".toMin").hide();
	}
	
	
	this.ToMax = function(){
		///最大化	
		parentArea.find(".sw_content").slideDown(1500);
		parentArea.find(".toMax").hide();
		parentArea.find(".toMin").show();		
		
	}
	
	
	//初始化状态及事件
	parentArea.find(".toMax").hide();
	//如果开始none，那么显示		
		
	
	if(autoHideTime){
		setTimeout(	function(){
			curWin.ToMin();
		},autoHideTime);
	}
	
	
	parentArea.find(".toMin").click(function(){
		curWin.ToMin();		
	});
	
	parentArea.find(".toMax").click(function(){
		curWin.ToMax();
	});
	
	parentArea.find(".toClose").click(function(){
		curWin.close();
	});
	
	
	$.Float(floatId,xPx,0,isLeft);
	
	
}
$.Win=function(floatId,xPx,isLeft,autoHideTime){
	new SDA.Win(floatId,xPx,isLeft,autoHideTime);
}



SDA.UpDown = function(sdaId,height,pxStep,timeStep,timeStay){
	var curSda = this;
	
	var sdaObj = $("#"+sdaId);

    var h = 0;  
	
	if(pxStep== undefined){
		pxStep =15;		
	}
	
	if(timeStay == undefined){
		timeStay = 3000;
	}
	
	if(timeStep == undefined){
		
		timeStep = 10;
		
	}
 

	
	
	this.Up =function(){  
		
        if(h<=0){
            sdaObj.hide();            
            return;
        }else{
            h -= pxStep;
			h = h<0 ? 0:h;
            sdaObj.height(h);
			
            setTimeout(function(){
               curSda.Up();
            },timeStep); 
        }        
       
    
    }
	
	this.Down = function(){
        if(h>= height){		
			h = height;
            setTimeout( function(){
				curSda.Up();
			},timeStay);
           
        }else{
		
            h += pxStep;
			h = h>height? height:h;
            sdaObj.show();
            sdaObj.height(h);
			
            setTimeout(function(){
                curSda.Down();
            },timeStep); 
        }
    }	
	
	
	curSda.Down();
	
}

$.UpDown= function(sdaId,height,pxStep,timeStep,timeStay){	
	new SDA.UpDown(sdaId,height,pxStep,timeStep,timeStay);	
}
































headDl = {
	i:-1,
	d:[],
	l:0,
	x: function(i){
		i++;
		if( i >= this.l) i = 0;
		this.i = i;
		this.d.each(function(ii){
			if( ii == headDl.i){
				$(this).addClass('hover');
				$(this).next().show();		
			}else{
				$(this).removeClass('hover');
				$(this).next().hide();
			}
		});
	},
	init:function(id){
		this.d = $(id);
		this.l = $(id) ? $(id).length : 0;
		$(id).each(function(){
			$(this).mouseover(function(){
				var si = $(id).index($(this)) - 1;
				headDl.x(si);
			})
		})
		this.x(this.i);
		setInterval(function(){
			headDl.x(headDl.i);
		},5000);
	}
}



function PiaoFuAffix(obj){
    
    var wObject=(document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
    var topHeight=(wObject.scrollTop + wObject.clientHeight - $(obj).height())/2;
    var leftWidth = (wObject.scrollLeft + wObject.clientWidth - $(obj).width())/2;
   
    var loc={left:leftWidth+"px",top:topHeight+215+"px"};
    $(obj).css(loc);
    $(obj).show();
}





