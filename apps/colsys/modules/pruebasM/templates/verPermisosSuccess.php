<?        
$data = $sf_data->getRaw( "data" );
$accesosUsuario = $sf_data->getRaw( "accesosUsuario" );
//print_r($accesosUsuario);
?>


<table class="tableList" width="1200px" border="1" id="mainTable">
    
    <tr>
        <th>Perfiles</th>
        <th>Usuarios</th>
    </tr>
    <?
    foreach($data as $k=>$d)
    {
    ?>
        <tr>
            <th width="70" scope="col" colspan="2"><a href="/adminPerfiles/formPermisos/perfil/<?=$d["perfil"]?>" target="_blank"><?=$k?></a> (<?=$d["departamento"]?>)</th>
        </tr>
        <tr>
            
            <td>
                <?
                foreach($d["accesos"] as $k1=>$a)
                {
                    echo "<b>".$a["rutina"]."</b> :".$a["descripcion"]." [ <b>".$a["nivel"]."</b>: ".$a["niveldescripcion"]." ]<br>";
                }
                ?>
            </td>
            <td>
                <?
                foreach($d["usuarios"] as $k1=>$a)
                {
                    echo "<b>"."<a href='/adminUsers/formPermisos/login/".$a["usuario"]."' target='_blank'>".$a["cargo"]."-".$a["usuario"]."</a></b>:".$a["nombre"]."(".$a["sucursal"]."-".$a["departamento"].")<br>";
                    foreach($accesosUsuario[$a["usuario"]] as $opcion=>$permiso){
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$opcion. " =>". $permiso."<br/>";
                    }
                }
                ?>
            </td>
        </tr>
    <?
    }
    ?>
        
</table>