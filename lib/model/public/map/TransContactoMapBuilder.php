<?php



class TransContactoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TransContactoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TransContactoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TransContactoPeer::TABLE_NAME);
		$tMap->setPhpName('TransContacto');
		$tMap->setClassname('TransContacto');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('CA_IDTRANSPORTISTA', 'CaIdtransportista', 'INTEGER', 'tb_transportistas', 'CA_IDTRANSPORTISTA', true, null);

		$tMap->addPrimaryKey('CA_IDCONTACTO', 'CaIdcontacto', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} 
} 