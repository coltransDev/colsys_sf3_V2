<?
//echo $idcliente;

//falabella 900017447
//firmenich 860030605

?>



<div align="center">
    <h3>Pagina Principal</h3>
    <br />

    <table width="539" border="1" class="table1">
        <tr>
            <th width="600"  colspan="2"></th>
        </tr>
        <tr>
            <td>
                <div id="cpanel">
                    <div style="float:left;">
                        <div class="icon">
                            <a href="<?= url_for("maritimo/index") ?>">
                                <?= image_tag("48x48/mar_ico.jpg") ?>
                                <span>Importaciones Mar&iacute;timas</span>
                            </a>
                        </div>
                    </div>

                    <div style="float:left;">
                        <div class="icon">
                            <a href="<?= url_for("aereo/index") ?>">
                                <?= image_tag("48x48/aer_ico.jpg") ?>				
                                <span>Importaciones Aereas</span></a>
                        </div>
                    </div>
                    <?
                    ?>
                    <div style="float:left;">
                        <div class="icon">

                            <a href="<?= url_for("exportaciones/index") ?>">
                                <?= image_tag("48x48/icon-48-install.png") ?>						<span>Exportaciones</span></a>
                        </div>
                    </div>

                    <div style="float:left;">
                        <div class="icon">

                            <a href="<?= url_for("exportaciones/index?transporte=maritimo") ?>">
                                <?= image_tag("48x48/barco.jpg") ?>						<span>Expo marítimo</span></a>
                        </div>
                    </div>

                    <div style="float:left;">
                        <div class="icon">

                            <a href="<?= url_for("exportaciones/index?transporte=aereo") ?>">
                                <?= image_tag("48x48/avion.jpg") ?>						<span>Expo aéreo</span></a>
                        </div>
                    </div>

                    <div style="float:left;">
                        <div class="icon">

                            <a href="<?= url_for("exportaciones/index?transporte=terrestre") ?>">
                                <?= image_tag("48x48/camion.jpg") ?>						<span>Expo terrestre</span></a>
                        </div>
                    </div>
                    <?
                    ?>				
                    <div style="float:left;">
                        <div class="icon">
                            <a href="<?= url_for("buscar/index") ?>">							
<?= image_tag("48x48/search.png") ?>			
                                <span>Busqueda</span></a>
                        </div>
                    </div>

                    <div style="float:left;">
                        <div class="icon">
                            <a href="<?= url_for("cuenta/index") ?>">

<?= image_tag("48x48/icon-48-config.png") ?>						<span>Configuraci&oacute;n de la cuenta</span></a>
                        </div>
                    </div>
                    <div style="float:left;">
                        <div class="icon">
<?
if($idcliente=="900017447" || $idcliente=="860030605")
{
    $url="falabellaAdu2/indexExt5";
}
else
{
    $url="indicadoresAdu/indexExt5";
}
//firmenich 
?>
                            <a href="<?= url_for($url) ?>">
<?= image_tag("48x48/idg.png") ?>			
                                <span>Indicadores</span></a>
                        </div>
                    </div>

                </div>

            </td>
            <td >
                Bienvenido al sistema de Tracking &amp; Tracing de <?= sfConfig::get("app_branding_name") ?>.
            </td>
        </tr>	
    </table>
</div>