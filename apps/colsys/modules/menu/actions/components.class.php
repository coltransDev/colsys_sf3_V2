<?php 
/*
* 
*/
class menuComponents extends sfComponents
{
	/*
	* 
	*/	
  	public function executeSubmenubar(){				
		$module = $this->getContext()->getModuleName ();
		$action = $this->getContext()->getActionName ();
				
		$button=array();			
        //echo sfConfig::get("sf_plugins_dir");

        
		$filename=sfConfig::get("sf_app_module_dir").DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR."_submenuBar.php";
		if( file_exists($filename) ){
			include($filename);
		}elseif ($pluginDirs = glob(sfConfig::get('sf_plugins_dir').DIRECTORY_SEPARATOR."*".DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR))
        {
          foreach ($pluginDirs as $dir)
          {
             $filename = $dir."_submenuBar.php";        
             if( file_exists($filename) ){
                include($filename);
            }
          }
        }
        
		$this->buttons = $button;		   
					
		
	} 
	
	
	
	/*
	* 
	*/	
	public function executeMenubar(){				
	
		$usuario = Doctrine::getTable("Usuario")->find( $this->getUser()->getUserId() );

	
		$this->grupos = array();
        //echo unserialize(($_COOKIE["menu"]));

        //setcookie("menu", "", time()-3600 );
		if( $usuario ){
            //if( !isset($_COOKIE["menu"]) ){
            if(true){
            
                $rutinas = Doctrine::getTable("Rutina")
                          ->createQuery("r")
                          ->select('r.*')
                          ->leftJoin("r.AccesoPerfil ap")
                          ->leftJoin("ap.UsuarioPerfil up")
                          ->leftJoin("r.AccesoUsuario au")
                          ->where(" (up.ca_login = ? or au.ca_login = ? )", array($this->getUser()->getUserId(), $this->getUser()->getUserId()) )
                          ->addWhere(" (ap.ca_acceso >= ? or ap.ca_acceso IS NULL )", 0 )
                          ->addWhere(" (au.ca_acceso >= ? or au.ca_acceso IS NULL )", 0 )
                          ->addOrderBy("r.ca_grupo ASC")
                          ->addOrderBy("r.ca_opcion ASC")
                          ->distinct()
                          ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                          ->execute();

                foreach( $rutinas as $rutina ){
                    if( !isset( $this->grupos[$rutina["ca_grupo"]] )){
                        $this->grupos[$rutina["ca_grupo"]]=array();
                    }
                    $this->grupos[$rutina["ca_grupo"]][]=$rutina;
                }

                $str = "";
                foreach( $this->grupos as $key=> $grupo ){
                    $str.=$key."|";
                    foreach( $grupo as $rutina ){
                        $str.=$rutina["ca_programa"]."#".$rutina["ca_opcion"].";";
                    }
                    $str.="\n";
                }
                
                //setcookie("menu", (utf8_encode($str)) , time()+3600 );
            }else{
                
                $menu = explode("\n",(utf8_decode($_COOKIE["menu"])));                
                $this->grupos = array();

                foreach( $menu as $m ){
                    $pos =  strpos( $m, "|" );
                    
                    $grupo = substr( $m, 0, $pos );
                    $items = explode( ";", substr( $m, $pos+1 , 9999 ) );
                    foreach( $items as $item ){                       
                        $val = explode("#", $item);
                        
                        if( $val[0] ){
                            $this->grupos[$grupo][] = array("ca_programa"=>$val[0],"ca_opcion"=>$val[1]);
                        }
                    }
                }
            }
        }
		$this->userid = $this->getUser()->getUserId();


	} 
	
	
	
}
?>