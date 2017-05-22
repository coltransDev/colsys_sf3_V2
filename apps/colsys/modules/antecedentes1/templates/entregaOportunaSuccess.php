<div class="content" align="center">
   <table class="tableList">
      <tr>
         <th>Impo/Expo</th>
         <th>Transporte</th>
         <th>Tr&aacute;fico</th>
         <th>Puerto</th>
         <th>Destino</th>
         <th>Modalidad</th>
         <th>D&iacute;as</th>
         <th>Observaciones</th>
         <th>
            <?= link_to(image_tag("16x16/edit_add.gif"), "antecedentes/editarEntregaOportuna") ?>
         </th>
      </tr>
      <?
      $tra_mem = null;
      $sub_tit = false;
      foreach ($antecedentes as $antecedente) {
         if ($antecedente->getTrafico() != $tra_mem) {
            $tra_mem = $antecedente->getTrafico();
            $sub_tit = true;
            ?>
            <tr>
               <td colspan="9">&nbsp;</td>
            </tr>
            <?
         }
         ?>
         <tr class="row0">
            <?
            if ($sub_tit) {
               $sub_tit = false;
               ?>
               <td><?= $antecedente->getCaImpoexpo() ?></td>
               <td><?= $antecedente->getCaTransporte() ?></td>
               <td><?= $antecedente->getTrafico()->getCaNombre() ?></td>
               <?
            } else {
               ?>
               <td colspan="3"></td>
               <?
            }
            ?>
            <td><?= $antecedente->getCiudad()->getCaCiudad() ?></td>
            <td><?= $antecedente->getDestino()->getCaCiudad() ?></td>
            <td><?= $antecedente->getCaModalidad() ?></td>
            <td><?= $antecedente->getCaDias() ?></td>
            <td><?= $antecedente->getCaObservaciones() ?></td>
            <td>
               <?= link_to(image_tag("16x16/edit.gif"), "antecedentes/editarEntregaOportuna?idtrafico=" . $antecedente->getCaIdtrafico() . "&idciudad=" . $antecedente->getCaIdciudad() . "&iddestino=" . $antecedente->getCaIddestino() . "&modalidad=" . $antecedente->getCaModalidad()) ?>
            </td>
         </tr>
         <?
      }
      ?>
   </table>
</div>