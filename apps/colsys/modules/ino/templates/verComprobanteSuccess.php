<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>


<div class="content" align="center">

    <iframe src="<?=url_for("ino/generarComprobantePDF?id=".$comprobante->getCaIdcomprobante()."&token=".md5(time()))?>" width="1000px" height="650px"></iframe>

</div>

