<strong>
<?=link_popup(Utils::fechaMes(substr($status->getCaFchEnvio(),0,10))."&gt;&gt;Status&gt;&gt;".$status->getEtapa(), "traficos/verStatus?id=".$status->getCaIdReporte()."&emailid=".$status->getcaIdEmail(), 800,600)?>


</strong> 

<br />
<?=substr($status->getCaStatus(),0,160)?> 
<?=strlen( $status->getCaStatus() )>160?"...":""?>