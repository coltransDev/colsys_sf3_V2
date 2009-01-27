<div align="center">
<h3>Tabla de Conceptos de Fletes</h3>
<br />

<table class="tableList">
  <thead>
    <tr>
      <th>Id</th>
      <th>Concepto</th>
      <th>Unidad</th>
      <th>Transporte</th>
      <th>Modalidad</th>    
      <th>Limite inferior</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($concepto_list as $concepto): ?>
    <tr>
      <td><a href="<?php echo url_for('conceptos/edit?ca_idconcepto='.$concepto->getCaIdconcepto()) ?>"><?php echo $concepto->getCaIdconcepto() ?></a></td>
      <td><?php echo $concepto->getCaConcepto() ?></td>
      <td><?php echo $concepto->getCaUnidad() ?></td>
      <td><?php echo $concepto->getCaTransporte() ?></td>
      <td><?php echo $concepto->getCaModalidad() ?></td>     
      <td><?php echo $concepto->getCaLiminferior() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
 
</div>