<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
    ReporteInoPanel = function( config ) {
        Ext.apply(this, config);

        this.grid1 = new ListaCamposGridPanel({idinforme: this.idinforme,
                                               boxMinHeight: 200,
                                               flex: 1
                                               });

        this.grid2 = new ListaFiltrosGridPanel({idinforme: this.idinforme,
                                               boxMinHeight: 200,
                                               flex: 1
                                               });
        ReporteInoPanel.superclass.constructor.call(this, {
            
            //id: 'form-ticket-panel',
            //autoHeight: true,
            bodyStyle:'padding:5px',
            layout:'vbox',
            layoutConfig: {
                align : 'stretch',
                pack  : 'start'
            },

            items: [
                 this.grid1,
                 this.grid2
                

            ],
            tbar:[
                {
                    text: 'Generar Informe',
                    iconCls: 'page_white_edit',
                    scope: this
                },
                {
                    text: 'Guardar Parametros',
                    iconCls: 'disk',
                    scope: this
                }
            ]
        });

       
    }

    Ext.extend(ReporteInoPanel, Ext.Panel, {

        
        

       

    
    });

</script>