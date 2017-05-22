<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InformeOpenSoap
 *
 * @author alramirez
 */
class InformeOpenSoap {
    
    /**
     * View method
     *
     * @param array $params     
     * @return string
     */
    private function authenticate($params = array()){
        
        $nit = $params["nit"];
        
        $login = $_SERVER["PHP_AUTH_USER"]?$_SERVER["PHP_AUTH_USER"]:$_SERVER["HTTP_LOGIN"];
        $password = $_SERVER["PHP_AUTH_PW"]?$_SERVER["PHP_AUTH_PW"]:$_SERVER["HTTP_PASSWORD"];
        
        if(!empty($login) && !empty($password)) {            
        
            $query = "SELECT ca_id
                      FROM ids.tb_accesos_ws
                      WHERE
                        ca_id = $nit
                        AND ca_login = '".$login."'
                        AND ca_password = '".$password."'
                        AND ca_activo = TRUE
                      LIMIT 1";
            
            $con = Doctrine_Manager::getInstance()->getConnection('master');
            $st = $con->execute($query);
            $this->resul = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);  
                        
            //add your own auth code here. I have it check against a database table and return a value if found.            
            if($this->resul) {                 
                return true;                 
            } else {                
                return false;
            }             
        } else {
             return false;             
        }
    }    
    
    /**
     * verListadoDeclaraciones method
     *     
     * @param string $nit
     * @param string $pedido
     * @return array string
     */    
    public function verListadoDeclaraciones($nit, $pedido) {
        
        $params = array("nit"=>$nit);        
        $auth = $this->authenticate($params);
        
        if($auth){            
            try {
                $con = Doctrine_Manager::getInstance()->getConnection('opencomex');

                $sql = "
                    SELECT 
                        brk.DOIIDXXX    as ca_referencia, 
                        brk.DOISFIDX, 
                        brk. ADMIDXXX, 
                        X.SUBID2XX, 
                        brk.DOIPEDXX    as ca_pedido, 
                        LIMSTKXX        as ca_numdeclaracion, 
                        LIMFSTKX        as ca_fchdeclaracion, 
                        SUB.CANTIDAD_DAV as ca_cant_dav, 
                        MODIDXXX        as ca_modalidad, 
                        X.DGETRMXX      as ca_tasa, 
                        LIMNETXX        as ca_valor_aduana, 
                        R.ODIIDXXX      as ca_codciudad,
                        R.ODIDESXX      as ca_ciudad, 
                        X.LIMFACEX      as ca_fchaceptacion, 
                        X.limacexx      as ca_aceptacion, 
                        limflevx        as ca_fchlevante, 
                        LIMLEVXX        as ca_numlevante, 
                        X.CLIUAPXX      as ca_aplica_uap, 
                        ARCIDXXX        as ca_subpartida,
                        LIMVLRXX        as ca_fob,
                        LIMCANXX        as ca_cant,
                        ARCPORXX        as ca_arancel,
                        LIMGRAXX        as ca_gravamen,
                        LIMSUBTX        as ca_iva,
                        SUBSALTL        as ca_sobretasa,
                        SUBSANTL        as ca_multa
                    FROM COLMASXX.SIAI0200 AS brk 
                        LEFT JOIN COLMASXX.SIAI0206 AS X ON (brk.DOIIDXXX = X.DOIIDXXX AND brk.DOISFIDX = X.DOISFIDX AND brk.ADMIDXXX = X.ADMIDXXX)    
                        LEFT JOIN COLMASXX.SIAI0103 AS R ON X.ODIIDXXX = R.ODIIDXXX
                        LEFT JOIN (
                            SELECT COUNT(DOIIDXXX) AS CANTIDAD_DAV, DOIIDXXX, DOISFIDX, ADMIDXXX
                            FROM COLMASXX.SIAI0207			            
                            GROUP BY DOIIDXXX, DOISFIDX, ADMIDXXX
                            ) AS SUB on SUB.DOIIDXXX = X.DOIIDXXX AND SUB.DOISFIDX = X.DOISFIDX AND SUB.ADMIDXXX = X.ADMIDXXX
                    WHERE brk.CLIIDXXX = '$nit' AND brk.DOIAPDTA = false and brk.DOIPEDXX LIKE '%$pedido%'
                    ORDER BY brk.DOIPEDXX, brk.DOIIDXXX ASC";
                $st = $con->execute($sql);
                $this->resul = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                
                $data = array();
                foreach($this->resul as $k=>$r){
                    $data[$k]["NumeroDeclaracion"] =   $r["ca_numdeclaracion"];
                    $data[$k]["Fechadeclaracion"] =    $r["ca_fchdeclaracion"];
                    $data[$k]["CantidaddeDeclaracionesdevalor"] = $r["ca_cant_dav"];
                    $data[$k]["Modalidad"] =            $r["ca_modalidad"];
                    $data[$k]["Tasarepresentativa"] =  $r["ca_tasa"];
                    $data[$k]["Valoraduana"] =         $r["ca_valor_aduana"];
                    $data[$k]["Ciudadaduana"] =        "(".$r["ca_codciudad"].") ".$r["ca_ciudad"];
                    $data[$k]["Fechaaceptacion"] =     $r["ca_fchaceptacion"];
                    $data[$k]["Numeroaceptacion"] =    $r["ca_aceptacion"];
                    $data[$k]["Fechalevante"] =        $r["ca_fchlevante"];
                    $data[$k]["Numerolevante"] =       $r["ca_numlevante"];
                    $data[$k]["AplicaUAP"] =           $r["ca_aplica_uap"];
                    $data[$k]["Subpartida"] =           $r["ca_subpartida"];
                    $data[$k]["FOB"] =                  $r["ca_fob"];
                    $data[$k]["Cantidad"] =             $r["ca_cant"];
                    $data[$k]["PorcentajeArancel"] =   $r["ca_arancel"];
                    $data[$k]["Gravamen"] =             $r["ca_gravamen"];
                    $data[$k]["IVA"] =                  $r["ca_iva"];
                    $data[$k]["Sobretasa"] =            $r["ca_sobretasa"];
                    $data[$k]["Multa"] =                $r["ca_multa"];
                }
                return $data;
            }
            catch (Exception $e){                
                return array("Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"]);//." u:".$usuario."-nu:".$newUsuario;
            }            
        }else{
            
            
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("Ws");
            $email->setCaIdcaso($nit);
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");

            $email->setCaSubject("Fallo autenticación Nit #" . $nit);
            $texto = "Log de eventos.<br/>".print_r($_REQUEST)."<br/>".print_r($_SERVER);
            $log = json_encode($_SERVER);
            $log.="<br/>".json_encode($_REQUEST);
            $email->setCaBodyhtml($log);                    
            $email->addTo("alramirez@coltrans.com.co");
            $email->addTo("colsys@coltrans.com.co");
            $email->save();
            $email->send();
            
            $login = $_SERVER["PHP_AUTH_USER"]?$_SERVER["PHP_AUTH_USER"]:$_SERVER["HTTP_LOGIN"];
            $password = $_SERVER["PHP_AUTH_PW"]?$_SERVER["PHP_AUTH_PW"]:$_SERVER["HTTP_PASSWORD"];
            
            return array("Falló Autenticación: Login=>".$login." Password=>".$password);
        }
    }    
}