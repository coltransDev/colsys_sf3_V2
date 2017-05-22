<?php

/**
 * config actions.
 *
 * @package    symfony
 * @subpackage config
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class falabellaAdu2Actions extends sfActions {


/**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */

    public function preExecute() {
        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        switch ($app) {
            case "colsys":
                $this->pref = "";
                $this->idcliente = '900017447';//falabella
                $this->top = 30;
                break;
            case "tracking":
                $this->pref = "/tracking";
                $this->top = 75;
                $this->idcliente = $this->getUser()->getClienteActivo();
                break;
        }

        /*if ($this->idcliente == "900204182") {
            $this->plantilla = true;
        } else
            $this->plantilla = false;
         */
    }
    

    
    public function executeActualizarfechasdo(sfWebRequest $request)
    {
//210.10.07.0032.16
            $con = Doctrine_Manager::getInstance()->getConnection('opencomex');
            $con1 = Doctrine_Manager::getInstance()->getConnection('master');

            $sql="SELECT 
            distinct(brk.DOIIDXXX)    as ca_referencia,             
                      
            
            brk.DOIMYDOC    as ca_fchmayordoc,
            brk.DOIMYLEV    as ca_fchlevante,
            brk.DOIMYSTK    as ca_fchpago,
            brk.DOIFLOSI    as ca_fchsiga,
            brk.DOIENTTR    as ca_fchenttransportador,
            brk.DOIDEDEP    as ca_fchdespcarga,
            brk.DGEFMCXX    as ca_fcheta,
            brk.DOIFENCA    as ca_fchentrcarpfacturacion,
            brk.DOIFENFA    as ca_fchentrfacturacion,
            brk.DOIFENTR    as ca_fchfacturacion,
            brk.DOIFENME    as ca_fchmensajeria,
            q.docmtrxx      as ca_transporte
            /*, (SELECT COUNT(*) FROM COLMASXX.SIAI0205 AS items WHERE brk.DOIIDXXX = items.DOIIDXXX and brk.DOISFIDX=items.DOISFIDX )    as ca_nitems                   */
            
            FROM COLMASXX.SIAI0200 AS brk            
            INNER JOIN COLMASXX.sys00121 AS q ON (brk.DOIIDXXX = q.docidxxx AND brk.DOISFIDX = q.docsufxx AND brk.ADMIDXXX = q.sucidxxx)
        
        WHERE 
            (
            (brk.REGFECXX>='2017-01-01'  )
            and brk.DOISFIDX='001' and brk.REGESTXX ='ACTIVO'
            )";
            
            
            $st = $con->execute($sql);
            //echo $sql;
            $this->resul = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        /*echo "<pre>";
        print_r($this->resul);
        echo "</pre>";
            exit;*/
        $importa=array();
        $noimporta=array();
        foreach($this->resul as $datos)
        {
            $caReferencia=substr($datos["ca_referencia"],0,3).".".substr($datos["ca_referencia"],3,2).".".substr($datos["ca_referencia"],5,2).".0"
                .substr($datos["ca_referencia"],7,3).".1".substr($datos["ca_referencia"],10,1);               

            $ref = Doctrine::getTable("InoMaestraAdu")->find($caReferencia);

            if($datos["ca_transporte"]=="MARITIMO")
                $datos["ca_transporte"]=  Constantes::MARITIMO;
            else if($datos["ca_transporte"]=="AEREO")
                $datos["ca_transporte"]=  Constantes::AEREO;
            else
                $datos["ca_transporte"]=  "";

            if($ref)
            {                    
                if($datos["ca_fchlevante"]!="" && $datos["ca_fchlevante"]!="0000-00-00")
                    $ref->setCaFchlevante($datos["ca_fchlevante"]);

                if($datos["ca_fchpago"]!="" && $datos["ca_fchpago"]!="0000-00-00")
                    $ref->setCaFchpago($datos["ca_fchpago"]);

                if($datos["ca_fchsiga"]!="" && $datos["ca_fchsiga"]!="0000-00-00")
                    $ref->setCaFchsiga($datos["ca_fchsiga"]);

                if($datos["ca_fchenttransportador"]!="" && $datos["ca_fchenttransportador"]!="0000-00-00")
                    $ref->setCaFchenttransportador($datos["ca_fchenttransportador"]);

                if($datos["ca_fchdespcarga"]!="" && $datos["ca_fchdespcarga"]!="0000-00-00")
                    $ref->setCaFchdespcarga($datos["ca_fchdespcarga"]);

                if($datos["ca_fcheta"]!="" && $datos["ca_fcheta"]!="0000-00-00")
                    $ref->setCaFcheta($datos["ca_fcheta"]);

                if($datos["ca_fchentrcarpfacturacion"]!="" && $datos["ca_fchentrcarpfacturacion"]!="0000-00-00")
                    $ref->setCaFchentrcarpfacturacion($datos["ca_fchentrcarpfacturacion"]);

                if($datos["ca_fchentrfacturacion"]!="" && $datos["ca_fchentrfacturacion"]!="0000-00-00")
                    $ref->setCaFchentrfacturacion($datos["ca_fchentrfacturacion"]);

                if($datos["ca_fchfacturacion"]!="" && $datos["ca_fchfacturacion"]!="0000-00-00")
                    $ref->setCaFchfacturacion($datos["ca_fchfacturacion"]);


                if($datos["ca_fchmayordoc"]!="" && $datos["ca_fchmayordoc"]!="0000-00-00")
                    $ref->setCaFchmayordoc($datos["ca_fchmayordoc"]);

                if($datos["ca_fchmensajeria"]!="" && $datos["ca_fchmensajeria"]!="0000-00-00")
                    $ref->setCaFchmensajeria($datos["ca_fchmensajeria"]);

                if($datos["ca_fchenttransportador"]!="" && $datos["ca_fchenttransportador"]!="0000-00-00")
                    $ref->setCaFchenttransportador($datos["ca_fchenttransportador"]);

                if($datos["ca_transporte"]!="" )
                    $ref->setCaTransporte($datos["ca_transporte"]);

                /*if($datos["ca_nitems"]!="" )
                    $ref->setCaNitems($datos["ca_nitems"]);*/

                $ref->stopBlaming();
                $ref->save();

                $importa[]=$caReferencia;
            }
            else
            {
                $noimporta[]=$caReferencia;                   
            }
        }
        echo "Se importaron los siguientes D0:".implode("<br>", $importa);            
        echo "<br><br>No Se importaron los siguientes D0:".implode("<br>", $noimporta);
        exit;
    }


    public function executeTaskImportarDo(sfWebRequest $request)
    {
            $con = Doctrine_Manager::getInstance()->getConnection('opencomex');
            $con1 = Doctrine_Manager::getInstance()->getConnection('master');

            $fechafil=date("Y-m-d");
            //$fechafil="2016-09-02";
            $ndias=-1;
            //$ndias=0;
            
            $email = ParametroTable::retrieveByCaso("CU067", null, null,3);
            
            //foreach()
            //echo "::".$email[0]->getCaValor2();
            //exit;
            
            $nits ="'900017447','830091748', '800026212', '830066852'
            ,'860004270','900144807', '830055853', '830001490'
            ,'830134654','860535493', '900322900', '800185683'
            ,'891410137','800087902', '900204182', '830055643'
            ,'900766060','800137068', '900833595', '900926426'
            ,'88236840','830138217', '900085739', '900491174'
            ,'900138085','900591448', '900782422', '900450455'
            ,'900238976','900512637', '832005624', '900741561'
            ,'830018818','900879599', '900231994', '900884373'";
            
            //$nits ="'900017447','830091748'";
            
            
            $sql="SELECT 
            distinct(brk.DOIIDXXX)    as ca_referencia,             
            brk.DOISFIDX    as ca_version,
            brk.REGFECXX    as ca_fchcreado, 
            brk.REGHORXX    as ca_hracreado, 
            brk.ADMIDXXX    as ca_destino,            
            p.PIECIUXX      as ca_origen, 
            brk.LINIDXXX    as ca_destino, 
            brk.CLIIDXXX    as ca_idcliente, 
            brk.DOCVENXX    as ca_idvendedor,
            brk.USRID2XX    as ca_idcoordinador, 
            brk.USRIDXXX    as ca_idanalista,
            p.PIENOMXX      as ca_proveedor, 
            q.docpedxx      as ca_pedido, 
            
            items.ITECANXX  as ca_piezas, 
            items.LIMPBRXX  as ca_peso, 
            items.ITENOCXX  as ca_mercancia, 
            
            dep.DAADESXX    as ca_deposito, 
            brk.DOIFRAXX    as ca_fcharribo, 
            brk.DGEFMCXX    as ca_fcharribo1, 
            brk.DOIETAXX    as ca_fcharribo2, 
            modal.MODDESXX  as ca_modalidad,
            q.docmtrxx      as ca_transporte,
            brk.DOIMYDOC    as ca_fchmayordoc,
            brk.DOIMYLEV    as ca_fchlevante,
            brk.DOIMYSTK    as ca_fchpago,
            brk.DOIFLOSI    as ca_fchsiga,
            brk.DOIENTTR    as ca_fchenttransportador,
            brk.DOIDEDEP    as ca_fchdespcarga,
            brk.DGEFMCXX    as ca_fcheta,
            brk.DOIFENCA    as ca_fchentrcarpfacturacion,
            brk.DOIFENFA    as ca_fchentrfacturacion,
            brk.DOIFENTR    as ca_fchfacturacion,
            brk.DOIFENME    as ca_fchmensajeria,            
            (SELECT count(*) FROM COLMASXX.SIAI0205 AS items1 WHERE brk.DOIIDXXX = items1.DOIIDXXX and brk.DOISFIDX=items1.DOISFIDX ) as ca_nitems,
            
            brk.REGMODXX    as ca_actualizado,
            
            
            h.REGFECXX      as ca_fchcreadoh, 
            h.REGHORXX    	as ca_hracreadoh,  
            h.REGMODXX    	as ca_actualizadoh,
            
            
            
            items.REGFECXX      as ca_fchcreadoitems, 
            items.REGHORXX    	as ca_hracreadoitems,
            items.REGMODXX    	as ca_actualizadoitems,
            
            sub.REGFECXX      as ca_fchcreadosub, 
            sub.REGHORXX    	as ca_hracreadosub,
            sub.REGMODXX    	as ca_actualizadosub
            
                       
            
FROM COLMASXX.SIAI0200 AS brk
        LEFT JOIN COLMASXX.SIAI0202 AS h ON (brk.DOIIDXXX = h.DOIIDXXX AND brk.DOISFIDX = h.DOISFIDX AND brk.ADMIDXXX = h.ADMIDXXX and h.RIMIDXXX='.1')
        LEFT JOIN COLMASXX.SIAI0125 AS p ON h.PIEIDXXX = p.PIEIDXXX
        INNER JOIN COLMASXX.sys00121 AS q ON (brk.DOIIDXXX = q.docidxxx AND brk.DOISFIDX = q.docsufxx AND brk.ADMIDXXX = q.sucidxxx)
        LEFT JOIN COLMASXX.SIAI0205 AS items ON brk.DOIIDXXX = items.DOIIDXXX and brk.DOISFIDX=items.DOISFIDX and items.ITEIDXXX=1
        LEFT JOIN COLMASXX.SIAI0110 AS dep ON brk.DAAIDXXX = dep.DAAIDXXX
        LEFT JOIN COLMASXX.SIAI0203 AS sub ON (items.SUBIDXXX = sub.SUBIDXXX AND brk.DOIIDXXX = sub.DOIIDXXX AND brk.DOISFIDX = sub.DOISFIDX AND brk.ADMIDXXX = sub.ADMIDXXX)
        LEFT JOIN COLMASXX.SIAI0121 AS modal ON sub.MODIDXXX = modal.MODIDXXX
        WHERE 
            (
                (brk.REGFECXX>='".Utils::addDate($fechafil, $ndias)."' or brk.REGMODXX >='".Utils::addDate($fechafil, $ndias)."' )
            or
                (h.REGFECXX>='".Utils::addDate($fechafil, $ndias)."' or h.REGMODXX >='".Utils::addDate($fechafil, $ndias)."')
            or
                (items.REGFECXX>='".Utils::addDate($fechafil, $ndias)."' or items.REGMODXX >='".Utils::addDate($fechafil, $ndias)."')
            or
                (sub.REGFECXX>='".Utils::addDate($fechafil, $ndias)."' or sub.REGMODXX >='".Utils::addDate($fechafil, $ndias)."')
              or
                brk.DOIFENTR>='".Utils::addDate($fechafil, $ndias)."' or  brk.DOIFENME>='".Utils::addDate($fechafil, $ndias)."'
            )
            and brk.CLIIDXXX in (
            ".$nits."
            )  and  brk.REGESTXX ='ACTIVO'            
             and brk.DOISFIDX='001'             
            /*and brk.DOIIDXXX = '22070080316' and brk.DOISFIDX='001'*/
            /*and brk.DOIIDXXX = '22070060316' and brk.DOISFIDX='001'*/";
            
            
            $sql="SELECT 
            distinct(brk.DOIIDXXX)    as ca_referencia,             
            brk.DOISFIDX    as ca_version,
            brk.REGFECXX    as ca_fchcreado, 
            brk.REGHORXX    as ca_hracreado, 
            brk.ADMIDXXX    as ca_destino,            
            p.PIECIUXX      as ca_origen, 
            brk.LINIDXXX    as ca_destino, 
            brk.CLIIDXXX    as ca_idcliente, 
            brk.DOCVENXX    as ca_idvendedor,
            brk.USRID2XX    as ca_idcoordinador, 
            brk.USRIDXXX    as ca_idanalista,
            p.PIENOMXX      as ca_proveedor, 
            q.docpedxx      as ca_pedido, 
            
            items.ITECANXX  as ca_piezas, 
            items.LIMPBRXX  as ca_peso, 
            items.ITENOCXX  as ca_mercancia, 
            
            dep.DAADESXX    as ca_deposito, 
            brk.DOIFRAXX    as ca_fcharribo, 
            brk.DGEFMCXX    as ca_fcharribo1, 
            brk.DOIETAXX    as ca_fcharribo2, 
            modal.MODDESXX  as ca_modalidad,
            q.docmtrxx      as ca_transporte,
            brk.DOIMYDOC    as ca_fchmayordoc,
            brk.DOIMYLEV    as ca_fchlevante,
            brk.DOIMYSTK    as ca_fchpago,
            brk.DOIFLOSI    as ca_fchsiga,
            brk.DOIENTTR    as ca_fchenttransportador,
            brk.DOIDEDEP    as ca_fchdespcarga,
            brk.DGEFMCXX    as ca_fcheta,
            brk.DOIFENCA    as ca_fchentrcarpfacturacion,
            brk.DOIFENFA    as ca_fchentrfacturacion,
            brk.DOIFENTR    as ca_fchfacturacion,
            brk.DOIFENME    as ca_fchmensajeria,            
            (SELECT count(*) FROM COLMASXX.SIAI0205 AS items1 WHERE brk.DOIIDXXX = items1.DOIIDXXX and brk.DOISFIDX=items1.DOISFIDX ) as ca_nitems,
            
            brk.REGMODXX    as ca_actualizado,
            
            
            h.REGFECXX      as ca_fchcreadoh, 
            h.REGHORXX    	as ca_hracreadoh,  
            h.REGMODXX    	as ca_actualizadoh,
            
            
            
            items.REGFECXX      as ca_fchcreadoitems, 
            items.REGHORXX    	as ca_hracreadoitems,
            items.REGMODXX    	as ca_actualizadoitems,
            
            sub.REGFECXX      as ca_fchcreadosub, 
            sub.REGHORXX    	as ca_hracreadosub,
            sub.REGMODXX    	as ca_actualizadosub
            
                       
            
FROM COLMASXX.SIAI0200 AS brk
        LEFT JOIN COLMASXX.SIAI0202 AS h ON (brk.DOIIDXXX = h.DOIIDXXX AND brk.DOISFIDX = h.DOISFIDX AND brk.ADMIDXXX = h.ADMIDXXX and h.RIMIDXXX='.1')
        LEFT JOIN COLMASXX.SIAI0125 AS p ON h.PIEIDXXX = p.PIEIDXXX
        INNER JOIN COLMASXX.sys00121 AS q ON (brk.DOIIDXXX = q.docidxxx AND brk.DOISFIDX = q.docsufxx AND brk.ADMIDXXX = q.sucidxxx)
        LEFT JOIN COLMASXX.SIAI0205 AS items ON brk.DOIIDXXX = items.DOIIDXXX and brk.DOISFIDX=items.DOISFIDX and items.ITEIDXXX=1
        LEFT JOIN COLMASXX.SIAI0110 AS dep ON brk.DAAIDXXX = dep.DAAIDXXX
        LEFT JOIN COLMASXX.SIAI0203 AS sub ON (items.SUBIDXXX = sub.SUBIDXXX AND brk.DOIIDXXX = sub.DOIIDXXX AND brk.DOISFIDX = sub.DOISFIDX AND brk.ADMIDXXX = sub.ADMIDXXX)
        LEFT JOIN COLMASXX.SIAI0121 AS modal ON sub.MODIDXXX = modal.MODIDXXX
        WHERE 
            (
                (brk.REGFECXX>='".Utils::addDate($fechafil, $ndias)."' or brk.REGMODXX >='".Utils::addDate($fechafil, $ndias)."' )
            or
                (h.REGFECXX>='".Utils::addDate($fechafil, $ndias)."' or h.REGMODXX >='".Utils::addDate($fechafil, $ndias)."')
            or
                (items.REGFECXX>='".Utils::addDate($fechafil, $ndias)."' or items.REGMODXX >='".Utils::addDate($fechafil, $ndias)."')
            or
                (sub.REGFECXX>='".Utils::addDate($fechafil, $ndias)."' or sub.REGMODXX >='".Utils::addDate($fechafil, $ndias)."')
              or
                brk.DOIFENTR>='".Utils::addDate($fechafil, $ndias)."' or  brk.DOIFENME>='".Utils::addDate($fechafil, $ndias)."'
            )
             and  brk.REGESTXX ='ACTIVO'            
             and brk.DOISFIDX='001'             
            /*and brk.DOIIDXXX = '22070080316' and brk.DOISFIDX='001'*/
            /*and brk.DOIIDXXX = '22070060316' and brk.DOISFIDX='001'*/";

            //where brk.REGFECXX>'2015-10-08' order by 1,2,3,4";//WHERE brk.DOIIDXXX = '22070091425' ";//WHERE brk.DOIIDXXX = '21010050425' AND brk.DOISFIDX = '001'";        //22070091425        
            $st = $con->execute($sql);
            echo $sql;
            $this->resul = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);        

        $noimportado= array();
        $importado= array();

        foreach($this->resul as $k=>$r)
        {
            
            $caReferecnia=substr($r["ca_referencia"],0,3).".".substr($r["ca_referencia"],3,2).".".substr($r["ca_referencia"],5,2).".0"
                .substr($r["ca_referencia"],7,3).".1".substr($r["ca_referencia"],10,1);
            
            echo $caReferecnia."<br>";
            $ref = Doctrine::getTable("InoMaestraAdu")->find($caReferecnia);
            $this->resul[$k]["ca_referencia1"]=$caReferecnia;
            
            if($ref)
            {            
                if($ref->getCaFchcerrado()!="")
                {
                    
                    $noimportado[]=$caReferecnia." Cerrada ---> ".$ref->getCliente()->getCaIdalterno()."-".$ref->getCliente()->getCaDigito()."  ".$ref->getCliente()->getCaCompania();
                    continue;
                }
            }
            else
            {  
                //continue;
                //echo "---";
            }

            $sql="select c.*,fun_similarpercent('".$r["ca_origen"]."',c.ca_ciudad ) from tb_ciudades c
            where fun_similarpercent('".$r["ca_origen"]."',c.ca_ciudad )>60";

            $st = $con1->execute($sql);
            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($ciu_simil)>0)
            {
                //echo "120";
                $this->resul[$k]["ca_idorigen1"]=$ciu_simil[0]["ca_idciudad"];
                $this->resul[$k]["ca_origen1"]=$ciu_simil[0]["ca_ciudad"];
                $this->resul[$k]["ca_traforigen1"]=$ciu_simil[0]["ca_idtrafico"];
            }
            else
            {
                $this->resul[$k]["ca_idorigen1"]="DRZ-0513";
                $this->resul[$k]["ca_origen1"]="Durres";
                $this->resul[$k]["ca_traforigen1"]="AL-355";
            }

            $sql="select c.*,fun_similarpercent('".$r["ca_destino"]."',c.ca_idciudad ) from tb_ciudades c
            where fun_similarpercent('".$r["ca_destino"]."',c.ca_idciudad )>60";

            $st = $con1->execute($sql);
            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($ciu_simil)>0)
            {
                
                $this->resul[$k]["ca_iddestino1"]=$ciu_simil[0]["ca_idciudad"];
                $this->resul[$k]["ca_destino1"]=$ciu_simil[0]["ca_ciudad"];
                $this->resul[$k]["ca_trafdestino1"]=$ciu_simil[0]["ca_idtrafico"];
            }
            else
            {
               
                $this->resul[$k]["ca_iddestino1"]="DRZ-0513";
                $this->resul[$k]["ca_destino1"]="Durres";
                $this->resul[$k]["ca_trafdestino1"]="AL-355";
            }

            $sql="select c.* from vi_concliente c
            where UPPER(ca_idalterno) = '".trim($this->resul[$k]["ca_idcliente"])."' and ca_fijo=true  limit 1";
            $st = $con1->execute($sql);
            //echo $sql;
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($tmp_simil)>0)
            {
                $this->resul[$k]["ca_compania"]=$tmp_simil[0]["ca_compania"];
                $this->resul[$k]["ca_nombrecontacto"]=$tmp_simil[0]["ca_ncompleto_cn"];
                $this->resul[$k]["ca_emailcontacto"]=$tmp_simil[0]["ca_email"];
                $this->resul[$k]["ca_idcliente1"]=$tmp_simil[0]["ca_idcliente"]; 
                
                $this->resul[$k]["ca_vendedor"]=$tmp_simil[0]["ca_vendedor"];
            }
            else
            {
                /*$this->resul[$k]["ca_compania"]="<span class='rojo'>No Registrado en Colsys</span>";
                $this->resul[$k]["ca_nombrecontacto"]="<span class='rojo'>No Registrado en Colsys</span>";
                $this->resul[$k]["ca_emailcontacto"]="<span class='rojo'>No Registrado en Colsys</span>";*/
                //$noimportado[]=$caReferecnia." ---> ".$ref->getCliente()->getCaIdalterno()."-".$ref->getCliente()->getCaDigito()."  ".$ref->getCliente()->getCaCompania();
                $noimportado[]=$caReferecnia." ---> Cliente no encontrado  ".$this->resul[$k]["ca_idcliente"];
                continue;
            }
            
            
            $sql="select u.ca_login from control.tb_usuarios u
            where ca_docidentidad = '".$this->resul[$k]["ca_idanalista"]."'";
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($tmp_simil)>0)
            {
                $this->resul[$k]["ca_analista"]=$tmp_simil[0]["ca_login"];
            }
            else
            {
                //$this->resul[$k]["ca_analista"]="<span class='rojo'>No Registrado en Colsys</span>";
                $noimportado[]=$caReferecnia." ---> Analista no encontrado ".$ref->getCliente()->getCaIdalterno()."-".$ref->getCliente()->getCaDigito()."  ".$ref->getCliente()->getCaCompania();
                continue;
            }
            
            
            if($this->resul[$k]["ca_vendedor"]=="")
            {
                $sql="select u.ca_login from control.tb_usuarios u
                where ca_docidentidad = '".$this->resul[$k]["ca_idvendedor"]."'";            
                $st = $con1->execute($sql);
                $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                if(count($tmp_simil)>0)
                {

                        $this->resul[$k]["ca_vendedor"]=$tmp_simil[0]["ca_login"];
                }
                else
                {
                    $noimportado[]=$caReferecnia." ---> Vendedor no identificado ".$this->resul[$k]["ca_idvendedor"];
                    continue;
                    //$this->resul[$k]["ca_vendedor"]="<span class='rojo'>No Registrado en Colsys</span>";
                }
            }
            
            
            $sql="select u.ca_login from control.tb_usuarios u
            where ca_docidentidad = '".$this->resul[$k]["ca_idcoordinador"]."'";
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($tmp_simil)>0)
            {
                $this->resul[$k]["ca_coordinador"]=$tmp_simil[0]["ca_login"];
            }
            else
            {
                /*if($ref->getCliente())
                    $noimportado[]=$caReferecnia." ---> ".$ref->getCliente()->getCaIdalterno()."-".$ref->getCliente()->getCaDigito()."  ".$ref->getCliente()->getCaCompania();
                else*/
                    $noimportado[]=$caReferecnia." ---> coordinador no encontrado";
                
                continue;
                //$this->resul[$k]["ca_coordinador"]="<span class='rojo'>No Registrado en Colsys</span>";
            }
            
            //MODALIDAD ADUANA
            $sql="select *,fun_similarpercent('IMPORTACION ORDINARIA',v.ca_value ) 
            from control.tb_config_values v
            inner join control.tb_config c ON c.ca_idconfig=v.ca_idconfig and ca_param='CU025'
            where fun_similarpercent('".$this->resul[$k]["ca_modalidad"]."',v.ca_value ) >60
            order by ca_ident
            limit 1";
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($tmp_simil)>0)
            {
                $this->resul[$k]["ca_modalidad1"]=$tmp_simil[0]["ca_ident"];
            }
            else
            {
                $this->resul[$k]["ca_modalidad1"]="1";
            }
            
            if($this->resul[$k]["ca_transporte"]=="MARITIMO")
                $this->resul[$k]["ca_transporte"]=  Constantes::MARITIMO;
            else if($this->resul[$k]["ca_transporte"]=="AEREO")
                $this->resul[$k]["ca_transporte"]=  Constantes::AEREO;
            else
                $this->resul[$k]["ca_transporte"]=  Constantes::MARITIMO;
            
            if($this->resul[$k]["ca_proveedor"]=="")
                $this->resul[$k]["ca_proveedor"]="Sin Proveedor";
            
            if($this->resul[$k]["ca_peso"]=="")
                $this->resul[$k]["ca_peso"]="0";
            
            if($this->resul[$k]["ca_piezas"]=="")
                $this->resul[$k]["ca_piezas"]="0";
            
            if($this->resul[$k]["ca_mercancia"]=="")
                $this->resul[$k]["ca_mercancia"]="Sin Mercancia";
            
            if($this->resul[$k]["ca_deposito"]=="")
                $this->resul[$k]["ca_deposito"]="Sin Deposito";
            
            if($this->resul[$k]["ca_fcharribo"]=="0000-00-00")
                $this->resul[$k]["ca_fcharribo"]=date("Y-m-d");
            
                
            $sql="select * from tb_costos c
            where ca_impoexpo = 'Aduanas' and ca_transporte='{$this->resul[$k]["ca_transporte"]}' and ca_conceptoopen IS NOT NULL ";
            //echo $sql;
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            
            $this->resul[$k]["ca_transporte"]=  utf8_encode($this->resul[$k]["ca_transporte"]);

            $this->costos=$tmp_simil;
            $this->costos1= array();
            foreach($this->costos as $l=>$c)
            {
                $arrCos=explode("|",$c["ca_conceptoopen"]);
                foreach($arrCos as $tmpc  )
                {
                    //echo $tmpc;
                    if(trim($tmpc)!="")
                        $costos1[$tmpc]=$l;
                }
            }
            
                     /*--------------------------------------------------------------------------------------------------------------------------------------------------*/
            $year=date('Y');
            $yearold=$year-1;
            $sql="SELECT * from COLMASXX.fcoc$yearold where COMIDXXX='F' and comfpxxx like '%{$r['ca_referencia']}%' and regestxx='ACTIVO'"
                . " UNION "
                . " SELECT * from COLMASXX.fcoc$year where COMIDXXX='F' and comfpxxx like '%{$r['ca_referencia']}%' and regestxx='ACTIVO'";
            //$sql="SELECT * from COLMASXX.fcoc2015 where COMIDXXX='F' and regstamp>'2015-10-07 '";



            $st = $con->execute($sql);
            $this->resul[$k]["facturacion"] = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);



            if($debug=="true")
            {
                echo "FACTURACION<pre>";print_r($this->resul[$k]["facturacion"]);echo "</pre>";
            }

            //echo "----------------------------------------------------------------------";

            //$sql="SELECT * FROM COLMASXX.fcod2015 where (COMIDXXX='F' or (COMIDXXX='P' and comcodxx='004')) and DOCIDXXX like '%{$this->do}%'";
            $sql="SELECT * FROM COLMASXX.fcod$yearold where (COMIDXXX='F' or ( COMIDXXX='P' and comcodxx='004' and comfacxx ='') or ( COMIDXXX='P' and comcodxx='020' and ctoidxxx='2815050025' ) ) and DOCIDXXX like '%{$r['ca_referencia']}%' and regestxx='ACTIVO'"
            . " UNION SELECT * FROM COLMASXX.fcod$year where (COMIDXXX='F' or ( COMIDXXX='P' and comcodxx='004' and comfacxx ='') or ( COMIDXXX='P' and comcodxx='020' and ctoidxxx='2815050025' ) ) and DOCIDXXX like '%{$r['ca_referencia']}%' and regestxx='ACTIVO' order by comseqxx";
            //$sql="SELECT * FROM COLMASXX.fcod2015 where DOCIDXXX like '%{$this->do}%'";
            //$sql="SELECT * FROM COLMASXX.fcod2015 where regstamp>'2015-10-07'";


            $st = $con->execute($sql);
            $this->resul[$k]["propios"] = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);


            if($debug=="true")
            {
                echo "PROPIOS:<pre>";print_r($this->resul[$k]["propios"]);echo "</pre>";
            }
            
