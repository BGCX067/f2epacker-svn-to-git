var Class = {
    create: function() {
        return function() {
            this.initialize.apply(this, arguments);
        }
    }
}
Object.extend = function(destination, source) {
    for (var property in source) {
        destination[property] = source[property];
    }
    return destination;
}

Object.extend(Object, {
    inspect: function(object) {
        try {
            if (object === undefined) return 'undefined';
            if (object === null) return 'null';
            return object.inspect ? object.inspect() : object.toString();
        } catch (e) {
            if (e instanceof RangeError) return '...';
            throw e;
        }
    },

    keys: function(object) {
        var keys = [];
        for (var property in object)
            keys.push(property);
        return keys;
    },

    values: function(object) {
        var values = [];
        for (var property in object)
            values.push(object[property]);
        return values;
    },

    clone: function(object) {
        return Object.extend({}, object);
    }
});

window.__Debug = new Object();









var GoodsLib = {}

GoodsLib.SpecInit = function(objPrice) {
    $(".J_Spec").each(function() {
        var mySpec = this;
        var propArray = $(mySpec).find(".J_Prop");
        propArray.each(function() {
            var myProp = this;
            $(myProp).click(function() {

                if (!$(myProp).hasClass("cur")) {
                    var specId = $(myProp).attr("spec_id");
                    var propId = $(myProp).attr("prop_id");
                    var propName = $(myProp).find(".J_PropName").text();
                    var propPrice = $(myProp).find(".J_PropPrice").text();
                    var iptResult = $("#J_SpecResult_" + specId);
                    iptResult.attr("price", propPrice).attr("name", 'std_property[' + propId + ']');

                    $("#J_selSpec_" + specId).text(propName);



                    propArray.each(function() {
                        $(this).removeClass("cur");
                    });
                    $(myProp).addClass("cur");

                    if ($('#J_CongfigSpec_' + specId).get(0)) {
                        var jCongfigSpec = $('#J_CongfigSpec_' + specId);
                        $(jCongfigSpec).find(".J_PropName").text(propName).attr("prop_id", propId);
                        $(jCongfigSpec).find(".J_PropPrice").text(propPrice);
                    }

                    //计算总价
                    //函数调用
                    if (objPrice) {
                        objPrice.priceTotal();
                    }
                }
            });

        });

    });

};

GoodsLib.getCommission = function(_totalPrice, _rate, _policy, _amount) {
    ///<summary>计算佣金率</summary>
    _policy = parseInt(_policy);
    if (_policy == 1) {
        return _totalPrice;
    } else if (_policy == 2) {
        var c_price = _totalPrice * _rate;
        var retPrice = Math.ceil(c_price / 100) * 100;
        return Math.min(retPrice, _totalPrice);
    } else if (_policy == 3) {
        return Math.min(_totalPrice, _amount);
    } else if (_policy == 4) {
        return parseFloat(_amount);
    } else if (_policy == 5) {
		
        if (_amount == 1) {
            return _totalPrice;
        } else {
			var c_price = _totalPrice * _amount;
            var retPrice = Math.ceil(c_price);			
            return Math.min(retPrice, _totalPrice);
        }

    } else if (_policy == 6) {
        return parseFloat(_amount);
    } else {
        return _totalPrice;
    }
}






function round2(x, y) {
    
    if (y == undefined) {
        y = 2;
    }
    var p = Math.pow(10, y);
    x *= p;
    x = Math.round(x);
    return x / p;
}
