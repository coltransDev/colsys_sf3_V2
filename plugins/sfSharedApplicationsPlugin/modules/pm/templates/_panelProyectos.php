<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">


PanelProyectos = function( config ){

    Ext.apply(this, config);

    this.panelTickets = new PanelTickets({
                                            title: 'Tickets',
                                            idproject: this.idproject
                                            
                                        });

    this.panelMilestones = new PanelMilestones({
                                            title: 'Milestones',
                                            idproject: this.idproject                                            
                                        });

    this.panelArchivos = new PanelArchivos({                                               
                                                            
                                                title:"Archivos",
                                                closable:false,                                                
                                                idproject: this.idproject,
                                                folder: this.folder
                                            });
    
    this.preview = new Ext.TabPanel({
            activeTab: 0,           
            height: 500,
            items: [
                this.panelTickets,
                this.panelMilestones,
                this.panelArchivos
            ]
    });

    var idcomponent = this.id;
    PanelProyectos.superclass.constructor.call(this, {
        
        labelAlign: 'top',        
        bodyStyle:'padding:1px',
		//fileUpload: true,
        items: [
            {
                    
                    layout:'form',
                    //defaults: {width: 470},
                    
                    labelWidth: 140,
                    bodyStyle: 'padding: 10px',
                    items: [
                       new Ext.ProgressBar({
                                        id: idcomponent+"-progressbar",
                                        text:'',
                                        value: '',
                                        fieldLabel: 'Estado del proyecto ',
                                        width: 450                                        
                                    })
                    ]
                    
                },
                this.preview
        ]

    });

    
    Ext.Ajax.request({

        url: '<?=url_for("pm/estadoPanelProyectos")?>',
        method: 'POST',
        //Solamente se envian los cambios
        params :	{idproject:this.idproject},

        callback :function(options, success, response){

            var res = Ext.util.JSON.decode( response.responseText );
            if( res.success ){   
                pbar = Ext.getCmp(idcomponent+"-progressbar");
                pbar.reset();
                pbar.updateText( res.text );
                pbar.updateProgress( res.progress );

            }
        }
     });



    

};

Ext.extend(PanelProyectos, Ext.Panel, {


});

</script>