<?
use_helper("MimeType");
$email = $sf_data->getRaw("email");
?>

<table width="90%" border="0" class="table1" align="center">
    <tr>
        <th  scope="col">Email</th>
    </tr>
    <tr>
        <td ><div align="left"><strong>Fecha</strong><br />
                <?= $email->getCaFchenvio() ?>
            </div></td>
    </tr>
    <tr>
        <td ><div align="left"><strong>Enviado por:</strong><br />
                <?= $email->getCaFromname() ?>
                &lt;
                <?= $email->getCaFrom() ?>
                &gt;</div></td>
    </tr>
    <tr>
        <td ><div align="left"><strong>Destinatarios</strong>:<br />
                <?= str_replace(",", ", ", $email->getCaAddress()) ?>
            </div></td>
    </tr>
    <tr>
        <td ><div align="left"><strong>CC:</strong><br />
                <?= $email->getCaCc() ?>
            </div></td>

    </tr>
    <tr>
        <td ><div align="left"><strong>Asunto:</strong>
                <br />
                <?= Utils::replace($email->getCaSubject()) ?>
            </div></td>
    </tr>
    <tr>
        <td ><div align="left"><strong>Mensaje:</strong><br />
            </div>

            <?
            if ($email->getCaBodyhtml()) {
                echo $email->getCaBodyhtml();
            } else {
                echo $email->getCaBody();
            }
            ?>

        </td>
    </tr>
    <tr><td><?
            if ($email->getCaAttachment()) {
                $attachments = explode("|", $email->getCaAttachment());
                ?>
                <tr>
                    <td><b>Adjuntos:</b>
                        <table cellspacing="1" width="95%">					
                            <tr>
                                <td>
                                    <?
                                    foreach ($attachments as $attachment) {
                                        if (substr($attachment, -3, 3) == ".gz") {
                                            $nombreArchivo = substr($attachment, 0, strlen($attachment) - 3);
                                        } else {
                                            $nombreArchivo = $attachment;
                                        }
                                        echo link_to(mime_type_icon(basename($nombreArchivo)) . " " . basename($nombreArchivo), "gestDocumental/verArchivo?idarchivo=" . base64_encode($nombreArchivo)) . "<br />";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table></td>
                </tr>
                <?
            }
            ?></td></tr>
</table>
<br />
<div align="center"><a onclick="history.go(-1)">Regresar</a></div>
<br />
<br />

