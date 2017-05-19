<?php

/**
 * subastas actions.
 *
 * @package    symfony
 * @subpackage subastas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class subastasActions extends sfActions {
    
    const RUTINA = 108;

    public function getNivel() {

        $rutina = self::RUTINA;

        $this->nivel = $this->getUser()->getNivelAcceso($rutina);
        if (!$this->nivel) {
            $this->nivel = 0;
        }

        

        return $this->nivel;
    }
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $this->articulos = Doctrine::getTable("SubArticulo")
                ->createQuery("a") 
                ->leftJoin("a.Sucursal s")
                ->addWhere("a.ca_usucomprador IS NULL")
                ->addWhere("a.ca_fchvencimiento >= ? ", date("Y-m-d H:i:s"))
                ->andWhereIn("a.ca_idempresa",$grupoEmp)                     
                ->addOrderBy("a.ca_fchcreado DESC")
                ->execute();
        
        
        $this->articulosVendidos = Doctrine::getTable("SubArticulo")
                ->createQuery("a") 
                ->addWhere("a.ca_usucomprador IS NOT NULL")
                ->addWhere("a.ca_usucreado = ? ", $this->getUser()->getuserId())
                ->addOrderBy("a.ca_fchcreado DESC")
                //->limit(15)
                ->execute();
        
        $this->articulosSinOfertas = Doctrine::getTable("SubArticulo")
                ->createQuery("a") 
                ->addWhere("a.ca_usucomprador IS NULL")
                ->addWhere("a.ca_usucreado = ? ", $this->getUser()->getuserId())
                ->addWhere("a.ca_fchvencimiento < ? ", date("Y-m-d H:i:s"))
                ->addOrderBy("a.ca_fchcreado DESC")
                ->limit(15)
                ->execute();
        
        $this->nivel = $this->getNivel();
        $this->user = $this->getUser();
        
    }
    
    
    /**
     * Formulario para ingresar un nuevo articulo
     *
     * @param sfRequest $request A request object
     */
    public function executeFormArticulo(sfWebRequest $request) {        
                
        if( $request->getParameter("idarticulo") ){
            $articulo = Doctrine::getTable("SubArticulo")->find( $request->getParameter("idarticulo"));
            $this->forward404Unless( $articulo );
        }else{
            $articulo = new SubArticulo();   
            
            $nivel = $this->getNivel();
            $this->forward404Unless($nivel>=1 );
        }
        
        if( $articulo->getCaUsucomprador() ){
            $this->articulo=$articulo;
            return sfView::ERROR;
        }
        
        $this->form = new ArticuloForm();
        
        
        if ($request->isMethod('post')){	            
            $bindValues = array();
            $bindValues["idarticulo"] = $request->getParameter("idarticulo");
            $bindValues["titulo"] = $request->getParameter("titulo");
            $bindValues["descripcion"] = $request->getParameter("descripcion");
            $bindValues["idsucursal"] = $request->getParameter("idsucursal");
            $bindValues["fchinicio"] = $request->getParameter("fchinicio");
            $bindValues["horainicio"] = $request->getParameter("horainicio");
            $bindValues["fchvencimiento"] = $request->getParameter("fchvencimiento");
            $bindValues["horavencimiento"] = $request->getParameter("horavencimiento");
            $bindValues["valor"] = $request->getParameter("valor");
            $bindValues["incremento"] = $request->getParameter("incremento");
            $bindValues["formapago"] = $request->getParameter("formapago");
            $bindValues["directa"] = $request->getParameter("directa");
            $bindValues["tope"] = $request->getParameter("tope");            
            $this->form->bind( $bindValues ); 
			if( $this->form->isValid() ){					
				
                $articulo->setCaTitulo( $bindValues["titulo"] );
                $articulo->setCaDescripcion( $bindValues["descripcion"] );
                
                if( $bindValues["fchinicio"] ){                    
                    $horainicio =  $request->getParameter("horainicio");
                    if( !$horainicio['minute'] ){
                        $horainicio['minute']='00';
                    }

                    $horainicio['hour']=str_pad($horainicio['hour'],2, "0", STR_PAD_LEFT );
                    $horainicio['minute']=str_pad($horainicio['minute'],2, "0", STR_PAD_LEFT );
                    $horainicio = implode(":", $horainicio );
                    $articulo->setCaFchinicio( Utils::parseDate($request->getParameter("fchinicio"), "Y-m-d")." ".$horainicio );
                }
                
                if( $bindValues["fchvencimiento"] ){
                    
                    $horavencimiento =  $request->getParameter("horavencimiento");
                    if( !$horavencimiento['minute'] ){
                        $horavencimiento['minute']='00';
                    }

                    $horavencimiento['hour']=str_pad($horavencimiento['hour'],2, "0", STR_PAD_LEFT );
                    $horavencimiento['minute']=str_pad($horavencimiento['minute'],2, "0", STR_PAD_LEFT );
                    $horavencimiento = implode(":", $horavencimiento );
                    $articulo->setCaFchvencimiento( Utils::parseDate($request->getParameter("fchvencimiento"), "Y-m-d")." ".$horavencimiento );
                }                
               
                $articulo->setCaValor( $bindValues["valor"] );
                if( $bindValues["incremento"] ){
                    $articulo->setCaIncremento( $bindValues["incremento"] );
                }
                
                if( $bindValues["tope"] ){
                    $articulo->setCaTope( $bindValues["tope"] );
                }
                $articulo->setCaFormapago( $bindValues["formapago"] );
                $articulo->setCaDirecta( $bindValues["directa"]=="1" );
                $articulo->setCaIdsucursal( $request->getParameter("idsucursal")?$request->getParameter("idsucursal"):null );
                $articulo->setCaIdempresa($this->getUser()->getIdempresa() );
                $articulo->save();
                
                $this->redirect("subastas/verArticulo?idarticulo=".$articulo->getCaIdarticulo());                
			}	
        }
        $this->articulo=$articulo;
        
    }
    
    
    /**
     * Muestra los detalles de un articulo.
     *
     * @param sfRequest $request A request object
     */
    public function executeVerArticulo(sfWebRequest $request) {
        
               
        $this->forward404Unless( $request->getParameter("idarticulo") );
        $this->articulo = Doctrine::getTable("SubArticulo")->find( $request->getParameter("idarticulo"));
        $this->forward404Unless( $this->articulo );
        
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("jquery.min.js", 'last');
        $response->addStylesheet("slideshow.css", 'last');
        
        $this->folder = "Subastas".DIRECTORY_SEPARATOR.$this->articulo->getCaIdarticulo();
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$this->folder;         
        $this->archivos = sfFinder::type('file')->maxDepth(0)->in($directory);        
        
        $this->user = $this->getUser();
        
        
    }
    
    /**
     * Muestra los detalles de un articulo por correo.
     *
     * @param sfRequest $request A request object
     */
    public function executeVerArticuloEmail(sfWebRequest $request) {
        $this->forward404Unless( $request->getParameter("idarticulo") );
        $this->articulo = Doctrine::getTable("SubArticulo")->find( $request->getParameter("idarticulo"));
        $this->forward404Unless( $this->articulo );        
     
        $this->mensaje = $request->getParameter("mensaje");
       
        $this->setLayout("email");
    }
    
    
    
    
    /**
     * Permite agregar las fotos del articulo
     *
     * @param sfRequest $request A request object
     */
    public function executeFormImagenes(sfWebRequest $request) {
        $this->forward404Unless( $request->getParameter("idarticulo") );
        $this->articulo = Doctrine::getTable("SubArticulo")->find( $request->getParameter("idarticulo"));
        $this->forward404Unless( $this->articulo );
        
        if( $this->articulo->getCaUsucomprador() ){           
            return sfView::ERROR;
        }
    }
    
    /**
     * Permite agregar las fotos del articulo
     *
     * @param sfRequest $request A request object
     */
    public function executeRealizarOferta(sfWebRequest $request) {
        $this->forward404Unless( $request->getParameter("idarticulo") );
        $articulo = Doctrine::getTable("SubArticulo")->find( $request->getParameter("idarticulo"));
        $this->forward404Unless( $articulo );
        
       
        if( $articulo->getCaUsucomprador() || $articulo->getCaFchvencimiento()<date("Y-m-d") ){
            return sfView::ERROR;
        }
        
        $conn = Doctrine::getTable("SubArticulo")->getConnection();
        $conn->beginTransaction();
        
        if( $articulo->getCaDirecta() ){
            $articulo->setCaValorventa( $articulo->getCaValor() );
            $articulo->setCaUsucomprador( $this->getUser()->getUserId() );
            $articulo->save( $conn );
            $mensaje = "Felicitaciones, usted ha adquirido este articulo.";     
            $articulo->notifyUser( $this->getUser()->getUserId() , 'Usted ha ganado una subasta' ,$mensaje, $conn );          
                                   
        }else{                      
            $valor = Doctrine::getTable("SubOferta")
                    ->createQuery("o")
                    ->select("MAX(ca_valor)") 
                    ->addWhere("o.ca_idarticulo = ? ", $articulo->getCaIdarticulo())
                    ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                    ->execute();   
            
            if( !$valor ){
                $valorOferta = $articulo->getCaValor();
            }else{
                $valorOferta = $valor+$articulo->getCaIncremento();                
            }
            
            if( $valorOferta>=$articulo->getCaTope() ){
                $valorOferta = $articulo->getCaTope();
                $articulo->setCaValorventa( $valorOferta );
                $articulo->setCaUsucomprador( $this->getUser()->getUserId() );
                $articulo->save( $conn );
                
                $mensaje = "Felicitaciones, usted ha adquirido este articulo.";         
                $articulo->notifyUser( $this->getUser()->getUserId() , $mensaje, 'Oferta Subasta', $conn );          
                
            }
            
            
            $oferta = new SubOferta();           
            
            $oferta->setCaIdarticulo( $articulo->getCaIdarticulo() );
            $oferta->setCaValor( $valorOferta );
            $oferta->save( $conn );
                        
            $ofertas = Doctrine::getTable("SubOferta")
                    ->createQuery("o") 
                    ->select("ca_usucreado")
                    ->addWhere("o.ca_idarticulo = ? ", $articulo->getCaIdarticulo())
                    ->distinct()
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)                                       
                    ->execute(); 
            
            foreach( $ofertas as $usuoferta ){
                
                if( $usuoferta["o_ca_usucreado"]!=$this->getUser()->getUserId() ){
                    
                    $asunto = 'Alguien hizo una oferta mayor a la suya.'; 
                    $mensaje = "Se ha creado una oferta mayor a la suya, alguien ofertó ".Utils::formatNumber($valorOferta);                                       
                    
                    $articulo->notifyUser( $usuoferta["o_ca_usucreado"] , $mensaje, $asunto, $conn ); 
                }
            }
            
            
            $this->nuevoValor = $valor+$articulo->getCaIncremento()*2;
            
        }
        
        $conn->commit(); 
        
        $this->articulo = $articulo;        
    }  
    
    
    /*
     * Se ejecuta en un crontab y cierra las subastas de un articulo cuando se vence. 
     */
    
    public function executeCerrarSubastas(sfWebRequest $request) {
        
        $conn = Doctrine::getTable("SubArticulo")->getConnection();
        $conn->beginTransaction();
        
        $articulos = Doctrine::getTable("SubArticulo")
                        ->createQuery("a")
                        ->addWhere("a.ca_directa = ?", false)
                        ->addWhere("a.ca_fchvencimiento <= ?", date("Y-m-d H:i:s") )
                        ->addWhere("a.ca_usucomprador IS NULL")
                        ->execute();

        foreach ($articulos as $articulo ) {
            $oferta = Doctrine::getTable("SubOferta")
                    ->createQuery("o")                               
                    ->addWhere("o.ca_idarticulo = ? ", $articulo->getCaIdarticulo())
                    ->addOrderBy("o.ca_fchcreado DESC")
                    ->limit(1)
                    ->fetchOne();
            
            
            if( $oferta ){
                $articulo->setCaUsucomprador( $oferta->getCaUsucreado() );
                $articulo->setCaValorventa( $oferta->getCaValor() );
                $articulo->save( $conn );
                
                $mensaje = "El articulo en referencia ha sido vendido!";                 
                $articulo->notifyUser( $articulo->getCaUsucreado(), $mensaje, $mensaje, $conn ); 
                                
                $mensaje = "Felicitaciones usted ha adquirido este articulo!";            
                $articulo->notifyUser( $articulo->getCaUsucomprador(), $mensaje, $mensaje, $conn );                 
                            
            }else{           
                if( !$articulo->getCaFchnotificacion() ){
                    $mensaje = "El articulo en referencia finalizó sin ninguna oferta!";        
                    $articulo->notifyUser( $articulo->getCaUsucreado(), $mensaje, $mensaje, $conn );     
                    $articulo->setCaFchnotificacion( date("Y-m-d H:i:s") );
                    $articulo->save( $conn );
                }
            }            
        }
        $conn->commit();
        
        return sfView::NONE;
    }
}