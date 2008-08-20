<?php


	
class UsuariosMapBuilder {

	
	const CLASS_NAME = 'lib.model.control.map.UsuariosMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('control.tb_usuarios');
		$tMap->setPhpName('Usuarios');

		$tMap->setUseIdGenerator(true);
 
		$tMap->setPrimaryKeyMethodInfo('control.tb_usuarios_SEQ');

		$tMap->addPrimaryKey('CA_LOGIN', 'CaLogin', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SUCURSAL', 'CaSucursal', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_RUTINAS', 'CaRutinas', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EXTENSION', 'CaExtension', 'string', CreoleTypes::VARCHAR, false, null);
				
    } 
} 