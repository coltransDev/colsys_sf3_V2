<?php
/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
include_component("inventory", "panelCategorias");
use_helper("ExtCalendar");
?>

<script type="text/javascript">
    showHideBajas = function(){
        if( document.getElementById("bajasChkbox").checked ){
            document.getElementById("bajas").style.display = "";
        }else{
            document.getElementById("bajas").style.display = "none";
        }
    }
</script>
<div class="content" align="center">
    <h2>Listados de Activos</h2>
    <br />
    <form action="<?= url_for("inventory/informeListadoActivosResult") ?>" method="post">
        <input type="hidden" id="idcategory" name="idcategory" />
        <table class="tableList alignLeft" width="60%" >
            <tr>
                <th colspan="2">
                    Ingrese los criterios de busqueda
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Sucursal:</b>
                    <br />
                    <select name="idsucursal">
                        <option value="">Todas</option>
                        <?
                        foreach ($sucursales as $s) {
                            ?>
                            <option value="<?= $s->getCaIdsucursal() ?>"><?= $s->getCaNombre() ?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <b>Categoria:</b>
                    <br />
                    <div id="panel"></div>
                </td>
                <td valign="top">
                    <b>Seleccionadas:</b>
                    <br />
                    <div id="panel2"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                   <input type="checkbox" name="bajasChkbox" id="bajasChkbox" onClick="showHideBajas()" /> Incluir dados de baja
                   <div id="bajas" >
                       <b>Fecha de Inicio</b>
                       
                       <?=extDatePicker("fchbajainicio", date("Y-m-d", time()-86400*120))?>
                       <br />
                       <b>Fecha Final</b>
                       
                       <?=extDatePicker("fchbajafinal", date("Y-m-d", time()))?>
                   </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" value="Consultar" />
                    </div>
                </td>
            </tr>
        </table>
    </form>

</div>

<script type="text/javascript">
    Ext.onReady(function(){
        showHideBajas();
        
        var panelConsulta = new PanelCategorias({
            title: "",                        
            idsucursal: "",
            enableDrag:true,  
            readOnly: true,
            onClick: function( n ){
                if( n.leaf ){  // ignore clicks on folders           
                    //alert("OK");            
                }else{
                    n.expand();
                }
            }
            ,listeners:{
                startdrag:function() {
                    alert("asdasd");
                    var t = Ext.getCmp('target').body.child('div.drop-target');
                    if(t) {
                        t.applyStyles({'background-color':'#f0f0f0'});
                    }
                }
                ,enddrag:function() {
                    var t = Ext.getCmp('target').body.child('div.drop-target');
                    if(t) {
                        t.applyStyles({'background-color':'white'});
                    }
                }
            }
        });
        
        var target = new Ext.Panel({
            region:'center'
            ,layout:'fit'
            ,id:'target'
            ,bodyStyle:'font-size:13px'
            //,title:'Drop Target'
            ,html:'<div class="drop-target" '
                +'style="border:1px silver solid;margin:20px;padding:8px;height:140px">'
                +'Arrastre aca la categoria que desea consultar.</div>'
 
            // setup drop target after we're rendered
            ,afterRender:function() {                
                Ext.Panel.prototype.afterRender.apply(this, arguments);
                this.dropTarget = this.body.child('div.drop-target');
                var dd = new Ext.dd.DropTarget(this.dropTarget, {
                    // must be same as for tree
                    ddGroup:'TreeDD'
 
                    // what to do when user drops a node here
                    ,notifyDrop:function(dd, e, node) {
                        if( node.node.attributes.main ){
                            return false;
                        }
                        // var t = Ext.getCmp('target').body;
                        var msg = '<i>Usted va a consultar:</i><br><br><table style="font-size:13px">';                       
                        msg += '<tr><td>Categoria:</td><td><b>' + node.node.attributes.data + '</b></td></tr>';
                        msg += '</table>'
                        Ext.getCmp('target').body.child('div.drop-target').update(msg)
                        
                        document.getElementById("idcategory").value = node.node.id;
                        return true;
                    } // eo function notifyDrop
                });
            } // eo function afterRender
        });
        
    
        panelConsulta.render("panel");
        target.render("panel2");
    });
</script>