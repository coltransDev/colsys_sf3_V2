<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if( $numtickets["p_tc"]+$numtickets["p_ta"]>0 ){
    $porcentaje = round( $numtickets["p_tc"]*100/($numtickets["p_tc"]+$numtickets["p_ta"]), 1);
}else{
    $porcentaje = 0;
}
?>
<script type="text/javascript">


PanelProyectos = function( config ){

    Ext.apply(this, config);

    this.panelTickets = new PanelTickets({
                                            title: 'Tickets',
                                            idproject: '<?=$project->getCaIdproject()?>'
                                        });

    this.panelMilestones = new PanelMilestones({
                                            title: 'Milestones',
                                            idproject: '<?=$project->getCaIdproject()?>'
                                        });

    this.panelArchivos = new PanelArchivos({
                                                folder:"<?=base64_encode($project->getDirectorioBase())?>",
                                                closable:true,                                                
                                                title:"Archivos",
                                                closable:false,
                                                boxMinHeight: 400
                                            });
    
    this.preview = new Ext.TabPanel({
            activeTab: 0,
            items: [
                this.panelTickets,
                this.panelMilestones,
                this.panelArchivos
            ]
    });


    PanelProyectos.superclass.constructor.call(this, {
        
        labelAlign: 'top',
        title: 'Sistema de Administración de Proyectos: <?=$project->getCaName()?>',
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
                                        text:'<?=$numtickets["p_ta"]." Tickets Abiertos/".$numtickets["p_tc"]." Tickets Cerrados ".$porcentaje."% Terminado "?>',
                                        value: <?=$porcentaje/100?>,
                                        fieldLabel: 'Estado del proyecto ',
                                        width: 450                                        
                                    })
                    ]
                    
                },
            this.preview
        ]

    });

    

};

Ext.extend(PanelProyectos, Ext.Panel, {


});

</script>