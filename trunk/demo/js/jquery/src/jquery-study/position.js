


jQuery.fn.extend({
	position: function() {
		if ( !this[0] ) {	 //this[0] :  this为jquery对象，【0】为当前对象所含的dom元素本身
			return null;
		}

		var elem = this[0],		   //dom元素

		// Get *real* offsetParent
		offsetParent = this.offsetParent(),

		// Get correct offsets
		offset       = this.offset(),
		parentOffset = /^body|html$/i.test(offsetParent[0].nodeName) ? { top: 0, left: 0 } : offsetParent.offset();

		// Subtract element margins
		// note: when an element has margin: auto the offsetLeft and marginLeft
		// are the same in Safari causing offset.left to incorrectly be 0
		offset.top  -= parseFloat( jQuery.curCSS(elem, "marginTop",  true) ) || 0;
		offset.left -= parseFloat( jQuery.curCSS(elem, "marginLeft", true) ) || 0;

		// Add offsetParent borders
		parentOffset.top  += parseFloat( jQuery.curCSS(offsetParent[0], "borderTopWidth",  true) ) || 0;
		parentOffset.left += parseFloat( jQuery.curCSS(offsetParent[0], "borderLeftWidth", true) ) || 0;

		// Subtract the two offsets
		return {
			top:  offset.top  - parentOffset.top,
			left: offset.left - parentOffset.left
		};
	},

	offsetParent: function() {

		/*
		  返回第一个匹配元素用于定位的父节点。

			这返回父元素中第一个其position设为relative或者absolute的元素。此方法仅对可见元素有效。

		*/

		return this.map(function() {

			var offsetParent = this.offsetParent || document.body;
			while ( 
					offsetParent 
				&& 
					(!/^body|html$/i.test(offsetParent.nodeName) 
				&& 
					jQuery.css(offsetParent, "position") === "static") 
			) {
				offsetParent = offsetParent.offsetParent;
			}
			return offsetParent;
		});
	}
});