/*--------------------------------------------------------------------------------------------------------------------------------------------------*/

            $importado[]= $this->guardarDo($ref , $this->resul[$k] )." ---> ".$this->resul[$k]["ca_idcliente"]."-  ".$this->resul[$k]["ca_compania"];            
            $this->guardarFacturacion($ref,$this->resul[$k], $costos1,$this->costos,$con1);
           
        }

        
        //print_r($importado);
        
        //"to" => "maquinche@coltrans.com.co,leonardo.sandoval@colmas.com.co,coordinadorpto-1@colmas.com.co,coordinadorbog-4@colmas.com.co",
        if(count($importado)>0 || count($noimportado)>0)
        {
            /*$parametro = Doctrine::getTable("Parametro")->find(array("CU067", 3, "defaultEmails"));
                if ($parametro) {
                    if (stripos($parametro->getCaValor2(), ',') !== false) {
                        $defaultEmail = explode(",", $parametro->getCaValor2());
                    } else {
                        $defaultEmail = array($parametro->getCaValor2());
                    }
                }*/

            $email = ParametroTable::retrieveByCaso("CU067", null, null,3);

            Utils::sendEmail(
                        array(
                            "tipo" => "alerta",
                            "from" => "colsys@coltrans.com.co",
                            "fromname" => "colsys",
                            "to" => $email[0]->getCaValor2(),
                            "subject" => "Importacion de DO's Automaticos",
                            "body" => "Importacion de DO's Automaticos",
                            "mensaje" => "En caso de ver alguna informacion incorrecta, por favor informar al Depto. de Sistemas. <br>"
                            . "Se importaron  ".count($importado)." Do ,los Do no :<br>"
                            . "<br>" . implode(" <br> ", $importado) . "<br>"
                             ."No Se importaron  ".count($noimportado)." Do ,los Do no :<br>"
                            . "<br>" . implode(" <br> ", $noimportado) . "<br>"

                        )
                );
        }
        
        foreach($this->resul as $r)
            {
                echo "<pre>";
                print_r($r);
                echo "</pre>";
            }
            //$request->set
            
            
            //$this->executeImportarDo($request);
            
            
            exit;
    }    
   
    public function guardarDo($ref,$datos)
    {
        //print_r($datos);
        /*echo "<pre>";
        print_r($datos);
        echo "</pre>";
        exit;
        */
        if(!$ref)
        {
            
            $ref= new InoMaestraAdu();
            $ref->setCaReferencia($datos["ca_referencia1"]);
            $ref->setCaFchreferencia($datos["ca_fchcreado"]);
            $ref->setCaOrigen($datos["ca_idorigen1"]);
            $ref->setCaDestino($datos["ca_iddestino1"]);
            $ref->setCaIdcliente($datos["ca_idcliente1"]);
            $ref->setCaVendedor($datos["ca_vendedor"]);
            $ref->setCaCoordinador($datos["ca_coordinador"]);
            $ref->setCaProveedor($datos["ca_proveedor"]);
            $ref->setCaPedido($datos["ca_pedido"]);
            $ref->setCaPiezas($datos["ca_piezas"]);
            $ref->setCaPeso($datos["ca_peso"]);
            $ref->setCaMercancia($datos["ca_mercancia"]);
            $ref->setCaDeposito($datos["ca_deposito"]);
            $ref->setCaFcharribo($datos["ca_fcharribo"]);
            $ref->setCaModalidad($datos["ca_modalidad1"]);
            $ref->setCaNombrecontacto($datos["ca_nombrecontacto"]);
            $ref->setCaEmail($datos["ca_emailcontacto"]);
            $ref->setCaAnalista($datos["ca_analista"]);
            $ref->setCaUsucreado("Administrador");
            $ref->setCaFchcreado(date('Y-m-d H:i:s'));
            
           
        }
        
        

        
        
         if($datos["ca_fchlevante"]!="" && $datos["ca_fchlevante"]!="0000-00-00")
                $ref->setCaFchlevante($datos["ca_fchlevante"]);
            
            if($datos["ca_fchpago"]!="" && $datos["ca_fchpago"]!="0000-00-00")
                $ref->setCaFchpago($datos["ca_fchpago"]);
            
            if($datos["ca_fchsiga"]!="" && $datos["ca_fchsiga"]!="0000-00-00")
                $ref->setCaFchsiga($datos["ca_fchsiga"]);
            
            if($datos["ca_fchenttransportador"]!="" && $datos["ca_fchenttransportador"]!="0000-00-00")
                $ref->setCaFchenttransportador($datos["ca_fchenttransportador"]);
            
            if($datos["ca_fchdespcarga"]!="" && $datos["ca_fchdespcarga"]!="0000-00-00")
                $ref->setCaFchdespcarga($datos["ca_fchdespcarga"]);
            
            if($datos["ca_fcheta"]!="" && $datos["ca_fcheta"]!="0000-00-00")
                $ref->setCaFcheta($datos["ca_fcheta"]);
            
            if($datos["ca_fchentrcarpfacturacion"]!="" && $datos["ca_fchentrcarpfacturacion"]!="0000-00-00")
                $ref->setCaFchentrcarpfacturacion($datos["ca_fchentrcarpfacturacion"]);
            
            if($datos["ca_fchentrfacturacion"]!="" && $datos["ca_fchentrfacturacion"]!="0000-00-00")
                $ref->setCaFchentrfacturacion($datos["ca_fchentrfacturacion"]);
            
            if($datos["ca_fchfacturacion"]!="" && $datos["ca_fchfacturacion"]!="0000-00-00")
                $ref->setCaFchfacturacion($datos["ca_fchfacturacion"]);
            
            
            if($datos["ca_fchmayordoc"]!="" && $datos["ca_fchmayordoc"]!="0000-00-00")
                $ref->setCaFchmayordoc($datos["ca_fchmayordoc"]);
            
            if($datos["ca_fchmensajeria"]!="" && $datos["ca_fchmensajeria"]!="0000-00-00")
                $ref->setCaFchmensajeria($datos["ca_fchmensajeria"]);
            
            if($datos["ca_nitems"]!="" )
                $ref->setCaNitems($datos["ca_nitems"]);
            
            if($datos["ca_transporte"]!="" )
                $ref->setCaTransporte($datos["ca_transporte"]);
            
            $ref->stopBlaming();
            
            $ref->save();
        //Eventos
        //echo $datos["ca_fchentrfacturacion"];
        if($datos["ca_fchentrfacturacion"]!="" && $datos["ca_fchentrfacturacion"]!="0000-00-00" ) //entrega a facturacion
        {
            //echo $datos["ca_fchentrfacturacion"];
            
            $evento = Doctrine::getTable("InoEventoAdu")->find(array("15",$datos["ca_referencia1"]));            
            if(!$evento)
            {
                $evento= new InoEventoAdu();                
            }
            $evento->setCaIdevento("15");
            $evento->setCaReferencia($datos["ca_referencia1"]);
            $evento->setCaRealizado("1");                
            $evento->setCaFchevento($datos["ca_fchentrfacturacion"]);
            if(!$this->getUser()->getUserId())
            {
                $evento->setCaUsuario("Administrador");                            
            }
             else
                $evento->setCaUsuario($this->getUser()->getUserId());
            $evento->save();
            //echo "fecha entrega a facturacion ".$evento->getCaFchevento()."<br>";
        }
        if($datos["ca_fchfacturacion"]!="" && $datos["ca_fchfacturacion"]!="0000-00-00") //Elaboracion de Factura
        {
            $evento = Doctrine::getTable("InoEventoAdu")->find(array("16",$datos["ca_referencia1"]));
            if(!$evento)
            {
                $evento= new InoEventoAdu();
            }
            $evento->setCaIdevento("16");
            $evento->setCaReferencia($datos["ca_referencia1"]);
            $evento->setCaRealizado("1");                
            $evento->setCaFchevento($datos["ca_fchfacturacion"]);
            if(!$this->getUser()->getUserId())
            {
                $evento->setCaUsuario("Administrador");
                
            }
             else
                $evento->setCaUsuario($this->getUser()->getUserId());            
            $evento->save();
            
        }
        if($datos["ca_fchmensajeria"]!="" && $datos["ca_fchmensajeria"]!="0000-00-00") //entrega de Factura a Mensajeria    
        {
            $evento = Doctrine::getTable("InoEventoAdu")->find(array("17",$datos["ca_referencia1"]));
            if(!$evento)
            {
                $evento= new InoEventoAdu();
            }
            $evento->setCaIdevento("17");
            $evento->setCaReferencia($datos["ca_referencia1"]);
            $evento->setCaRealizado("1");
            $evento->setCaFchevento($datos["ca_fchmensajeria"]);
            if(!$this->getUser()->getUserId())
            {
                $evento->setCaUsuario("Administrador");                
            }
             else
                $evento->setCaUsuario($this->getUser()->getUserId());            
            $evento->save();
        }
        return $datos["ca_referencia1"];
        
    }    
    
    public function guardarFacturacion($ref,$datos, $costos1,$costos,$con1)
    {
        
        
        $ca_facturas=array();
        $ca_costos=array();
        //echo "<br>::".count($datos["facturacion"])."::<br>";
        foreach($datos["facturacion"] as $keyFac=>$f)
        {
            $total=0;
            
            $nfactura=$f["comidxxx"].substr($f["comcodxx"], -1)."-".$f["comcscxx"];

            $ca_facturas[$nfactura]["valor"]=$f["comvlrxx"]-$f["comvlr01"]-$f["comrivax"]-$f["comricax"];
            $ca_facturas[$nfactura]["cliente"]=$f["teridxxx"];
            $ca_facturas[$nfactura]["fecha"]=$f["comfecxx"];

        
            $cons=0;
            
            if($f["commemod"]!="")
            {
                $arrCostos=explode("|", $f["commemod"]);
                $titulo=true;
                $total=0;
                

                foreach($arrCostos as $c)
                {                    
                    $arrConceptos=explode("~", $c);                    
                    
                    if(count($arrConceptos)<25)
                        continue;
                    
                    
                    
                    if(count($arrConceptos)>=25)
                    {
                        //echo "<pre>";print_r($arrConceptos);echo "</pre>";
                        //exit;
                        $arrDo=explode("-", $arrConceptos["14"]);
                        //echo $arrDo[1]."----------".$datos["ca_referencia"]."<br>";
                        if($arrDo[1]!=$datos["ca_referencia"])
                        {
                            $observaciones[$nfactura][$arrDo[1]]=$arrDo[1];
                            continue;
                        }
                        else
                            $observaciones[$nfactura][$arrDo[1]]=$arrDo[1];

                        
                        $total+=$arrConceptos[7];
                        //foreach($arrConceptos as $p)
                        {
                            $arrTer=  explode("^", $arrConceptos[2]);
                            //echo "<pre>";print_r($arrConceptos);echo "</pre>";
                            //print_r($costos[$costos1[$arrConceptos[1]]]);
                            //exit;
                            if(isset($costos1[$arrConceptos[1]]))
                            {
                                $tmpCosto=$costos[$costos1[$arrConceptos[1]]];
                            }
                            else
                            {   
                                
                                return;
                                //$tmpCosto["ca_costo"]="<span class='rojo'>No Registrado en Colsys</span>";
                                //$tmpCosto["ca_idcosto"]="<span class='rojo'>No Registrado en Colsys</span>";
                            }                        
                            
                            $ca_costos[$tmpCosto["ca_idcosto"]]["tipo"]="T";
                            $ca_costos[$tmpCosto["ca_idcosto"]]["valor"][]=$arrConceptos[7];
                            $ca_costos[$tmpCosto["ca_idcosto"]]["factura"]=$arrConceptos[5];
                            $ca_costos[$tmpCosto["ca_idcosto"]]["fecha"]=$f["comfecxx"];
                        }
                    }
                }
            }
            else if($f["comfpxxx"]!=""&& $f["comobsxx"] =="FACTURA ADICIONAL, COBRO DE POLIZA DE SEGURO")
            {
                $total=0;
                $arrCostos=explode("|", $f["comfpxxx"]);            
                foreach($arrCostos as $c)
                {
                    $arrConceptos=explode("~", $c);
                    if(count($arrConceptos)>=25)
                    {
                        $total+=$arrConceptos[19];
                        if(isset($costos1[$arrConceptos[14]]))
                        {
                            $tmpCosto=$costos[$costos1[$arrConceptos[14]]];
                        }
                        else
                        {
                            return;
                            //$tmpCosto["ca_costo"]="<span class='rojo'>No Registrado en Colsys</span>";
                            //$tmpCosto["ca_idcosto"]="<span class='rojo'>No Registrado en Colsys</span>";
                        }
                            $ca_costos[$tmpCosto["ca_idcosto"]]["tipo"]="T";
                            $ca_costos[$tmpCosto["ca_idcosto"]]["valor"][]=$arrConceptos[19];
                            $ca_costos[$tmpCosto["ca_idcosto"]]["factura"]=$nfactura;
                            $ca_costos[$tmpCosto["ca_idcosto"]]["fecha"]=$f["comfecxx"];
                    }
                }
            }
        
        
            if($f["comifxxx"]>0)
            {
                $imp=round($total*0.004);
                $total+=$imp;//$f["comifxxx"];

                if(isset($costos1["2815050041"]))
                {
                    $tmpCosto=$costos[$costos1["2815050041"]];
                }
                else
                {
                    return;
                    //$tmpCosto["ca_costo"]="No Registrado en Colsys";
                    //$tmpCosto["ca_idcosto"]="No Registrado en Colsys";
                }
                $ca_costos[$tmpCosto["ca_idcosto"]]["tipo"]="T";
                $ca_costos[$tmpCosto["ca_idcosto"]]["valor"][]=$imp;
                $ca_costos[$tmpCosto["ca_idcosto"]]["factura"]=$nfactura;
                $ca_costos[$tmpCosto["ca_idcosto"]]["fecha"]=$f["comfecxx"];
            }
            $costoNeto+=$total;
            $facClientes+=$total;

            if(count($observaciones[$nfactura])>1)
            {        
                    $ca_facturas[$nfactura]["observaciones"]="LA FACTURA DE INGRESOS A TERCEROS #".$nfactura." AGRUPA LOS DO(S) ".implode(" , ",$observaciones[$nfactura]);
            }

        }
        
        $propios=$datos["propios"];
         foreach($propios as $p)
        {
            if(($p["comidxxx"]=="F" && ($p["comidc2x"]!="P" && $p["comidc2x"]!="" ) )   )
            {
                //echo "<pre>";print_r($p);echo "</pre>";
                continue;
            }
            if($p["comidxxx"] == "P"  && $p["comcodxx"] && ($p["comcodxx"]!="004" && $p["comcodxx"]!="020" ))
            {
                //echo "<pre>";print_r($p);echo "</pre>";
                $concep="Seguro y Administración de Riesgo";
            }
            else if($p["comidxxx"] == "P"  &&  $p["comcodxx"]=="004")
            {
                if($p["ctoidxxx"]=="5295950004")
                {
                    $neto["4145400002"]=round($p["comvlrxx"]+($p["comvlrxx"]*0.16));
                    //echo $neto["4145400002"];
                }
                //4145400002
                continue;
            }
            else if($p["comidxxx"] == "P"  &&  $p["comcodxx"]=="020")
            {
                $concep=$p["comobsxx"];
                $neto["2815050025"]=round($p["comvlrxx"]);
                $p["comvlrxx"]=0;            
            }        
            else
            {
                $arrConceptos=explode("~", $p["comobsxx"]);
                $concep=$arrConceptos[2];
            }
            $total+=$p["comvlrxx"];
            $total-=$neto[$p["ctoidxxx"]];

            if(isset($costos1[$p["ctoidxxx"]]))
            {
                $tmpCosto=$costos[$costos1[$p["ctoidxxx"]]];
            }
            else
            {
                //return;
                //$tmpCosto["ca_costo"]="<span class='rojo'>No Registrado en Colsys</span>";
                //$tmpCosto["ca_idcosto"]="<span class='rojo'>No Registrado en Colsys</span>";
            }
            //print_r($tmpCosto)


                $ca_costos[$tmpCosto["ca_idcosto"]]["tipo"]="P";
                $ca_costos[$tmpCosto["ca_idcosto"]]["valor"][]=$p["comvlrxx"];
                $ca_costos[$tmpCosto["ca_idcosto"]]["factura"]=$p["comcscxx"];
                $ca_costos[$tmpCosto["ca_idcosto"]]["neto"]=$neto[$p["ctoidxxx"]];
                $ca_costos[$tmpCosto["ca_idcosto"]]["fecha"]=$p["comfecxx"];

        }
        
        
        
        Doctrine::getTable("InoCostosAdu")
            ->createQuery("s")
            ->delete()
            ->where("s.ca_referencia = ? ", $datos["ca_referencia1"])
            ->execute();


        Doctrine::getTable("InoIngresosAdu")
            ->createQuery("s")
            ->delete()
            ->where("s.ca_referencia = ? and ca_reccaja is null ", $datos["ca_referencia1"])
            ->execute();
        
    //echo "<pre>";print_r($ca_costos);echo "</pre>";
    //exit;
        foreach ($ca_costos as $idc=>$c)
        {
            if(is_numeric($idc))
            {
                
                $costo= new InoCostosAdu();
                $costo->setCaReferencia($datos["ca_referencia1"]);
                $costo->setCaIdcosto($idc);
                $costo->setCaFactura($c["factura"]);                
                //echo $c["fecha"];exit;                
                $costo->setCaFchfactura($c["fecha"]);
                $costo->setCaMoneda("COP");                
                $costo->setCaTasacambio(1);
                $valor=0;
                foreach($c["valor"] as $v)
                    $valor+=$v;

                $costo->setCaVenta($valor);
                $costo->setCaUtilidad(0);
                if($c["tipo"]=="P")
                {
                    if($c["neto"]>0)
                    {
                        $costo->setCaNeta($c["neto"]);
                        $costo->setCaUtilidad(0);
                    }
                    else
                    {
                        $costo->setCaNeta(0);
                        $costo->setCaUtilidad($valor);
                    }

                    
                    $costo->setCaProveedor("COLMAS S.A.S.");
                }
                else
                {
                    $costo->setCaNeta($valor);
                    $costo->setCaProveedor($datos["ca_proveedor"]);
                }

                if($idc==458 || $idc==215)//gastos varios
                {
                    $costo->setCaUtilidad( round($valor/2));
                }else if(($idc==214 || $idc==312)  )//comision diferente a bogota
                {
                    /*$sql="select count(*) as nn 
                        from control.tb_usuarios u
                        inner join control.tb_sucursales s ON  u.ca_idsucursal=s.ca_idsucursal
                    where u.ca_login = '".$datos["ca_vendedor"]."' and s.ca_nombre='Pereira'";
                    
                    
                    $st = $con1->execute($sql);
                    $tmp_usu = $st->fetchColumn();
                  
                    if($tmp_usu>0 || $datos["ca_iddestino1"]!="BOG-0001")
                        $costo->setCaUtilidad( ($valor-110000) );
                     * 
                     */
                    
                    $sql="select s.ca_nombre
                        from control.tb_usuarios u
                        inner join control.tb_sucursales s ON  u.ca_idsucursal=s.ca_idsucursal
                    where u.ca_login ='".$datos["ca_vendedor"]."' ";
                    $st = $con1->execute($sql);
                    $tmp_usu = $st->fetchColumn();
                    
                    if( $datos["ca_destino1"]!=$tmp_usu)                    
                    //if(substr($datos["ca_referencia1"],0,3)=="210" || substr($datos["ca_referencia1"],0,3)=="220")
                        $costo->setCaUtilidad( ($valor-110000) );
                }
                else if($idc==328||  $idc==463 ||  $idc==232 ||  $idc==461 ||  $idc==498 ||  $idc==499 ||  $idc==566 ||  $idc==567  ||  $idc==555 ||  $idc==220  )////328-463: manejo de archivo||232-461:Incorporación Siglo XXI|| 498-499:Administracion del riesgo || 498-499:In House ||555-220 Valor Poliza
                {
                    $costo->setCaUtilidad( 0 );
                }
                else if($idc==554 || $idc ==219  )//cotizacion seguro
                {
                    $costo->setCaUtilidad( $valor-8120 );//8120
                    $costo->setCaNeta(8120);
                }
                else if($idc==200 || $idc ==569  )//sellos de seguridad
                {
                  //  echo "dsfsfdsfds";
                    //echo $request->getParameter("ca_idcliente");
                    //exit;
                    if($datos["ca_idcliente"]=="900017447")//cliente falabella
                    {
                        $valorV=5000;
                        $valorP=2250;
                        $nP=$valor/$valorV;
                        
                        $costo->setCaUtilidad( $valor-($valorP*$nP) );
                        $costo->setCaNeta($valorP*$nP);                        
                    }
                    else
                    {
                        $costo->setCaUtilidad( $valor-2250 );//8120
                        $costo->setCaNeta(2250);
                    }
                    
                }
                
                $costo->stopBlaming();
                $costo->setCaUsucreado("Administrador");
                $costo->setCaFchcreado(date('Y-m-d H:i:s'));
            
                $costo->save();
            }
        }
        //exit;
        
         foreach($ca_facturas as $nfact=>$f)
        {
            //$ingreso = new InoIngresosAdu();
            $ingreso = Doctrine::getTable("InoIngresosAdu")->find(array($datos["ca_referencia1"],$nfact));
            if($ingreso)
                continue;
            else
                $ingreso = new InoIngresosAdu();
            
            $ingreso->setCaReferencia($datos["ca_referencia1"]);
            $ingreso->setCaFactura($nfact);
            $ingreso->setCaFchfactura($f["fecha"]);
            $ingreso->setCaValor($f["valor"]);
            $ingreso->setCaTasacambio(1);
            $ingreso->setCaMoneda("COP");
            $ingreso->setCaDeclaracion("1");
            if($datos["ca_idcliente"]=="900017447")//cliente falabella
                $ingreso->setCaObservaciones("Cliente Especial");
            $ingreso->stopBlaming();
            $ingreso->setCaUsucreado("Administrador");
            $ingreso->setCaFchcreado(date('Y-m-d H:i:s'));
            $ingreso->save();
            
            if($f["observaciones"]!="")
            {
                $nota = new InoNotasAdu();
                $nota->setCaReferencia($datos["ca_referencia1"]);
                $nota->setCaTexto($f["observaciones"]);
                $nota->setCaFchnota(date("Y-m-d h:i:s"));
                $nota->setCaUsuario("Administrador");                
                $nota->save();
            }
        }

    }
    
    
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
   

    public function executeImportarDo(sfWebRequest $request)
    {
        $con1 = Doctrine_Manager::getInstance()->getConnection('master');
        $do=$request->getParameter("do");
        //Doctrine_Manager::getInstance()->setCurrentConnection('testing');
        $ref = Doctrine::getTable("InoMaestraAdu")->find($do);
        $arrDo= explode(".", $do);
        $batch=($request->getParameter("batch")!="true")?false:true;
        if(!$ref)
        {
            
            $ref= new InoMaestraAdu();
            $ref->setCaReferencia($do);
            $ref->setCaFchreferencia($request->getParameter("ca_fchcreado"));
            $ref->setCaOrigen($request->getParameter("ca_origen"));
            $ref->setCaDestino($request->getParameter("ca_destino"));
            $ref->setCaIdcliente($request->getParameter("ca_idcliente"));
            $ref->setCaVendedor($request->getParameter("ca_vendedor"));
            $ref->setCaCoordinador($request->getParameter("ca_coordinador"));
            $ref->setCaProveedor($request->getParameter("ca_proveedor"));
            $ref->setCaPedido($request->getParameter("ca_pedido"));
            $ref->setCaPiezas($request->getParameter("ca_piezas"));
            $ref->setCaPeso($request->getParameter("ca_peso"));
            $ref->setCaMercancia($request->getParameter("ca_mercancia"));
            $ref->setCaDeposito($request->getParameter("ca_deposito"));
            $ref->setCaFcharribo($request->getParameter("ca_fcharribo"));
            $ref->setCaModalidad($request->getParameter("ca_modalidad"));
            $ref->setCaNombrecontacto($request->getParameter("ca_nombrecontacto"));
            $ref->setCaEmail($request->getParameter("ca_emailcontacto"));
            $ref->setCaAnalista($request->getParameter("ca_analista"));
            

        }

        
        if($request->getParameter("ca_fchlevante")!="" && $request->getParameter("ca_fchlevante")!="0000-00-00")
            $ref->setCaFchlevante($request->getParameter("ca_fchlevante"));

        if($request->getParameter("ca_fchpago")!="" && $request->getParameter("ca_fchpago")!="0000-00-00")
            $ref->setCaFchpago($request->getParameter("ca_fchpago"));

        if($request->getParameter("ca_fchsiga")!="" && $request->getParameter("ca_fchsiga")!="0000-00-00")
            $ref->setCaFchsiga($request->getParameter("ca_fchsiga"));

        if($request->getParameter("ca_fchenttransportador")!="" && $request->getParameter("ca_fchenttransportador")!="0000-00-00")
          $ref->setCaFchenttransportador($request->getParameter("ca_fchenttransportador"));

        if($request->getParameter("ca_fchdespcarga")!="" && $request->getParameter("ca_fchdespcarga")!="0000-00-00")
            $ref->setCaFchdespcarga($request->getParameter("ca_fchdespcarga"));

        if($request->getParameter("ca_fcheta")!="" && $request->getParameter("ca_fcheta")!="0000-00-00")
            $ref->setCaFcheta($request->getParameter("ca_fcheta"));

        if($request->getParameter("ca_fchentrcarpfacturacion")!="" && $request->getParameter("ca_fchentrcarpfacturacion")!="0000-00-00")
            $ref->setCaFchentrcarpfacturacion($request->getParameter("ca_fchentrcarpfacturacion"));

        if($request->getParameter("ca_fchentrfacturacion")!="" && $request->getParameter("ca_fchentrfacturacion")!="0000-00-00")
            $ref->setCaFchentrfacturacion($request->getParameter("ca_fchentrfacturacion"));

        if($request->getParameter("ca_fchfacturacion")!="" && $request->getParameter("ca_fchfacturacion")!="0000-00-00")
            $ref->setCaFchfacturacion($request->getParameter("ca_fchfacturacion"));

        if($request->getParameter("ca_fchmayordoc")!="" && $request->getParameter("ca_fchmayordoc")!="0000-00-00")
            $ref->setCaFchmayordoc($request->getParameter("ca_fchmayordoc"));

        if($request->getParameter("ca_fchmensajeria")!="" && $request->getParameter("ca_fchmensajeria")!="0000-00-00")
                    $ref->setCaFchmensajeria($request->getParameter("ca_fchmensajeria"));

        if($request->getParameter("ca_nitems")!="" )
            $ref->setCaNitems($datos["ca_nitems"]);
        
        
        $ref->setCaTransporte($request->getParameter("ca_transporte"));
        
        

        $ref->save();
            
        //Eventos
        //echo $request->getParameter("ca_fchentrfacturacion");
        if($request->getParameter("ca_fchentrfacturacion")!="" && $request->getParameter("ca_fchentrfacturacion")!="0000-00-00" ) //entrega a facturacion
        {
            echo $request->getParameter("ca_fchentrfacturacion");
            
            $evento = Doctrine::getTable("InoEventoAdu")->find(array("15",$do));            
            if(!$evento)
            {
                $evento= new InoEventoAdu();                
            }
            $evento->setCaIdevento("15");
            $evento->setCaReferencia($do);
            $evento->setCaRealizado("1");                
            $evento->setCaFchevento($request->getParameter("ca_fchentrfacturacion"));
            $evento->setCaUsuario($this->getUser()->getUserId());
            $evento->save();
            //echo "fecha entrega a facturacion ".$evento->getCaFchevento()."<br>";
        }
        if($request->getParameter("ca_fchfacturacion")!="" && $request->getParameter("ca_fchfacturacion")!="0000-00-00") //Elaboracion de Factura
        {
            $evento = Doctrine::getTable("InoEventoAdu")->find(array("16",$do));
            if(!$evento)
            {
                $evento= new InoEventoAdu();
            }
            $evento->setCaIdevento("16");
            $evento->setCaReferencia($do);
            $evento->setCaRealizado("1");                
            $evento->setCaFchevento($request->getParameter("ca_fchfacturacion"));
            $evento->setCaUsuario($this->getUser()->getUserId());
            $evento->save();
            
        }
        if($request->getParameter("ca_fchmensajeria")!="" && $request->getParameter("ca_fchmensajeria")!="0000-00-00") //entrega de Factura a Mensajeria    
        {
            $evento = Doctrine::getTable("InoEventoAdu")->find(array("17",$do));
            if(!$evento)
            {
                $evento= new InoEventoAdu();
            }
            $evento->setCaIdevento("17");
            $evento->setCaReferencia($do);
            $evento->setCaRealizado("1");
            $evento->setCaFchevento($request->getParameter("ca_fchmensajeria"));
            $evento->setCaUsuario($this->getUser()->getUserId());
            $evento->save();
        }

        //exit;
        Doctrine::getTable("InoCostosAdu")
            ->createQuery("s")
            ->delete()
            ->where("s.ca_referencia = ? ", $do)
            ->execute();


        Doctrine::getTable("InoIngresosAdu")
            ->createQuery("s")
            ->delete()
            ->where("s.ca_referencia = ? and ca_reccaja is null ", $do)            
            ->execute();
        
        
        $facturas=$request->getParameter("ca_facturas");        
        $costos=$request->getParameter("ca_costos");
        $proveedor=$request->getParameter("ca_proveedor");
        //echo "<pre>";echo print_r($costos);echo "</pre>";
        //exit;
        //$propios=$request->getParameter("ca_valorpropio");
        
        
        foreach ($costos as $idc=>$c)
        {
            if(is_numeric($idc))
            {
                $costo= new InoCostosAdu();
                $costo->setCaReferencia($do);
                $costo->setCaIdcosto($idc);
                $costo->setCaFactura($c["factura"]);                
                //echo $c["fecha"];exit;                
                $costo->setCaFchfactura($c["fecha"]);
                $costo->setCaMoneda("COP");                
                $costo->setCaTasacambio(1);
                $valor=0;
                foreach($c["valor"] as $v)
                    $valor+=$v;

                $costo->setCaVenta($valor);
                $costo->setCaUtilidad(0);
                if($c["tipo"]=="P")
                {
                    if($c["neto"]>0)
                    {
                        $costo->setCaNeta($c["neto"]);
                        $costo->setCaUtilidad(0);
                    }
                    else
                    {
                        $costo->setCaNeta(0);
                        $costo->setCaUtilidad($valor);
                    }

                    
                    $costo->setCaProveedor("COLMAS S.A.S.");
                }
                else
                {
                    $costo->setCaNeta($valor);
                    $costo->setCaProveedor($proveedor);
                }

                if($idc==458 || $idc==215)//gastos varios
                {
                    $costo->setCaUtilidad( round($valor/2));
                }else if(($idc==214 || $idc==312)  )//comision diferente a bogota
                {
                    /*$sql="select count(*) as nn 
                        from control.tb_usuarios u
                        inner join control.tb_sucursales s ON  u.ca_idsucursal=s.ca_idsucursal
                    where u.ca_login = '".$request->getParameter("ca_vendedor")."' and s.ca_nombre='Pereira'";
                    $st = $con1->execute($sql);
                    $tmp_usu = $st->fetchColumn();
                    
                    if($tmp_usu>0 || $request->getParameter("ca_destino")!="BOG-0001")
                        $costo->setCaUtilidad( ($valor-110000) );
                     * 
                     */
                    if(substr($do,0,3)=="210" || substr($do,0,3)=="220")
                        $costo->setCaUtilidad( ($valor-110000) );
                }
                else if($idc==328||  $idc==463 ||  $idc==232 ||  $idc==461 ||  $idc==498 ||  $idc==499 ||  $idc==566 ||  $idc==567  ||  $idc==555 ||  $idc==220  )////328-463: manejo de archivo||232-461:Incorporación Siglo XXI|| 498-499:Administracion del riesgo || 498-499:In House ||555-220 Valor Poliza
                {
                    $costo->setCaUtilidad( 0 );
                }
                else if($idc==554 || $idc ==219  )//cotizacion seguro
                {
                    $costo->setCaUtilidad( $valor-8120 );//8120
                    $costo->setCaNeta(8120);
                }
                else if($idc==200 || $idc ==569  )//sellos de seguridad
                {
                  //  echo "dsfsfdsfds";
                    //echo $request->getParameter("ca_idcliente");
                    //exit;
                    if($request->getParameter("ca_idcliente")=="900017447")//cliente falabella
                    {
                        $valorV=5000;
                        $valorP=2250;
                        $nP=$valor/$valorV;
                        
                        $costo->setCaUtilidad( $valor-($valorP*$nP) );
                        $costo->setCaNeta($valorP*$nP);
                        //echo "Precinto";
                    }
                    else
                    {
                        $costo->setCaUtilidad( $valor-2250 );//8120
                        $costo->setCaNeta(2250);
                    }                    
                }
                
                $costo->save();
            }
        }

        foreach($facturas as $nfact=>$f)
        {
            //$ingreso = new InoIngresosAdu();
            $ingreso = Doctrine::getTable("InoIngresosAdu")->find(array($do,$nfact));
            if($ingreso)
                continue;
            else
                $ingreso = new InoIngresosAdu();
            
            $ingreso->setCaReferencia($do);
            $ingreso->setCaFactura($nfact);
            $ingreso->setCaFchfactura($f["fecha"]);
            $ingreso->setCaValor($f["valor"]);
            $ingreso->setCaTasacambio(1);
            $ingreso->setCaMoneda("COP");
            $ingreso->setCaDeclaracion("1");
            if($request->getParameter("ca_idcliente")=="900017447")//cliente falabella
                $ingreso->setCaObservaciones("Cliente Especial");
            $ingreso->save();
            
            if($f["observaciones"]!="")
            {
                $nota = new InoNotasAdu();
                $nota->setCaReferencia($do);
                $nota->setCaTexto($f["observaciones"]);
                $nota->setCaFchnota(date("Y-m-d h:i:s"));
                $nota->setCaUsuario($this->getUser()->getUserId());
                $nota->save();
            }
        }

        //return $this->redirect('https://localhost/falabellaAdu2/index/do/'.$do);
        $arrDo=  explode(".", $do);
        $do=$arrDo[0].$arrDo[1].$arrDo[2].substr($arrDo[3], -3).substr($arrDo[4], -1);
        if(!$batch)
        {
            $this->redirect("falabellaAdu2/index?do=".$do);        
            exit;
        }
        else
            return $do;
        
    }
    
    public function executeIndex(sfWebRequest $request) {
        
        //echo "<pre>";print_r($_SERVER);echo "</pre>";
//        Doctrine_Manager::getInstance()->bindComponent('all', 'opencomex');
        //var_dump(Doctrine_Manager::getInstance()->getConnections());

        /*$config = ProjectConfiguration::getActive();

        $manager = new sfDatabaseManager($config);

        var_dump($manager->getDatabase('opencomex'));*/
        
        
        //$con = Doctrine_Manager::getInstance()->getConnection('opencomex');
        /*$con1 = Doctrine_Manager::getInstance()->getConnection('produccion');
        
        $sql="select * from tb_costos c
            where ca_impoexpo = 'Aduanas' and ca_conceptoopen IS NOT NULL ";
            //echo $sql;
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        
        foreach($tmp_simil as $r)
        {
            $ref = Doctrine::getTable("Costo")->find($r["ca_idcosto"]);
            if(!$ref)
            {
                $ref = new Costo();
                //$ref->setCaIdcosto($r["ca_idcosto"]);                
                $ref->setCaCosto($r["ca_costo"]);
                $ref->setCaTransporte($r["ca_transporte"]);
                $ref->setCaImpoexpo($r["ca_impoexpo"]);
                $ref->setCaModalidad($r["ca_modalidad"]);
                $ref->setCaComisionable($r["ca_comisionable"]);
                $ref->setCaParametros($r["ca_parametros"]);
                $ref->setCaActivo($r["ca_activo"]);
            }
                //continue;
            $ref->setCaConceptoopen($r["ca_conceptoopen"]);
            $ref->save();
        }
        exit;*/
        
        
        
        
        $this->do=($request->getParameter("do")!="")?$request->getParameter("do"):"22010071485";
        
        if(strlen($this->do)==17)
        {
            //210.20.09.0033.15
            $this->do=substr($this->do,0,3).substr($this->do,4,2).substr($this->do,7,2)
                .substr($this->do,11,3).substr($this->do,16,1);
        }
        //echo $this->do;
        //exit;
        $debug=$request->getParameter("debug");
        
        $this->do1=substr($this->do,0,3).".".substr($this->do,3,2).".".substr($this->do,5,2).".0"
                .substr($this->do,7,3).".1".substr($this->do,10,1);
        //$this->do
        
        
        $con = Doctrine_Manager::getInstance()->getConnection('opencomex');
        $con1 = Doctrine_Manager::getInstance()->getConnection('master');
        
        $sql="SELECT 
            distinct(brk.DOIIDXXX)    as ca_referencia, 
            brk.DOISFIDX    as ca_version,
            brk.REGFECXX    as ca_fchcreado, 
            brk.REGHORXX    as ca_hracreado, 
            brk.ADMIDXXX    as ca_destino,            
            p.PIECIUXX      as ca_origen, 
            brk.LINIDXXX    as ca_destino, 
            brk.CLIIDXXX    as ca_idcliente, 
            brk.DOCVENXX    as ca_idvendedor,
            brk.USRID2XX    as ca_idcoordinador,
            brk.USRIDXXX    as ca_idanalista,            
            p.PIENOMXX      as ca_proveedor,             
            q.docpedxx      as ca_pedido, 
            items.ITECANXX  as ca_piezas, 
            items.LIMPBRXX  as ca_peso, 
            items.ITENOCXX  as ca_mercancia, 
            dep.DAADESXX    as ca_deposito, 
            brk.DOIFRAXX    as ca_fcharribo, 
            brk.DGEFMCXX    as ca_fcharribo1, 
            modal.MODDESXX  as ca_modalidad,
            q.docmtrxx      as ca_transporte,
            brk.DOIMYDOC    as ca_fchmayordoc,
            brk.DOIMYLEV    as ca_fchlevante,
            brk.DOIMYSTK    as ca_fchpago,
            brk.DOIFLOSI    as ca_fchsiga,
            brk.DOIENTTR    as ca_fchenttransportador,
            brk.DOIDEDEP    as ca_fchdespcarga,
            brk.DGEFMCXX    as ca_fcheta,
            brk.DOIFENCA    as ca_fchentrcarpfacturacion,
            brk.DOIFENFA    as ca_fchentrfacturacion,
            brk.DOIFENTR    as ca_fchfacturacion,
            brk.DOIFENME    as ca_fchmensajeria,
            (SELECT count(*) FROM COLMASXX.SIAI0205 AS items1 WHERE brk.DOIIDXXX = items1.DOIIDXXX and brk.DOISFIDX=items1.DOISFIDX ) as ca_nitems
            
FROM COLMASXX.SIAI0200 AS brk
        left JOIN COLMASXX.SIAI0202 AS h ON (brk.DOIIDXXX = h.DOIIDXXX AND brk.DOISFIDX = h.DOISFIDX AND brk.ADMIDXXX = h.ADMIDXXX)
        left JOIN COLMASXX.SIAI0125 AS p ON h.PIEIDXXX = p.PIEIDXXX
        INNER JOIN COLMASXX.sys00121 AS q ON (brk.DOIIDXXX = q.docidxxx AND brk.DOISFIDX = q.docsufxx AND brk.ADMIDXXX = q.sucidxxx)
        left JOIN COLMASXX.SIAI0205 AS items ON (brk.DOIIDXXX = items.DOIIDXXX AND brk.DOISFIDX = items.DOISFIDX AND brk.ADMIDXXX = items.ADMIDXXX)
        LEFT JOIN COLMASXX.SIAI0110 AS dep ON brk.DAAIDXXX = dep.DAAIDXXX
        left JOIN COLMASXX.SIAI0203 AS sub ON (items.SUBIDXXX = sub.SUBIDXXX AND brk.DOIIDXXX = sub.DOIIDXXX AND brk.DOISFIDX = sub.DOISFIDX AND brk.ADMIDXXX = sub.ADMIDXXX)
        left JOIN COLMASXX.SIAI0121 AS modal ON sub.MODIDXXX = modal.MODIDXXX
        WHERE brk.DOIIDXXX = '{$this->do}' AND brk.DOISFIDX = '001' limit 1";
        //where brk.REGFECXX>'2015-10-08' order by 1,2,3,4";//WHERE brk.DOIIDXXX = '22070091425' ";//WHERE brk.DOIIDXXX = '21010050425' AND brk.DOISFIDX = '001'";        //22070091425        
        $st = $con->execute($sql);
        $this->resul = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        
        if($debug=="true")
        {
            echo "DO:<pre>";print_r($this->resul);echo "</pre>";
        }        
        $this->importar=1;
        foreach($this->resul as $k=>$r)
        {
            $caReferecnia=substr($r["ca_referencia"],0,3).".".substr($r["ca_referencia"],3,2).".".substr($r["ca_referencia"],5,2).".0"
                .substr($r["ca_referencia"],7,3).".1".substr($r["ca_referencia"],10,1);
            
            
            $ref = Doctrine::getTable("InoMaestraAdu")->find($caReferecnia);
            
            if($ref)
            {
                
                if($ref->getCaFchcerrado()!="")
                    $this->importar=0;
              //  $ref= new InoMaestraAdu();
              //  $ref->setCaReferencia($caReferecnia);
            }
            else
            {
                //echo "---";
            }
            /*
            $ref->setCaFchreferencia($r["ca_fchcreado"]);
            $ref->setCaOrigen($r["ca_origen"]);
            $ref->setCaDestino($r["ca_destino"]);
            $ref->setCaIdcliente($r["ca_idcliente"]);
            $ref->setCaIdcliente($r["ca_vendedor"]);
            $ref->setCaCoordinador($r["ca_coordinador"]);
            $ref->setCaProveedor($r["ca_proveedor"]);
            $ref->setCaPedido($r["ca_pedido"]);
            $ref->setCaPiezas($r["ca_piezas"]);
            $ref->setCaPeso($r["ca_peso"]);
            $ref->setCaMercancia($r["ca_mercancia"]);
            $ref->setCaDeposito($r["ca_deposito"]);
            $ref->setCaFcharribo($r["ca_fcharibo"]);
            $ref->setCaModalidad($r["ca_fchmodalidad"]);
             * 
             */
            
            /*$q = Doctrine::getTable("Ciudad")
                            ->createQuery("c")
                            ->select("*")
                            ->where("UPPER(ca_ciudad) like ?","%".$r["ca_origen"]."%");
             * 
             */
            $sql="select c.*,fun_similarpercent('".$r["ca_origen"]."',c.ca_ciudad ) from tb_ciudades c
            where fun_similarpercent('".$r["ca_origen"]."',c.ca_ciudad )>60";

            $st = $con1->execute($sql);
            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($ciu_simil)>0)
            {
                //echo "120";
                $this->resul[$k]["ca_idorigen1"]=$ciu_simil[0]["ca_idciudad"];
                $this->resul[$k]["ca_origen1"]=$ciu_simil[0]["ca_ciudad"];
                $this->resul[$k]["ca_traforigen1"]=$ciu_simil[0]["ca_idtrafico"];
            }
            else
            {
                $this->resul[$k]["ca_idorigen1"]="DRZ-0513";
                $this->resul[$k]["ca_origen1"]="Durres";
                $this->resul[$k]["ca_traforigen1"]="AL-355";
            }

            $sql="select c.*,fun_similarpercent('".$r["ca_destino"]."',c.ca_idciudad ) from tb_ciudades c
            where fun_similarpercent('".$r["ca_destino"]."',c.ca_idciudad )>60";
            //echo $sql;
            $st = $con1->execute($sql);
            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($ciu_simil)>0)
            {
                //echo "134";
                $this->resul[$k]["ca_iddestino1"]=$ciu_simil[0]["ca_idciudad"];
                $this->resul[$k]["ca_destino1"]=$ciu_simil[0]["ca_ciudad"];
                $this->resul[$k]["ca_trafdestino1"]=$ciu_simil[0]["ca_idtrafico"];
            }
            else
            {
                $this->resul[$k]["ca_iddestino1"]="DRZ-0513";
                $this->resul[$k]["ca_destino1"]="Durres";
                $this->resul[$k]["ca_trafdestino1"]="AL-355";
                
            }
            
            
            $sql="select c.* from vi_concliente c
            where UPPER(ca_idalterno) = '".trim($this->resul[$k]["ca_idcliente"])."' and ca_fijo=true  limit 1";
            $st = $con1->execute($sql);
            //echo $sql;
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($tmp_simil)>0)
            {
                $this->resul[$k]["ca_compania"]=$tmp_simil[0]["ca_compania"];
                $this->resul[$k]["ca_nombrecontacto"]=$tmp_simil[0]["ca_ncompleto_cn"];
                $this->resul[$k]["ca_emailcontacto"]=$tmp_simil[0]["ca_email"];
                $this->resul[$k]["ca_idcliente1"]=$tmp_simil[0]["ca_idcliente"];
                $this->resul[$k]["ca_vendedor"]=$tmp_simil[0]["ca_vendedor"];
            }
            else
            {
                $this->resul[$k]["ca_compania"]="<span class='rojo'>No Registrado en Colsys</span>";
                $this->resul[$k]["ca_nombrecontacto"]="<span class='rojo'>No Registrado en Colsys</span>";
                $this->resul[$k]["ca_emailcontacto"]="<span class='rojo'>No Registrado en Colsys</span>";
            }
            
            
            $sql="select u.ca_login from control.tb_usuarios u
            where ca_docidentidad = '".$this->resul[$k]["ca_idanalista"]."'";
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($tmp_simil)>0)
            {
                $this->resul[$k]["ca_analista"]=$tmp_simil[0]["ca_login"];
            }
            else
            {
                $this->resul[$k]["ca_analista"]="<span class='rojo'>No Registrado en Colsys</span>";
            }
            
            if($this->resul[$k]["ca_vendedor"]=="")
            {
                $sql="select u.ca_login from control.tb_usuarios u
                where ca_docidentidad = '".$this->resul[$k]["ca_idvendedor"]."'";            
                $st = $con1->execute($sql);
                $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                if(count($tmp_simil)>0)
                {
                    $this->resul[$k]["ca_vendedor"]=$tmp_simil[0]["ca_login"];
                }
                else
                {
                    $this->resul[$k]["ca_vendedor"]="<span class='rojo'>No Registrado en Colsys</span>";
                }
            }
            
            
            
            
            $sql="select u.ca_login from control.tb_usuarios u
            where ca_docidentidad = '".$this->resul[$k]["ca_idcoordinador"]."'";
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($tmp_simil)>0)
            {
                $this->resul[$k]["ca_coordinador"]=$tmp_simil[0]["ca_login"];
            }
            else
            {
                $this->resul[$k]["ca_coordinador"]="<span class='rojo'>No Registrado en Colsys</span>";
            }
            
            //MODALIDAD ADUANA
            $sql="select *,fun_similarpercent('IMPORTACION ORDINARIA',v.ca_value ) 
            from control.tb_config_values v
            inner join control.tb_config c ON c.ca_idconfig=v.ca_idconfig and ca_param='CU025'
            where fun_similarpercent('".$this->resul[$k]["ca_modalidad"]."',v.ca_value ) >60
            order by ca_ident
            limit 1";
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            if(count($tmp_simil)>0)
            {
                $this->resul[$k]["ca_modalidad1"]=$tmp_simil[0]["ca_ident"];
            }
            else
            {
                $this->resul[$k]["ca_modalidad1"]="1";
            }
            
            if($this->resul[$k]["ca_transporte"]=="MARITIMO")
                $this->resul[$k]["ca_transporte"]=  Constantes::MARITIMO;
            else if($this->resul[$k]["ca_transporte"]=="AEREO")
                $this->resul[$k]["ca_transporte"]=  Constantes::AEREO;
            else
                $this->resul[$k]["ca_transporte"]=  Constantes::MARITIMO;
            
            if($this->resul[$k]["ca_proveedor"]=="")
                $this->resul[$k]["ca_proveedor"]="Sin Proveedor";
            
            if($this->resul[$k]["ca_peso"]=="")
                $this->resul[$k]["ca_peso"]="0";
            
            if($this->resul[$k]["ca_piezas"]=="")
                $this->resul[$k]["ca_piezas"]="0";
            
            if($this->resul[$k]["ca_mercancia"]=="")
                $this->resul[$k]["ca_mercancia"]="Sin Mercancia";
            
            if($this->resul[$k]["ca_deposito"]=="")
                $this->resul[$k]["ca_deposito"]="Sin Deposito";
            
            if($this->resul[$k]["ca_fcharribo"]=="0000-00-00")
                $this->resul[$k]["ca_fcharribo"]=date("Y-m-d");
            
                
            $sql="select * from tb_costos c
            where ca_impoexpo = 'Aduanas' and ca_transporte='{$this->resul[$k]["ca_transporte"]}' and ca_conceptoopen IS NOT NULL ";
            //echo $sql;
            $st = $con1->execute($sql);
            $tmp_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            
            $this->resul[$k]["ca_transporte"]=  utf8_encode($this->resul[$k]["ca_transporte"]);

            $this->costos=$tmp_simil;
            $this->costos1= array();
            foreach($this->costos as $l=>$c)
            {
                $arrCos=explode("|",$c["ca_conceptoopen"]);
                foreach($arrCos as $tmpc  )
                {
                    //echo $tmpc;
                    if(trim($tmpc)!="")
                        $this->costos1[$tmpc]=$l;
                }
            }
            
            
            //echo "<pre>";print_r($this->costos1);echo "</pre>";
            
            //echo "<pre>";print_r($tmp_simil);echo "</pre>";
            //echo "<pre>";print_r($this->resul);echo "</pre>";
            
            //z$this->resul[]:
            //DRZ-0513
        }
    /*
    ca_nombrecontacto: string
    ca_email: string
    ca_analista: string
    ca_trackingcode: string
    ca_aplicaidg: boolean
        */
        
        
        
        $year=date('Y');
        $yearold=$year-1;
        $sql="SELECT * from COLMASXX.fcoc$yearold where COMIDXXX='F' and comfpxxx like '%{$this->do}%' and regestxx='ACTIVO'"
            . " UNION "
            . " SELECT * from COLMASXX.fcoc$year where COMIDXXX='F' and comfpxxx like '%{$this->do}%' and regestxx='ACTIVO'";
        //$sql="SELECT * from COLMASXX.fcoc2015 where COMIDXXX='F' and regstamp>'2015-10-07 '";
        
        
        
        $st = $con->execute($sql);
        $this->facturacion = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        
        

        if($debug=="true")
        {
            echo "FACTURACION<pre>";print_r($this->facturacion);echo "</pre>";
        }
        
        //echo "----------------------------------------------------------------------";

        //$sql="SELECT * FROM COLMASXX.fcod2015 where (COMIDXXX='F' or (COMIDXXX='P' and comcodxx='004')) and DOCIDXXX like '%{$this->do}%'";
        $sql="SELECT * FROM COLMASXX.fcod$yearold where (COMIDXXX='F' or ( COMIDXXX='P' and comcodxx='004' and comfacxx ='') or ( COMIDXXX='P' and comcodxx='020' and ctoidxxx='2815050025' ) ) and DOCIDXXX like '%{$this->do}%' and regestxx='ACTIVO'"
        . " UNION SELECT * FROM COLMASXX.fcod$year where (COMIDXXX='F' or ( COMIDXXX='P' and comcodxx='004' and comfacxx ='') or ( COMIDXXX='P' and comcodxx='020' and ctoidxxx='2815050025' ) ) and DOCIDXXX like '%{$this->do}%' and regestxx='ACTIVO' order by comseqxx";
        //$sql="SELECT * FROM COLMASXX.fcod2015 where DOCIDXXX like '%{$this->do}%'";
        //$sql="SELECT * FROM COLMASXX.fcod2015 where regstamp>'2015-10-07'";
        
        
        $st = $con->execute($sql);
        $this->propios = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        
        
        if($debug=="true")
        {
            echo "PROPIOS:<pre>";print_r($this->propios);echo "</pre>";
        }
 //exit;        

      
        
        //$this->setTemplate("responseTemplate");
    }
    public function executeIndexExt5(sfWebRequest $request) {
        $this->serverJS=$_SERVER["HTTP_HOST"];
        
        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        //return 1;
        switch ($app) {
            case "colsys":
                $this->top = 30;
                break;
            case "tracking":
                $this->top = 75;
                break;
        }
        
        

    }


    function executeDatosIndex($request) {
        $idopcion = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Opciones","leaf" => true,"id" => "1");
        
        if($idopcion==0)
        {
            $childrens[] = array("text" => "Cuadro Matriz","leaf" => true,"id" => "1");            
            $childrens[] = array("text" => "Indicador","leaf" => true,"id" => "2");
            //$childrens[] = array("text" => "Indicador Facturacion","leaf" => true,"id" => "4");
            $childrens1[] = array("text" => "Generador","leaf" => true,"id" => "3");
            //$childrens1[] = array("text" => "Costos","leaf" => true,"id" => "4");
            //$childrens1[] = array("text" => "T. nacionalizacion","leaf" => true,"id" => "4");
            //$childrens1[] = array("text" => "Frec. Inspeccion","leaf" => true,"id" => "5");
            $childrens[] = array("text" => "Estadisticas","leaf" => false,"children"=>$childrens1);
        }
        $tree["children"] = $childrens;
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }



    public function executeGuardarArchivoControl( sfWebRequest $request  ){
        
        //$file=sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
                
        
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';
        
        
        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';

        if ($request->isMethod('post')){
            $file = $_FILES["archivo"];
            //print_r($file);
            //exit;
            if($file["tmp_name"])
            {                
                $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
                
                $fileName = $file['name'];
                $existe=true;
                $con=0;

                while($existe)
                {
                    $con++;
                    //$fileNametmp=
                    $pos= stripos($fileName, "(");
                    if($pos>0)
                        $fileNametmp= substr($fileName,0,$pos);
                    else
                    {
                        $pos= stripos($fileName, ".");
                        $fileNametmp=substr($fileName,0,$pos);
                    }
                        
                    if(file_exists($directory . $fileName))
                    {
                        while(file_exists($directory . $fileName."(".$cont.")"))
                        {
                            $con++;
                        }
                        $info = pathinfo($directory.$fileName);
                        $fileName=$fileNametmp."(".$con.")". ".".$info['extension'];
                    }
                    else
                        $existe=false;
                }

                //echo $directory . $fileName;
                if (move_uploaded_file($file['tmp_name'], $directory . $fileName)) {
                    
                    //$objReader = new PHPExcel_Reader_Excel5();
                    //$objPHPExcel = $objReader->load($directory . $fileName);
                    $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
                    //echo PHPEXCEL_ROOT;
                    $objPHPExcel = PHPExcel_IOFactory::load($directory.$fileName);
                    //exit;
                    $hojas=array();
                    foreach($objPHPExcel->getSheetNames() as $s)
                    {
                        $hojas[]=array("name"=>$s);
                    }
                    
                    $this->responseArray = array("id" => base64_encode($fileName), "fileName" => $fileName, "fecha" => $fecha, "hojas"=>$hojas ,"success" => true);
                    
                    
                } else {
                    $this->responseArray = array("error" => "No se pudo mover el archivo", "filename" => $fileName, "folder" => $folder, "success" => false);
                }
            }
            else
            {
                $fileName=$request->getParameter("fileName");
            }
        }    
        
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeProcesarArchivoControl( sfWebRequest $request  ){
        
        
        $fileName = $request->getParameter("fileName");
        $hoja = $request->getParameter("hoja");
        $muelle = $request->getParameter("muelle");
        $fecha = $request->getParameter("fecha");
        
        //include '/home/maquinche/Desarrollo/colsys_sf3/plugins/sfPhpEcxelPlugin/Classes/PHPExcel/IOFactory.php';
        include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
        //echo sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
        $objPHPExcel = PHPExcel_IOFactory::load($directory.$fileName);
        
        $ws = $objPHPExcel->getSheetByName($hoja);

        $array = $ws->toArray();
        //echo "<pre>";print_r($array);echo "</pre>";
        //exit;
        
        $cab = new AduFalaCabControl();
        $conn = $cab->getTable()->getConnection();
        $conn->beginTransaction();
        //try
        {
            //echo "<pre>";print_r($array);echo "</pre>";
            //exit;
            foreach( $array as $pos=>$row ){
                if($pos==0)
                {
                    $cab=new AduFalaCabControl();
                    $cab->setCaFile($fileName);
                    $cab->setCaHoja($hoja);
                    $cab->setCaMuelle($muelle);
                    $cab->setCaFecha($fecha);
                    $cab->setCaTransporte(Constantes::MARITIMO);
                    $cab->save($conn);
                    $columnas=array(
                        "CaReferencia"=>0,
                        "CaPreinspeccion"=>1,
                        "CaConsolidado"=>2,
                        "CaContenedor"=>3,
                        "CaTipocontenedor"=>4,
                        "CaCarpeta"=>5,
                        "CaLognet"=>6,
                        "CaBl"=>7,
                        "CaBlimpresion"=>8,
                        "CaFabricante"=>9,
                        "CaProveedor"=>10,
                        "CaObservaciones"=>11,
                        "CaTransportador"=>12,
                        "CaTipocarga"=>13,
                        "CaValor"=>14,
                        "CaFchcourrier"=>15,
                        "CaFchbl"=>16,
                        "CaFactura"=>17,
                        "CaFchfactura"=>18,
                        "CaFchlistempaque"=>19,
                        "CaCertfletes"=>20,
                        "CaFchcertfletes"=>21,
                        "CaFchpago"=>22,
                        "CaFchconsinv"=>26,                     
                        "CaFchrecepcion"=>27,
                        "CaFchdescripciones"=>28,
                        "CaFchlevante"=>30,
                        "CaFchentregatrans"=>31,
                        "CaEmbarque"=>32,
                        "CaInspeccion"=>33
                        );
                }
                if( $pos < 14){
                    continue;
                }
                else{
                    if(trim($row[0])=="" || trim($row[0])==".")
                        continue;

                    $det=new AduFalaDetControl();
                    $det->setCaIdFalCabControl($cab->getCaIdFalCabControl());
                    $det->setCaUsucreado("maquinche");
                    $det->setCaFchcreado(date("Y-m-d h:i:s"));
                    
                    
                    $ca_referencia=  str_replace(".", "", $row[$columnas["CaReferencia"]]);
                    $row[$columnas["CaReferencia"]]= substr($ca_referencia,0,3).".".substr($ca_referencia,3,2).".".substr($ca_referencia,5,2).".0"
                        .substr($ca_referencia,7,3).".1".substr($ca_referencia,10,1);

                    $row[$columnas["CaConsolidado"]]=  intval($row[$columnas["CaConsolidado"]]);                    
                    $row[$columnas["CaTipocontenedor"]]=  intval($row[$columnas["CaTipocontenedor"]]);
                    $row[$columnas["CaEmbarque"]]=  intval($row[$columnas["CaEmbarque"]]);
                    
                    if($row[$columnas["CaPreinspeccion"]]=="NO")
                        $row[$columnas["CaPreinspeccion"]]="false";
                    else if($row[$columnas["CaPreinspeccion"]]=="SI")
                        $row[$columnas["CaPreinspeccion"]]="true";

                    if($row[$columnas["CaInspeccion"]]=="NO")
                        $row[$columnas["CaInspeccion"]]="false";
                    else if($row[$columnas["CaInspeccion"]]=="SI")
                        $row[$columnas["CaInspeccion"]]="true";

                    $this->tmp = ParametroTable::retrieveByCaso("CU247", $row[$columnas["CaLognet"]]);                
                    if(count($this->tmp)<1)
                    {                    
                        ParametroTable::saveCaso( "CU247", $row[$columnas["CaLognet"]] );
                        $this->tmp = ParametroTable::retrieveByCaso("CU247", $row[$columnas["CaLognet"]]);
                    }
                    $row[$columnas["CaLognet"]]=$this->tmp[0]->getCaIdentificacion();


                    $this->tmp = ParametroTable::retrieveByCaso("CU248", $row[$columnas["CaBlimpresion"]]);
                    if(count($this->tmp)<1)
                    {                    
                        ParametroTable::saveCaso( "CU248", $row[$columnas["CaBlimpresion"]] );
                        $this->tmp = ParametroTable::retrieveByCaso("CU248", $row[$columnas["CaBlimpresion"]]);
                    }
                    $row[$columnas["CaBlimpresion"]]=$this->tmp[0]->getCaIdentificacion();

                    $this->tmp = ParametroTable::retrieveByCaso("CU249", $row[$columnas["CaTransportador"]]);
                    if(count($this->tmp)<1)
                    {                    
                        ParametroTable::saveCaso( "CU249", $row[$columnas["CaTransportador"]] );
                        $this->tmp = ParametroTable::retrieveByCaso("CU249", $row[$columnas["CaTransportador"]]);
                    }
                    $row[$columnas["CaTransportador"]]=$this->tmp[0]->getCaIdentificacion();



                    $this->tmp = ParametroTable::retrieveByCaso("CU250", $row[$columnas["CaTipocarga"]]);
                    if(count($this->tmp)<1)
                    {                    
                        ParametroTable::saveCaso( "CU250", $row[$columnas["CaTipocarga"]] );
                        $this->tmp = ParametroTable::retrieveByCaso("CU250", $row[$columnas["CaTipocarga"]]);
                    }
                    $row[$columnas["CaTipocarga"]]=$this->tmp[0]->getCaIdentificacion();


                    if(!is_numeric($row[$columnas["CaEmbarque"]]))
                        $row[$columnas["CaEmbarque"]]="0";



                    $row[$columnas["CaValor"]]=str_replace(",","",$row[$columnas["CaValor"]]);



                    //$det->setArray($array);
                    foreach($columnas as $k=>$c)
                    {
                        /*if(strpos($k, "fch")!==false)
                        {
                            $row[$c]=Utils::transformDate1( trim($row[$c]) , 1 );
                        }*/
                        eval("\$det->set".$k."(\$row[\$c]);");
                        //echo("\$det->set".$k."('{$row[$c]}');");echo "<br>";
                    }


                    $det->save($conn);

                }
            }
        
            $conn->commit();
            $success=true;
        }
        /*catch(Exception $e)
        {
            $error=$e->getmessage();
            $success=false;
        }*/
        //exit;
        
        $this->responseArray = array("id" => base64_encode($fileName), "fileName" => $fileName,  "hojas"=>$hoja ,"success" => $success,"error"=>$error);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeProcesarArchivoControlAereo( sfWebRequest $request  ){
        
        
        $fileName = $request->getParameter("fileName");
        $hoja = $request->getParameter("hoja");
        $muelle = $request->getParameter("muelle");
        $fecha = $request->getParameter("fecha");

        //include '/home/maquinche/Desarrollo/colsys_sf3/plugins/sfPhpEcxelPlugin/Classes/PHPExcel/IOFactory.php';
        include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
        //echo sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
        //echo $directory.$fileName;
        $objPHPExcel = PHPExcel_IOFactory::load($directory.$fileName);
        
        $ws = $objPHPExcel->getSheetByName($hoja);

        $array = $ws->toArray();
        //echo "<pre>";print_r($array);echo "</pre>";
        //exit;
        
        $cab = new AduFalaCabControl();
        $conn = $cab->getTable()->getConnection();
        $conn->beginTransaction();
        try
        {
            //echo "<pre>";print_r($array);echo "</pre>";
            //exit;
            foreach( $array as $pos=>$row ){
                if($pos==0)
                {
                    $cab=new AduFalaCabControl();
                    $cab->setCaFile($fileName);
                    $cab->setCaHoja($hoja);
                    $cab->setCaMuelle($muelle);
                    $cab->setCaFecha($fecha);
                    $cab->setCaTransporte(Constantes::AEREO);
                    
                    $cab->save($conn);
                    $columnas=array(
                        "CaFcheta"=>1,
                        "CaFchingresodep"=>2,                        
                        "CaReferencia"=>3,
                        "CaPreinspeccion"=>4,                        
                        "CaPaisorigen"=>5,
                        "CaFchconsolidado"=>6,
                        "CaConsolidado"=>7,
                        "CaDoctransporte"=>8,
                        "CaCarpeta"=>9,
                        "CaProveedor"=>10,
                        "CaLognet"=>11,
                        "CaTipocarga"=>12,
                        "CaValor"=>13,
                        "CaFchdoctransporte"=>14,
                        "CaFactura"=>15,
                        "CaFchfactura"=>16,
                        "CaFchlistempaque"=>17,
                        "CaCertfletes"=>18,
                        "CaFchcertfletes"=>19,
                        "CaFchpago"=>20,
                        "CaFchconsinv"=>24,
                        "CaFchrecepcion"=>25,
                        "CaFchdescripciones"=>26,
                        "CaAtiempo"=>27,
                        "CaFchlevante"=>28,
                        "CaFchentregatrans"=>29,
                        "CaInspeccion" => 31
                        );
                }
                if( $pos < 13){
                    continue;
                }
                else{
                    //echo "<pre>";print_r($row);echo "</pre>";
                    //if(trim($row[0])=="" || trim($row[0])==".")
                        //continue;

                    $det=new AduFalaDetControlAereo();
                    $det->setCaIdFalCabControl($cab->getCaIdFalCabControl());
                    $det->setCaUsucreado("maquinche");
                    $det->setCaFchcreado(date("Y-m-d h:i:s"));
                    
                    
                    $ca_referencia=  str_replace(".", "", $row[$columnas["CaReferencia"]]);
                    $row[$columnas["CaReferencia"]]= substr($ca_referencia,0,3).".".substr($ca_referencia,3,2).".".substr($ca_referencia,5,2).".0"
                        .substr($ca_referencia,7,3).".1".substr($ca_referencia,10,1);

                    $row[$columnas["CaConsolidado"]]=  intval($row[$columnas["CaConsolidado"]]);                    
                    //$row[$columnas["CaTipocontenedor"]]=  intval($row[$columnas["CaTipocontenedor"]]);
                    //$row[$columnas["CaEmbarque"]]=  intval($row[$columnas["CaEmbarque"]]);
                    
                    if(trim($row[$columnas["CaPreinspeccion"]])=="NO")
                        $row[$columnas["CaPreinspeccion"]]="false";
                    else if(trim($row[$columnas["CaPreinspeccion"]])=="SI" || trim($row[$columnas["CaPreinspeccion"]])=="si")
                        $row[$columnas["CaPreinspeccion"]]="true";

                    if(trim($row[$columnas["CaInspeccion"]])=="NO")
                        $row[$columnas["CaInspeccion"]]="false";
                    else if(trim($row[$columnas["CaInspeccion"]])=="SI" || trim($row[$columnas["CaInspeccion"]])=="si")
                        $row[$columnas["CaInspeccion"]]="true";
                    
                    if(trim($row[$columnas["CaAtiempo"]])=="NO" || trim($row[$columnas["CaAtiempo"]])=="No" || trim($row[$columnas["CaAtiempo"]])=="no")
                        $row[$columnas["CaAtiempo"]]="false";
                    else if(trim($row[$columnas["CaAtiempo"]])=="SI" || trim($row[$columnas["CaAtiempo"]])=="si" || trim($row[$columnas["CaAtiempo"]])=="Si")
                        $row[$columnas["CaAtiempo"]]="true";

                    $this->tmp = ParametroTable::retrieveByCaso("CU247", $row[$columnas["CaLognet"]]);                
                    if(count($this->tmp)<1)
                    {                    
                        ParametroTable::saveCaso( "CU247", $row[$columnas["CaLognet"]] );
                        $this->tmp = ParametroTable::retrieveByCaso("CU247", $row[$columnas["CaLognet"]]);
                    }
                    $row[$columnas["CaLognet"]]=$this->tmp[0]->getCaIdentificacion();


                    $this->tmp = ParametroTable::retrieveByCaso("CU250", $row[$columnas["CaTipocarga"]]);
                    if(count($this->tmp)<1)
                    {                    
                        ParametroTable::saveCaso( "CU250", $row[$columnas["CaTipocarga"]] );
                        $this->tmp = ParametroTable::retrieveByCaso("CU250", $row[$columnas["CaTipocarga"]]);
                    }
                    $row[$columnas["CaTipocarga"]]=$this->tmp[0]->getCaIdentificacion();

                    $row[$columnas["CaValor"]]=str_replace(",","",$row[$columnas["CaValor"]]);

                    foreach($columnas as $k=>$c)
                    {
                        /*if(strpos($k, "fch")!==false)
                        {
                            $row[$c]=Utils::transformDate1( trim($row[$c]) , 1 );
                        }*/
                        eval("\$det->set".$k."(\$row[\$c]);");                        
                    }
                    //echo $cab->getCaIdFalCabControl()."<br>";
                    $det->save($conn);
                    
                    
                    //echo "<pre>";print_r($det->getData());echo "</pre>";
                    //if(trim($row[0])=="" || trim($row[0])==".")
                    //    continue;
                }
            }
        
            $conn->commit();
            //echo "commit";
            $success=true;
        }
        catch(Exception $e)
        {
           $error=$e->getmessage();
            $success=false;
        }
        //exit;
        
        $this->responseArray = array("id" => base64_encode($fileName), "fileName" => $fileName,  "hojas"=>$hoja ,"success" => $success,"error"=>$error);
        $this->setTemplate("responseTemplate");
    }
    

    public function executeConsultaCabControl( sfWebRequest $request  ){

        $q = Doctrine::getTable("AduFalaCabControl")
                            ->createQuery("c")
                            ->select("*")                            
                             //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                            ->addOrderBy( "c.ca_fchcreado desc" )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            $debug=$q->getSqlQuery();
        
        $datos=$q->execute();
        //echo count($servicios);        
        foreach($datos as $k=>$c)
        {
            $datos[$k]["c_ca_transporte"]=utf8_encode($datos[$k]["c_ca_transporte"]);
        }
        //echo "<pre>";print_r($datos);echo "</pre>";

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
        
    }

    public function executeDatosDetControl( sfWebRequest $request  ){

        $idcabcontrol = $request->getParameter("idcabcontrol");
        $parametros="";
        
        if($request->getParameter("parametros"))
            $parametros = json_decode($request->getParameter("parametros"));

        $q = Doctrine::getTable("AduFalaDetControl")
                            ->createQuery("c")
                            ->select("c.*,f.ca_fecha,f.ca_muelle")
                            ->innerJoin("c.AduFalaCabControl f")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        if($idcabcontrol!="")
        {
            $q->addWhere("ca_id_fal_cab_control=?  ",$idcabcontrol );
            $q->addOrderBy( "c.ca_id_fal_det_control " );
        }
        
        if($parametros!="")
        {
            foreach($parametros->filtros as $f)
            {
                //echo "<pre>";print_r($filtro);echo "</pre>";
                //foreach($filtro as $f)
                {
                    //echo "<pre>";print_r($f);echo "</pre>";
                
                    if($f->name!="" && $f->operador!="" && $f->valor!="")
                        $q->addWhere($f->name.$f->operador."'".$f->valor."'" );
                    //echo $f->id.$f->operador.$f->valor;
                }
            }            
        }

        $debug=$q->getSqlQuery();
        //exit($debug);
        $datos=$q->execute();
        //echo count($datos);
        $festivos = TimeUtils::getFestivos(date("Y"));
        //print_r($festivos);
        //echo Utils::diffDays("2015-04-08","2015-03-23");
        //exit;
        foreach($datos as $k=>$c)
        {
            $this->tmp = ParametroTable::retrieveByCaso("CU247", null,null,$c["c_ca_lognet"]);
            $datos[$k]["c_ca_lognet"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            
            $this->tmp = ParametroTable::retrieveByCaso("CU248", null,null,$c["c_ca_blimpresion"]);
            $datos[$k]["c_ca_blimpresion"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            
               
            $this->tmp = ParametroTable::retrieveByCaso("CU249", null,null,$c["c_ca_transportador"]);
            $datos[$k]["c_ca_transportador"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            $this->tmp = ParametroTable::retrieveByCaso("CU250", null,null,$c["c_ca_tipocarga"]);
            $datos[$k]["c_ca_tipocarga"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            
            if($c["f_ca_fecha"]!="")
            {
                if($c["c_ca_fchrecepcion"]!="")
                    $datos[$k]["demoradocs"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchrecepcion"]));

                if($c["c_ca_fchdescripciones"]!="" || $c["c_ca_fchrecepcion"]!="")
                {
                    $fechatmp="";
                    switch(Utils::compararFechas($c["c_ca_fchdescripciones"], $c["c_ca_fchrecepcion"]))
                    {
                        case "0":
                        case "1":
                            $fechatmp=$c["c_ca_fchdescripciones"];                            
                        break;
                        case "-1":
                            $fechatmp=$c["c_ca_fchrecepcion"];                            
                        break;                    
                    }
                    $datos[$k]["atiempo"]= (Utils::compararFechas($fechatmp,$c["f_ca_fecha"])==1)?"No":"Si";
                    
                }
                
                if($c["c_ca_fchlevante"]!="")
                {
                    $datos[$k]["diasnaleta"]=TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchlevante"]);
                    
                    if(Utils::compararFechas($c["c_ca_fchconsinv"],$fechatmp)==1)
                    {
                        $fechatmp=$c["c_ca_fchconsinv"];
                    }                    
                    
                    $datos[$k]["diasnalhab"]=(TimeUtils::workDiff($festivos,$fechatmp,$c["c_ca_fchlevante"]));
                    //$datos[$k]["diasnalhab"]++;
                }
                
            }
        }
        
        
        
        //echo "<pre>";print_r($datos);echo "</pre>";

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
        
    }
    
    
    public function executeDatosIndFact( sfWebRequest $request  ){

        $fecha1 = $request->getParameter("fecha1");
        $fecha2 = $request->getParameter("fecha2");

        $eta1 = $request->getParameter("eta1");
        $eta2 = $request->getParameter("eta2");

        $q = Doctrine::getTable("InoMaestraAdu")
                            ->createQuery("c")
                            ->select("c.*,t.ca_factura")
                            ->leftJoin("c.InoCostosAdu t WITH ca_idcosto in(312,214)")//comision
                            ->where("ca_idcliente = ?  ",  array("900017447") )//nit cliente falabella
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);


        if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("ca_fcheta BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }
        
        $datos=$q->execute();
        
        $festivos = TimeUtils::getFestivos(date("Y"));

        //print_r($festivos);
        $festivos1=$festivos;
        $festivos1[]="2016-01-25";
        $festivos1[]="2016-01-26";
        $festivos1[]="2016-01-27";
        $festivos1[]="2016-01-28";
        $festivos1[]="2016-01-29";

        $festivos1[]="2016-02-23";
        $festivos1[]="2016-02-24";
        $festivos1[]="2016-02-25";
        $festivos1[]="2016-02-26";
        $festivos1[]="2016-02-29";
        
        $festivos1[]="2016-03-23";
        $festivos1[]="2016-03-24";
        $festivos1[]="2016-03-25";
        $festivos1[]="2016-03-28";
        $festivos1[]="2016-03-29";
        $festivos1[]="2016-03-30";
        $festivos1[]="2016-03-31";
        
        $festivos1[]="2016-04-25";
        $festivos1[]="2016-04-26";
        $festivos1[]="2016-04-27";
        $festivos1[]="2016-04-28";
        $festivos1[]="2016-04-29";
        
        $festivos1[]="2016-05-24";
        $festivos1[]="2016-05-25";
        $festivos1[]="2016-05-26";
        $festivos1[]="2016-05-27";
        $festivos1[]="2016-05-30";        
        $festivos1[]="2016-05-31";
        
        $festivos1[]="2016-06-24";
        $festivos1[]="2016-06-27";
        $festivos1[]="2016-06-28";
        $festivos1[]="2016-06-29";
        $festivos1[]="2016-06-30";
        //$festivos1[]="2016-05-31";


        $festivos1[]="2016-07-25";
        $festivos1[]="2016-07-26";
        $festivos1[]="2016-07-27";
        $festivos1[]="2016-07-28";
        $festivos1[]="2016-07-29";


        $festivos1[]="2016-08-25";
        $festivos1[]="2016-08-26";
        $festivos1[]="2016-08-29";
        $festivos1[]="2016-08-30";
        $festivos1[]="2016-08-31";


        $festivos1[]="2016-09-26";
        $festivos1[]="2016-09-27";
        $festivos1[]="2016-09-28";
        $festivos1[]="2016-09-29";
        $festivos1[]="2016-09-30";


        $festivos1[]="2016-10-25";
        $festivos1[]="2016-10-26";
        $festivos1[]="2016-10-27";
        $festivos1[]="2016-10-28";
        $festivos1[]="2016-10-31";
        
        $festivos1[]="2016-11-24";
        $festivos1[]="2016-11-25";
        $festivos1[]="2016-11-28";
        $festivos1[]="2016-11-29";
        $festivos1[]="2016-11-30";

        $festivos1[]="2016-12-16";
        $festivos1[]="2016-12-19";
        $festivos1[]="2016-12-20";
        $festivos1[]="2016-12-21";
        $festivos1[]="2016-12-22";
        $festivos1[]="2016-12-23";
        $festivos1[]="2016-12-26";
        $festivos1[]="2016-12-27";
        $festivos1[]="2016-12-28";
        $festivos1[]="2016-12-29";
        $festivos1[]="2016-12-30";
        
        
        

        foreach($datos as $k=>$c)
        {
            //$datos[$k]["dias1"]=floor(TimeUtils::dateDiff1($c["f_ca_fecha"],$c["c_ca_fchrecepcion"]));
            $datos[$k]["c_ca_transporte"]=utf8_encode($datos[$k]["c_ca_transporte"]);
            $datos[$k]["c_ca_nombrecontacto"]=utf8_encode($datos[$k]["c_ca_nombrecontacto"]);
            $datos[$k]["c_ca_mercancia"]=utf8_encode($datos[$k]["c_ca_mercancia"]);
            
            if($c["c_ca_fchdespcarga"]=="" || $c["c_ca_fchentrfacturacion"]=="" || $c["c_ca_fchfacturacion"]=="")
                continue;
            $datos[$k]["dias1"]=(TimeUtils::workDiff($festivos,$c["c_ca_fchdespcarga"],$c["c_ca_fchentrfacturacion"]));
            $datos[$k]["dias2"]=(TimeUtils::workDiff($festivos1,$c["c_ca_fchentrfacturacion"],$c["c_ca_fchfacturacion"]));
            $datos[$k]["dias3"]=(TimeUtils::workDiff($festivos1,$c["c_ca_fchdespcarga"],$c["c_ca_fchfacturacion"]));

            
            //if($datos[$k]["dias1"] !=null &&  $datos[$k]["dias1"]!="")
            {
                if($datos[$k]["dias1"]<=3)
                {
                    $indicador["indicador1"]["cumple"]["valor"]++;
                    $datos[$k]["ind1"]="Si";
                }
                else
                {
                    $indicador["indicador1"]["nocumple"]["valor"]++;
                    $datos[$k]["ind1"]="No";
                }
                $sum_dias1+=$datos[$k]["dias1"];
                $no_dias1++;
            }
            
            //if($c["c_ca_fchentrfacturacion"] && $c["c_ca_fchfacturacion"])
            {
                if($datos[$k]["dias2"]<=4)
                {
                    $indicador["indicador2"]["cumple"]["valor"]++;
                    $datos[$k]["ind2"]="Si";
                }
                else
                {
                    $indicador["indicador2"]["nocumple"]["valor"]++;
                    $datos[$k]["ind2"]="No";
                }
                $sum_dias2+=$datos[$k]["dias2"];
                $no_dias2++;
            }
            
            //if($c["c_ca_fchdespcarga"] && $c["c_ca_fchfacturacion"])
            {
                if($datos[$k]["dias3"]<=7)
                {
                    $indicador["indicador3"]["cumple"]["valor"]++;
                    $datos[$k]["ind3"]="Si";
                }
                else
                {
                    $indicador["indicador3"]["nocumple"]["valor"]++;
                    $datos[$k]["ind3"]="No";
                }
                $sum_dias3+=$datos[$k]["dias3"];
                $no_dias3++;
            }
            
            $indicador["total"]++;
        }
        
        
        $indicador["indicador1"]["cumple"]["%"]= ($indicador["indicador1"]["cumple"]["valor"] * 100 )/$indicador["total"];
        $indicador["indicador1"]["nocumple"]["%"]= ($indicador["indicador1"]["nocumple"]["valor"] * 100 )/$indicador["total"];
        
        $indicador["indicador2"]["cumple"]["%"]= ($indicador["indicador2"]["cumple"]["valor"] * 100 )/$indicador["total"];
        $indicador["indicador2"]["nocumple"]["%"]= ($indicador["indicador2"]["nocumple"]["valor"] * 100 )/$indicador["total"];
        
        $indicador["indicador3"]["cumple"]["%"]= ($indicador["indicador3"]["cumple"]["valor"] * 100 )/$indicador["total"];
        $indicador["indicador3"]["nocumple"]["%"]= ($indicador["indicador3"]["nocumple"]["valor"] * 100 )/$indicador["total"];
        
        
        $indicador1[]=array("indicador"=>"REFERENCIAS CON DEMORA","total"=>$indicador["indicador1"]["nocumple"]["valor"]);
        $indicador1[]=array("indicador"=>"REFERENCIAS CONFORMES","total"=> ($indicador["total"]-$indicador["indicador1"]["nocumple"]["valor"]));
        
        //foreach($indicador1 as $k =>$d)
        {
            $indicador1grid[]=array("total_carpeta"=>$indicador["total"],"total_demora"=>(is_null($indicador["indicador1"]["nocumple"]["valor"])?"0":$indicador["indicador1"]["nocumple"]["valor"]),"por_demora"=>round( $indicador["indicador1"]["nocumple"]["%"],1 ));
        }
        
        
        $indicador2[]=array("indicador"=>"REFERENCIAS CON DEMORA","total"=>$indicador["indicador2"]["nocumple"]["valor"]);
        $indicador2[]=array("indicador"=>"REFERENCIAS CONFORMES","total"=> ($indicador["total"]-$indicador["indicador2"]["nocumple"]["valor"]));
        
        //foreach($indicador2 as $k =>$d)
        {
            $indicador2grid[]=array("total_carpeta"=>$indicador["total"],"total_demora"=>(is_null($indicador["indicador2"]["nocumple"]["valor"])?"0":$indicador["indicador2"]["nocumple"]["valor"]),"por_demora"=>round( $indicador["indicador2"]["nocumple"]["%"],1 ));
        }
        
        $indicador3[]=array("indicador"=>"REFERENCIAS CON DEMORA","total"=>$indicador["indicador3"]["nocumple"]["valor"]);
        $indicador3[]=array("indicador"=>"REFERENCIAS CONFORMES","total"=> ($indicador["total"]-$indicador["indicador3"]["nocumple"]["valor"]));
        
        //foreach($indicador3 as $k =>$d)
        {
            $indicador3grid[]=array("total_carpeta"=>$indicador["total"],"total_demora"=>(is_null($indicador["indicador3"]["nocumple"]["valor"])?"0":$indicador["indicador3"]["nocumple"]["valor"]),"por_demora"=>round( $indicador["indicador3"]["nocumple"]["%"],1 ));
        }
        
        $sum_dias1+=$datos[$k]["dias1"];
        $no_dias1++;
        
        
        
        
        $sum["prom_dias1"]["total"]=($sum_dias1/$no_dias1);
        $sum["prom_dias2"]["total"]=($sum_dias2/$no_dias2);
        $sum["prom_dias3"]["total"]=($sum_dias3/$no_dias3);
        
        $htmlencabezado='<table align="center">'
                . '<tr >'
                . '     <th class="x-column-header x-column-header-inner">Dias Promedio de Envio DCTS Colmas BUN</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.round($sum["prom_dias1"]["total"],2).'</td>'
                . '</tr>'
                . '<tr>'
                . '     <th class="x-column-header x-column-header-inner">Dias Promedio de Facturaci&oacute;n Colmas BOG</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.round($sum["prom_dias2"]["total"],2).'</td>'                
                . '</tr>'
                . '<tr>'
                . '     <th class="x-column-header x-column-header-inner">Dias Promedio de Facturaci&oacute;n Colmas</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.round($sum["prom_dias3"]["total"],2).'</td>'                
                . '</tr>'
                . '</table>';
        /*echo "<pre>";
                print_r($indicador);print_r($datos);echo "</pre>";*/

        
        
        $this->responseArray = array("success" => true, "datos" => $datos,"indicador"=>$indicador, "indicador1"=>$indicador1,"indicador1grid"=>$indicador1grid, "indicador2"=>$indicador2,"indicador2grid"=>$indicador2grid,"indicador3"=>$indicador3,"indicador3grid"=>$indicador3grid,"encabezados"=>$htmlencabezado,"debug"=>$debug);
        //echo "<pre>";print_r($this->responseArray);echo "</pre>";
        //$this->responseArray = array("success" => true, "datos" => $datos);        
        $this->setTemplate("responseTemplate");
         //exit;
        
    }
    
    public function executeDatosIndAereo( sfWebRequest $request  )
    {
        $fecha1 = $request->getParameter("fecha1");
        $fecha2 = $request->getParameter("fecha2");
        
        $eta1 = $request->getParameter("eta1");
        $eta2 = $request->getParameter("eta2");
        
        /*$q = Doctrine::getTable("InoMaestraAdu")
                            ->createQuery("c")
                            ->select("c.*")                            
                            ->where("ca_idcliente = ? and  ca_transporte=? ",  array("900017447", Constantes::AEREO) )//nit cliente falabella
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);*/
           
        $q = Doctrine::getTable("AduFalaDetControlAereo")
                            ->createQuery("c")
                            ->select("c.*")
                            //->innerJoin("c.AduFalaCabControl f")
                             //->where("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) )
                            ->addOrderBy( "c.ca_id_fal_det_control_aereo " )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);


        if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("ca_fcheta BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }
        
        $datos=$q->execute();
        //echo $q->getSqlQuery();
        //print_r($datos);
        
        $festivos = TimeUtils::getFestivos(date("Y"));

        //print_r($festivos);
        $festivos1=$festivos;
        $festivos1[]="2016-01-25";
        $festivos1[]="2016-01-26";
        $festivos1[]="2016-01-27";
        $festivos1[]="2016-01-28";
        $festivos1[]="2016-01-29";

        $festivos1[]="2016-02-23";
        $festivos1[]="2016-02-24";
        $festivos1[]="2016-02-25";
        $festivos1[]="2016-02-26";
        $festivos1[]="2016-02-29";
        
        $festivos1[]="2016-03-23";
        $festivos1[]="2016-03-24";
        $festivos1[]="2016-03-25";
        $festivos1[]="2016-03-28";
        $festivos1[]="2016-03-29";
        $festivos1[]="2016-03-30";
        $festivos1[]="2016-03-31";
        
        $festivos1[]="2016-04-25";
        $festivos1[]="2016-04-26";
        $festivos1[]="2016-04-27";
        $festivos1[]="2016-04-28";
        $festivos1[]="2016-04-29";
        
        $festivos1[]="2016-05-24";
        $festivos1[]="2016-05-25";
        $festivos1[]="2016-05-26";
        $festivos1[]="2016-05-27";
        $festivos1[]="2016-05-30";        
        $festivos1[]="2016-05-31";
        
        $festivos1[]="2016-06-24";
        $festivos1[]="2016-06-27";
        $festivos1[]="2016-06-28";
        $festivos1[]="2016-06-29";
        $festivos1[]="2016-06-30";
        //$festivos1[]="2016-05-31";


        $festivos1[]="2016-07-25";
        $festivos1[]="2016-07-26";
        $festivos1[]="2016-07-27";
        $festivos1[]="2016-07-28";
        $festivos1[]="2016-07-29";


        $festivos1[]="2016-08-25";
        $festivos1[]="2016-08-26";
        $festivos1[]="2016-08-29";
        $festivos1[]="2016-08-30";
        $festivos1[]="2016-08-31";


        $festivos1[]="2016-09-26";
        $festivos1[]="2016-09-27";
        $festivos1[]="2016-09-28";
        $festivos1[]="2016-09-29";
        $festivos1[]="2016-09-30";


        $festivos1[]="2016-10-25";
        $festivos1[]="2016-10-26";
        $festivos1[]="2016-10-27";
        $festivos1[]="2016-10-28";
        $festivos1[]="2016-10-31";
        
        $festivos1[]="2016-11-24";
        $festivos1[]="2016-11-25";
        $festivos1[]="2016-11-28";
        $festivos1[]="2016-11-29";
        $festivos1[]="2016-11-30";

        $festivos1[]="2016-12-16";
        $festivos1[]="2016-12-19";
        $festivos1[]="2016-12-20";
        $festivos1[]="2016-12-21";
        $festivos1[]="2016-12-22";
        $festivos1[]="2016-12-23";
        $festivos1[]="2016-12-26";
        $festivos1[]="2016-12-27";
        $festivos1[]="2016-12-28";
        $festivos1[]="2016-12-29";
        $festivos1[]="2016-12-30";
        
        $festivos1[]="2017-03-27";
        $festivos1[]="2017-03-28";
        $festivos1[]="2017-03-29";
        $festivos1[]="2017-03-30";        
        $festivos1[]="2017-03-31";
        
        
    $indicador["indicador1"]["nocumple"]["valor"]=0;
    $indicador["indicador2"]["nocumple"]["valor"]=0;
    $indicador["indicador3"]["nocumple"]["valor"]=0;
    //$indicador["indicador4"]["nocumple"]["valor"]=0;
    $indicador["total"]=0;
    $consolidado = array();
            
        foreach($datos as $k=>$c)
        {
            
            //echo "<pre>";print_r($c);echo "</pre>";
            //exit;
            $datos[$k]["c_ca_transporte"]=utf8_encode($datos[$k]["c_ca_transporte"]);
            $datos[$k]["demoradocs"]=floor(TimeUtils::dateDiff($c["c_ca_fcheta"],$c["c_ca_fchrecepcion"]))-1;
            //$datos[$k]["demoradocs"]=floor(TimeUtils::dateDiff($c["c_ca_fchingresodep"],$c["c_ca_fchrecepcion"]))-1;
            
            $datos[$k]["descripciones"]=floor(TimeUtils::dateDiff($c["c_ca_fcheta"],$c["c_ca_fchdescripciones"]));
            
            $datos[$k]["etadeposito"]=floor(TimeUtils::dateDiff($c["c_ca_fcheta"],$c["c_ca_fchingresodep"]));
            $datos[$k]["etaconsolida"]=floor(TimeUtils::dateDiff($c["c_ca_fcheta"],$c["c_ca_fchconsolidado"]));
            //$datos[$k]["descripciones"]=floor(TimeUtils::dateDiff($c["c_ca_fcheta"],$c["c_ca_fchdescipciones"]));
            
            if($c["c_ca_fchlevante"]=="")
            {
                $datos[$k]["nacionalizacion"]=0;
                $datos[$k]["optimizacion"]=0;
            }
             else{
                $datos[$k]["nacionalizacion"]=floor( TimeUtils::workDiff($festivos1,$c["c_ca_fcheta"],$c["c_ca_fchlevante"]) );
                //$datos[$k]["nacionalizacion"]=floor( TimeUtils::workDiff($festivos1,$c["c_ca_fchingresodep"],$c["c_ca_fchlevante"]) );
                $datos[$k]["optimizacion"]=floor(TimeUtils::dateDiff($c["c_ca_fchrecepcion"],$c["c_ca_fchlevante"]));
                $fechatmp=$c["c_ca_fchdescripciones"];
                switch(Utils::compararFechas($c["c_ca_fchdescripciones"], $c["c_ca_fchrecepcion"]))
                {
                    case "0":
                    case "1":
                        $fechatmp=$c["c_ca_fchdescripciones"];
                        //echo "1<br>";
                    break;
                    case "-1":
                        $fechatmp=$c["c_ca_fchrecepcion"];
                        //echo "2<br>";
                    break;
                }
                switch(Utils::compararFechas($fechatmp, $c["c_ca_fchconsinv"]))
                {
                    case "0":
                    case "1":
                        $fechatmp=$fechatmp;
                        //echo "1<br>";
                    break;
                    case "-1":
                        $fechatmp=$c["c_ca_fchconsinv"];
                        //echo "2<br>";
                    break;
                }
                
                switch(Utils::compararFechas($fechatmp, $c["c_ca_fchconsolidado"]))
                {
                    case "0":
                    case "1":
                        $fechatmp=$fechatmp;
                        //echo "1<br>";
                    break;
                    case "-1":
                        $fechatmp=$c["c_ca_fchconsolidado"];
                    break;
                }

                    
                
                //$datos[$k]["nacionalizacion"]=floor( TimeUtils::workDiff($festivos1,$c["c_ca_fcheta"],$c["c_ca_fchlevante"]) );
                $datos[$k]["optimizacion"]=floor(TimeUtils::workDiff($festivos1,$fechatmp,$c["c_ca_fchlevante"]));
                
            }
            /*$tmp=$datos[$k]["demoradocs"];
            $datos[$k]["demoradocs"]=$datos[$k]["nacionalizacion"];
            $datos[$k]["nacionalizacion"]=$tmp;*/
            
             if($datos[$k]["demoradocs"]>1)
            {
                $indicador["indicador1"]["nocumple"]["valor"]++;
                $datos[$k]["indicador1"]="No cumple";
                //$indicador["documentos"]["muelle"][$datos[$k]["f_ca_muelle"]]["nocumple"]++;
            }
            else
            {
                $indicador["indicador1"]["cumple"]["valor"]++;
                $datos[$k]["indicador1"]="Cumple";
            }
                
            
            if($datos[$k]["descripciones"]>1)
            {
                $indicador["indicador2"]["nocumple"]["valor"]++;
                $datos[$k]["indicador2"]="No cumple";
                //$indicador["documentos"]["muelle"][$datos[$k]["f_ca_muelle"]]["nocumple"]++;
            }
            else
            {
                $indicador["indicador2"]["cumple"]["valor"]++;
                $datos[$k]["indicador2"]="Cumple";
            }            
            
            
            if($datos[$k]["c_ca_atiempo"]=="No" || $datos[$k]["c_ca_atiempo"]=="false" || $datos[$k]["c_ca_atiempo"]=="NO" )
            {
                if($datos[$k]["optimizacion"]>2)
                {
                    $consolidado[$datos[$k]["c_ca_consolidado"]]="nocumple";
                    $datos[$k]["indicador3"]="No cumple";
                }
                else
                {
                    if($consolidado[$datos[$k]["c_ca_consolidado"]]=="")
                    {
                        $consolidado[$datos[$k]["c_ca_consolidado"]]="cumple";
                        $datos[$k]["indicador3"]="Cumple";
                    }
                }
            }
            else
            {
                if($datos[$k]["optimizacion"]>5)
                {
                    $consolidado[$datos[$k]["c_ca_consolidado"]]="nocumple";
                    $datos[$k]["indicador3"]="No cumple";
                }
                else
                {
                    if($consolidado[$datos[$k]["c_ca_consolidado"]]=="")
                    {
                        $consolidado[$datos[$k]["c_ca_consolidado"]]="cumple";
                        $datos[$k]["indicador3"]="Cumple";
                    }
                }                
            }
            
            $datos[$k]["linea"]=substr($datos[$k]["c_ca_carpeta"],12,3);
            $indicador["indicador4"][$datos[$k]["linea"]]["total"]++;
            $indicador["indicador4"][$datos[$k]["linea"]]["cantidad"]+=$datos[$k]["etadeposito"];
            
            $indicador["indicador5"][$datos[$k]["linea"]]["total"]++;
            $indicador["indicador5"][$datos[$k]["linea"]]["cantidad"]+=$datos[$k]["etaconsolida"];
//=array("total"=>,"cantidad"=>)

            $indicador["total"]++;
        }

        $indicador["indicador1"]["cumple"]["%"]= ($indicador["indicador1"]["cumple"]["valor"] * 100 )/$indicador["total"];
        $indicador["indicador1"]["nocumple"]["%"]= ($indicador["indicador1"]["nocumple"]["valor"] * 100 )/$indicador["total"];
        
        $indicador["indicador2"]["cumple"]["%"]= ($indicador["indicador2"]["cumple"]["valor"] * 100 )/$indicador["total"];
        $indicador["indicador2"]["nocumple"]["%"]= ($indicador["indicador2"]["nocumple"]["valor"] * 100 )/$indicador["total"];

        foreach($consolidado as $k=>$c)
        {
            if($c=="nocumple")
                $indicador["indicador3"]["nocumple"]["valor"]++;
            else if($c=="cumple")
                $indicador["indicador3"]["cumple"]["valor"]++;
        }
        
        $indicador["indicador3"]["cumple"]["%"]= ($indicador["indicador3"]["cumple"]["valor"] * 100 )/count($consolidado);
        $indicador["indicador3"]["nocumple"]["%"]= ($indicador["indicador3"]["nocumple"]["valor"] * 100 )/count($consolidado);
        //echo "<pre>";print_r($indicador["indicador3"]);echo "</pre>";
        
        $indicador1[]=array("indicador"=>"REFERENCIAS CON DEMORA","total"=>$indicador["indicador1"]["nocumple"]["valor"]);
        $indicador1[]=array("indicador"=>"REFERENCIAS CONFORMES","total"=> ($indicador["total"]-$indicador["indicador1"]["nocumple"]["valor"]));
        
        //foreach($indicador1 as $k =>$d)
        {
            $indicador1grid[]=array("total_carpeta"=>$indicador["total"],"total_demora"=>(is_null($indicador["indicador1"]["nocumple"]["valor"])?"0":$indicador["indicador1"]["nocumple"]["valor"]),"por_demora"=>round( $indicador["indicador1"]["nocumple"]["%"],1 ));
        }
        
        
        $indicador2[]=array("indicador"=>"REFERENCIAS CON DEMORA","total"=>$indicador["indicador2"]["nocumple"]["valor"]);
        $indicador2[]=array("indicador"=>"REFERENCIAS CONFORMES","total"=> ($indicador["total"]-$indicador["indicador2"]["nocumple"]["valor"]));
        
        //foreach($indicador2 as $k =>$d)
        {
            $indicador2grid[]=array("total_carpeta"=>$indicador["total"],"total_demora"=>(is_null($indicador["indicador2"]["nocumple"]["valor"])?"0":$indicador["indicador2"]["nocumple"]["valor"]),"por_demora"=>round( $indicador["indicador2"]["nocumple"]["%"],1 ));
        }
        
        $indicador3[]=array("indicador"=>"CONSOLIDADOS CON DEMORA","total"=>$indicador["indicador3"]["nocumple"]["valor"]);
        $indicador3[]=array("indicador"=>"CONSOLIDADOS CONFORMES","total"=> (count($consolidado)-$indicador["indicador3"]["nocumple"]["valor"]));
        //$indicador3[]=array("indicador"=>"CONSOLIDADOS CON DEMORA","total"=>23);
        //$indicador3[]=array("indicador"=>"CONSOLIDADOS CONFORMES","total"=> 49);
        //49 23
        //echo "<pre>";print_r($indicador3);echo "</pre>";
        foreach($indicador3 as $k =>$d)
        {
            $indicador3grid[]=array("total_carpeta"=>count($consolidado),"total_demora"=>(is_null($indicador["indicador3"]["nocumple"]["valor"])?"0":$indicador["indicador3"]["nocumple"]["valor"]),"por_demora"=>round( $indicador["indicador3"]["nocumple"]["%"],1 ));
        }
        //$indicador3grid[]=array("total_carpeta"=>count($consolidado),"total_demora"=>23,"por_demora"=>round( (23/71)*100,1 ));


        $contenedores=array();
        
        //$arrtmp=array();
        //sort($indicador["indicador4"]);
        /*echo "<pre>";
        $lineassort=array_keys($indicador["indicador4"]);
        print_r($indicador["indicador4"]);
        print_r($lineassort);        
        sort($lineassort);
        print_r($lineassort);
        echo "</pre>";
        exit;*/
        $lineassort=array_keys($indicador["indicador4"]);        
        sort($lineassort);
        
        foreach($lineassort as $lin)
        {
            $i4=$indicador["indicador4"][$lin];
            $i5=$indicador["indicador5"][$lin];
            
            $indicador4[]=array("tipo"=>$lin,"Deposito"=> round($i4["cantidad"]/$i4["total"]),"Consolidado"=>round($i5["cantidad"]/$i5["total"]));
            
            $indicador4grid[]=array("Linea"=>$lin,"Deposito"=>round($i4["cantidad"]/$i4["total"]),"Consolidado"=>round($i5["cantidad"]/$i5["total"]));
        }
        //$indicador4[]=array("");
        /*$contenedores[]=array("tipo"=>"Contenedores","SPRBUN"=>count($indicador["contenedor"]["SPRBUN"]),"TCBUEN"=>count($indicador["contenedor"]["TCBUEN"]));
        $contenedores[]=array("tipo"=>"Teus","SPRBUN"=>
                (count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2)),
                "TCBUEN"=>(count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2)));
        */
        
        /*
        $contenedoresgrid[]=array(
            "terminal"=>'TCBUEN',
            "contenedor"=>count($indicador["contenedor"]["TCBUEN"]),
            "por_contenedor"=>round((count($indicador["contenedor"]["TCBUEN"])*100)/(count($indicador["contenedor"]["SPRBUN"])+count($indicador["contenedor"]["TCBUEN"]))),
            "teus"=>(count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2)),
            "por_teus"=>round((( count($indicador["tipocontenedor"]["TCBUEN"]["20"]) +( count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))*100)/((count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))+(count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2))))
            );
         * 
         */

        
        

        $this->responseArray = array("success" => true, "datos" => $datos,"indicador"=>$indicador, "indicador1"=>$indicador1,"indicador1grid"=>$indicador1grid, "indicador2"=>$indicador2,"indicador2grid"=>$indicador2grid,"indicador3"=>$indicador3,"indicador3grid"=>$indicador3grid,"indicador4"=>$indicador4,"indicador4grid"=>$indicador4grid,"consolidado"=>$consolidado/*,"encabezados"=>$htmlencabezado,"debug"=>$debug*/);
        //$this->responseArray = array("success" => true, "datos" => $datos);        
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeDatosPie( sfWebRequest $request  ){

        set_time_limit(3000);
        ini_set('max_execution_time', 3000);
        try{

        $datos=array();
        $tipo = $request->getParameter("tipo");
        $fecha1 = $request->getParameter("fecha1");
        $fecha2 = $request->getParameter("fecha2");
        
        $eta1 = $request->getParameter("eta1");
        $eta2 = $request->getParameter("eta2");
        
        $q = Doctrine::getTable("AduFalaDetControl")
                            ->createQuery("c")
                            ->select("c.*,f.ca_fecha,f.ca_muelle")
                            ->innerJoin("c.AduFalaCabControl f")
                             //->where("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) )
                            ->addOrderBy( "c.ca_id_fal_det_control " )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("f.ca_fecha BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }

        $debug=$q->getSqlQuery();
        $datos=$q->execute();
        $festivos = TimeUtils::getFestivos(date("Y"));
        $sum_diashab=0;
        $prom_diashab=0;
        $sum_diaseta=0;
        $prom_diaseta=0;
        $consolidadosnc=array();
        
        
        foreach($datos as $k=>$c)
        {
            
            $this->tmp = ParametroTable::retrieveByCaso("CU247", null,null,$c["c_ca_lognet"]);
            $datos[$k]["c_ca_lognet"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            
            $this->tmp = ParametroTable::retrieveByCaso("CU248", null,null,$c["c_ca_blimpresion"]);
            $datos[$k]["c_ca_blimpresion"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
               
            $this->tmp = ParametroTable::retrieveByCaso("CU249", null,null,$c["c_ca_transportador"]);
            $datos[$k]["c_ca_transportador"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            $this->tmp = ParametroTable::retrieveByCaso("CU250", null,null,$c["c_ca_tipocarga"]);
            $datos[$k]["c_ca_tipocarga"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            $datos[$k]["linea"]=substr($datos[$k]["c_ca_carpeta"],12,3);
            if($c["f_ca_fecha"]!="")
            {
                if($c["c_ca_fchrecepcion"]!="")
                    $datos[$k]["demoradocs"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchrecepcion"]));
                    //$datos[$k]["demoradocs"]=Utils::diffDays($c["f_ca_fecha"],$c["c_ca_fchrecepcion"]);
                
                
                //$datos[$k]["diasbl"]=floor(TimeUtils::dateDiff1($c["f_ca_fecha"],$c["c_ca_fchbl"]));
                $datos[$k]["diasbl"]=$c["c_ca_inspeccion"];
                
                
                if($c["c_ca_fchdescripciones"]!="" || $c["c_ca_fchrecepcion"]!="")
                {
                    $fechatmp="";                    
                    switch(Utils::compararFechas($c["c_ca_fchdescripciones"], $c["c_ca_fchrecepcion"]))
                    {
                        case "0":
                        case "1":
                            $fechatmp=$c["c_ca_fchdescripciones"];
                            //echo "1<br>";
                        break;
                        case "-1":
                            $fechatmp=$c["c_ca_fchrecepcion"];
                            //echo "2<br>";
                        break;
                    }

                    if(Utils::compararFechas($fechatmp,$c["f_ca_fecha"])==1)
                    {
                        $datos[$k]["atiempo"]= "No";
                    //    $indicador["descripciones"]["nocumple"]++;
                    //      $indicador["descripciones"]["muelle"][$datos[$k]["f_ca_muelle"]]["nocumple"]++;
                    }
                    else
                        $datos[$k]["atiempo"]= "Si";

                    $datos[$k]["demoradescmin"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchdescripciones"]));
                    if(Utils::compararFechas($c["c_ca_fchdescripciones"],$c["f_ca_fecha"])==1)
                    {
                        $datos[$k]["atiempodm"]= "No";
                        $indicador["descripciones"]["nocumple"]++;
                        $indicador["descripciones"]["muelle"][$datos[$k]["f_ca_muelle"]]["nocumple"]++;
                        $indicador["descripciones"]["linea"][$datos[$k]["linea"]]["nocumple"]++;
                    }
                    else
                        $datos[$k]["atiempodm"]= "Si";

                    $indicador["descripciones"]["linea"][substr($datos[$k]["c_ca_carpeta"],12,3) ]["total"]++;
                    $indicador["descripciones"]["muelle"][$datos[$k]["f_ca_muelle"]]["total"]++;
                }

                if($c["c_ca_fchlevante"]!="")
                {
                    $datos[$k]["diasnaleta"]=TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchlevante"]);
                    $sum_diaseta+=$datos[$k]["diasnaleta"];
                    $no_diaseta++;

                    if(Utils::compararFechas($c["c_ca_fchconsinv"],$fechatmp)==1)
                    {
                        $fechatmp=$c["c_ca_fchconsinv"];
                    }

                    $datos[$k]["diasnalhab"]=(TimeUtils::workDiff($festivos,$fechatmp,$c["c_ca_fchlevante"]));
                    $sum_diashab+=$datos[$k]["diasnalhab"];
                    $no_diashab++;
                    //$datos[$k]["diasnalhab"]++;
                }
            }
            if(!$consolidados[$datos[$k]["c_ca_consolidado"]])
            {
                $consolidados[$datos[$k]["c_ca_consolidado"]]="nocumple";
                //$consolidadosnc[]=$datos[$k]["c_ca_consolidado"];                
            }            
            
            $indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]]["valor"] = $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]]["valor"]?$indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]]["valor"]:0;
            $containers[$datos[$k]["f_ca_muelle"]][$datos[$k]["c_ca_consolidado"]] = $containers[$datos[$k]["f_ca_muelle"]][$datos[$k]["c_ca_consolidado"]]?$containers[$datos[$k]["f_ca_muelle"]][$datos[$k]["c_ca_consolidado"]]:"nocumple";
            
            if( $datos[$k]["c_ca_preinspeccion"]=="true" || $datos[$k]["c_ca_preinspeccion"]=="1" || $datos[$k]["c_ca_inspeccion"]=="true" || $datos[$k]["c_ca_inspeccion"]=="1")
            {
                if($datos[$k]["diasnalhab"]>4)
                {
                    //$indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]]["valor"]++;
                    //$indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]][$datos[$k]["f_ca_muelle"]]=1;
                }
                else
                {
                    $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]]["valor"]++;
                    $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]][$datos[$k]["f_ca_muelle"]]=1;
                    $consolidados[$datos[$k]["c_ca_consolidado"]]="cumple";
                    $containers[$datos[$k]["f_ca_muelle"]][$datos[$k]["c_ca_consolidado"]] = "cumple";
                }
            }
            else{
                if($datos[$k]["diasnalhab"]>2)
                {
                    //$indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]]["valor"]++;
                    //$indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]][$datos[$k]["f_ca_muelle"]]=1;
                }
                else
                {
                    $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]]["valor"]++;
                    $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]][$datos[$k]["f_ca_muelle"]]=1;
                    $consolidados[$datos[$k]["c_ca_consolidado"]]="cumple";
                    $containers[$datos[$k]["f_ca_muelle"]][$datos[$k]["c_ca_consolidado"]] = "cumple";
                }
            }

            $cumplimiento = array_count_values($consolidados);
            
            foreach ($containers as $muelle =>$val) {             
                $count_values[$muelle] = array_count_values($val);                
            }            
            
            if($datos[$k]["demoradocs"]>1)
            {
                $indicador["documentos"]["nocumple"]++;
                $indicador["documentos"]["muelle"][$datos[$k]["f_ca_muelle"]]["nocumple"]++;
            }
            $indicador["documentos"]["muelle"][$datos[$k]["f_ca_muelle"]]["total"]++;
            
            if($datos[$k]["diasbl"])
            {
                $datos[$k]["demorabl"]="Si";
                $indicador["demorabl"]["nocumple"]++;
                $indicador["demorabl"]["muelle"][$datos[$k]["f_ca_muelle"]]["nocumple"]++;
                
                $indicador["demorabl2"][$datos[$k]["f_ca_muelle"]]["nocumple"][$datos[$k]["c_ca_bl"]]=1;
                
            }
            else
            {
                $datos[$k]["demorabl"]="No";
                $indicador["demorabl2"][$datos[$k]["f_ca_muelle"]]["cumple"][$datos[$k]["c_ca_bl"]]=1;
            }
            
            $indicador["demorabl2"][$datos[$k]["f_ca_muelle"]]["total"][$datos[$k]["c_ca_bl"]]=1;
            
            $indicador["demorabl"]["muelle"][$datos[$k]["f_ca_muelle"]]["total"]++;
            
            $indicador["contenedor"][$c["f_ca_muelle"]][$c["c_ca_contenedor"]]++;
            $indicador["tipocontenedor"][$c["f_ca_muelle"]][$c["c_ca_tipocontenedor"]][$c["c_ca_contenedor"]][]=1;
                            
            $indicador["total"]++;
        }
        
        foreach($consolidados as $k=>$c)
        {
            if($c=="cumple")
                continue;
            $consolidadosnc[]=$k;
        }        
        
        foreach($datos as $k=>$c)
        {
            if(in_array($datos[$k]["c_ca_consolidado"], $consolidadosnc))
            {
                $datos[$k]["consnal"]=1;                
            }
            else
                $datos[$k]["consnal"]=0;
        }
            
                
        $prom_diashab=$sum_diashab/$no_diashab;
        $prom_diaseta=$sum_diaseta/$no_diaseta;
        
        $sum["prom_diashab"]["total"]=$prom_diashab;
        $sum["prom_diashab"]["sum_diashab"]=$sum_diashab;
        $sum["prom_diashab"]["no_diashab"]=$no_diashab;
                
        $sum["prom_diaseta"]["total"]=$prom_diaseta;
        $sum["prom_diaseta"]["sum_diaseta"]=$sum_diaseta;
        $sum["prom_diaseta"]["no_diaseta"]=$no_diaseta;
        
        $documentos[]=array("indicador"=>"CARPETAS CON DEMORA","total"=>$indicador["documentos"]["nocumple"]);
        $documentos[]=array("indicador"=>"CARPETAS CONFORME","total"=> ($indicador["total"]-$indicador["documentos"]["nocumple"]));
        
        foreach($indicador["documentos"]["muelle"] as $k =>$d)
        {
            $encabezados["carpetas"]+=$d["total"];
            $documentosgrid[]=array("terminal"=>$k,"total_carpeta"=>$d["total"],"total_demora"=>  (is_null($d["nocumple"])?"0":$d["nocumple"]),"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ),"tipo"=>"documentos");
        }

        $descripciones[]=array("indicador"=>"MERCANCIA CON DEMORA","total"=>$indicador["descripciones"]["nocumple"]);
        $descripciones[]=array("indicador"=>"MERCANCIA CONFORME","total"=> ($indicador["total"]-$indicador["descripciones"]["nocumple"]));
        
        
        /*foreach($indicador["descripciones"]["muelle"] as $k =>$d)
        {
            $descripcionesgrid[]=array("terminal"=>$k,"total_carpeta"=>$d["total"],"total_demora"=>$d["nocumple"],"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ));
        }*/
        foreach($indicador["descripciones"]["linea"] as $k =>$d)
        {
            $descripcionesgrid[]=array("terminal"=>$k,"total_carpeta"=>$d["total"],"total_demora"=>(is_null($d["nocumple"])?"0":$d["nocumple"]),"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ));
        }
        
        /*$nacionalizacion[]=array("indicador"=>"CONS CON DEMORA","total"=>count($indicador["nacionalizacion"]["nocumple"]));
        $nacionalizacion[]=array("indicador"=>"CONS CONFORME","total"=> count($indicador["nacionalizacion"]["cumple"]));*/
        $nacionalizacion[]=array("indicador"=>"CONS CON DEMORA","total"=>$cumplimiento["nocumple"]);
        $nacionalizacion[]=array("indicador"=>"CONS CONFORME","total"=> $cumplimiento["cumple"]);
        $nal_puertos=array();
        foreach($indicador["nacionalizacion"] as $k =>$cons)
        {
            foreach($cons as $c)
            {
                foreach($c as $p=>$d)
                {
                    if($p=="valor")
                        continue;
                    $nal_puertos[$p][$k]++;
                }
            }
        }

        foreach($nal_puertos as $k =>$d)
        {
            $nacionalizaciongrid[]=array("terminal"=>$k,"total_carpeta"=>($count_values[$k]["cumple"]+$count_values[$k]["nocumple"]),"total_demora"=>(is_null($count_values[$k]["nocumple"])?"0":$count_values[$k]["nocumple"]),"por_demora"=>round( ($count_values[$k]["nocumple"]*100)/($count_values[$k]["cumple"]+$count_values[$k]["nocumple"]),2 ));
        }        
            
        $contenedores=array();
        
        
        
        $contenedores[]=array("tipo"=>"Contenedores","SPRBUN"=>count($indicador["contenedor"]["SPRBUN"]),"TCBUEN"=>count($indicador["contenedor"]["TCBUEN"]));
        $contenedores[]=array("tipo"=>"Teus","SPRBUN"=>
                (count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2)),
                "TCBUEN"=>(count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2)));
        
        $contenedoresgrid[]=array(
                "terminal"=>'SPRBUN',
                "contenedor"=>count($indicador["contenedor"]["SPRBUN"]),
                "por_contenedor"=>round((count($indicador["contenedor"]["SPRBUN"])*100)/(count($indicador["contenedor"]["SPRBUN"])+count($indicador["contenedor"]["TCBUEN"]))),
                "teus"=>( count($indicador["tipocontenedor"]["SPRBUN"]["20"]) +(count($indicador["tipocontenedor"]["SPRBUN"]["40"]) *2)),
                "por_teus"=>round(((count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2))*100)/((count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))+(count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2))))
            );
        $contenedoresgrid[]=array(
            "terminal"=>'TCBUEN',
            "contenedor"=>count($indicador["contenedor"]["TCBUEN"]),
            "por_contenedor"=>round((count($indicador["contenedor"]["TCBUEN"])*100)/(count($indicador["contenedor"]["SPRBUN"])+count($indicador["contenedor"]["TCBUEN"]))),
            "teus"=>(count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2)),
            "por_teus"=>round((( count($indicador["tipocontenedor"]["TCBUEN"]["20"]) +( count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))*100)/((count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))+(count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2))))
            );
        
        
        /*$bls[]=array("indicador"=>"BL CON INSPECCION","total"=>$indicador["demorabl"]["nocumple"]);
        $bls[]=array("indicador"=>"BL AUTOMATICA","total"=> ($indicador["total"]-$indicador["demorabl"]["nocumple"]));
        
        foreach($indicador["demorabl"]["muelle"] as $k =>$d)
        {
            $blsgrid[]=array("terminal"=>$k,"total_carpeta"=>count($d["total"]),"total_demora"=>(is_null($d["nocumple"])?"0":$d["nocumple"]),"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ));
        }
        
        
        $bls[]=array("indicador"=>"BL CON INSPECCION","total"=>$indicador["demorabl"]["nocumple"]);
        $bls[]=array("indicador"=>"BL AUTOMATICA","total"=> ($indicador["total"]-$indicador["demorabl"]["nocumple"]));        
         * 
         */
        $totalbl=0;
        $totaldemorabl=0;
        foreach($indicador["demorabl2"] as $k =>$d)
        {
            $totalbl+=count($d["total"]);
            $totaldemorabl+=count($d["nocumple"]);
            $blsgrid[]=array("terminal"=>$k,"total_carpeta"=>count($d["total"]),"total_demora"=>(is_null(count($d["nocumple"]))?"0":count($d["nocumple"])),"por_demora"=>round( (count($d["nocumple"])*100)/(count($d["cumple"])+count($d["nocumple"])),2 ));
        }
        
        $bls[]=array("indicador"=>"BL CON INSPECCION","total"=>$totaldemorabl);
        $bls[]=array("indicador"=>"BL AUTOMATICA","total"=> $totalbl);
        
        
        $encabezados["bls"]=$totalbl;
        //$encabezados["carpetas"]=0;
        $encabezados["contenedores"]=count($indicador["contenedor"]["SPRBUN"])+count($indicador["contenedor"]["TCBUEN"]);
        $encabezados["teus"]=(count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))+(count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2));
        
        $htmlencabezado='<table align="center">'
                . '<tr >'
                . '     <th class="x-column-header x-column-header-inner">Total Contenedores</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["contenedores"].'</td>'
                . '     <th class="x-column-header x-column-header-inner">Cantidad BL</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["bls"].'</td>'
                . '</tr>'
                . '<tr>'
                . '     <th class="x-column-header x-column-header-inner">Total Carpetas</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["carpetas"].'</td>'
                . '     <th class="x-column-header x-column-header-inner">Cantidad Teus</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["teus"].'</td>'
                . '</tr>'
                . '<tr>'
                . '     <th class="x-column-header x-column-header-inner">Promedio Dias Habiles</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.round($sum["prom_diashab"]["total"],2).'</td>'
                . '     <th class="x-column-header x-column-header-inner">Promedio Dias Eta</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.round($sum["prom_diaseta"]["total"],2).'</td>'
                . '</tr>'
                . '</table>';
        }
        catch(Exception $e)
        {
            $errorInfo=$e->getMessage();
        }
        $this->responseArray = array("success" => true,"sum"=>$sum, "datos" => $datos,"encabezados"=>$htmlencabezado,"indicador"=>$indicador, "consolidados"=>$consolidados,"documentos"=>$documentos,"documentosgrid"=>$documentosgrid , "descripciones"=>$descripciones,"descripcionesgrid"=>$descripcionesgrid,"nacionalizacion"=>$nacionalizacion,"nacionalizaciongrid"=>$nacionalizaciongrid,"contenedores"=>$contenedores,"contenedoresgrid"=>$contenedoresgrid,"bls"=>$bls,"blsgrid"=>$blsgrid, "total" => count($datos),"prom_diashab"=>$prom_diashab,"prom_diaseta"=>$prom_diaseta,"debug"=>$debug,"error"=>$errorInfo);
        //$this->responseArray = array("success" => true, "indicador"=>$indicador, "muelles"=>$count_values, "consolidados"=>$consolidados,"containers"=>$containers,"nacionalizaciongrid"=>$nacionalizaciongrid);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGrafica( sfWebRequest $request  ){
        
        //$datos = $request->getParameter("datos");
        
        $datos = json_decode($request->getParameter("datos"));
        
        $this->responseArray = array("success" => true, "root" => $datos);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGenReporte(sfWebRequest $request){
        
        
        $q = Doctrine::getTable("AduFalaDetControl")
            ->createQuery("c")
            ->select("c.*,f.ca_fecha,f.ca_muelle")
            ->innerJoin("c.AduFalaCabControl f") 
            //->where("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) )
            ->addOrderBy( "c.ca_id_fal_det_control " )
            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");        
    }
    
    public function executeDatosFacturacion(sfWebRequest $request)
    {
        $tipo = $request->getParameter("tipo");
        $fecha1 = $request->getParameter("fecha1");
        $fecha2 = $request->getParameter("fecha2");
        
        $eta1 = $request->getParameter("eta1");
        $eta2 = $request->getParameter("eta2");
        
        /*$q = Doctrine::getTable("AduFalaDetControl")
                            ->createQuery("c")                            
                            ->select("distinct(c.ca_referencia),ic.ca_idcosto, ic.ca_neta, ic.ca_venta")
                            ->innerJoin("c.AduFalaCabControl f")
                            ->innerJoin("c.InoCostosAdu ic") 
                             //->where("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) )
                            //->addOrderBy( "c.ca_id_fal_det_control " )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
       */
$q = Doctrine::getTable("InoMaestraAdu")
                            ->createQuery("c")
                            //->select("c.*,t.ca_factura")
                            ->select("c.ca_referencia,ic.ca_idcosto, ic.ca_neta, ic.ca_venta,cos.ca_costo")
                            ->innerJoin("c.InoCostosAdu ic")
                            ->where("ca_idcliente = ?  ",  array("900017447") )//nit cliente falabella
                            ->innerJoin("ic.Costo cos")
                            ->addOrderBy( "c.ca_referencia,ic.ca_idcosto " )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);


        if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("ca_fcheta BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }
        /*$q = Doctrine::getTable("AduFalaDetControl")
                            ->createQuery("c")
                            ->select("c.ca_referencia,ic.ca_idcosto, ic.ca_neta, ic.ca_venta,cos.ca_costo")
                            ->innerJoin("c.AduFalaCabControl f")
                            ->innerJoin("c.InoCostosAdu ic")
                            ->innerJoin("ic.Costo cos")
                            ->addOrderBy( "c.ca_referencia,ic.ca_idcosto " )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
                if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("f.ca_fecha BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }*/

        $debug=$q->getSqlQuery();
        $datos=$q->execute();
        //echo "<pre>";print_r($datos);echo "</pre>";
        $columnas=array();
        $columnas["zreferencia"]=array("name"=>"Do","dataindex"=>"zreferencia","summaryType"=>'count');
        foreach($datos as $d)
        {            
            $datosJson[$d["c_ca_referencia"]][$d["ic_ca_idcosto"]]=array("costo"=>$d["ic_ca_idcosto"],"neta"=>$d["ic_ca_neta"],"venta"=>$d["ic_ca_venta"]);
            if(!isset($columnas[$d["ic_ca_idcosto"]]))
            {
                $columnas["z".$d["ic_ca_idcosto"]]=array("name"=>utf8_encode($d["cos_ca_costo"]),"dataindex"=>"z".$d["ic_ca_idcosto"],"summaryType"=>'sum');
            }
        }
        $columnas["zpropio"]=array("name"=>"Propio","dataindex"=>"zpropio","summaryType"=>'sum');
        $columnas["ztercero"]=array("name"=>"Tercero","dataindex"=>"ztercero","summaryType"=>'sum');
        //echo "<pre>";print_r($columnas);echo "</pre>";
        $datos=array();
        
        foreach($datosJson as $r=>$d)
        {
            $costo=null;            
            $costo["zreferencia"]=$r;
            foreach($d as $c)
            {
                if($c["neta"]>0)
                {
                    $costo["z".$c["costo"]]=round(($c["neta"]!="")?$c["neta"]:"0");                    
                    $costo["ztercero"]+=round($costo["z".$c["costo"]]);
                }
                else
                {
                    $costo["z".$c["costo"]]=round(($c["venta"]!="")?$c["venta"]:"0");
                    $costo["zpropio"]+=round($costo["z".$c["costo"]]);
                }
            }
            //echo "<pre>";print_r($costo);echo "</pre>";
            $datos[]=$costo;
        }
        
        //echo "<pre>";print_r($columnas);echo "</pre>";

        $this->responseArray = array("success" => true, "datos" => $datos, "columnas" =>$columnas ,"total" => count($datosJson),"debug"=>$debug);
        //$this->responseArray = array("success" => true, "indicador"=>$indicador, "muelles"=>$count_values, "consolidados"=>$consolidados,"containers"=>$containers,"nacionalizaciongrid"=>$nacionalizaciongrid);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEliminarCabControl(sfWebRequest $request)
    {
        $id = $request->getParameter("id");
        $success=true;
        $errorInfo="";
        try{
            Doctrine_Query::create()
                ->delete()
                ->from("AduFalaCabControl c")
                ->where("c.ca_id_fal_cab_control = ? ", array($id))
                ->execute();            
        }catch(Exception $e)
        {
            $success=false;
            $errorInfo=$e->getMessage();
        }
        $this->responseArray = array("success" => $success,"errorInfo"=>$errorInfo);
        $this->setTemplate("responseTemplate");
    }
    
    
    
    
}
