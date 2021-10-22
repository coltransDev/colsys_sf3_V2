
/**
 * @class Ext.form.NumberFieldMin
 * @extends Ext.form.NumberField
 * Numeric text field that provides automatic keystroke filtering and numeric validation.
 * @constructor
 * Creates a new NumberField
 * @param {Object} config Configuration options
 */
Ext.form.NumberFieldMin = Ext.extend(Ext.form.NumberField,  {
    
    /**
     * @cfg {String} baseChars The base set of characters to evaluate as valid numbers (defaults to '0123456789').
     */
    baseChars : "0123456789/",
	
	
	
    // private
    validateValue : function(value){  
		
		if(!Ext.form.NumberField.superclass.validateValue.call(this, value)){
            return false;
        }
		 
        if(value.length < 1){ // if it's blank and textfield didn't flag it then it's valid
             return true;
        }
		var index = value.indexOf("/");
		if( index ){
			var value1 = value.substring(0, index);
			var value2 = value.substring(index+1, 20); 
			
			if(isNaN(value1)||isNaN(value2)){
				this.markInvalid(String.format(this.nanText, value));
				return false;
			}
			
		}else{
			value = String(value).replace(this.decimalSeparator, ".");
			if(isNaN(value)){
				this.markInvalid(String.format(this.nanText, value));
				return false;
			}
		}       
        return true;
    },

    getValue : function(){
		return Ext.form.NumberField.superclass.getValue.call(this);
    },

    setValue : function(v){    
        Ext.form.NumberField.superclass.setValue.call(this, v);
    }
   
});




var rendererMin=function( value ){
	if( !value ){
		return '';	
	}
	if( value == 0 ){
		return '';
	}
	
	var index = value.indexOf("/");
	if( index!=-1 ){			
		var value1 = value.substring(0, index);
		var value2 = value.substring(index+1, 20); 		
		return formatNumber(value1)+"/Min"+formatNumber(value2);
	}else{
		return formatNumber(value);
	}	
};

var rendererSug=function( value ){
	
	if( !value ){
		return '';	
	}
	if( value == 0 ){
		return '';
	}
	
	var index = value.indexOf("/");
	if( index!=-1 ){			
		var value1 = value.substring(0, index);
		var value2 = value.substring(index+1, 20); 		
		return formatNumber(value1)+"/Sug"+formatNumber(value2);
	}else{
		return formatNumber(value);
	}	
};
