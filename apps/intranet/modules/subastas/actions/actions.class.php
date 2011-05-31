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

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->articulos = Doctrine::getTable("SubArticulo")
                     ->createQuery("a") 
                     ->execute();
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
        }
        
        
        $this->form = new ArticuloForm();
        
        
        if ($request->isMethod('post')){	            
            $bindValues = array();
            $bindValues["idarticulo"] = $request->getParameter("idarticulo");
            $bindValues["titulo"] = $request->getParameter("titulo");
            $bindValues["descripcion"] = $request->getParameter("descripcion");
            $bindValues["fchvencimiento"] = $request->getParameter("fchvencimiento");
            $bindValues["valor"] = $request->getParameter("valor");
            $bindValues["incremento"] = $request->getParameter("incremento");
            $bindValues["formapago"] = $request->getParameter("formapago");
            $bindValues["directa"] = $request->getParameter("directa");
            $this->form->bind( $bindValues ); 
			if( $this->form->isValid() ){					
				
                $articulo->setCaTitulo( $bindValues["titulo"] );
                $articulo->setCaDescripcion( $bindValues["descripcion"] );
                $articulo->setCaFchvencimiento( $bindValues["fchvencimiento"] );
                $articulo->setCaValor( $bindValues["valor"] );
                $articulo->setCaIncremento( $bindValues["incremento"] );
                $articulo->setCaFormapago( $bindValues["formapago"] );
                $articulo->setCaDirecta( $bindValues["directa"] );
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
        
        if( $articulo->getCaDirecta() ){
            $articulo->setCaValorventa( $articulo->getCaValor() );
            $articulo->setCaUsucomprador( $this->getUser()->getUserId() );
            $articulo->save();
           
            
        }else{                      
            $valor = Doctrine::getTable("SubOferta")
                               ->createQuery("o")
                               ->select("MAX(ca_valor)") 
                               ->addWhere("o.ca_idarticulo = ? ", $articulo->getCaIdarticulo())
                               ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                               ->execute();        
            $oferta = new SubOferta();
            $valorOferta = $valor+$articulo->getCaIncremento();
            $articulo->setCaValorventa( $valorOferta );
            $oferta->setCaIdarticulo( $articulo->getCaIdarticulo() );
            $oferta->setCaValor( $valorOferta );
            $oferta->save();
            
            $this->nuevoValor = $valor+$articulo->getCaIncremento()*2;
            
        }
        
        $this->articulo = $articulo;
        
        
        
        
        
        
    }  
    

}
