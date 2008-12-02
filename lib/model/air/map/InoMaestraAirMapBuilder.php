<?php


/**
 * This class adds structure of 'tb_inomaestra_air' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.air.map
 */
class InoMaestraAirMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.air.map.InoMaestraAirMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_inomaestra_air');
		$tMap->setPhpName('InoMaestraAir');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CA_FCHREFERENCIA', 'CaFchreferencia', 'int', CreoleTypes::DATE, true, null);

		$tMap->addPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'int', CreoleTypes::INTEGER, 'tb_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_MAWB', 'CaMawb', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_PESOVOLUMEN', 'CaPesovolumen', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHPREAVISO', 'CaFchpreaviso', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHLLEGADA', 'CaFchllegada', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHLIQUIDADO', 'CaFchliquidado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USULIQUIDADO', 'CaUsuliquidado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // InoMaestraAirMapBuilder
