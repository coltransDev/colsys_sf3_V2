<?php


/**
 * This class adds structure of 'tb_trayectos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.pricing.map
 */
class TrayectoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.TrayectoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(TrayectoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrayectoPeer::TABLE_NAME);
		$tMap->setPhpName('Trayecto');
		$tMap->setClassname('Trayecto');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('OID', 'Oid', 'INTEGER', true, null);

		$tMap->addPrimaryKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'INTEGER', true, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', true, 8);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', true, 8);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'INTEGER', 'tb_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TERMINAL', 'CaTerminal', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FRECUENCIA', 'CaFrecuencia', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIEMPOTRANSITO', 'CaTiempotransito', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_IDTARIFAS', 'CaIdtarifas', 'INTEGER', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDAGENTE', 'CaIdagente', 'INTEGER', 'tb_agentes', 'CA_IDAGENTE', false, null);

		$tMap->addColumn('CA_ACTIVO', 'CaActivo', 'BOOLEAN', false, null);

	} // doBuild()

} // TrayectoMapBuilder
