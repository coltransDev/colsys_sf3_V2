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
                      group: this.group,
                      idproject: this.idproject,
                      department: this.department,
                      actionTicket: this.actionTicket,
                      assignedTo: this.assignedTo,
                      reportedBy: this.reportedBy,                      
                      readOnly: this.readOnly,
                      region: 'center'                      
                     });
    
    var idcomponent = this.id;    
    var idGrid = this.grid.getId();
    
    this.grid.on('beforerender', function(grid, rowIndex, columnIndex, e) {        
        if(this.department=="Sistemas"){
            grid.getColumnModel().setHidden(1, false);//Checkcolumn
            grid.getColumnModel().setHidden(12, false);//Fecha de Entrega            
        }
    });
   
    this.previewTicketPanel = new PanelPreviewTicket({idcomponent:idcomponent,
            idgrid: idGrid,
            idgroup: this.idgroup,
            department: this.department,
            region: 'south',
            deferredRender: false,
            activeTab: 0,     // first tab initially active
            height: 400,
            enableTabScroll:true,
            readOnly: this.readOnly
    });
    
    this.tbar = [
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
                text: 'Agenda',
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
            },            
            {
                text: 'Unificar Tickets',
                tooltip: 'Unifica los tickets seleccionados',
                iconCls: 'link',  // reference to our css
                scope: this,
                handler: this.unificar
            }
    ]
    
    if(this.department == "Sistemas"){
        this.tbar.push(  {
                    text: 'Re-Agendar Entregas',
                    tooltip: 'Agrupa los tickets por usuario',
                    iconCls: 'calendar-today',  // reference to our css
                    scope: this,
                    handler: this.programacion
                } )
    }

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
            layout:'border',            
            hideMode:'offsets',
            items:[
                this.grid,                
                {
                    layout:'fit',
                    items: this.previewTicketPanel,
                    height: 300,
                    split: true,
                    border:false,
                    region:'south'
                }]
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
    
    programacion: function(){
        this.grid.programacion(this.grid);
    },

    unificar: function(){
        this.grid.unificar(this.grid);
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