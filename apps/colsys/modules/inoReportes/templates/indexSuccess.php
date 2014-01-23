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
            <td class="mostrar"><?=link_to("Listado de comprobantes", "inoReportes/listadoComprobantes") ?></td>
            <td class="mostrar">Lista los comprobantes de una referencia para efectos de auditoria</td>
        </tr>
        
        <!--
        <tr>  
            <td class="mostrar"><a href="repgenerator.php"  class="mudacor">Generador de Informes</a></td>
            <td class="mostrar">Módulo Contructor de Informes multimples opciones</td>
        </tr>
        <tr>  
            <td class="mostrar"><a href="repcomisiones.php"  class="mudacor">Comisiones</a></td>
            <td class="mostrar">Informe de Comisiones para Vendedores</td>
        </tr>
        <tr>  
            <td class="mostrar"><a href="reputilidades.php"  class="mudacor">Análisis de Utilidades</a></td>
            <td class="mostrar">Informe Análisis de Utilidades por Referencia</td></tr>
        <tr>  
            <td class="mostrar"><a href="repcarga.php"  class="mudacor">Carga por Surcursales</a></td>
            <td class="mostrar">Informe Movimiento de Carga por Sucursal</td>
        </tr>
        <tr>  
            <td class="mostrar"><a href="repnavieras.php"  class="mudacor">Carga por Navieras</a></td>
            <td class="mostrar">Informe Movimiento de Carga por Naviera</td>
        </tr>
        <tr>  
            <td class="mostrar"><a href="reptraficos.php"  class="mudacor">Carga por Tráficos</a></td>
            <td class="mostrar">Informe Movimiento de Carga por Tráfico</td>
        </tr>
        <tr>  
            <td class="mostrar"><a href="repconsolidado.php"  class="mudacor">Consolidado de Casos</a></td>
            <td class="mostrar">Consolidación de Referencias detallada por Tráficos</td></tr>
        <tr>  
            <td class="mostrar"><a href="/Coltrans/Reportes/FactMarEntrada.jsp"  class="mudacor">Elaboración de Facturas</a></td>
            <td class="mostrar">Informe con Fecha de Creación de facturas</td></tr>
        <tr>  
            <td class="mostrar"><a href="repreferencia.php"  class="mudacor">Libro de Referencias</a></td>
            <td class="mostrar">Informe de Referencias Procesadas</td></tr>
        <tr>  
            <td class="mostrar"><a href="repauditoria.php"  class="mudacor">Reporte de Auditoria</a></td>
            <td class="mostrar">Informe sobre Rastros de Auditoría</td>
        </tr>
        <tr>  
            <td class="mostrar"><a href="/reportesGer/reporteCargaTraficos"  class="mudacor">Listado carga por Tráficos</a></td>
            <td class="mostrar">lista de cargas por tráficos</td>
        </tr>-->
    </table>
</div>    
