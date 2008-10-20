<?php


/**
 * This class adds structure of 'tb_cotopciones' table to 'propel' DatabaseMap object.
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
class CotOpcionMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotOpcionMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_cotopciones');
		$tMap->setPhpName('CotOpcion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotopciones_SEQ');

		$tMap->addPrimaryKey('CA_IDOPCION', 'CaIdopcion', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'int' , CreoleTypes::INTEGER, 'tb_cotproductos', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'int' , CreoleTypes::INTEGER, 'tb_cotproductos', 'CA_IDPRODUCTO', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'int', CreoleTypes::INTEGER, 'tb_conceptos', 'CA_IDCONCEPTO', false, null);

		$tMap->addColumn('CA_VALOR_TAR', 'CaValorTar', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_APLICA_TAR', 'CaAplicaTar', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VALOR_MIN', 'CaValorMin', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_APLICA_MIN', 'CaAplicaMin', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TARIFA', 'CaTarifa', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OFERTA', 'CaOferta', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_RECARGOS', 'CaRecargos', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // CotOpcionMapBuilder
