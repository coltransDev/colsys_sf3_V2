<?
$arrObjData = $sf_data->getRaw("arrObjData");

print_r( $arrObjData );
?>

asdasd
<div class="content">
    <table >
        <tr>
            <th>Cliente</th>
            <th>Consecutivo</th>
            <th>Referencia Cliente</th>
            <th>Tipo orden</th>
            <th>DO</th>
        </tr>


<?



foreach ($arrObjData as $index => $value) {
    /*?>
    <tr>
        <td>Cliente</td>
        <td>Consecutivo</td>
        <td>Referencia Cliente</td>
        <td>Tipo orden</td>
        <td>DO</td>
    </tr>
    <?*/
    $arrData[$index] = $value;

    print_r( $arrData );
}

?>
   </table>
</div>
