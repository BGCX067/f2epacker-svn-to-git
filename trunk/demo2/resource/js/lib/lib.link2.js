function gl(o){ var v=o.offsetLeft;while((o=o.offsetParent)!=null){if(o.tagName!='HTML')v+= o.offsetLeft;}return v;}
function change(x) {$('#'+x).hide();} 
function onClickbox(x){$('#'+x).show();} 

var timeOut=[];
function onMouseOutbox(x){
	timeOut[x]= window.setTimeout( function() {
		$('#'+x).hide();
	 },500);
} 
function onMouseOverbox(x){
	window.clearTimeout(timeOut[x]);
	$('#'+x).show();

} 
function getRandom(max) {return parseInt( Math.random() * (- max) + (max + 1));}
function indexJump(url){if(url.substr(0,4)!='http'){url='http://'+url;}location.href=url}



var Base64 = {};

Base64.EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
Base64.DecodeChars = new Array(-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1, -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);

Base64.encode=function(str){
    var out, i, len;
    var c1, c2, c3;

    len = str.length;
    i = 0;
    out = "";
    while (i < len) {
        c1 = str.charCodeAt(i++) & 0xff;
        if (i == len) {
            out += this.EncodeChars.charAt(c1 >> 2);
            out += this.EncodeChars.charAt((c1 & 0x3) << 4);
            out += "==";
            break;
        }
        c2 = str.charCodeAt(i++);
        if (i == len) {
            out += this.EncodeChars.charAt(c1 >> 2);
            out += this.EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
            out += this.EncodeChars.charAt((c2 & 0xF) << 2);
            out += "=";
            break;
        }
        c3 = str.charCodeAt(i++);
        out += this.EncodeChars.charAt(c1 >> 2);
        out += this.EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
        out += this.EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >> 6));
        out += this.EncodeChars.charAt(c3 & 0x3F);
    }
    return out;
}

Base64.decode = function(str) {


    var c1, c2, c3, c4;
    var i, len, out;

    len = str.length;
    i = 0;
    out = "";
    while (i < len) {
        /* c1 */
        do {
            c1 = this.DecodeChars[str.charCodeAt(i++) & 0xff];
        }
        while (i < len && c1 == -1);
        if (c1 == -1)
            break;

        /* c2 */
        do {
            c2 = this.DecodeChars[str.charCodeAt(i++) & 0xff];
        }
        while (i < len && c2 == -1);
        if (c2 == -1)
            break;

        out += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));

        /* c3 */
        do {
            c3 = str.charCodeAt(i++) & 0xff;
            if (c3 == 61)
                return out;
            c3 = this.DecodeChars[c3];
        }
        while (i < len && c3 == -1);
        if (c3 == -1)
            break;

        out += String.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));

        /* c4 */
        do {
            c4 = str.charCodeAt(i++) & 0xff;
            if (c4 == 61)
                return out;
            c4 = this.DecodeChars[c4];
        }
        while (i < len && c4 == -1);
        if (c4 == -1)
            break;
        out += String.fromCharCode(((c3 & 0x03) << 6) | c4);
    }
    return out;
}

Base64.decodeUtf8 = function(str) {
   return utf8to16(this.decode(str));

}





/*
* Interfaces:
* utf8 = utf16to8(utf16);
* utf16 = utf16to8(utf8);
*/

function utf16to8(str) {
    var out, i, len, c;

    out = "";
    len = str.length;
    for (i = 0; i < len; i++) {
        c = str.charCodeAt(i);
        if ((c >= 0x0001) && (c <= 0x007F)) {
            out += str.charAt(i);
        } else if (c > 0x07FF) {
            out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));
            out += String.fromCharCode(0x80 | ((c >> 6) & 0x3F));
            out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
        } else {
            out += String.fromCharCode(0xC0 | ((c >> 6) & 0x1F));
            out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
        }
    }
    return out;
}

function utf8to16(str) {
    var out, i, len, c;
    var char2, char3;

    out = "";
    len = str.length;
    i = 0;
    while (i < len) {
        c = str.charCodeAt(i++);
        switch (c >> 4) {
            case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
                // 0xxxxxxx
                out += str.charAt(i - 1);
                break;
            case 12: case 13:
                // 110x xxxx   10xx xxxx
                char2 = str.charCodeAt(i++);
                out += String.fromCharCode(((c & 0x1F) << 6) | (char2 & 0x3F));
                break;
            case 14:
                // 1110 xxxx  10xx xxxx  10xx xxxx
                char2 = str.charCodeAt(i++);
                char3 = str.charCodeAt(i++);
                out += String.fromCharCode(((c & 0x0F) << 12) |
                                           ((char2 & 0x3F) << 6) |
                                           ((char3 & 0x3F) << 0));
                break;
        }
    }

    return out;
}




function TextAutoScroll() {
    $(".textScrollSda").each(function() {
        var curObj = this;

        setInterval(function() {
            $(obj).find("ul:first").animate({

                marginTop: "-22px"

            }, 500, function() {

                $(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);

            });
        }, 4000);      

    });
}


/*=时间处理=*/

function str2date(str) {
    /*=str：yy-mm-dd hh:mm:ss=*/
    var d = null;
    var reg = /^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/;
    if (arr = str.match(reg)) d = new Date(Number(arr[1]), Number(arr[2]) - 1, Number(arr[3]), Number(arr[4]), Number(arr[5]), Number(arr[6]));
    return d;
}

function timeCountDown(msSpan) {
    var day = Math.floor(msSpan / 86400); //天
    var hour = Math.floor((msSpan - day * 86400) / 3600); //小时
    var minute = Math.floor((msSpan - ((day * 86400) + (hour * 3600))) / 60); //分
    //var second = seconds % 60;//秒

    //格式化输出时间为x天x小时xx分xx秒
    var output = "";
    output += (day <= 0) ? "" : (day + '天 '); //天
    output += (hour <= 0) ? "" : (hour + '小时 '); //小时
    output += ((minute <= 0) ? "" : (minute < 10 ? ('0' + minute) : minute) + '分 '); //分
   // output += ((second < 10) ? ('0' + second) : second) + '秒'; //秒

    return output;

}





