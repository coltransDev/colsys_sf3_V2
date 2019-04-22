Ext.define('Colsys.Status.PanelHeaderHouse', {    
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Status.PanelHeaderHouse',
    border: false,                                        
    style: {
        backgroundColor: '#5097CA',
        borderRadius: '4px'
    },    
    tpl: new Ext.XTemplate(
        '<div class="text-wrapper">'+
            '<div class="news-data">'+
                '<div class="news-picture"><img src="{url}"></div>'+
                '<table><tr><td>'+
                    '<div class="news-content">' +                                                        
                        '<div class="news-title">{cliente}' +
                            '<tpl if="global === true">'+
                                '<img src="/images/CG30.png" />' +
                            '</tpl>' +
                            '<tpl if="comunicaciones === true">',
                                '<img src="/images/consolidate.png" />' +
                            '</tpl>' +
                        '</div>' +
                        '<div class="news-small">Nit <span class="news-author">{idcliente}</span>' +
//                        '&nbsp;<a href="/reportesNeg/emailInstruccionesOtm/idreporte/{idreporte}" target="_blank"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>' +
                        '<div class="news-small">Vendedor <span class="news-author">{vendedor}</span>' +
                    '</div>'+                                                    
                '</td>'+                
                '<td><div class="news-content">'+
                '<div class="">{reporte:ellipsis(130, true)}<a href="/reportesNeg/verReporte/id/{idreporte}" target="_blank">&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div><div class="news-small"><span class="news-author">REPORTE DE NEGOCIO</span></div>'+
                '<div class="">{doctransporte:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">HBL</span></div>'+
                '</div></td>'+
                '<td><div class="news-content">'+
                '<div class="">{numpiezas:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">PIEZAS</span></div>'+
                '<div class="">{peso:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">PESO</span></div>'+
                '</div></td>'+
                '<td><div class="news-content">'+
                '<div class="">{volumen:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">VOLUMEN</span></div>'+
                '<div class="">Id:{idtercero:ellipsis(130, true)} - {tercero:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">PROVEEDOR</span></div>'+
                '</div></td>'+  
//                '<td><div class="news-content">'+
//                '<tpl if="global === true">',
//                            '<div class=""><img src="/images/CG30.png" /></div>' +
//                        '</tpl>',
//                        '<tpl if="comunicaciones === true">',
//                            '<div class=""><img src="/images/consolidate.png" /></div>' +
//                        '</tpl>',
//                '</div></td>'+  
                '</tr></table>'+
                '<table><tr><td><div><a href="/traficos/verHistorialStatus/idreporte/{idreporte}" target="_blank">Ver historial de status</a></div></td></tr></table>'+
            '</div>'+
        '</div>'        
    ),    
    listeners:{
        beforerender:function (me, eOpts){                                                
            me.setWidth("90%");
        }
    }
});