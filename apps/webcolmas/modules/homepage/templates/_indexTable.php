<?
if ($cargoWeb == "Representantes legales") {
    $titulo = $cargoWeb;
    $cargo = "Representantes legales";
} else if ($cargoWeb == "Gerentes") {
    $titulo = $cargoWeb;
    $cargo = "Gerentes";
} else if ($cargoWeb == "Agentes de Aduana") {
    $titulo = $cargoWeb;
    $cargo = "Agentes de Aduana";
}else if ($cargoWeb == "Auxiliares") {
    $titulo = $cargoWeb;
    $cargo = "Auxiliares";
}

?>

<h3><? echo $cargoWeb ?></h3>  
<table class="staff_table" border="1">   
    <tr class="">
        <th class="staff_table_th_title">
            Nombre
        </th>
        <th class="staff_table_th_title">
            Cargo
        </th>
        <th class="staff_table_th_title">
            Experiencia
        </th>
        <th class="staff_table_th_title">
            Acciones
        </th>
    </tr>
    <?
    foreach ($users as $user) {
        if ($user->getCaCargoweb() == $cargo) {
            ?>  
            <tr>
                <td>
                    <?= $user->getCaNombres() . " " . $user->getCaApellidos() ?>
                </td>
                <td>
                    <?= $user->getCaCargo() ?>
                </td>
                <td>
                    <?= $user->getCaExperiencia() ?> 
                </td>
                <td>
                    <a class="" target="" href="<? echo url_for('homepage/viewUser?l=' . md5($user->getCaLogin())) ?>  "><img title="Previsualizar" alt="Previsualizar" src="images/verx16.png"></a>          
                </td>
            </tr>
            <?
        }
    }
    ?>
</table>
