<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script language="javascript" type="text/javascript">
	function mostrarGrupo( idgrupo ){
		//alert(idgrupo);
		var childs = document.getElementById("manual-nav" ).getElementsByTagName("a");

		for( var i = 0; i < childs.length; i++ )
		{
			childs[i].className = "off";
		}


		//document.getElementById("li_"+idgrupo ).className = "group group-active";
        document.getElementById("a_"+idgrupo ).className = "on";
		document.getElementById("content-homepage" ).innerHTML = document.getElementById( idgrupo ).innerHTML;
	}


</script>
<div class="content" align="center">
    <div class="borderPrimaryTable">
        <table cellpadding="0" cellspacing="0" class="primaryTable" width="100%" border="0">
            <tr>
                <td class="primaryMainColumn" colspan="2">
                    <div id="mainColumn">
                        <div class="wp subTitle" id="SubTitle"><h1><?=$categoria->getcaName()?></h1></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top" width="180px">
                    <div >
                        <ul id="manual-nav">
                            <?
                            $subcategorias = $categoria->getSubCategory();
                            foreach( $subcategorias as $subcategoria ){
                            ?>
                            <li class="group" id="li_content-<?=$subcategoria->getCaIdcategory()?>">
                                <a class="off" id="a_content-<?=$subcategoria->getCaIdcategory()?>" onmouseover="mostrarGrupo('content-<?=$subcategoria->getCaIdcategory()?>')"><?=$subcategoria->getCaName()?></a>
                            </li>
                            <?
                            }

                            $issuesUnc = $categoria->getKBIssue();                            
                            if( count( $issuesUnc )>0 ){
                             ?>
                            <li class="group" id="li_content-uncategorized">
                                <a class="off" id="a_content-uncategorized" onmouseover="mostrarGrupo('content-uncategorized')">Sin categoria</a>
                            </li>
                            <?
                            
                            }
                            ?>
                        </ul>
                        <?

                        ?>
                    </div>
                </td>
                <td rowspan="2"valign="top">
                    <div id="content-wrap" class="content-wrap" align="left">
                        <div id="content-homepage">
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td valign="top" >
                    <div class="mainColumn">
                       &nbsp;
                    </div>
                </td>
                <td colspan="2" >
                </td>
            </tr>

    </table>
</div>
</div>

<?
$i = 0;
$first = null;
foreach( $subcategorias as $subcategoria ){
    if( $i++==0 ){
        $first = $subcategoria->getCaIdcategory();
    }

    $issues = $subcategoria->getKBIssue();
?>

    <div id="content-<?=$subcategoria->getCaIdcategory()?>" style="display:none">
        <?=image_tag($categoria->getCaIcon()?$categoria->getCaIcon():"kb/top-issues.png")?>
        <br />
        <span class="titleCategory"><?=$subcategoria->getCaName()?></span>
        <br />
        <br />

        <ul >
        <?
        foreach( $issues as $issue ){
        ?>
            <li><?=image_tag("kb/bullet.png")?>&nbsp;<?=link_to($issue->getCaTitle(), "kbase/viewIssue?id=".$issue->getCaIdissue())?></li>
        <?
        }
       
        if( $nivel>=2 ){
        ?>
        <li><?=link_to(image_tag("16x16/edit_add.gif"), "kbase/formIssue?idcategory=".$subcategoria->getCaIdcategory())?></li>
        <?
        }
        ?>
        </ul>

    </div>
<?
}



if( $first===null ){
    $first = "uncategorized";
}
?>
<div id="content-uncategorized" style="display:none">
    <?=image_tag($categoria->getCaIcon()?$categoria->getCaIcon():"kb/top-issues.png")?>
    <br />
    <span class="titleCategory">Sin subcategoria</span>
    <br />
    <br />

    <ul >
    <?
    foreach( $issuesUnc as $issue ){
    ?>
        <li><?=image_tag("kb/bullet.png")?>&nbsp;<?=link_to($issue->getCaTitle(), "kbase/viewIssue?id=".$issue->getCaIdissue())?></li>
    <?
    }
     if( $nivel>=2 ){
        ?>
        <li><?=link_to(image_tag("16x16/edit_add.gif"), "kbase/formIssue?idcategory=".$categoria->getCaIdcategory())?></li>
        <?
        }
        ?>
    

    </ul>

</div>
<?

?>


<script language="javascript" type="text/javascript">

    <?
    if( $first ){
    ?>
	mostrarGrupo("content-<?=$first?>");
    <?
    }
    ?>
</script>