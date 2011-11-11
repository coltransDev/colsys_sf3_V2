
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
    <li>
        <b><div id="digitalclock"></div></b>
    </li> 
	<li >	
		 <?=$userid?>
	</li>	
	<li >	
		<?=link_to("Salir","users/logout")?>
	</li>
</ul>

<script type="text/javascript" >
    var secsElapsed = 0;
    function show(){
        
        var clockobj=document.getElementById("digitalclock");
        var Digital=new Date(<?=time()*1000?>+secsElapsed)
        var hours=Digital.getHours();
        var minutes=Digital.getMinutes();
        var seconds=Digital.getSeconds();
        var dn="AM"
        
        if (hours==12){
            dn="PM" 
        }
        if (hours>12){
            dn="PM"
            hours=hours-12
        }
        if (hours==0){            
            hours=12
        }
        if (hours.toString().length==1){
            hours="0"+hours
        }
        if (minutes<=9){
            minutes="0"+minutes
        }
        
        if (seconds<=9){
            seconds="0"+seconds
        }
        
        clockobj.innerHTML=hours+":"+minutes+":"+seconds+" "+dn+"";
        secsElapsed+=1000;
        setTimeout("show()",1000)
    }
    
    show();
</script>


