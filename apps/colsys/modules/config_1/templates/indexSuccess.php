
<div class="content" align="center">
    <table class="tableList">
        <tr>
            <th>Parametro</th>
            <th>Modulo</th>
            <th>Descripción</th>
            <th>
                <?=link_to(image_tag("16x16/edit_add.gif"),"config/formParam")?>
            </th>
        </tr>
        <?
        foreach( $params as $p ){
        ?>
        
        <tr class="row0">
            <td><?=$p->getCaParam()?></td>
            <td><?=$p->getCaModule()?></td>
            <td><?=$p->getCaDescription()?></td>
            <td>
                <?=link_to(image_tag("16x16/edit.gif"),"config/formParam?idconfig=".$p->getCaIdconfig())?> 
                <?=link_to(image_tag("16x16/edit_add.gif"),"config/formValue?idconfig=".$p->getCaIdconfig())?>
            </td>
        </tr>
        <?
        $values = $p->getColsysConfigValue();
        
        
        foreach( $values as $v ){
        ?>
        
        <tr >
            <td><?=$v->getCaIdent()?></td>
            <td><?=nl2br(substr($v->getCaValue(), 0, 100))?></td>
            <td><?=nl2br(substr($v->getCaValue2(), 0, 100))?></td>
            <td><?=link_to(image_tag("16x16/edit.gif"),"config/formValue?idvalue=".$v->getCaIdvalue())?></td>
        </tr>
        <?
        }
        ?>
        <tr>
            <td colspan="4">&nbsp;</td>
            
        </tr>
        <?
        }
        ?>
    </table>
</div>