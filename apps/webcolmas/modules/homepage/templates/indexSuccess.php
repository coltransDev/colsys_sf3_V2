<div class="staff_wrapper_table">
    <?
    $cargoWeb = "Representantes legales";
    include_partial('homepage/indexTable', array('users' => $users, 'cargoWeb' => $cargoWeb));
    $cargoWeb = "Gerentes";
    include_partial('homepage/indexTable', array('users' => $users, 'cargoWeb' => $cargoWeb));
    $cargoWeb = "Agentes de Aduana";
    include_partial('homepage/indexTable', array('users' => $users, 'cargoWeb' => $cargoWeb));
    $cargoWeb = "Auxiliares";
    include_partial('homepage/indexTable', array('users' => $users, 'cargoWeb' => $cargoWeb));
    ?>

</div>
