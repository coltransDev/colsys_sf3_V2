<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
use_helper("ExtCalendar");


include_component("pm", "widgetDepartamentos");
include_component("pm", "widgetAsignaciones");
include_component("pm", "widgetGrupos");
?>
<div class="content" align="center">

    <h2>Informe Promedio de Tickets</h2>
    <br />

    <form action="<?= url_for("idgsistemas/informePromedioTickets") ?>" method="POST">
        <table class="tableList alignLeft" width="50%">
            <tr>
                <th>
                    Datos para la busqueda
                </th>
            </tr>            
            <tr>
                <td>
                    <b>Fecha Inicio:</b><br />

                    <div id="fchinicio_id">
                        <?
                        echo extDatePicker('fchinicio');
                        ?>
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <b>Fecha Fin:</b><br />

                    <div id="fchfin_id">
                        <?
                        echo extDatePicker('fchfin');
                        ?>
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <b>Departamento:</b>
                    <div id="wdg_departamentos"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <b>&Aacute;rea:</b>
                    <div id="wdg_grupo"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Usuario:</b>
                    <div id="wdg_usuario"></div>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Consultar" /></td>
            </tr>

        </table>
    </form>
</div>

<script type="text/javascript">
    var wdg = new WidgetDepartamentos({
        hiddenName: 'departamento',
        id: 'departamento_id',
        linkGrupos: "grupo",//
        linkAsignaciones: "usuario2"        
    });
    wdg.render("wdg_departamentos");
    
    
    var wdg = new WidgetGrupos({
        name: 'grupo',//
        id:'grupo',
        linkAsignaciones: "usuario2"
        

    });


    wdg.render("wdg_grupo");

    var wdgAsignaciones = new WidgetAsignaciones({
        id: 'usuario2',
        name: 'usuario2'
    })
    wdgAsignaciones.render("wdg_usuario");
    
</script>
