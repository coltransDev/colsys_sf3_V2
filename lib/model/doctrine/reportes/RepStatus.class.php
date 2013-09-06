<?php

/**
 * RepStatus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class RepStatus extends BaseRepStatus
{
    var $bodega = null;

    const IDG_MARITIMO = 5; // 21000 5h 50m
    const IDG_AEREO = 4; // 16200 4h 30

	/*
	* Retorna la etapa del status
	* @author: Andres Botero
	*/
	public function getEtapa(){
		return $this->getCaEtapa();
	}

	public function getClass(){
		$etapa = $this->getTrackingEtapa();
		if( $etapa ){
			return $etapa->getCaClass();
		}
	}


    
	/*
	* Aplica la plantilla al status
	*/
	public function applyTemplate( $template ){

		$result = "";

		$tpl = explode(" ", $template );
        
		foreach( $tpl as $t ){
			if( $result ){
				$result.=" ";
			}

			if( substr($t,0,1)=="{" && substr($t,strlen($t)-1)=="}" ){
				$evalExpr = substr($t,1,strlen($t)-2);
				$evalExprArray = explode("_",$evalExpr);
				$str = "";
				foreach( $evalExprArray as $eval ){
					$str .= "->get".ucfirst($eval)."()";
				}
				eval("\$result .= \$this".$str.";");

			}else{
				$result.=$t;
			}
		}

		return $result;
	}

	/*
	*
	*/
	public function getTxtStatus(  ){
		$etapa = $this->getTrackingEtapa();
		$txt = "";

        /*
         * Si es un aviso y tiene carga embarcada no se aplica
         */
       /* if( $this->getCaIdetapa()=="IMETA" ){

            $count = Doctrine::getTable("RepStatus")
                                 ->createQuery("r")
                                 ->select("count(*)")
                                 ->where("r.ca_idetapa = ? AND r.ca_idreporte = ?", array("IMCEM", $this->getCaIdreporte()))
                                 ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                                 ->execute();

        }else{
            $count=0;
        }*/

		if( $etapa ){
			$template = $etapa->getCaMessage();
			if( $template ){                
                if( $this->getCaIdetapa()=="IACAD" ){
                    /*
                    * Si es un cabotaje el destino debe ser el final
                    */
                    $reporte = $this->getReporte();
                    if( $reporte->getCaContinuacion()=="CABOTAJE" ){
                        $template = "Nos permitimos informar que la carga en referencia lleg� a {reporte_destinoCont_caCiudad} el {caFchcontinuacion}";
                    }
                }
				$txt = $this->applyTemplate($template)."\n\n";
			}
		}        
		return $txt;
	}

	/*
	* Aplica el texto al status
	*/
	public function setStatus( $status ){

		$txt = $this->getTxtStatus();
		if( $txt ){
			$txt.="\n";
		}

		$this->setCaStatus( $txt.$status );

	}

	/*
	* Retorna el texto del status de acuaerdo a la plantilla
	*/
	public function getStatus(){
		if( $this->getCaStatus() ){
			return $this->getCaStatus();
		}else{
			return $this->getTxtStatus();
		}

	}

	/*
	* Envia el status, generalemte se usa despues de guardar
	*/
	public function getBodega(){
		if( !$this->bodega ){
			$idbodega = $this->getProperty("idbodega");
			if( $idbodega ){
				$this->bodega = Doctrine::getTable("Bodega")->find( $idbodega );
			}
		}

		return $this->bodega;
	}

	public function getIntroAsunto(){
		$etapa = $this->getTrackingEtapa();
		$reporte = $this->getReporte();
		if( $etapa ){
			$asunto = $etapa->getIntroAsunto();
		}else{
			$asunto = "";
		}

		$asunto .= " Id.: ".$reporte->getCaConsecutivo()." ";
		return $asunto;
	}

	public function getAsunto(){

		$reporte = $this->getReporte();

		$asunto = "";

		$origen = $reporte->getOrigen()->getCaCiudad();
		$destino = $reporte->getDestino()->getCaCiudad();
		$cliente = $reporte->getCliente();

		if( $reporte->getCaImpoexpo()=="Importaci�n" || $reporte->getCaImpoexpo()=="Triangulaci�n" ){
			$proveedor = substr($reporte->getProveedoresStr(),0,130);
			$asunto .= $proveedor." / ".$cliente." [".$origen." -> ".$destino."] ".$reporte->getCaOrdenClie();
		}else{
			$consignatario = $reporte->getConsignatario();
			$asunto .= $consignatario." / ".$cliente." [".$origen." -> ".$destino."] ";
		}
		return $asunto;
	}


    public function getUltReporte(){
        $rep = $this->getReporte();
        if( $rep ){
            $rep = Doctrine::getTable("Reporte")                         
                         ->createQuery("r")
                         ->select("r.*")                         
                         ->where("r.ca_consecutivo = ?", $rep->getCaConsecutivo())
                         ->addWhere("r.ca_usuanulado IS NULL")
                         ->orderBy("r.ca_version DESC")
                         ->limit("1")
                         ->fetchOne();
          
        }

        return $rep;
    }

	/*
	* Envia el status, generalemte se usa despues de guardar
	*/
	public function send(array $addresses=array(), array $cc=array(), array $attachments = array(),  $options=array() , $conn =null){

		$user = sfContext::getInstance()->getUser();

		$email = new Email();

		$email->setCaUsuenvio( $user->getUserId() );

		$email->setCaTipo( "Env�o de Status" );

		$email->setCaIdcaso( $this->getCaIdreporte() );

        $reporte = $this->getUltReporte();
        $user1 = Doctrine::getTable("Usuario")->find( $user->getUserId() );
        
        if($user->getSucursal()=="OBO")
        {
            $host="coltrans.com.co";
            $repotm=$reporte->getRepOtm();
            if(!$repotm)
                $repotm= new RepOtm();
            
            if($repotm->getCaLiberacion()=="" )
                $options["from"]=$user1->getProperty("alias")."@".$host;
            else 
            {
                $options["from"]=$user1->getProperty("alias")."@".$repotm->getCaLiberacion();
            }            
        }
		if(isset($options["from"]) && $options["from"] ){
			$email->setCaFrom( $options["from"] );
		}else{            
			$email->setCaFrom( $user->getEmail() );
		}
		$email->setCaFromname( $user->getNombre() );

		if( isset( $options['readreceipt'] ) && $options['readreceipt'] ){
			$email->setCaReadReceipt( true );
		}
        
        
		//$email->setCaReplyto( $user->getEmail() );

		foreach( $addresses as $recip ){
			$recip = str_replace(" ", "", $recip );
			if( $recip ){
				$email->addTo( $recip );
			}
		}

		foreach( $cc as $recip ){
			$recip = str_replace(" ", "", $recip );
			if( $recip ){
				$email->addCc( $recip );
			}
		}

		//$reporte = $this->getUltReporte();        
		if ( $reporte->getEsSeguro() ) {
			$email->addCc( "seguros@coltrans.com.co" );

			$repseguro = $reporte->getRepSeguro();
			if( $repseguro ){

				$usuario = Doctrine::getTable("Usuario")->find( $repseguro->getCaSeguroConf() );
				if( $usuario ){
					$email->addCc( $usuario->getCaEmail() );
				}
			}
		}

		if(isset($options["from"]) && $options["from"] ){
			$email->addCc( $options["from"] );
            $email->setCaReplyto( $options["from"] );
		}else{
			$email->addCc( $user->getEmail() );
            $email->setCaReplyto( $user->getEmail() );
		}
        if($reporte->getCaImpoexpo()!=Constantes::EXPO)
            $asunto = $this->getIntroAsunto();
		if(isset($options["subject"]) && $options["subject"] ){
            if($options["subject"]=="Notificaci�n de Desconsolidaci�n id: ".$reporte->getCaConsecutivo())
            {
                $asunto="";
            }
			$asunto.=  $options["subject"];
		}else{
			$asunto.= $this->getAsunto();
		}

		if( $attachments ){
			$email->setCaAttachment( implode( "|", $attachments ) );
		}
		$etapa = $this->getTrackingEtapa();
		if ( $reporte->getCaContinuacion() != 'N/A' ){
			if( ($etapa && $etapa->getCaDepartamento()!="OTM/DTA") || !$etapa ){
                if($reporte->getCaContinuacionConf()!="")
                {
                    $coordinador = Doctrine::getTable("Usuario")->find( $reporte->getCaContinuacionConf() );
                    if( $coordinador ){
                        $email->addCc( $coordinador->getCaEmail() );
                    }
                    else
                    {                        
                        if(in_array('cordinador-de-otm', $etapa->getPerfilxTipo('OTM')))
                        {
                            $suc=array();
                            switch($reporte->getCaContinuacionConf())
                            {
                                case "BOG":
                                    $suc[]='OBO';
                                    $suc[]='BOG';
                                break;
                                case "OBO":
                                    $suc[]='OBO';
                                    $suc[]='BOG';

                                break;

                                case "MDE":
                                    $suc[]='OMD';
                                    $suc[]='MDE';                    
                                break; 
                                case "OMD":
                                    $suc[]='OMD';
                                    $suc[]='MDE';                    
                                break; 
                            }

                            $coordinadores = Doctrine::getTable("Usuario")
                               ->createQuery("u")
                               ->select("u.ca_login,u.ca_nombre,u.ca_email")
                               ->innerJoin("u.UsuarioPerfil up")
                               ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE','cordinador-de-otm'))
                               ->andWhereIn("u.ca_idsucursal",$suc)               
                               ->addOrderBy("u.ca_idsucursal")
                               ->addOrderBy("u.ca_nombre")
                               ->execute();
                            foreach($coordinadores as $coordinador)
                            {
                                $email->addCc( $coordinador->getCaEmail() );
                            }
                        }
                    }
                }
			}
		}

		if ( $reporte->getCaColmas() == 'S�'  ){
			$repaduana = $reporte->getRepAduana();
			$coordinador = null;
			if( $repaduana ){
                
                if(in_array('coordinador-de-servicio-al-cliente-aduana', $etapa->getPerfilxTipo('ADUANA-COORDINADOR')))
                {
                    $coordinador = Doctrine::getTable("Usuario")->find($repaduana->getCaCoordinador());
                    if( $coordinador ){
                        $email->addCc( $coordinador->getCaEmail() );
                    }
                }
                
                $perfiles=array();
                
                if( ($reporte->getCaTransporte()==constantes::MARITIMO && $reporte->getCaImpoexpo()==constantes::IMPO) && $reporte->getCaContinuacion()!="OTM")
                {
                    if ( $reporte->getCaDeclaracionant() == "true" || $reporte->getCaDeclaracionant() == "TRUE" || $reporte->getCaDeclaracionant() == "1" || $reporte->getCaDeclaracionant() == 1  )
                        $perfiles=array("Jefe de Aduanas Puerto","Coordinador Control Riesgo Aduana");
                    else
                        $perfiles=$etapa->getPerfilxTipo('ADUANA-PUERTO');
                }
                else if(($reporte->getCaTransporte()==constantes::AEREO && $reporte->getCaImpoexpo()==constantes::IMPO) || $reporte->getCaContinuacion()=="OTM")
                {
                    if ( $reporte->getCaDeclaracionant() == "true" || $reporte->getCaDeclaracionant() == "TRUE" || $reporte->getCaDeclaracionant() == "1" || $reporte->getCaDeclaracionant() == 1  )
                        $perfiles=array("Jefe Dpto. Aduana","Coordinador Control Riesgo Aduana");
                    else
                        $perfiles= $etapa->getPerfilxTipo('ADUANA-AEREO');
                }
                if(count($perfiles)>0)
                {
                    $suc=$user->getSucursal();
                    if($suc=="ABG" || $suc=="BGA" || $suc=="PEI"  )
                    {
                        if($suc=="BGA")
                            $cargo1='Sin cargo';
                        $suc="BOG";
                    }
                    $sucursal=Doctrine::getTable("Sucursal")->find( $suc );                
                    if(!$sucursal)
                        $sucursal=new Sucursal();                    

                    //echo $cargo.'--Coordinador Control Riesgo Aduana---'.$sucursal->getCaNombre();

                    {    
                        $q = Doctrine::getTable("Usuario")
                                        ->createQuery("c")
                                        ->select("c.ca_email")
                                        ->innerJoin("c.Sucursal s")                                
                                        ->where("s.ca_nombre = ?", array($sucursal->getCaNombre()))
                                        ->andWhereIn("c.ca_cargo",$perfiles);
                        $jef_adu=$q->execute();
                        foreach($jef_adu as $j)
                        {
                            $email->addCc( $j->getCaEmail() );                            
                        }
                    }
                }
			}
		}        
        if ( $reporte->getCaDeclaracionant() == "true" || $reporte->getCaDeclaracionant() == "TRUE" || $reporte->getCaDeclaracionant() == "1" || $reporte->getCaDeclaracionant() == 1  ){
            $asunto="*ANT*".$asunto;
            $email->setCaPriority(1);                
        }
        $email->setCaSubject( substr($asunto, 0, 250) );
        
        if($this->getCaTipo()=="1")
        {
            
            $contac=array($email->getCaAddress(),$email->getCaReplyto(),$email->getCaCc());
            foreach($contac as $cont)
            {
                $contacts=explode(",",$cont);
                foreach($contacts as $c)
                {
                    if (stripos(strtolower($c), '@coltrans.com.co') !== false || stripos(strtolower($c), '@colmas.com.co') !== false || stripos(strtolower($c), '@colotm.com') !== false)
                    {
                        $contac[]["ca_email"]=$c;
                    }
                }
            }
        }

		sfContext::getInstance()->getRequest()->setParameter("idstatus", $this->getCaIdstatus());
		$email->setCaBodyhtml(  sfContext::getInstance()->getController()->getPresentationFor( 'traficos', 'verStatus') );
		$email->save( $conn );
		$this->setCaIdemail( $email->getCaIdemail() );
		$this->save( $conn );
		//$email->send();
	}

    public static function retrieveByHbl( $hbl ){

        $hbl = Doctrine::getTable("RepStatus")
                            ->createQuery("s")
                            ->where("s.ca_doctransporte = ?", $hbl )
                            ->addOrderBy("s.ca_idstatus DESC")
                            ->limit(1)
                            ->fetchOne();

		return $hbl;

	}
}