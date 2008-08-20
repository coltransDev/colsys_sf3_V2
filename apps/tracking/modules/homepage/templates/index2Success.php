<?=include_partial("reportes/paginadorReportes", array( "reportes_pager"=>$reportes_pager, "url"=>"/homepage/index2" ));?>

<?=include_partial("reportes/listaReportes", array( "reportes"=>$reportes_pager->getResults() ));?>
<br />
