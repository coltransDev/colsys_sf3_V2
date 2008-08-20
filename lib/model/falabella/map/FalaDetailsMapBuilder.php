<?php


	
class FalaDetailsMapBuilder {

	
	const CLASS_NAME = 'lib.model.falabella.map.FalaDetailsMapBuilder';	

    
    private $dbMap;

	
    public function isBuilt()
    {
        return ($this->dbMap !== null);
    }

	
    public function getDatabaseMap()
    {
        return $this->dbMap;
    }

    
    public function doBuild()
    {
		$this->dbMap = Propel::getDatabaseMap('propel');
		
		$tMap = $this->dbMap->addTable('tb_faladetails');
		$tMap->setPhpName('FalaDetails');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDDOC', 'CaIddoc', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addPrimaryKey('CA_SKU', 'CaSku', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addPrimaryKey('CA_VPN', 'CaVpn', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_CANTIDAD_MILES', 'CaCantidadMiles', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('CA_UNIDAD_MEDIDAD_CANTIDAD', 'CaUnidadMedidadCantidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESCRIPCION_ITEM', 'CaDescripcionItem', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CANTIDAD_PAQUETES_MILES', 'CaCantidadPaquetesMiles', 'double', CreoleTypes::NUMERIC, false);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_PAQUETES', 'CaUnidadMedidaPaquetes', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CANTIDAD_VOLUMEN_MILES', 'CaCantidadVolumenMiles', 'double', CreoleTypes::NUMERIC, false);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_VOLUMEN', 'CaUnidadMedidaVolumen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CANTIDAD_PESO_MILES', 'CaCantidadPesoMiles', 'double', CreoleTypes::NUMERIC, false);

		$tMap->addColumn('CA_UNIDAD_MEDIDA_VOLUMEN', 'CaUnidadMedidaVolumen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_POSICION_PACK_CONTAINER', 'CaPosicionPackContainer', 'string', CreoleTypes::VARCHAR, false, null);
				
    } 
} 