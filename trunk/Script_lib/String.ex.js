
if(!String.prototype.trim){

	String.prototype.trim = function(){
		alert("aaa");
		var str = this;

		str = str.replace(/^\s+/, '');
		for (var i = str.length - 1; i >= 0; i--) {
			if (/\S/.test(str.charAt(i))) {
				str = str.substring(0, i + 1);
				break;
			}
		}
		return str;
	}

}



String.prototype.HTMLEncode = function() { 
	var temp = document.createElement ("div"); 
	(temp.textContent != null) ? (temp.textContent = this) : (temp.innerText = this); 
	var output = temp.innerHTML; 
	temp = null; 
	return output; 
} 


String.prototype.HTMLDecode = function() { 
	var temp = document.createElement("div"); 
	temp.innerHTML = this; 
	var output = temp.innerText || temp.textContent; 
	temp = null; 
	return output; 
} 




String.prototype.longth = function (){
    return (this.replace(/[^\x00-\xff]/g, "rr").length);
}