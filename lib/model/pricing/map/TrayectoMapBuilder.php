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
class TrayectoMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_trayectos');
		$tMap->setPhpName('Trayecto');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('OID', 'Oid', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addPrimaryKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, true, 8);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, true, 8);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'int', CreoleTypes::INTEGER, 'tb_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_TERMINAL', 'CaTerminal', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FRECUENCIA', 'CaFrecuencia', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TIEMPOTRANSITO', 'CaTiempotransito', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_IDTARIFAS', 'CaIdtarifas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDAGENTE', 'CaIdagente', 'int', CreoleTypes::INTEGER, 'tb_agentes', 'CA_IDAGENTE', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'string', CreoleTypes::VARCHAR, false, 3);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // TrayectoMapBuilder
