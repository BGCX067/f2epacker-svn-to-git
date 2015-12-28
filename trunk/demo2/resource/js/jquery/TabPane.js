

  function TabBox(selectRule,n){  
		$(selectRule).find(".t-t").each(function(i){
			if(i==n){
				$(this).addClass("cur");
				$.cookie("category_index",n);
			}else{
				$(this).removeClass("cur");
			}
		});
		
		$(selectRule).find(".t-c").each(function(i){
			if(i==n){
				$(this).show();
			}else{
				$(this).hide();
			}
		});

}

	function TabBox_init(){
		//tabBox
		$(".tabBox").each(function(){
			var tabCur= this;
			$(this).find(".t-t").each(function(i){
				$(this).click(function(){
					TabBox(tabCur,i);
				});
				
			});
			$(this).find(".t-t").each(function(i){
				var curIndex = parseInt($.cookie("category_index"));
				if(i==curIndex){
					TabBox(tabCur,curIndex);
				}
				
			});
			

		});
		
		
	}

	function MutiplePane_init(myArea,bHover){
	    var selectRule = ".MutiplePane";
	    
	    if(myArea!= undefined){
	        selectRule = myArea +" "+ selectRule;

	    }
	    if (bHover != undefined) {
	        TabSwitch(selectRule);
	    }
	    
	    
		$(selectRule).each(function(){
			var curPane=this;
			var tObj = $(curPane).find(".m-t");
			var cObj = $(curPane).find(".m-c");

			tObj.each(function(i){
				$(this).click(function(){
					tObj.each(function(j){
						if(i==j){
							$(this).addClass("cur");						
						}else{
							$(this).removeClass("cur");
						}
					});

					cObj.each(function(k){
						if(i==k){							
							$(this).show();							
						}else{
							$(this).hide();
						}
					});				
					
				});				
				
			});
		});
	}


	function TabSwitch(selectRule) {
		
	    //1.获取元素
	    var sltElm = $(selectRule);
	    
	    sltElm.start = 0;
     
	    //2.获取事件触发元素。
	    var sltMt= $(sltElm).find(".m-t");

	    $(sltMt).each(function(i) {
	        $(this).hover(
              function() {
	              $(this).trigger("click");
                  if (sltElm.timeOut) {
                      clearInterval(sltElm.timeOut);
                      sltElm.start = i;
                  }
              },
              function() {
				 
                  sltElm.timeOut = setInterval(function() {
                      sltMt.each(function(i) {
                          if (sltElm.start > sltMt.length - 1) {
                              sltElm.start = 0;
                          }
                          if (sltElm.start == i) {
                              $(this).trigger("click");
                              
                          }

                      });
					  sltElm.start++;
					  window.startNum=sltElm.start;
                  }, 5000);
              }
            );

	    });
	    
	    //3.停止事件，
	    //4.停止事件后的重新开始事件。

	    //5.开始循环触发
	    sltElm.timeOut = setInterval(function() {
	        sltMt.each(function(i) {
	            if (sltElm.start > sltMt.length- 1) {
	                sltElm.start = 0;
	            }
	            if (sltElm.start == i) {
	                $(this).trigger("click");
	               
	            }

	        });
			sltElm.start++;
			window.startNum=sltElm.start;
	    }, 5000);
	    
	  
	  


	}

	function SingePane_init() {
	    $(".SinglePane").each(function(i) {
	        var singleCur = this;
	        var tObj = $(singleCur).find(".s-t");
	        var cObj = $(singleCur).find(".s-c");
	        var cssStyle = $(singleCur).hasClass("pane");
	        if (!cssStyle) {
	            if (cObj.css("display") == "none") {
	                tObj.addClass("close");
	            } else {
	                tObj.removeClass("close");
	            }
	        } else {
	            if (cObj.hasClass("pane_css")) {
	                tObj.addClass("close");
	            } else {
	                tObj.removeClass("close");
	            }
	        }
	        tObj.click(function() {	        

	            if (!cssStyle) {
	               
	                cObj.toggle();
	                if (cObj.css("display") == "none") {
	                    $(this).addClass("close");
	                } else {
	                    $(this).removeClass("close");
	                }
	            } else {
	               
	                cObj.toggleClass("pane_css");
	                if (cObj.hasClass("pane_css")) {
	                    $(this).addClass("close");
	                } else {
	                    $(this).removeClass("close");
	                }
	            }
	        });
	    })
	}


	function HoverPane_init() {
	    $(".HoverPane").each(function(i) {
	        var singleCur = this;
	        var tObj = $(singleCur).find(".h-t");
	        var cObj = $(singleCur).find(".h-c");	        

	        tObj.hover(
				function() {
					cObj.show();
					$(singleCur).addClass("hpOver");
				},
				function() {
					singleCur.timeout = setTimeout(function() {
						cObj.hide();
						$(singleCur).removeClass("hpOver");
					}, 800);
				}
              );
	        cObj.hover(function() {
	                clearTimeout(singleCur.timeout);
	                cObj.show();
					$(singleCur).addClass("hpOver");
	            },
                  function() {
                      cObj.hide();
					  $(singleCur).removeClass("hpOver");
                  }
              );
	    });
	}



	$(document).ready(function() {
	    TabBox_init();
	    SingePane_init();
	    MutiplePane_init();
	    HoverPane_init();
	});


	