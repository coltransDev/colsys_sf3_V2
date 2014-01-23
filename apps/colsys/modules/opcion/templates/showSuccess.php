<h1>Detalle de la Opci&oacute;n</h1>

<table>
    <tbody>
        <tr>
            <th>Id:</th>
            <td><?php echo $opcion->getCaId() ?></td>
        </tr>
        <tr>
            <th>Texto:</th>
            <td><?php echo $opcion->getCaTexto() ?></td>
        </tr>
        <tr>
            <th>Orden:</th>
            <td><?php echo $opcion->getCaOrden() ?></td>
        </tr>
        <tr>
            <th>Id Pregunta:</th>
            <td><?php echo $opcion->getCaIdpregunta() ?></td>
        </tr>
        <tr>
            <th>Texto Pregunta:</th>
            <td><?php echo html_entity_decode($opcion->getPregunta()->ca_texto) ?></td>
        </tr>
    </tbody>
</table>

