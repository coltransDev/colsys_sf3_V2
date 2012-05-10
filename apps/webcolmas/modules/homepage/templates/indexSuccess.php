<div class="staff_wrapper_table">
    <table class="staff_table">

        <?

        $lastGrupo = null;
        foreach( $users as $user ){

            if( $lastGrupo!=$user->getCaCargoweb() ){
            ?>
            <tr class="row0">
                <td colspan="2">
                    <p class="department_name"  >
                    <?
                    echo $user->getCaCargoweb();
                    ?>
                    </p>                    
                </td>            
            </tr>        
            <tr>
                <th class="staff_table_th_title">
                    Nombre
                </th>
                <th class="staff_table_th_title">
                    Identificaci&oacute;n
                </th>
                <th class="staff_table_th_title">
                    Profesion
                </th>
                <th class="staff_table_th_title">
                    Experiencia
                </th>
            </tr>

            <?   
                $lastGrupo=$user->getCaCargoweb();

            }
        ?>
        <tr>
            <td>
                <?=link_to($user->getCaNombres()." ".$user->getCaApellidos(), "homepage/viewUser?l=".md5($user->getCaLogin()))?>
            </td>
            <td>
                <?=$user->getCaDocidentidad()?>
            </td>
            <td>
                <?=$user->getCaProfesion()?>
            </td>
            <td>
                <?=$user->getCaExperiencia()?>
            </td>
        </tr>
        <?
        }
        ?>
    </table>
</div>    
    