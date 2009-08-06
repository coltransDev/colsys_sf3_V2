<?php



class TrackingUserMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TrackingUserMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TrackingUserPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrackingUserPeer::TABLE_NAME);
		$tMap->setPhpName('TrackingUser');
		$tMap->setClassname('TrackingUser');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_EMAIL', 'CaEmail', 'VARCHAR', true, null);

		$tMap->addColumn('CA_BLOCKED', 'CaBlocked', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_ACTIVATION_CODE', 'CaActivationCode', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PASSWD', 'CaPasswd', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PASSWORD_EXPIRY', 'CaPasswordExpiry', 'DATE', false, null);

		$tMap->addColumn('CA_ACTIVATED', 'CaActivated', 'BOOLEAN', false, null);

		$tMap->addForeignKey('CA_IDCONTACTO', 'CaIdcontacto', 'INTEGER', 'tb_concliente', 'CA_IDCONTACTO', false, null);

	} 
} 