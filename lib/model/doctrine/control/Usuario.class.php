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
                        ->fetchOne();            
			if( $acceso ){
				return $acceso->getCaAcceso();
			}
		}

		return -1;
        
    }

    public function getFirmaHTML(){
		$resultado = "<strong>".Utils::replace(strtoupper($this->getCaNombre()))."</strong><br />";
		$resultado .= $this->getCaCargo()."- COLTRANS S.A.<br />";
		$sucursal = $this->getSucursal();
		if( $sucursal ){
			$resultado .= $sucursal->getCaDireccion()."<br />";
			$resultado .= "Tel.: ".$sucursal->getCaTelefono()." ".$this->getCaExtension()."<br />";
			$resultado .= "Fax.: ".$sucursal->getCaFax()."<br />";
		}
		$resultado .= Utils::replace($sucursal->getCaNombre())."- Colombia<br />";
		$resultado .= "<a href=\"http://www.coltrans.com.co\">http://www.coltrans.com.co</a>";
		return $resultado;
	}

	public function getFirma(){
		$resultado = Utils::replace(strtoupper($this->getCaNombre()))."\n";
		$resultado .= $this->getCaCargo()."\nCOLTRANS S.A.\n";
		$sucursal = $this->getSucursal();
		if( $sucursal ){
			$resultado .= $sucursal->getCaDireccion()."\n";
			$resultado .= "Tel.: ".$sucursal->getCaTelefono()." ".$this->getCaExtension()."\n";
			$resultado .= "Fax.: ".$sucursal->getCaFax()."\n";
		}
		$resultado .= $sucursal->getCaNombre()." - Colombia\n";
		$resultado .= "http://www.coltrans.com.co";
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
                        
                        $this->setPasswd( $passwd );
                        $this->save();
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
             default:
                 $imagen = $this->getDirectorio().DIRECTORY_SEPARATOR.'foto120x150.jpg';
                 break;
         }
        
        return $imagen;
    }


}