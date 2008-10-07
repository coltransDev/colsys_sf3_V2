<?php


/**
 * This class adds structure of 'tb_cotcontinuacion' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.cotizaciones.map
 */
class CotContinuacionMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotContinuacionMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_cotcontinuacion');
		$tMap->setPhpName('CotContinuacion');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'int' , CreoleTypes::INTEGER, 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addPrimaryKey('CA_TIPO', 'CaTipo', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addPrimaryKey('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addPrimaryKey('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addForeignPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'int' , CreoleTypes::INTEGER, 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDEQUIPO', 'CaIdequipo', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_TARIFA', 'CaTarifa', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VALOR_TAR', 'CaValorTar', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_VALOR_MIN', 'CaValorMin', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_FRECUENCIA', 'CaFrecuencia', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TIEMPOTRANSITO', 'CaTiempotransito', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // CotContinuacionMapBuilder
