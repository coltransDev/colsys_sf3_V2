<strong>
	<?=link_popup( Utils::fechaMes(substr($aviso->getCaFchEnvio(),0,10))."&gt;&gt;Aviso&gt;&gt;".$aviso->getEtapa(), "traficos/verAviso?id=".$aviso->getCaIdReporte()."&emailid=".$aviso->getcaIdEmail(), 800,600)?>
</strong> 

<br />
<div class="">
<?=substr($aviso->getCaNotas(),0,160)?> 
<?=strlen( $aviso->getCaNotas() )>160?"...":""?>  
</div>