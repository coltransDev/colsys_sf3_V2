<?php

/**
 * CotProducto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class CotProducto extends BaseCotProducto
{
    /*
	* Convierte automaticamente este objeto a string
	* Author: Andres Botero
	*/
	public function __toString(){
		$trayecto = "";
		$origen = $this->getOrigen();
		$destino = $this->getDestino();
		$escala = $this->getEscala();

		$linea = $this->getTransportador();

		if( $linea ){
			$lineaStr = $linea->getIds()->getCaNombre();
		}else{
			$lineaStr = "";
		}

		$trayecto = $this->getCaImpoexpo()." ".$this->getCaTransporte()." ".$this->getCaModalidad()." [".$origen->getCaCiudad()." - ".$origen->getTrafico()->getCaNombre()." � ";


		if( $escala ){
			$trayecto .= $escala->getCaCiudad()." - ".$escala->getTrafico()->getCaNombre()." � ";
		}

		$trayecto .= $destino->getCaCiudad()." - ".$destino->getTrafico()->getCaNombre()."]  ".$lineaStr." ".$this->getCaIdproducto();
		return $trayecto;
	}

	/*
	* Retorna el id del objeto
	* Author: Andres Botero
	*/
	public function getId(){
		return $this->getCaIdProducto();
	}
	/*
	* Retorna el objeto ciudad asociado al campo ca_origen
	* Author: Andres Botero
	*/
	public function getOrigen(){		
		return Doctrine::getTable("Ciudad")->find($this->getCaOrigen());
	}

	/*
	* Retorna el objeto ciudad asociado al campo ca_destino
	* Author: Andres Botero
	*/
	public function getDestino(){
        return Doctrine::getTable("Ciudad")->find($this->getCaDestino());
	}

	/*
	* Retorna el objeto ciudad asociado al campo ca_escala
	* Author: Andres Botero
	*/
	public function getEscala(){
        return Doctrine::getTable("Ciudad")->find($this->getCaEscala());
	}

    /*
	* Retorna el objeto IdsProveedor asociado al campo ca_idlinea
	* Author: Andres Botero
	*/
    public function getTransportador(){
        return Doctrine::getTable("IdsProveedor")->find($this->getCaIdlinea());
    }
	/*
	*alias para getCotOpciones
	* Author: Andres Botero
	*/
	public function getCotOpciones(  ){
		return Doctrine::getTable("CotOpcion")
                        ->createQuery("o")
                        ->innerJoin("o.Concepto c")
                        ->where("o.ca_idcotizacion = ? ", $this->getCaIdcotizacion() )
                        ->addWhere("o.ca_idproducto = ? ", $this->getCaIdproducto() )
                        ->addOrderBy("o.ca_idequipo ASC")
                        ->addOrderBy("c.ca_liminferior ASC")
                        ->addOrderBy("c.ca_concepto")
                        ->execute();
	}

	/*
	* Retorna los recargos en origen generales del producto en una cadena de texto para facilitar la impresi�n
	*/
	public function getTextoRecargosGenerales(){
		$recargos = $this->getRecargosGenerales();
		$textoRecargos = '';
		foreach( $recargos as $recargo ){
			$tipoRecargo = $recargo->getTipoRecargo();
			$textoRecargos.= $recargo->getTextoRecargo()."\n";

		}
		return $textoRecargos;
	}
	/*
	* Retorna los recargos en origen generales del producto
	*/
	public function getRecargosGenerales(){
		
            
         $q=Doctrine::getTable("CotRecargo")
               ->createQuery("r")
               ->select("r.*")
               ->where("ca_idcotizacion= ? and r.ca_idproducto = ? AND ca_idopcion = '999'",array($this->getCaIdcotizacion(),$this->getCaIdproducto()) )
               ->distinct();
         
            return $q->execute();
	}

	/*
	* Retorna los seguimientos de la cotizaci�n
	*/
	public function getSeguimientos(){		
		return  Doctrine::getTable("CotSeguimiento")
                          ->createQuery("s")
                          ->where("s.ca_idproducto = ?", array($this->getCaIdproducto()))
                          ->addOrderBy("s.ca_fchseguimiento DESC")
                          ->execute();
	}

	/*
	* Retorna los seguimientos de la cotizaci�n
	*/
	public function getUltSeguimiento(){		

        return  Doctrine::getTable("CotSeguimiento")
                          ->createQuery("s")
                          ->where("s.ca_idproducto = ?", array( $this->getCaIdproducto()))
                          ->addOrderBy("s.ca_fchseguimiento DESC")
                          ->limit(1)
                          ->fetchOne();
	}

	/*
	*
	*/
	public function getEtapa(){
		$parametro = ParametroTable::retrieveByCaso("CU074", $this->getCaEtapa() );

		if( $parametro ){
			return $parametro[0]->getCaValor2();
		}
	}
	
}