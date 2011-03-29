<?php

/**
 * Usuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class Usuario extends BaseUsuario
{
    const FOLDER = "Usuarios";
    
    public function __toString(){
        $result = $this->getCaNombre();
        if( !$this->getCaActivo() ){
            $result .=" (Inactivo)";
        }
        return $result;
    }
    
    public function getNivelAcceso( $rutina ){
        
        $acceso = Doctrine::getTable("AccesoUsuario")
                        ->createQuery("a")
                        ->where('a.ca_login = ?', $this->getCaLogin())
                        ->addWhere('a.ca_rutina = ?', $rutina)
                        ->addOrderBy('a.ca_acceso DESC')
                        ->fetchOne();

		if( $acceso ){
			return $acceso->getCaAcceso();
		}else{
            $acceso = Doctrine::getTable("AccesoPerfil")
                        ->createQuery("a")
                        ->innerJoin("a.Perfil p")
                        ->innerJoin("p.UsuarioPerfil up")
                        ->where('up.ca_login = ?', $this->getCaLogin())
                        ->addWhere('a.ca_rutina = ?', $rutina)
                        ->addOrderBy('a.ca_acceso DESC')
                        ->fetchOne();            
			if( $acceso ){
				return $acceso->getCaAcceso();
			}
		}
		return -1;
    }

    public function getFirmaHTML(){

        $sucursal = $this->getSucursal();
        $empresa = $sucursal->getEmpresa();
		$resultado = "<strong>".Utils::replace(strtoupper($this->getCaNombre()))."</strong><br />";
		$resultado .= $this->getCaCargo()."- ".strtoupper($empresa->getCaNombre())."<br />";
		
		if( $sucursal ){
			$resultado .= $sucursal->getCaDireccion()."<br />";
			$resultado .= "Tel.: ".$sucursal->getCaTelefono()." ".$this->getCaExtension()."<br />";
			$resultado .= "Fax.: ".$sucursal->getCaFax()."<br />";
		}
		$resultado .= Utils::replace($sucursal->getCaNombre())."- ".$empresa->getTrafico()->getCaNombre()."<br />";
		$resultado .= "<a href=\"http://".$empresa->getCaUrl()."\">".$empresa->getCaUrl()."</a>";
		return $resultado;
	}

	public function getFirma(){
        $sucursal = $this->getSucursal();
        $empresa = $sucursal->getEmpresa();
		$resultado = Utils::replace(strtoupper($this->getCaNombre()))."\n";
		$resultado .= $this->getCaCargo()."\n".strtoupper($empresa->getCaNombre()).".\n";
		
		if( $sucursal ){
			$resultado .= $sucursal->getCaDireccion()."\n";
			$resultado .= "Tel.: ".$sucursal->getCaTelefono()." ".$this->getCaExtension()."\n";
			$resultado .= "Fax.: ".$sucursal->getCaFax()."\n";
		}
		$resultado .= $sucursal->getCaNombre()." - ".$empresa->getTrafico()->getCaNombre();
		$resultado .= "http://".$empresa->getCaUrl();
		return $resultado;
	}


	public function setPasswd( $passwd ){
		$salt = hash("md5", uniqid(rand(), true));
		$this->setCaPasswd( sha1( $passwd.$salt ) );
		$this->setCaSalt( $salt );
	}

	public function checkPasswd( $passwd, &$error="", &$errorno="" ){
        if( $this->getCaActivo() ){
            $username = $this->getCaLogin();
            $ldap_auth_enabled = sfConfig::get("app_ldap_auth_enabled");
            if( !$ldap_auth_enabled ){
                $this->setCaAuthmethod("sha1");                
            }
            
            if( $this->getCaAuthmethod()=="ldap" ){
                $auth_user="cn=".$username.",o=coltrans_bog";
                $ldap_server=sfConfig::get("app_ldap_host");
                $connect=ldap_connect($ldap_server);                
                if( $connect ){
                    if(@$bind=ldap_bind($connect, $auth_user, utf8_encode($passwd))){
                        try{
                            $this->stopBlaming();
                            $this->setPasswd( $passwd );
                            $this->save();
                        }catch( Exception $e){
                            //echo $e->getMessage();
                        }
                        return true;
                    }else{                        
                        $error = ldap_error( $connect );
                        $errorno = ldap_errno( $connect );
                    }
                    ldap_close($connect);
                }
            }            

            if( $this->getCaAuthmethod()=="sha1" ){                
                return $this->getCaPasswd()==sha1($passwd.$this->getCaSalt() );
            }
        }
        return false;
	}
    public function getDirectorio(){
        $folder = self::FOLDER;
        return $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$this->getDirectorioBase();

    }

    public function getDirectorioBase(){
        $folder = self::FOLDER;
        return $directory = $folder.DIRECTORY_SEPARATOR.$this->getCaLogin();

    }
    public function getImagen($tamano='120x150'){
         switch($tamano){
             case '120x150':
                 $imagen = $this->getDirectorio().DIRECTORY_SEPARATOR.'foto120x150.jpg';
                 break;
             case '60x80':
                 $imagen = $this->getDirectorio().DIRECTORY_SEPARATOR.'foto60x80.jpg';
                 break;
             case '30x40':
                 $imagen = $this->getDirectorio().DIRECTORY_SEPARATOR.'foto30x40.jpg';
                 break;
             default:
                 $imagen = $this->getDirectorio().DIRECTORY_SEPARATOR.'foto120x150.jpg';
                 break;
         }
        
        return $imagen;
    }
    
    public function getImagenUrl($tamano='120x150'){
         
        if( file_exists($this->getImagen($tamano) ) ){
            $imagen="/gestDocumental/verArchivo/folder/".base64_encode($this->getDirectorioBase())."/idarchivo/".base64_encode("foto".$tamano.".jpg");
        }else{
            $imagen="/gestDocumental/verArchivo/folder/".base64_encode(Usuario::FOLDER)."/idarchivo/".base64_encode("nologin".$tamano.".jpg");
        }
        
        return $imagen;
    }
    
    public function getEsJefe( $login ){

        if( $this->getCaManager()==$login ){
            return true;
        }
        
        if( !$this->getCaManager() && $login!=$this->getCaLogin()  ){
            return false;
        }
        
        $manager = $this->getManager();

        if( !$manager ){
            return true;
        }
        
        return $manager->getEsJefe( $login );
    }
    
	public function updateLuceneIndex(){

		$index = $this->getTable()->getLuceneIndex();

        // remove an existing entry
	    
        $hits = $index->find('ca_login:'.$this->getCaLogin());
        foreach ($hits as $hit) {
        
            $index->delete($hit->id);
            
        }

	    // don't index expired and non-activated jobs
	    if (!$this->getCaActivo()){
	    	return;
	  	}

	  	$doc = new Zend_Search_Lucene_Document();

	 	// store job primary key URL to identify it in the search results
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('pk', $this->getCaLogin()));
	  	$doc->addField(Zend_Search_Lucene_Field::UnStored('ca_login', $this->getCaLogin()));

	 	 // index job fields
	    $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_nombre',utf8_encode($this->getCaNombre()), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_nombres',utf8_encode($this->getCaNombres()), 'utf-8'));
	    $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_apellidos', utf8_encode($this->getCaApellidos()), 'utf-8'));
	    $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_cargo', utf8_encode($this->getCaCargo()), 'utf-8'));
	    $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_sucursal', utf8_encode($this->getSucursal()->getCaNombre()), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_empresa', utf8_encode($this->getSucursal()->getEmpresa()->getCaNombre()), 'utf-8'));

	    // add job to the index
	    $index->addDocument($doc);
	    $index->commit();
	}

    public function save(Doctrine_Connection $conn = null)
    {
      // ...

      $conn = $conn ? $conn : $this->getTable()->getConnection();
      $conn->beginTransaction();
      try
      {
        $ret = parent::save($conn);

        $this->updateLuceneIndex();

        $conn->commit();

        return $ret;
      }
      catch (Exception $e)
      {
        $conn->rollBack();
        throw $e;
      }
    }

    // lib/model/doctrine/JobeetJob.class.php
    public function delete(Doctrine_Connection $conn = null)
    {
      $index = UsuarioTable::getLuceneIndex();

      if ($hit = $index->find('pk:'.$this->getCaLogin()))
      {
        $index->delete($hit->id);
      }

      return parent::delete($conn);
    }
}





