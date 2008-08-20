
<?=include_partial("reportes/paginadorReportes", array( "reportes_pager"=>$reportes_pager, "url"=>"/aereo/index" ));?>

<?=include_partial("reportes/listaReportes", array( "reportes"=>$reportes_pager->getResults() ));?>
