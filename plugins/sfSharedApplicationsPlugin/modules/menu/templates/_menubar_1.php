



<div id="demo-bar">

        <ul>
            <li alt="Home"><a href="<?=url_for("homepage/index")?>"><img src="/images/toolbar/home.png" alt=" " /></a></li>

        </ul>

        <span class="jx-separator-left"></span>

		<ul>
            <li alt="Programas"><a href="#"><img src="/images/toolbar/synaptic.png" alt="Programas" /></a>
                <ul>
                  
                    <?
                    foreach( $grupos as $key=> $grupo ){
                    ?>
                    <!--
                    <li onmouseover="showMenu('sub<?=str_replace("-", "" ,$key )?>')" onmouseout="hideMenu('sub<?=str_replace("-", "" ,$key )?>')" >
                    -->
                    <li onmouseover="document.getElementById('sub<?=str_replace("-", "" ,$key )?>')" onmouseout="hideMenu('sub<?=str_replace("-", "" ,$key )?>')" >
                        <a href="#">&nbsp;&nbsp;&nbsp; <?=$key?></a>

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
           

        
        <ul  class="jx-bar-button-right">
            <li alt="Salir"><a href="<?=url_for("users/logout")?>"><img src="/images/toolbar/endturn.png" alt="Salir" /></a></li>
        </ul>

        <ul  class="jx-bar-button-right">
            <li alt="<?=$userid?>"><a href="#"><img src="/images/toolbar/personal.png" alt="<?=$userid?>" /></a></li>
        </ul>
      

       

        

          <ul>
            <li alt="Favoritos"><a href="#"><img src="/images/toolbar/bookmark.png" alt="Favoritos" /></a></li>

        </ul>


        <ul class="jx-bar-button-right">
			<li alt="Feeds"><a href="#"><img src="/images/toolbar/internet.png" alt=" " /></a>
                <ul>
        		    <li><a href="#"><img src="icons/feed-document.png" />&nbsp;&nbsp;&nbsp;Content Feed</a></li>

		            <li><a href="#"><img src="icons/balloon-quotation.png" />&nbsp;&nbsp;&nbsp;Comment Feed</a></li>
                </ul>
			</li>
        </ul>
        <span class="jx-separator-right"></span>


        

</div>



