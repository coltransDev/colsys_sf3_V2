<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("gestDocumental", "panelArchivos");
include_component("gestDocumental", "panelDirectorios");
?>
<script type="text/javascript">
    /**
     * FileManagerPanel object definition
     **/
    FileManagerPanel = function( config ){
        Ext.apply(this, config);

        FileManagerPanel.superclass.constructor.call(this, {
            layout: 'border',
            items:[
                new PanelDirectorios({
                    region: 'west',
                    split: true,
                    width: 200,
                    minSize: 175,
                    maxSize: 400,
                    collapsible: true,
                    folder: this.folder
                }),
                new PanelArchivos({
                    region: 'center',
                    folder: this.folder
                })
            ]
        });

        
    }

    Ext.extend(FileManagerPanel, Ext.Panel, {
    
    
    });

</script>