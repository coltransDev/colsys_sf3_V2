/*
 * Ext JS Library 2.1
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 *
 * Esta versión se ha modificado ver comentarios
 */

Ext.grid.myRowExpander = function(config){
    Ext.apply(this, config);

    this.addEvents({
        beforeexpand : true,
        expand: true,
        beforecollapse: true,
        collapse: true
    });

    Ext.grid.RowExpander.superclass.constructor.call(this);

    if(this.tpl){
        if(typeof this.tpl == 'string'){
            this.tpl = new Ext.Template(this.tpl);
        }
        this.tpl.compile();
    }

    this.state = {};
    this.bodyContent = {};
};

Ext.extend(Ext.grid.myRowExpander, Ext.grid.RowExpander, {
   

    getRowClass : function(record, rowIndex, p, ds){
        p.cols = p.cols-1;
		
        var content = this.bodyContent[record.id];
		
        //if(!content && !this.lazyRender){		//hace que los comentarios no se borren cuando se guarda		
            content = this.getBodyContent(record, rowIndex);
        //}
		
        if(content){
            p.body = content;
        }
        return this.state[record.id] ? 'x-grid3-row-expanded' : 'x-grid3-row-collapsed';
    },

    
    getBodyContent : function(record, index){				
        if(!this.enableCaching){
            return this.tpl.apply(record.data);
        }
        var content = this.bodyContent[record.id];
        //if(!content){  //hace que los comentarios no se borren cuando se guarda
            content = this.tpl.apply(record.data);
            this.bodyContent[record.id] = content;
        //}
        return content;
    }
    
  

    
});
