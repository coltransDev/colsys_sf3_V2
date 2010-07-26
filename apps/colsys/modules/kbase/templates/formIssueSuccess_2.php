<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>


<?
$issue = $sf_data->getRaw("issue");
?>
<div class="content" align="center">

    <h1>Administraci&oacute;n de la base de datos de conocimiento</h1>

    <br />

        <!--there is no custom header content for this example-->

          
        <!--BEGIN SOURCE CODE FOR EXAMPLE =============================== -->

       
        <form action="<?=url_for("kbase/formIssue")?>" method="post">
            <input type="hidden" name="id" value="<?=$issue->getCaIdissue()?>"/>
            <input type="hidden" name="idcategory" value="<?=$idcategory?$idcategory:$issue->getCaIdcategory()?>"/>
            <table class="tableList" width="80%">
                <tr>
                    <td>
                        <b>Titulo:</b><br />
                        <input type="text" name="title" value="<?=$issue->getCaTitle()?>" size="113" maxlength="255" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Resumen:</b><br />
                        <textarea name="summary" cols="110" rows="2"><?=$issue->getCaSummary()?></textarea>

                    </td>
                </tr>
                <tr>
                    <td>
                       


                            <textarea id="info" name="info" rows="10" cols="80"></textarea>
                         
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center"><input type="submit" value="Guardar" class="button"/></div>
                    </td>
                </tr>
            </table>
    </form>
</div>





<script type="text/javascript">

// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
else
{
	var editor = CKEDITOR.replace( 'info' );
    CKFinder.SetupCKEditor( editor, { BasePath : '/ckfinder/'} );

    var text = '<?=str_replace("'", "\'", str_replace("\r", "", str_replace("\n", "<br />",$issue->getCaInfo())))?>';
    text = text.split("<br />").join("\n");
	editor.setData( text );


	// Just call CKFinder.SetupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	

	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.SetupCKEditor( editor, { BasePath : '../../', RememberLastFolder : false } ) ;
}

		</script>




