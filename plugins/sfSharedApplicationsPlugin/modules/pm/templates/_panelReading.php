<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<script type="text/javascript">

PanelReading = function( config ){

    Ext.apply(this, config);
    
    this.grid = new PanelTickets({id:idcomponent,
                      idgroup: this.idgroup,
                      idproject: this.idproject,
                      actionTicket: this.actionTicket,
                      assignedTo: this.assignedTo,
                      reportedBy: this.reportedBy,                      
                      readOnly: this.readOnly,
                      region: 'center'                      
                     });

    var idcomponent = this.id;
   
    
    this.previewTicketPanel = new PanelPreviewTicket({idcomponent:idcomponent,
            department: this.department,
            region: 'south',
            deferredRender: false,
            activeTab: 0,     // first tab initially active
            height: 400,
            enableTabScroll:true,
            readOnly: this.readOnly
    });
    
    this.tbar = [

                /*{
                    split:true,
                    text:'Panel Lectura',
                    tooltip: {title:'Reading Pane',text:'Show, move or hide the Reading Pane'},
                    iconCls: 'preview-bottom',
                    handler: this.movePreview.createDelegate(this, []),
                    menu:{
                        id:'reading-menu-'+idcomponent,
                        cls:'reading-menu',
                        width:100,
                        items: [{
                            text:'Abajo',
                            checked:true,
                            group:'rp-group',
                            checkHandler:this.movePreview,
                            scope:this,
                            iconCls:'preview-bottom'
                        },{
                            text:'Derecha',
                            checked:false,
                            group:'rp-group',
                            checkHandler:this.movePreview,
                            scope:this,
                            iconCls:'preview-right'
                        },{
                            text:'Ocultar',
                            checked:false,
                            group:'rp-group',
                            checkHandler:this.movePreview,
                            scope:this,
                            iconCls:'preview-hide'
                        }]
                    }
                },*/
                {
                    text: 'Nuevo ticket',
                    tooltip: '',
                    iconCls: 'add',  // reference to our css
                    scope: this,
                    handler: this.crearTicket
                },
                {
                    text: 'Recargar',
                    tooltip: 'Actualiza losdatos del panel',
                    iconCls: 'refresh',  // reference to our css
                    scope: this,
                    handler: this.recargar
                },
                {
                    text: 'Roadmap',
                    tooltip: 'Permite ver el cronograma de entrega de los tickets',
                    iconCls: 'calendar',  // reference to our css
                    scope: this,
                    handler: this.roadmap
                },

                {
                    text: 'Asignaciones',
                    tooltip: 'Agrupa los tickets por usuario',
                    iconCls: 'tux',  // reference to our css
                    scope: this,
                    handler: function(){
                        this.agruparPor('assignedto');
                    }
                }
    ]

    if( this.idproject ){
        this.tbar.push(  {
                    text: 'Asignar milestone',
                    tooltip: 'Asigna un milestone a los elementos seleccionados',
                    iconCls: 'calendar',  // reference to our css
                    scope: this,
                    handler: this.asignarMilestone
                } )
    }

    
    PanelReading.superclass.constructor.call(this, {                       
        margins:'0 5 5 0',              
        layout: 'fit',        
        tbar: this.tbar,        
        
        items: {
            //id:'main-view',
            layout:'border',
            //title:'Loading...',
            hideMode:'offsets',
            items:[
                this.grid,
                //this.tabPanel
            {

                //id:'bottom-preview-'+idcomponent,
                layout:'fit',
                items: this.previewTicketPanel,
                height: 300,
                split: true,
                border:false,
                region:'south'
            }/*, {
                id:'right-preview-'+idcomponent,
                layout:'fit',
                border:false,
                region:'east',
                width: 400,
                split: true,
                hidden:true
            }*/]
        }

      
      
      
    });

    this.gsm = this.grid.getSelectionModel();

    this.gsm.on('rowselect', this.onRowSelect, this, {buffer:250});

};

Ext.extend(PanelReading, Ext.Panel, {
    
    getTemplate: function(){
        return this.tpl;
    },

    recargar: function(){
        this.grid.recargar();
    },

    crearTicket: function(){
        this.grid.crearTicket();
    },

    roadmap: function(){
        this.grid.roadmap();
    },

    agruparPor: function( val ){
        this.grid.agruparPor( val );
    },

    asignarMilestone: function( val ){
        this.grid.asignarMilestone( val );
    },
    
    onRowSelect: function(sm, index, record){
        this.idticket = record.data.idticket;
        this.previewTicketPanel.loadRecord( record );
    }
   
});

</script>