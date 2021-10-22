
<table cellspacing="1" border="1" class="tableList">
    <tr>
        <th>ca_idmaster</th>
        <th>ca_referencia</th>
        <th>ca_consecutivo</th>
        <th>ca_idconcepto</th>
        <!--<th>ca_fchanulado</th>-->
        <th>ca_fchcerrado</th>
    </tr>
<?
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
    <tr <?=($n["ca_fchcerrado"]!="")?"style='background:red'":""?>>
        <td><?=$n["ca_idmaster"]?></td>
        <td><?=$n["ca_referencia"]?></td>
        <td><?=$n["ca_consecutivo"]?></td>
        <td><?=$n["ca_idconcepto"]?></td>
        <!--<td><?=$n["ca_fchanulado"]?></td>-->
        <td><?=$n["ca_fchcerrado"]?></td>
    </tr>
<?
    }
?>
</table>