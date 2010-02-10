<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$issues = $sf_data->getRaw("issues");
?>

<script language="javascript">
    <?
    foreach( $issues as $issue ){
        $info = str_replace("\"", "'",str_replace("\n", "<br />",$issue["t_ca_title"].":<br />".$issue["t_ca_info"]));
        ?>
        var info = "<?=$info?>";
        target = document.getElementById("<?=$issue["t_ca_field_id"]?>");
        if( target ){
            target.className="help";
            target.title=info;
        }
        <?
    }
    ?>
</script>