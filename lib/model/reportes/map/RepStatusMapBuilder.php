<?php


/**
 * This class adds structure of 'tb_repstatus' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.reportes.map
 */
class RepStatusMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepStatusMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(RepStatusPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepStatusPeer::TABLE_NAME);
		$tMap->setPhpName('RepStatus');
		$tMap->setClassname('RepStatus');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER' , 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignPrimaryKey('CA_IDEMAIL', 'CaIdemail', 'INTEGER' , 'tb_emails', 'CA_IDEMAIL', true, null);

		$tMap->addColumn('CA_FCHSTATUS', 'CaFchstatus', 'DATE', false, null);

		$tMap->addColumn('CA_STATUS', 'CaStatus', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COMENTARIOS', 'CaComentarios', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHRECIBO', 'CaFchrecibo', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_FCHENVIO', 'CaFchenvio', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUENVIO', 'CaUsuenvio', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INTRODUCCION', 'CaIntroduccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHSALIDA', 'CaFchsalida', 'DATE', false, null);

		$tMap->addColumn('CA_FCHLLEGADA', 'CaFchllegada', 'DATE', false, null);

		$tMap->addColumn('CA_FCHCONTINUACION', 'CaFchcontinuacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VOLUMEN', 'CaVolumen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DOCTRANSPORTE', 'CaDoctransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDNAVE', 'CaIdnave', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DOCMASTER', 'CaDocmaster', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHRESERVA', 'CaFchreserva', 'DATE', false, null);

		$tMap->addColumn('CA_FCHCIERRERESERVA', 'CaFchcierrereserva', 'DATE', false, null);

		$tMap->addColumn('CA_EQUIPOS', 'CaEquipos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_HORASALIDA', 'CaHorasalida', 'TIME', false, null);

		$tMap->addColumn('CA_HORALLEGADA', 'CaHorallegada', 'TIME', false, null);

	} // doBuild()

} // RepStatusMapBuilder
