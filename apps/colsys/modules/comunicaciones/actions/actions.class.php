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
        
        
        
        error_reporting(E_ALL);
        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "comunicaciones" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;

        $nreg = 120;
        
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
        
        /*$sql= "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes c
                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL
            WHERE (c.ca_colmas_std = 'Activo')  AND (c.ca_tipo  is NULL OR c.ca_tipo LIKE '%Proveedor%')
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto
            OFFSET 2000
            ";*/
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
            ORDER BY i.ca_nombre
            LIMIT $nreg OFFSET $inicio";*/
        
        
        //$st = $con->execute($sql);
        //$clientes = $st->fetchAll();
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $idComunicado = $this->getRequestParameter("idcomunicado");
        $conteo = 0;
        $emails_Control = "";
        
        $comunicado = Doctrine::getTable("Comunicado")->find($idComunicado);
        $this->forward404unless($comunicado);
        
        $asunto = $comunicado->getCaSubject();
        $emailFrom = $comunicado->getCaFrom();
        $tipo_email = $comunicado->getCaType();
        $fromName = $comunicado->getCaFromname();
        
        $mensaje_alternativo = $asunto;        
        //$mensaje_alternativo = "";
        $request->setParameter("asunto", $asunto);
        $html = sfContext::getInstance()->getController()->getPresentationFor('comunicaciones', 'emailComunicado');
        
        //if (count($clientes) > 0) {
            $data["email"] = array();
            /*foreach ($clientes as $cliente) {                
                $unsuscribe = "<div style='font-size: 9px;'>Por favor no responda a este correo, si tiene alguna inquietud o no desea recibir mas este correo electrónico por favor haga click <a href='https://www.coltrans.com.co/clientes/cancelarSuscripcion?idcontacto=".$cliente["ca_idcontacto"]."&idcliente=".$cliente["ca_idcliente"]."'>aquí</a></div>";             
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
            $email->setCaAddress("leonardo.sandoval@colmas.com.co");
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
            $email->setCaAddress("alramirez@coltrans.com.co");
            //$email->addTo("leonardo.sandoval@colmas.com.co");
            /*$email->setCaAddress("empleados-nal@coltrans.com.co");
            $email->addTo("colmasnal@colmas.com.co");
            $email->addTo("colotmnal@colotm.com");
            $email->addTo("empleados-nal@coldepositos.com.co");*/
            $email->setCaBodyhtml($html);
            $email->setCaTipo($tipo_email);
            $email->save();
            //$email->send();
        //}
        
        file_put_contents($filecontrol, $inicio + $nreg);
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
            "title"=>"1. DECRETO 343 DE 2016",
            "image"=>"http://cocinaysalud.weebly.com/uploads/2/6/4/5/26455101/3595747.jpg?353",
            "content"=>'El Ministerio de Comercio Industria y Turismo, estableció un arancel de 0% a la importación de frijol, lenteja, ajo y aceites de palma y soya.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Dec343-2016.pdf" target="_blank">Ver Decreto</a>'
            );
        
        $data[]=array(
            "title"=>"2. DECRETO 459 DE 2016",
            "image"=>"",
            "content"=>'Mediante Decreto 459 de 2016 se modifica el arancel de aduanas.'
                . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Dec459-2016.pdf" target="_blank">Ver Decreto</a>'
            );
        
        $data[]=array(
            "title"=>"3. DECRETO 515 DE 2016",
            "image"=>"http://www.larepublica.co/sites/default/files/larepublica/styles/img_interna/public/imagenes/noticias/1/importaciones1128-1000.jpg?itok=zHIV_x2q",
            "content"=>'Con Decreto 515 de 2016 el Ministerio de Comercio, Industria y Turismo prorrogó hasta el 30 de julio de 2016 la aplicación de aranceles mixtos aplicables a la importación de calzado y textiles.'
            .'<a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Dec515-2016.pdf" target="_blank">Ver Decreto</a>'
            );
        
        $data[]=array(
            "title"=>"4. RESOLUCIÓN 000043 DE 2016",
            "image"=>"",
            "content"=>'El Ministerio de Agricultura con resolución 000043 del 2016, reglamentó los contingentes de importación de alimento para perros y gatos, para el séptimo año en el TLC entre Colombia y El Salvador, Guatemala y Honduras.'
                .'<a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Res000043-2016.pdf" target="_blank">Ver Resolución</a>'
            );
        
        $data[]=array(
            "title"=>"5. RESOLUCION 000044 DE 2016",
            "image"=>"https://isisurdesa.files.wordpress.com/2012/03/26-250x2501.jpg",
            "content"=>'El Ministerio de Agricultura con resolución 000044 del 2016, reglamentó los contingentes de importación de alcohol etílico sin desnaturalizar, para el séptimo año en el TLC entre Colombia y El Salvador, Guatemala y Honduras.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Res000044-2016.pdf" target="_blank">Ver Resolución</a>'
            );
        
        $data[]=array(
            "title"=>"6. RESOLUCION 000045 DE 2016",
            "image"=>"",
            "content"=>'El Ministerio de Agricultura con resolución 000045 del 2016, reglamentó los contingentes de importación de quesos originarios de la Confederación Suiza y el Principado de Liechenstein, para el 2016.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Res000045-2016.pdf" target="_blank">Ver Resolución</a>'
            );
        $data[]=array(
            "title"=>"7. CONCEPTO 82 de 2016",
            "image"=>"http://carnetcarretillero.info/wp-content/uploads/2014/06/Obligacion1.jpg",
            "content"=>'La DIAN mediante concepto 82 de 2016, confirmó que a pesar de ser el castellano el idioma oficial para adelantar procesos, y la obligación de aportar información en el idioma oficial es del sujeto requerido, so pena de incurrir en infracción aduanera, en casos excepcionales se pueden evaluar documentos en inglés.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Concepto82-2016.pdf" target="_blank">Ver Concepto</a>'
            );
        $data[]=array(
            "title"=>"8. CONCEPTO 1992 DE 2016",
            "image"=>"",
            "content"=>'La DIAN en el Concepto jurídico 1992 DEL 2016 indicó las consecuencias aduaneras, cambiarias y tributarias del abandono legal de mercancías.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Concepto1992-2016.pdf" target="_blank">Ver Concepto</a>'
            );
        $data[]=array(
            "title"=>"9. CONCEPTO 2059 DE 2016",
            "image"=>"http://www.escueladelenguas.unlp.edu.ar/informacion-general/E9321C7F263ECB83181AC57FA4092098.jpg/image_preview",
            "content"=>'Mediante Concepto Jurídico 2059 de 2016 la DIAN confirma que no se aceptan los pagos de cuotas cancelados con anticipación, los pagos deben efectuarse el primer día hábil siguiente del semestre vencido.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Concepto2059-2016.pdf" target="_blank">Ver Concepto</a>'            
            );
        $data[]=array(
            "title"=>"10. CONCEPTO 3150 DE 2016",
            "image"=>"",
            "content"=>'El Concepto Jurídico 3150 del 2016 la DIAN aclara los efectos en materia de renta, IVA y régimen cambiario de una operación de triangulación por comercialización de bienes desde y en el exterior.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Concepto3150-2016.pdf" target="_blank">Ver Concepto</a>'
            );
        $data[]=array(
            "title"=>"11. CONCEPTO 4097 DE 2016",
            "image"=>"http://granadosasesores.com/images/juridico.jpg",
            "content"=>'La DIAN mediante Concepto jurídico 4097 del 2016, señala que con la declaración de legalización se inicia un nuevo trámite en el cual se puede controvertir el valor de las mercancías declaradas, no aplica la firmeza de la declaración de la inicial.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Concepto4097-2016.pdf" target="_blank">Ver Concepto</a>'
            );
        $data[]=array(
            "title"=>"12. COMUNICADO DE PRENSA CANCILLERIA",
            "image"=>"",
            "content"=>'El Comunicado de Prensa de la Cancillería señaló que la Alianza del Pacífico los países miembros (Chile, Colombia, México y Perú), entrará en vigor el 1º de mayo de 2016.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/ComunicadoCancilleria.pdf" target="_blank">Ver Comunicado</a>'
            );
        
        $data[]=array(
            "title"=>"13. CIRCULAR 000003 DE 2016",
            "image"=>"http://www.fedebiocombustibles.com/files/Editorial%2810%29.jpg",
            "content"=>'Con la Circular 000003 del 2016 la DIAN aclaró la entrada en vigencia del Decreto 390 de 2016 (Nueva Reglamentación Aduanera).'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Circular000003-2016.pdf" target="_blank">Ver Circular</a>'
            );
        /*$data[]=array(
            "title"=>"14. CONCEPTO 37128 DEL 2015",
            "image"=>"",
            "content"=>'Con concepto Jurídico 37128 del 2015 la DIAN precisó que la importación de mercancías que fueron objeto de reexportación en los términos del artículo 149 del Decreto 2685 de 1999, no exige la presentación de la declaración de importación en la misma jurisdicción aduanera por la que se haya efectuado la exportación de la mercancía.'            
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Concepto37128-2015.pdf" target="_blank">Ver Concepto</a>'
            );
        $data[]=array(
            "title"=>"15. RESOLUCION 40122 DEL 2016",
            "image"=>"http://politika.com.co/wp-content/uploads/2015/10/minminas.jpg",
            "content"=>'Minminas con Resolución 40122 del 2016 adicionó y modificó el reglamento técnico de iluminación y alumbrado público (RETILAP).'            
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Res40122-2016.pdf" target="_blank">Ver Resolución</a>'
            );
        $data[]=array(
            "title"=>"16. RESOLUCION 1828 DE 2016 DE LA CAN",
            "image"=>"",
            "content"=>'La CAN con Resolución 1828 del 2016 modificó el anexo de la Decisión 571 sobre Valor en Aduana de las Mercancías Importadas.'            
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Res1828-2016.pdf" target="_blank">Ver Resolución</a>'
            );
        $data[]=array(
            "title"=>"17. RESOLUCION 263 DEL 2016",
            "image"=>"https://www.logismarket.cl/ip/simma-cables-de-acero-cables-de-acero-626615-FGR.jpg",
            "content"=>'En la Resolución 263 del 2016 resolvió no revocar la resolución que impuso derechos antidumping provisionales a las importaciones de torón y cables de acero originarios de China.'            
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Res263-2016.pdf" target="_blank">Ver Resolución</a>'
            );
        
        $data[]=array(
            "title"=>"18. BOLETIN 8 DEL 2016",
            "image"=>"",
            "content"=>'El Banco de la República modifico Circular Reglamentaria Externa 83 del 2000.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Boletin8-2016.pdf" target="_blank">Ver Boletín</a>'
            );
        
        $data[]=array(
            "title"=>"19. CIRCULAR COLMAS 01 DE 2016",
            "image"=>"http://www.legiscomex.com/BancoMedios/Imagenes/exportacion-cartagena-legiscomex.int.jpg",
            "content"=>'En circular adjunto COLMAS 01 expone los principales cambios y transitorios de la Nueva Reglamentación Aduanera.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Circular01-2016.pdf" target="_blank">Ver Circular</a>'
            );
        /*
        $data[]=array(
            "title"=>"20. CONCEPTO 31929 DE 2015",
            "image"=>"https://claudiacao.files.wordpress.com/2011/05/3333.jpg",
            "content"=>'Mediante Concepto jurídico 31929 del 2015 la DIAN, define varios conceptos establecidos en la Resolución 62 de 2014, relacionados con Contratos de Tecnología, así como recuerda el procedimiento para su registro.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Concepto31929.pdf" target="_blank">Ver concepto</a>'
            );
        
        $data[]=array(
            "title"=>"21. CIRCULAR 23 DE 2015",
            "image"=>"",
            "content"=>'Con Circular 23 de 2015, el Ministerio de Comercio, Industria y Turismo reitera que en las solicitudes de registro o licencia de importación, es necesario que se diligencie la casilla ?solicitud visto bueno a Entidad?, en esta casilla se deben registrar todos los vistos buenos que requiera el producto de importación, de acuerdo con lo señalado en el Decreto 925 del 2013.'
               . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Circular23-2015.pdf" target="_blank">Ver Circular</a>'
            );
        
        $data[]=array(
            "title"=>"22. CONCEPTO TECNICO 1",
            "image"=>"http://image.slidesharecdn.com/aulasvirtuales-120828171402-phpapp02/95/int-exportaciones-27-728.jpg?cb=1346174200",
            "content"=>'La División de doctrina de la DIAN, aclaró a través del Concepto Técnico 1 del 2015, que no procede el endoso del certificado de origen ni de una factura comercial que contiene declaración de origen.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Concepto1.pdf" target="_blank">Ver concepto</a>'
            );
        
        $data[]=array(
            "title"=>"23. CIRCULAR COLMAS 036",
            "image"=>"",
            "content"=>'La CIRCULAR COLMAS 036, informa sobre los requisitos que serán exigidos para el trámite ante el ANLA a partir del 2 de enero de 2016.'
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Circular036.pdf" target="_blank">Ver comunicado</a>'            
            );
        
        $data[]=array(
            "title"=>"24. COMUNICADO PRENSA INVIMA ",
            "image"=>"http://acian.com.co/wp-content/uploads/2014/02/TRAMITES-INVIMA4.png",
            "content"=>'El Comunicado de prensa INVIMA informa el cierre de término para radicar trámites ante el INVIMA. '
            . ' <a style="color:#0070c0" href="https://www.coltrans.com.co/images/publicidad/colmas/201604noticolmas/Comunicado_Prensa_INVIMA.pdf" target="_blank">Ver circular</a>'
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

        $tree["children"] = $childrens;
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }
    
    function executeDatosEnvios($request) {
        
        $idcom = $request->getParameter("idcom");
        
        $q = Doctrine::getTable("Envio")
                            ->createQuery("e")
                            ->select("e.*, i.ca_nombre, cc.ca_nombres, cc.ca_papellido, em.ca_fchenvio, u.ca_nombre")
                            ->leftJoin("e.Contacto cc")
                            ->leftJoin("cc.Cliente c")
                            ->leftJoin("c.Ids i")
                            ->leftJoin("e.Email em")
                            ->leftJoin("c.Usuario u")
                            ->addWhere("e.ca_idcomunicado = ?", $idcom)
                            ->addWhere("e.ca_test = ?", false)
                            ->addOrderBy( "i.ca_nombre" )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

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