
<div class="box1">
    <?php
    if (count($datos)==0) {
        echo '<b>No hay coincidencias</b>';
    } else {
        echo '<b>Coincidencias encontradas </b><br />';
        echo '<div class="rojo">Si ha encontrado alguna coincidencia haga click sobre ella</div><br />';
        foreach ($datos as $row) {

            echo link_to($row["ca_nombre"]." ".$row["ca_direccion"], "bodegas/show?ca_idbodega=" . $row["ca_idbodega"]) . "<br />";
        }
    }
    ?>
</div>