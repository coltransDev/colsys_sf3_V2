<?php
/**
 */
class UsuarioTable extends Doctrine_Table
{
    public static function getComerciales(){

        return Doctrine::getTable("Usuario")
                             ->createQuery("u")
                             ->select("u.*")
                             ->innerJoin("u.UsuarioPerfil up")
                             ->where("up.ca_perfil = ?", 'comercial')
                             ->addWhere("u.ca_activo = true")
                             ->addOrderBy("u.ca_nombre")
                             ->execute();
    }

    public static function getUsuariosSeguros(){

        return Doctrine::getTable("Usuario")
                             ->createQuery("u")
                             ->select("u.*")
                             ->innerJoin("u.UsuarioPerfil up")
                             ->where("up.ca_perfil = ?", 'tramitador-de-polizas')
                             ->addWhere("u.ca_activo = true")
                             ->addOrderBy("u.ca_nombre")
                             ->execute();
    }

    public static function getCoordinadoresAduana(){

        return Doctrine::getTable("Usuario")
                             ->createQuery("u")
                             ->select("u.*")
                             ->innerJoin("u.UsuarioPerfil up")
                             ->where("up.ca_perfil = ?", 'coordinador-de-servicio-al-cliente-aduana')
                             ->addWhere("u.ca_activo = true")
                             ->addOrderBy("u.ca_nombre")
                             ->execute();
        
    }
    
	public function getLuceneIndex(){
  		
		ProjectConfiguration::registerZend();
 	
		if (file_exists($index = $this->getLuceneIndexFile())){
    		return Zend_Search_Lucene::open($index);
  		}else{
    		return Zend_Search_Lucene::create($index);
  		}
  	}
 
	public function getLuceneIndexFile(){
  		
		return sfConfig::get('sf_data_dir').'/clientes.'.sfConfig::get('sf_environment').'.index';
	}
}