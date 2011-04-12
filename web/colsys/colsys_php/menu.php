<?



$rsMenu =& DlRecordset::NewRecordset($conn);                                    // Selecciona las bases de datos a las que usuario identificado tiene acceso


$config = '../../../apps/colsys/config/app.yml';
$appConfig = sfYaml::load($config);



$template = $appConfig["all"]["branding"]["template"];
$templateName = $appConfig["all"]["branding"]["name"];


$grupos = $cache->get($session_id."_menu");


$trans = get_html_translation_table(HTML_ENTITIES);
?>
<script type="text/javascript" src="menu/menu.js"></script>


<link rel="stylesheet" type="text/css" media="screen" href="/css/ext/css/ext-all.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/ext/css/xtheme-gray.css" />

<script type="text/javascript" src="/js/ext/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="/js/ext/ext-all.js"></script>
<script type="text/javascript" src="/js/ext/src/locale/ext-lang-es.js"></script>
<script type="text/javascript" src="/js/loginWindow.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="/css/menu/menu.css" />

<div id="mask"></div>
<div align="center">
	<div class="header" align="center" >
		<div class="headerleft" ><img src="/images/branding/<?=$template?>/header/head_left.gif" /></div>
		<div class="headerright" ><img src="/images/branding/<?=$template?>/header//head_right.gif" /></div>
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
												<li > <a href="<?=$rutina['ca_programa']?>">
													<?=$rutina['ca_opcion']?>
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
