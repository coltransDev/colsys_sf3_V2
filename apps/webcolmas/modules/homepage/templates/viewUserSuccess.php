<div class="staff_wrapper_table">
    <?
    $user = $sf_data->getRaw("user")
    ?>
    <h3>Detalle del usuario </h3> 
    <table class="staff_table" border="1">   
        <tr class="">
            <th class="staff_table_th_title">
                Nombre
            </th>
            <td class="staff_table_th_title">
                <?= $user->getCaNombres() . " " . $user->getCaApellidos() ?> - <?= $user->getCaCargoweb() ?>
            </td>
        </tr>
        <tr class="">
            <th class="staff_table_th_title">
                Hoja de Vida
            </th>
            <td class="staff_table_th_title">
                <?= $user->getCaHojaVida() ?>
            </td>
        </tr>
        <tr class="">
            <th class="staff_table_th_title">
                Experiencia
            </th>
            <td class="staff_table_th_title">
                <?= $user->getCaExperiencia() ?> 
            </td>
        </tr>
    </table>
  
        <?= link_to("Volver", "homepage/index", array('class' => 'enlace_regreso')) ?>

</div>