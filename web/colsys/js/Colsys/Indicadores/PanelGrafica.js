Ext.define('Colsys.Indicadores.PanelGrafica', {
    alias: 'widget.wPanelGrafica',
    extend: 'Ext.panel.Panel',
    style: {
        border: 'solid',
        borderColor: '#157FCC',
        borderRadius: '10px',
        //padding: '10px',
        borderWidth: '2px',
        boxShadow: '5px 5px 5px #888888',
        margin: '2%',
        marginBottom: '6%'
    },
    listeners:{
        afterrender: function (ct, position) {            
            $('#'+ct.idgrafica + ct.indice + ct.idform + "-panel div").css({border: 'none'});            
        },
        render: function (ct, position) {
            agregarFooter(this, this.ngrafica, this.subtitulo, this.transporte);
        }
    }
});