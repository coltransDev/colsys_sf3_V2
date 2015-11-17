<script type="text/javascript" src="/js/highcharts/js/highcharts.js"></script>
<script type="text/javascript" src="/js/highcharts/js/modules/exporting.js"></script>
<?
$options = $sf_data->getRaw("options");
$filtros = array("login","idcliente","idservicio","pregunta");

foreach($filtros as $filtro){
    if(isset($options[$filtro]) && $options[$filtro]){
        $subtitle = 'Filtros:';
        $options["subtitle"] = $subtitle;
        break;
    }
} 

if (count($grid1)) {
    include_component("formulario", "reporteEncuestas", array("grid" => $grid1, "formulario" => $formulario, "servicio" => $servicio, "options" => $options));
    include_component("formulario", "reportePorNumSucursalServicio", array("grid" => $encuestas5, "formulario" => $formulario, "sucursales" => $sucRes, "options" => $options));
    include_component("formulario", "reportePorSucursal", array("grid" => $grid2, "formulario" => $formulario, "servicio" => $servicio, "options" => $options));    
    include_component("formulario", "reportePorServicio", array("grid" => $grid3, "formulario" => $formulario, "options" => $options));
    include_component("formulario", "reportePorSucursalServicio", array("grid" => $encuestas3, "formulario" => $formulario, "sucursales" => $sucRes, "options" => $options));
    include_component("formulario", "reportePorPregunta", array("grid" => $encuestas4, "formulario" => $formulario, "servicio" => $servicio, "options" => $options, "sucursales" => $sucRes));
} else {
    ?>
    <div align="center"><br />
        <div style="text-align: center; text-decoration-color: #0000FF; font-size: 18px;"><b><? echo "NO EXISTEN DATOS QUE CUMPLAN CON ESTOS CRITERIOS" ?></div>
    </div><br />
    <?
}
?>