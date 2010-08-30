
<ul id="navigation">	
	<li >	
		<?=link_to("Inicio","homepage/index")?>
	</li>
	<li >	
		<a >&nbsp;&nbsp;&nbsp;Aplicaciones</a>
		<a href="#" class="arrow" onclick="return tm(this)" >
		
		</a>
		<ul >
			<?
			foreach( $grupos as $key=> $grupo ){  	
			?>
		
			<li onmouseover="showMenu('sub<?=str_replace("-", "" ,$key )?>')" onmouseout="hideMenu('sub<?=str_replace("-", "" ,$key )?>')" >
				<a href="#"><?=$key?></a>
				<?
				if( count($grupos)>0 ){
				?>
				<ul id="sub<?=str_replace("-", "" ,$key )?>" style="display:none">
				<?
				foreach( $grupo as $rutina ){
				?>
					<li >
						<a href="<?=$rutina["ca_programa"]?>">
							<?=$rutina["ca_opcion"]?>
						</a>
					</li>
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
		 <?=$userid?>
	</li>	
	<li >	
		<?=link_to("Salir","adminUsers/logout")?>
	</li>
</ul>


