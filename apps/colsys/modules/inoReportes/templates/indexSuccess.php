<div class="content" align="center" >
    <h1>Indice de Reportes</h1>
    <br />
    <table class="tableList" width="80% ">
        <tr>
            <td class="titulo" width="110">Nombre</td>
            <td class="titulo">Detalle</td>
        </tr>
        <?if($empresa=='TPLogistics'){?>
        <tr>  
            <td class="mostrar"><?=link_to("Cuadro INO Inicial", "inoReportes/cuadroIno") ?></td>
            <td class="mostrar">Informe para Gerencia Cuadro INO hasta Febrero 2013</td>
        </tr>
        <tr>  
            <td class="mostrar"><?=link_to("Cuadro INO Complemento", "inoReportes/cuadroInoComplemento") ?></td>
            <td class="mostrar">Informe para Gerencia Cuadro INO a partir Marzo 2013</td>
        </tr>
        <?}else{?>
        <tr>  
            <td class="mostrar"><?=link_to("Cuadro INO", "inoReportes/cuadroIno") ?></td>
            <td class="mostrar">Informe para Gerencia Cuadro INO</td>
        </tr>
        <?}?>
        <tr>  
            <td class="mostrar"><?=link_to("Reporte de Comisiones", "inoReportes/reporteComisiones") ?></td>
            <td class="mostrar">Reporte de Comisiones por vendedor</td>
        </tr>
        <tr>  
            <td class="mostrar"><?=link_to("Reporte de Comisiones", "inoReportes/reporteComisiones") ?></td>
            <td class="mostrar">Reporte de Comisiones por vendedor</td>
        </tr>
        <tr>  
            <td class="mostrar"><?=link_to("Listado de comprobantes", "inoReportes/listadoComprobantes") ?></td>
            <td class="mostrar">Lista los comprobantes de una referencia para efectos de auditoria</td>
        </tr>        
    </table>
</div>    
