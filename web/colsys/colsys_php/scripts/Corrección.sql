

update tb_trayectos  set ca_modalidad = 'LCL' where tb_trayectos.ca_idtrayecto = tb_fletes.ca_idtrayecto and 
ca_transporte = 'Marítimo' and ca_modalidad = 'CONSOLIDADO' and tb_fletes.ca_idconcepto = 9;


update tb_trayectos  set ca_modalidad = 'FCL' where tb_trayectos.ca_idtrayecto = tb_fletes.ca_idtrayecto and 
ca_transporte = 'Marítimo' and ca_modalidad = 'CONSOLIDADO' and tb_fletes.ca_idconcepto != 9;


update tb_trayectos set ca_modalidad = 'FCL' where tb_trayectos.ca_idtrayecto = tb_fletes.ca_idtrayecto and 
ca_transporte = 'Marítimo' and ca_modalidad = 'LCL' and tb_fletes.ca_idconcepto != 9;


update tb_fletes set ca_vlrminimo = ca_vlrneto where ca_vlrminimo = 0