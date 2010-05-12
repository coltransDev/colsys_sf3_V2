<h1>Noticias List</h1>

<table>
  <thead>
    <tr>
      <th>Ca idnoticia</th>
      <th>Ca autor</th>
      <th>Ca titulo</th>
      <th>Ca categoria</th>
      <th>Ca fchcreado</th>
      <th>Ca fcharchivar</th>
      <th>Ca idsucursal</th>
      <th>Ca noticia</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($noticias as $noticia): ?>
    <tr>
      <td><a href="<?php echo url_for('noticias/edit?ca_idnoticia='.$noticia->getCaIdnoticia()) ?>"><?php echo $noticia->getCaIdnoticia() ?></a></td>
      <td><?php echo $noticia->getCaAutor() ?></td>
      <td><?php echo $noticia->getCaTitulo() ?></td>
      <td><?php echo $noticia->getCaCategoria() ?></td>
      <td><?php echo $noticia->getCaFchcreado() ?></td>
      <td><?php echo $noticia->getCaFcharchivar() ?></td>
      <td><?php echo $noticia->getCaIdsucursal() ?></td>
      <td><?php echo $noticia->getCaNoticia() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('noticias/new') ?>">New</a>
