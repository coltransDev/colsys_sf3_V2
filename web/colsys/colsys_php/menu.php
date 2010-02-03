<?



$rsMenu =& DlRecordset::NewRecordset($conn);                                    // Selecciona las bases de datos a las que usuario identificado tiene acceso



$sql = "SELECT DISTINCT control.tb_rutinas.ca_rutina, control.tb_rutinas.CA_OPCION, ca_programa, control.tb_rutinas.ca_grupo FROM control.tb_rutinas LEFT JOIN control.tb_accesos_perfiles ON (control.tb_rutinas.CA_RUTINA=control.tb_accesos_perfiles.CA_RUTINA AND control.tb_accesos_perfiles.ca_acceso>=0  ) 	LEFT JOIN control.tb_usuarios_perfil ON (control.tb_accesos_perfiles.CA_PERFIL=control.tb_usuarios_perfil.CA_PERFIL) 	LEFT JOIN control.tb_accesos_user ON (control.tb_rutinas.CA_RUTINA=control.tb_accesos_user.CA_RUTINA AND control.tb_accesos_user.ca_acceso>=0 ) WHERE (control.tb_usuarios_perfil.CA_LOGIN='".$usuario."' OR control.tb_accesos_user.CA_LOGIN='".$usuario."') ORDER BY control.tb_rutinas.CA_GRUPO ASC,control.tb_rutinas.CA_OPCION ASC";

$rsMenu->Open( $sql );  




$grupos = array();

if( !isset($_COOKIE["menu"]) ){
    while (!$rsMenu->Eof() and !$rsMenu->IsEmpty()) {
        if( !isset( $grupos[$rsMenu->Value('ca_grupo')] )){
            $grupos[$rsMenu->Value('ca_grupo')]=array();
        }

        $grupos[$rsMenu->Value('ca_grupo')][]=array( "opcion"=>$rsMenu->Value('ca_opcion'),
                                                     "programa"=>$rsMenu->Value('ca_programa')
                                            );
        $rsMenu->moveNext();
    }
}else{
    
    $menu = explode("\n",(utf8_decode($_COOKIE["menu"])));
    $grupos = array();

    foreach( $menu as $m ){
        $pos =  strpos( $m, "|" );

        $grupo = substr( $m, 0, $pos );
        $items = explode( ";", substr( $m, $pos+1 , 9999 ) );
        foreach( $items as $item ){
            $val = explode("#", $item);

            if( $val[0] ){
                $grupos[$grupo][] = array("programa"=>$val[0],"opcion"=>$val[1]);
            }
        }
    }
}


$trans = get_html_translation_table(HTML_ENTITIES);
?>
<script type="text/javascript" src="menu/menu.js"></script>


<link rel="stylesheet" type="text/css" media="screen" href="/css/ext/css/ext-all.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/ext/css/xtheme-gray.css" />

<script type="text/javascript" src="/js/ext/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="/js/ext/ext-all.js"></script>
<script type="text/javascript" src="/js/ext/src/locale/ext-lang-es.js"></script>
<script type="text/javascript" src="/js/loginWindow.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="menu/menu.css" />

<div id="mask"></div>
<div align="center">
	<div class="header" align="center" >
		<div class="headerleft" ><img src="menu/head_left.gif" /></div>
		<div class="headerright" ><img src="menu/head_right.gif" /></div>
		<div class="topmenuwraper" align="left">
			<ul id="navigation">
				
				<li > <a href="/homepage">Inicio</a> </li>
					<li > <a >&nbsp;&nbsp;&nbsp;&nbsp;Aplicaciones </a> <a href="#" class="arrow" onclick="return tm(this)" > </a>
						<ul>
					
						<?
						foreach( $grupos as $key=> $grupo ){  	
						?>
						<li onmouseover="showMenu('sub<?=str_replace("-", "" ,$key )?>')" onmouseout="hideMenu('sub<?=str_replace("-", "" ,$key )?>')" > <a href="#">
							<?=$key?>
							</a>
							<?
							if( count($grupos)>0  ){
							?>
							<ul id="sub<?=str_replace("-", "" ,$key )?>" style="display:none">
								<?
								foreach( $grupo as $rutina ){
								?>
												<li > <a href="<?=$rutina['programa']?>">
													<?=$rutina['opcion']?>
													</a> </li>
												<?
								}
								?>
							</ul>
							<?
							}
							?>
						</li>
						<?
						}
						?>
					</ul>
				</li>
			</ul>			
			<ul id="usermenu">
				<li >
					<?=$usuario?>
				</li>
				<li > <a href="/users/logout">Salir</a> </li>
			</ul>
		</div>
	</div>
</div>
<br>
<br>
