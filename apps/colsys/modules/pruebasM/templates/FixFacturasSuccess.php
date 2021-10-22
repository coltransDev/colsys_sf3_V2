<?
echo "No Referencias: ".count($estadisticas["referencias"])."<br>";
echo "No Referencias Cerradas: ".$estadisticas["cerradas"]."<br>";
?>

<table cellspacing="1" border="1" class="tableList" align="center">
    
    <tr>
        <th>No</th>
        <th>ca_idmaster</th>
        <th>ca_referencia</th>
        <th>ca_consecutivo</th>
        <th>ca_idconcepto</th>
        <th>valor</th>
        <th>ca_fchcerrado</th>
    </tr>
<?
//$j=0;
    foreach ($noexiste as $n)
    {
        /*$noexiste[]= array(
                        "ca_idmaster"=>$d["ca_idmaster"],
                        "ca_referencia"=>$d["ca_referencia"],
                        "ca_consecutivo"=>$d["ca_consecutivo"],
                        "ca_idconcepto"=>$d["ca_idconcepto"],
                        "valor"=>"",
                        "ca_fchanulado"=>$d["ca_fchanulado"],
                        "ca_fchcerrado"=>$d["ca_fchcerrado"]                        
                    );*/
?>
    <tr class="<?=($n["ca_fchcerrado"]!="")?"row_yellow":""?>" >
        <td><?=++$j?></td>
        <td><?=$n["ca_idmaster"]?></td>
        <td><?=$n["ca_referencia"]?></td>
        <td><?=$n["ca_consecutivo"]?></td>
        <td><?=$n["ca_idconcepto"]."-".$n["ca_concepto_esp"]?></td>
        <td><?=$n["valor"]?></td>
        <td><?=$n["ca_fchcerrado"]?></td>
    </tr>
<?
    }
?>
</table>