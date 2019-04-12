<?
    $registros = $sf_data->getRaw("registros");
    $summary = $sf_data->getRaw("summary");
    $html = $sf_data->getRaw("html");
    $datos = $sf_data->getRaw("datos");
    
    $headers = $datos["headers"];    
    $keysdata = array();
    
//    echo "<pre>";print_r($registros);echo "<pre>";
//    echo "<pre>";print_r($datos);echo "<pre>";
//    exit();
//    echo "<pre>";print_r($summary);echo "<pre>";
    
?>
<!--<input type="button" name="imprimir" value="Imprimir P&aacute;gina" onclick="window.print();">-->
<table style="background-color: #FFFFFF;
	padding: 0px;
	border: 1px solid #CCCCCC;
	border-spacing: 0px;
	border-collapse: collapse;" width="100%" border="1" cellspacing="1" cellpadding="2">
    
    <tr>
        <th align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3; border:1px solid #D0D0D0;">#</th>
    <?
    foreach($headers as $key => $val){        
        $keysdata[] = $val["dataIndex"];
        //foreach($val as $k => $v){
          //  $keysdata[] = $v; 
            ?>
        <th align="center" style="margin: 0px; padding: 6px 4px 2px 4px; background-color: #E3E3E3; border:1px solid #D0D0D0;"><?= utf8_decode($val["header"])?></th>
            
            <?
        //}
    }
    $i=1;        
//    echo "<pre>";print_r($keysdata);echo "<pre>";
    ?>
    </tr>
    <?
    
    foreach($registros as $key => $val){
        //echo "<pre>";print_r($val);echo "<pre>";
        //echo $val[$keysdata[$key]];
        //exit();
        ?>
        <tr align="center" style="white-space: nowrap; margin: 0px; padding: 6px 4px 2px 4px; background-color:<?=$val["ca_color"]?>;border:1px solid #D0D0D0;">
            <td><?=$i?></td>
        <?
        foreach($val as $dataIndex => $valor){            
            if(in_array($dataIndex, $keysdata)){
                ?>
            <td><?= utf8_decode($val[$dataIndex])?></td>    
                <?
            } 
        }
        echo "</tr>";
        $i++;
    }
    ?>  
</table>
<br/><br/>
<?
$arreglo = ["pnc_count","pnc_perc","avg_count","avg_perc", "exc_count","exc_perc", "lim_sup","sucursal"];

foreach($arreglo as $key => $val){
    $html = str_replace("{".$val."}", $summary[$val], $html);
}

echo $html;
?>