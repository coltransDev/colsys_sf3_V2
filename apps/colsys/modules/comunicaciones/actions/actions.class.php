<?php

/**
 * comunicaciones actions.
 *
 * @package    symfony
 * @subpackage comunicaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comunicacionesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  public function executeEnvioComunicado(sfWebRequest $request) {
        $this->setLayout("email");
        
        
        
        /*error_reporting(E_ALL);
        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "comunicaciones" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;

        $nreg = 120;*/
        
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*CONSULTAS SQL*/
        
        $con = Doctrine_Manager::getInstance()->connection();
        
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Clientes Coldepósitos +++++++++++++++++++++++++++*/
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/        
        
        /*$sql = "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes c
                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL and con.ca_cargo != 'Extrabajador'
            WHERE c.ca_idalterno IN ('800154351','830142051','830100784','830038515','830096788','830018818','830125741','9111111','860002964','860000368','800026212','830036557','900555904','900073312')
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto
            LIMIT $nreg OFFSET $inicio";*/
        
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Clientes Específicos por Nit +++++++++++++++++++++++++++*/
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/        
        
        /*$sql = "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes c
                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL and con.ca_cargo != 'Extrabajador'
            WHERE c.ca_idcliente IN (900425028,7227,800236772,6929,860535706,1796,890402550,4078,2839,830041850,860517718,6730,3313,800018359,800248701,4274,800221789,900136609,800047305,860006853,7272,4416,860501575,830132355,6829,800232283,4757,5612,7106,6416,2630,860002459,3199,7012,860006754,6588,900327290,6416,900237915,830010484,830076368,830122777,6088,830039854,5564,860036314,1641,6870,860533206,860350589,1644,5568,4332,6565,800110392,860403026,7128,860001605,6857,830046885,800209481,19118041,5777,860051812,800178498,900399003,800181509,830123972,860002119,3081,5019,7320,899999044,800127368,4297,860023411,2656,6719,7271,860352217,6465,6636,6748,860526809,860006327,7097,860521601,7378,860000332,860001999,2367,2124,800013834,6720,900104907,3313,900027833,6439,800013455,7312,860075684,3113,1936,6050,41626327,860536292,5339,6331,6428,6934,900080090,5622,6582,830053994,860034812,7498,830058969,3313,4748,860024986,4501,6971,7484,1642,5867,830033279,830122760,7178,6660,7522,6631,5678,830027231,6801,7118,6263,6168,6238,800133807,5375,5710,3452,7085,6943,6799,6747,2257,6446,830071604,860402109,6630,3376,890700058,7290,860031699,4318,7148,6079,6843,830108724)
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto
            OFFSET 1";*/
        
        /*+++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Clientes Coltrans & Colmas Activos +++++++*/
        /*+++++++++++++++++++++++++++++++++++++++++++++++++++*/
        
        /*$sql= "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes c
                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL
            WHERE (c.ca_colmas_std = 'Activo' OR c.ca_coltrans_std = 'Activo') AND (c.ca_tipo  is NULL OR c.ca_tipo LIKE '%Proveedor%')
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto
            limit 1 OFFSET 140";*/
        
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Clientes Noticolmas +++++++++++++++++++++++*/
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        
        $sql= "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes c
                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL
            WHERE (c.ca_colmas_std = 'Activo')  AND (c.ca_tipo  is NULL OR c.ca_tipo LIKE '%Proveedor%')
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto            
            ";
            //LIMIT $nreg OFFSET $inicio";
            
         
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Clientes Bogotá +++++++++++++++++++++++++++*/
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++*/
         
        /*$sql = "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes c
                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL
            WHERE (c.ca_colmas_std = 'Activo' OR c.ca_coltrans_std = 'Activo') AND (c.ca_tipo  is NULL OR c.ca_tipo LIKE '%Proveedor%')
                AND c.ca_idciudad LIKE '%BOG-0001%' 
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto
            LIMIT $nreg OFFSET $inicio";*/
            //LIMIT 3";                  
        
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Envio Contacto Específico +++++++++++++++++*/
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        
        /*$sql = "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes c
                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente
            WHERE c.ca_idcliente = 800024075 AND ca_idcontacto = 1112
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto
            LIMIT $nreg";*/
         
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Envio Proveedores Activos +++++++++++++++++*/
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        
        /*$sql = "
            SELECT i.ca_nombre, c.ca_email, c.ca_idcontacto, p.ca_idproveedor as ca_idcliente
            FROM ids.tb_contactos c
                LEFT JOIN ids.tb_sucursales s ON s.ca_idsucursal = c.ca_idsucursal
                LEFT JOIN ids.tb_ids i ON i.ca_id = s.ca_id
                LEFT JOIN ids.tb_proveedores p ON p.ca_idproveedor = i.ca_id
            WHERE (p.ca_activo_impo = true OR p.ca_activo_expo = true) and c.ca_email like '%@%' and c.ca_activo = true AND c.ca_notificar_vencimientos = true  
            ORDER BY i.ca_nombre OFFSET 2";            */
            /*LIMIT $nreg OFFSET $inicio";*/
        
        
        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        //$idComunicado = $this->getRequestParameter("id");
        $idComunicado = 26;
        $conteo = 0;
        $emails_Control = "";
        
        $comunicado = Doctrine::getTable("Comunicado")->find($idComunicado);
        $this->forward404unless($comunicado);
        
        $asunto = $comunicado->getCaSubject();
        $emailFrom = $comunicado->getCaFrom();
        $tipo_email = $comunicado->getCaType();
        $fromName = $comunicado->getCaFromname();
        $unsuscribe = "";
        
        $mensaje_alternativo = $asunto;        
        //$mensaje_alternativo = "";
        $request->setParameter("asunto", $asunto);
        $html = sfContext::getInstance()->getController()->getPresentationFor('comunicaciones', 'emailComunicado');
        
        /*if (count($clientes) > 0) {
            $data["email"] = array();
            foreach ($clientes as $cliente) {                
                $unsuscribe = "<div style='font-size: 9px;'>Por favor no responda a este correo, si tiene alguna inquietud o no desea recibir mas este correo electrónico por favor haga click <a href='https://www.colsys.com.co/clientes/cancelarSuscripcion?idcontacto=".$cliente["ca_idcontacto"]."&idcliente=".$cliente["ca_idcliente"]."'>aquí</a></div>";             
                if(!in_array($cliente["ca_email"], $data["email"])){
                    try {                        
                        $envio = new Envio();
                        $envio->setCaIdcomunicado($idComunicado);
                        $envio->setCaId($cliente["ca_idcliente"]);
                        $envio->setCaIdcontacto($cliente["ca_idcontacto"]);                        
                        $envio->save();
                        
                        $data["email"][]=$cliente["ca_email"];
                        
                        $email = new Email();
                        $email->setCaUsuenvio("Administrador");
                        $email->setCaIdcaso($idComunicado);
                        $email->setCaTipo($tipo_email);
                        $email->setCaFrom($emailFrom);
                        $email->setCaFromname($fromName);
                        $email->setCaSubject($asunto);
                        $email->setCaAddress($cliente["ca_email"]);
                        //$email->setCaAddress("alramirez@coltrans.com.co");                        
                        //$email->setCaAttachment( "tmp/COMUNICADO_DE_PRENSA_TARIFAS_SPRB.pdf" );
                        $request->setParameter("idcliente", $cliente["ca_idcliente"]);
                        $request->setParameter("idcontacto", $cliente["ca_idcontacto"]);
                        $request->setParameter("idenvio", $envio->getCaIdenvio());
                        $html = sfContext::getInstance()->getController()->getPresentationFor('comunicaciones', 'emailComunicado');
                        $email->setCaBody($mensaje_alternativo);
                        $email->setCaBodyhtml($html.$unsuscribe);
                        $email->save();
                        $email->send();
                        
                        $envio->setCaIdemail($email->getCaIdemail());
                        $envio->save();
                        
                        $emails_Control.=$cliente["ca_email"] . "<br>";
                        $conteo++;
                        
                    } catch (Exception $e) {
                        $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
                        $email = new Email();
                        $email->setCaUsuenvio("Administrador");
                        $email->setCaFrom($emailFrom);
                        $email->setCaFromname($fromName);
                        $email->setCaSubject("ERROR EN ENVIO".$asunto);
                        $email->setCaAddress("colsys@coltrans.com.co");
                        $email->setCaBodyhtml("emails:<br>" . $emails_Control);            
                        $email->setCaTipo($tipo_email);
                        $email->save();
                        //$email->send();
                    }
                }
            }
        }*/
        
            
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Remite mensaje para aprobación ++++++++++++++++++*/
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        
        /*$mensaje = "Se remite copia para aprobación.<br/>";        
        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname($fromName);
        $email->setCaSubject($asunto);        
        $email->setCaAddress("claudia.mejia@colmas.com.co");
        //$email->setCaAddress("tdiaz@coltrans.com.co");
        $email->addTo("alramirez@coltrans.com.co");
        //$email->setCaAttachment( "tmp/COMUNICADO_DE_PRENSA_TARIFAS_SPRB.pdf" );        
        $email->setCaBodyhtml($mensaje.$html);
        $email->setCaTipo($tipo_email);               
        $email->save();*/


        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        /*++++++++ Remite mensaje Informativo a Colaboradores ++++++*/
        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        
        $mensaje = "Se remite copia a Empleados Grupo Empresarial para información.<br/>";        
        //$mensaje = "Se envia mensaje a Gerentes y Jefes de sucursales Colmas y Coltrans.</br>";
        //$mensaje = "Se remite copia a Empleados Colmas para información.";

        $html = $mensaje;
        $html.= sfContext::getInstance()->getController()->getPresentationFor('comunicaciones', 'emailComunicado');

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname($fromName);
        $email->setCaSubject($asunto);        
        //$email->setCaAddress("jefesnal@coltrans.com.co");
        //$email->addTo("gerenciassuc@coltrans.com.co");
        //$email->addTo("jefesnal@colmas.com.co");
        //$email->setCaAddress("alramirez@coltrans.com.co");
        //$email->addTo("leonardo.sandoval@colmas.com.co");
        $email->setCaAddress("empleados-nal@coltrans.com.co");
        $email->addTo("colmasnal@colmas.com.co");
        $email->addTo("colotmnal@colotm.com");
        $email->addTo("empleados-nal@coldepositos.com.co");
        $email->setCaBodyhtml($html);
        $email->setCaTipo($tipo_email);
        $email->save();
        //$email->send();
        
        
        //file_put_contents($filecontrol, $inicio + $nreg);
        //echo $html;
        exit;        
    }
  
  public function executeConfirmarAsistencia(sfWebRequest $request){
        
        $idcontacto = $this->getRequestParameter("idcontacto");
        $idcliente = $this->getRequestParameter("idcliente");
        $this->idenvio = $this->getRequestParameter("idenvio");
        $this->aceptacion = $this->getRequestParameter("aceptacion");
        $comentarios = $this->getRequestParameter("comentarios");
        
        $this->contacto = Doctrine::getTable("Contacto")->find($idcontacto);        
        
        if($idcliente==$this->contacto->getCaIdcliente()){
            $this->cliente = Doctrine::getTable("Cliente")->find($this->contacto->getCaIdcliente());
            if($this->contacto){
                if( $this->idenvio){                
                    try{
                        
                        $envio = Doctrine::getTable("Envio")->find( $this->idenvio);
                        if( $envio->getCaId()==$idcliente && $envio->getCaIdcontacto() == $idcontacto){                        
                            if($this->aceptacion){
                                if($envio->getCaConf()){
                                    $this->respuesta = "La confirmación ya fué realizada. Gracias";
                                }else{
                                    $envio->setCaConf(true);
                                    $envio->setCaFchconf(date('Y-m-d H:i:s'));
                                    $envio->setCaObservaciones($comentarios);
                                    $envio->save();
                                }
                            }
                        }else{
                            $this->respuesta = "La información enviada no concuerda con nuestra base de datos";                            
                        }
                    }catch(Exception $e){
                        print_r($e);
                    }
                }else{
                    $this->respuesta = "La comunicación no existe";
                }
            }else{
                $this->respuesta = "El contacto no existe en la base de datos";                
            }
        }else{
            $this->respuesta = "Este contacto no pertenece al cliente";
        }
        
        $this->setLayout("email");
    }
    
    public function executeEmailComunicado(sfWebRequest $request){
        
        $this->idcontacto = $this->getRequestParameter("idcontacto");
        $this->idcliente = $this->getRequestParameter("idcliente");
        $this->idenvio = $this->getRequestParameter("idenvio");
        $this->asunto = $this->getRequestParameter("asunto");

        $data=array();
        
        
        $data[]=array(
            "title"=>"1. RESOLUCION 10 DE 2017",
            "image"=>"https://rauldlacruz.files.wordpress.com/2015/02/ret-iva.jpg",
            "content"=>'Con Resolución 10 de 2017, la Dirección de Impuestos y Aduanas Nacionales, estableció los códigos para las modalidades de importación, que de acuerdo con la última reforma tributaria quedaron con una tarifa del 16% de IVA,  aplicable a los contratos de construcción e infraestructura para contratos de infraestructura de transporte suscritos por las entidades públicas o estatales.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Res010-2017.pdf" target="_blank">Ver Resolución</a>'
            );        
        $data[]=array(
            "title"=>"2. RESOLUCION 17 DE 2017",
            "image"=>"http://www.noticosta.com/login/Administrador/insertar/imgGaleria/9c1048_image004.jpg",
            "content"=>'Con resolución 17 de 2017, la DIAN reglamentó la entrega de las Declaraciones de Importación de confecciones y calzado a los Observadores para que generen alertas sobre posibles operaciones de contrabando y fraude aduanero.'
                . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Res017-2017.pdf" target="_blank">Ver Resolución</a>'
            );        
        $data[]=array(
            "title"=>"3. COMUNICADO DIAN",
            "image"=>"http://www.clipartkid.com/images/90/change-management-kickstarter-checklist-change-management-change-8rUUWT-clipart.jpg",
            "content"=>'Con ocasión de la implementación de los Sistemas Informaticos aduaneros, que se requieren para la aplicación del Decreto 390 de 2016, la DIAN realizó diagnóstico de los cambios que se realizarán, entre los cuales se encuentran: automatización de trámites que actualmente se realizan en forma manual, ajustes a la plataforma del proceso de importación, inclusión de nuevos operadores de comercio exterior.  Dentro de los servicios informáticos que están conceptualizándose se encuentran: Régimen de Importación y depósito, carga e importaciones, tráfico postal y envios de entrega rápida.'
            .'<a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/ComunicadoDIAN-Sistemas_Informaticos.pdf" target="_blank">Ver Comunicado</a>'
            );        
        $data[]=array(
            "title"=>"4. CONCEPTO JURIDICO 2252 DE 2017",
            "image"=>"http://lapatriaenlinea.com/fotos/02_2015/211069_1_12.jpg",
            "content"=>'Mediante concepto 2252 de 2017 la División de Doctrina de la Dirección de Impuestos y Aduanas Nacionales, aclaró que la constitución y/o renovación de las garantías para el cumplimiento de obligaciones se debe calcular sobre el valor en salarios mínimos legales vigentes en el a?o que se constituye o renueva la garantía.'
                .'<a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto2252-2017.pdf" target="_blank">Ver Concepto</a>'
            );        
        $data[]=array(
            "title"=>"5. CIRCULAR COLMAS",
            "image"=>"",
            "content"=>'Con Circular 002 -2017 COLMAS informa a sus clientes sobre la generación de facturas adicionales que está realizando puerto, cuando el contenedor es devuelto vacío en sus instalaciones.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/CIRCULAR_COLMAS_02-2017.pdf" target="_blank">Ver Circular</a>'
            );        
        /*$data[]=array(
            "title"=>"6. CONCEPTO JURIDICO 514 DE 2017",
            "image"=>"",
            "content"=>'Mediante concepto jurídico 514 la DIAN, indicó los artículos del Decreto 390 de 2016 que no fueron reglamentados entrarán a regir cuando entre en funcionamiento el sistema informático aduanero ajustado a la nueva reglamentación.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto514-2017.pdf" target="_blank">Ver Concepto</a>'
            );
        /*$data[]=array(
            "title"=>"7. CERTIFICACION 02 DE 2016",
            "image"=>"",
            "content"=>'El Departamento Administrativo Nacional de Estadística certificó los precios promedio de bebidas alcohólicas para el 2017'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Cert02-2016.pdf" target="_blank">Ver Certificación</a>'
            );
        $data[]=array(
            "title"=>"8. CONCEPTO JURIDICO 33403 DE 2016",
            "image"=>"http://www.revistazonafranca.com/wp-content/uploads/2012/08/LogoRevistaZonaFranca.png",
            "content"=>'La División de Doctrina de la DIAN aclaró que la inspección previa aplica para las operaciones de importación realizadas en zona franca.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto33403-2016.pdf" target="_blank">Ver Concepto</a>'
            );
        $data[]=array(
            "title"=>"9. CONCEPTO JURIDICO 313 DE 2017",
            "image"=>"",
            "content"=>'La DIAN explicó cuáles son los artículos del Decreto 390 de 2016 que se encuentran vigentes de acuerdo con el artículo 674 del se?alado decreto y las resoluciones reglamentarias expedidas a la fecha.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto313-2017.pdf" target="_blank">Ver Concepto</a>'            
            );
        $data[]=array(
            "title"=>"10. CONCEPTO JURIDICO 36802 DE 2017",
            "image"=>"",
            "content"=>'La DIAN mediante concepto jurídico 36802 de 2017 aclaró que los contenedores se pueden introducir al país como equipo de transporte o como mercancía.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto36802-2017.pdf" target="_blank">Ver Concepto</a>'
            );
        $data[]=array(
            "title"=>"11. PROYECTO DE DECRETO MODIFICATORIO 390",
            "image"=>"",
            "content"=>'El proyecto de decreto modificatorio del Decreto 390 fue publicado en la página de la DIAN.   Este proyecto modifica varios artículos del mencionado Decreto.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Proyecto390.pdf" target="_blank">Ver Proyecto</a>'
            );
        $data[]=array(
            "title"=>"12. SENTENCIA 2013-00187",
            "image"=>"http://conorca.com/images/petroleo/Exploracin-petrolera.jpg",
            "content"=>'Mediante Sentencia 2013-00187, el Consejo de Estado se?aló que la exención de arancel en la importación de bienes destinados a la exploración de minas o petróleo, aplica cuando se realice directamente actividades de exploración.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Sentencia2013-00187.pdf" target="_blank">Ver Sentencia</a>'
            );        
        /*$data[]=array(
            "title"=>"13. CIRCULAR 28 DE 2016",
            "image"=>"",
            "content"=>'El Ministerio de Comercio, Industria y Turismo con la circular 28 de 2016 recuerda la entrada en vigencia del reglamento técnico para jabones y detergentes establecido mediante Resolución 689 de 2016.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Circular28-2016.pdf" target="_blank">Ver Circular</a>'
            );
        $data[]=array(
            "title"=>"14. CONCEPTO JURIDICO 963 DE 2016",
            "image"=>"",
            "content"=>'La DIAN con concepto jurídico 963 de 2016 confirmó que el incumplimiento en el pago de los tributos aduaneros y sanciones en el plazo previsto genera la pérdida inmediata de las prerrogativas del UAP.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto963-2016.pdf" target="_blank">Ver Concepto</a>'
            );
        $data[]=array(
            "title"=>"15. CONCEPTO JURIDICO 23934 DE 2016",
            "image"=>"",
            "content"=>'Mediante concepto jurídico 23934 de 2016, la Oficina Jurídica de la DIAN, informa que el plazo para pagar las cuotas es el día del vencimiento del plazo, si se genera después de esta fecha generará intereses moratorios.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto23934-2016.pdf" target="_blank">Ver Concepto</a>'
            );
        /*$data[]=array(
            "title"=>"16. PROYECTO DE NORMA",
            "image"=>"",
            "content"=>'La Dirección de Impuestos y Aduanas Nacionales, expidió el proyecto de norma aplicable a Importadores que quieran obtener la autorización como Operador Económico Autorizado.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/ProyectoNormaImportadores.pdf" target="_blank">Ver Proyecto</a>'
            );
        $data[]=array(
            "title"=>"17. RESOLUCION 263 DEL 2016",
            "image"=>"https://www.logismarket.cl/ip/simma-cables-de-acero-cables-de-acero-626615-FGR.jpg",
            "content"=>'En la Resolución 263 del 2016 resolvió no revocar la resolución que impuso derechos antidumping provisionales a las importaciones de torón y cables de acero originarios de China.'            
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Res263-2016.pdf" target="_blank">Ver Resolución</a>'
            );
        
        $data[]=array(
            "title"=>"18. BOLETIN 8 DEL 2016",
            "image"=>"",
            "content"=>'El Banco de la República modifico Circular Reglamentaria Externa 83 del 2000.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Boletin8-2016.pdf" target="_blank">Ver Boletín</a>'
            );
        
        $data[]=array(
            "title"=>"19. CIRCULAR COLMAS 01 DE 2016",
            "image"=>"http://www.legiscomex.com/BancoMedios/Imagenes/exportacion-cartagena-legiscomex.int.jpg",
            "content"=>'En circular adjunto COLMAS 01 expone los principales cambios y transitorios de la Nueva Reglamentación Aduanera.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Circular01-2016.pdf" target="_blank">Ver Circular</a>'
            );
        
        $data[]=array(
            "title"=>"20. CONCEPTO 31929 DE 2015",
            "image"=>"https://claudiacao.files.wordpress.com/2011/05/3333.jpg",
            "content"=>'Mediante Concepto jurídico 31929 del 2015 la DIAN, define varios conceptos establecidos en la Resolución 62 de 2014, relacionados con Contratos de Tecnología, así como recuerda el procedimiento para su registro.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto31929.pdf" target="_blank">Ver concepto</a>'
            );
        
        $data[]=array(
            "title"=>"21. CIRCULAR 23 DE 2015",
            "image"=>"",
            "content"=>'Con Circular 23 de 2015, el Ministerio de Comercio, Industria y Turismo reitera que en las solicitudes de registro o licencia de importación, es necesario que se diligencie la casilla ?solicitud visto bueno a Entidad?, en esta casilla se deben registrar todos los vistos buenos que requiera el producto de importación, de acuerdo con lo señalado en el Decreto 925 del 2013.'
               . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Circular23-2015.pdf" target="_blank">Ver Circular</a>'
            );
        
        $data[]=array(
            "title"=>"22. CONCEPTO TECNICO 1",
            "image"=>"http://image.slidesharecdn.com/aulasvirtuales-120828171402-phpapp02/95/int-exportaciones-27-728.jpg?cb=1346174200",
            "content"=>'La División de doctrina de la DIAN, aclaró a través del Concepto Técnico 1 del 2015, que no procede el endoso del certificado de origen ni de una factura comercial que contiene declaración de origen.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Concepto1.pdf" target="_blank">Ver concepto</a>'
            );
        
        $data[]=array(
            "title"=>"23. CIRCULAR COLMAS 036",
            "image"=>"",
            "content"=>'La CIRCULAR COLMAS 036, informa sobre los requisitos que serán exigidos para el trámite ante el ANLA a partir del 2 de enero de 2016.'
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Circular036.pdf" target="_blank">Ver comunicado</a>'            
            );
        
        $data[]=array(
            "title"=>"24. COMUNICADO PRENSA INVIMA ",
            "image"=>"http://acian.com.co/wp-content/uploads/2014/02/TRAMITES-INVIMA4.png",
            "content"=>'El Comunicado de prensa INVIMA informa el cierre de término para radicar trámites ante el INVIMA. '
            . ' <a style="color:#0070c0" href="https://www.colsys.com.co/images/publicidad/colmas/201704noticolmas/Comunicado_Prensa_INVIMA.pdf" target="_blank">Ver circular</a>'
            );*/
        
        $this->data=$data;
        $this->setLayout("email");
        
    }
    
    public function executeIndexExt5(sfWebRequest $request) {

    }
    
    function executeDatosIndex($request) {
        $idopcion = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Opciones","leaf" => true,"id" => "10");
        
        $comunicaciones = Doctrine::getTable("Comunicado")
                    ->createQuery("c")
                    ->select("*, extract(year from ca_fchcreado) as ano")
                    ->orderBy("ca_fchcreado ASC")                    
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();                    
        
        $ano = array();
        if($idopcion==0) {
            foreach($comunicaciones as $com){            
                if(!in_array($com["c_ano"], $ano)){
                    $ano[] = $com["c_ano"];
                    $childrens[] = array("text" => $com["c_ano"]);
                }            
            }
            $i=0;
            foreach($comunicaciones as $com){
                foreach($childrens as $key =>$arrayChild){
                    if($arrayChild["text"]==$com["c_ano"]){                    
                        if($childrens[$key]["children"]["id"]){
                            $childrens[$key]["children"][] = array("text" => utf8_encode($com["c_ca_subject"]),"leaf" => true, "id"=>$com["c_ca_idcomunicado"]);                        
                        }else{
                            $childrens[$key]["children"][] = array("text" => utf8_encode($com["c_ca_subject"]),"leaf" => true, "id"=>$com["c_ca_idcomunicado"]);
                        }
                    }                    
                }
            }
        }
        
        //echo "<pre>";print_r($childrens);echo "</pre>"

        $tree["children"] = $childrens;
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }
    
    function executeDatosEnvios($request) {
        
        $idcom = $request->getParameter("idcom");
        
        $comunicado = Doctrine::getTable("Comunicado")->find($idcom);
        
        $q = Doctrine::getTable("Envio")
                            ->createQuery("e")
                            ->select("e.*, i.ca_nombre, cc.ca_nombres, cc.ca_papellido, em.ca_fchenvio, u.ca_nombre");
        
        if($comunicado->getCaType()=="Proveedores"){
            $q->leftJoin("e.IdsContacto cc");
            $q->leftJoin("cc.IdsSucursal s");
            $q->leftJoin("s.Ids i");
            $q->leftJoin("i.IdsProveedor p");
        }else{
            $q->leftJoin("e.Contacto cc");
            $q->leftJoin("cc.Cliente c");
            $q->leftJoin("c.Ids i");
            $q->leftJoin("c.Usuario u");
        }                            
        $q->leftJoin("e.Email em");
        $q->addWhere("e.ca_idcomunicado = ?", $idcom);
        $q->addWhere("e.ca_test = ?", false);
        $q->addOrderBy( "i.ca_nombre" );
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $debug=$q->getSqlQuery();
        
        $envios=$q->execute();
        
        foreach($envios as $k=>$c)
        {
            $envios[$k]["i_ca_nombre"]=utf8_encode($envios[$k]["i_ca_nombre"]);
            $envios[$k]["cc_ca_nombres"]=utf8_encode($envios[$k]["cc_ca_nombres"])." ".utf8_encode($envios[$k]["cc_ca_papellido"]);
            $envios[$k]["cc_ca_papellido"]=utf8_encode($envios[$k]["cc_ca_papellido"]);
            $envios[$k]["u_ca_nombre"]=utf8_encode($envios[$k]["u_ca_nombre"]);
        }
        
        $this->responseArray = array("success" => true, "root" => $envios, "total" => count($envios),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
}