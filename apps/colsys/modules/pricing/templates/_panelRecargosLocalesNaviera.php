<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">


PanelRecargosLocalesNaviera = function( config ){
    Ext.apply(this, config);


    this.panelRecargos = new PanelRecargosPorLinea({
                                          idtrafico: "99-999",
                                          impoexpo: this.impoexpo,
                                          transporte: this.transporte,
                                          modalidad: this.modalidad,
                                          idlinea: this.idlinea,
                                          title: "Recargos locales",
                                          closable: false,
                                          readOnly: this.readOnly
                                      });
    
    this.panelRecargosParametros = new PanelRecargosLocalesParametros({
                                          idtrafico: "99-999",
                                          impoexpo: this.impoexpo,
                                          transporte: this.transporte,
                                          modalidad: this.modalidad,
                                          idlinea: this.idlinea,
                                          title: "Parametros",
                                          closable: false,
                                          readOnly: this.readOnly
                                      });

    this.panelRecargosPatios = new PanelRecargosLocalesPatios({
                                          idtrafico: "99-999",
                                          impoexpo: this.impoexpo,
                                          transporte: this.transporte,
                                          modalidad: this.modalidad,
                                          idlinea: this.idlinea,
                                          title: "Patios",
                                          closable: false,
                                          readOnly: this.readOnly
                                      });

    PanelRecargosLocalesNaviera.superclass.constructor.call(this, {
        frame: true,
		width: 540,
		height: 400,
		closable: true,
		activeTab: 0,
        items: [
            this.panelRecargosParametros,
            this.panelRecargos,
            this.panelRecargosPatios
        ]
    });

};

Ext.extend(PanelRecargosLocalesNaviera, Ext.TabPanel, {

});

</script>
