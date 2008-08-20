<?php


/**
 * This class adds structure of 'tb_inomaestra_sea' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.sea.map
 */
class InoMaestraSeaMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sea.map.InoMaestraSeaMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_inomaestra_sea');
		$tMap->setPhpName('InoMaestraSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CA_FCHREFERENCIA', 'CaFchreferencia', 'int', CreoleTypes::DATE, true, null);

		$tMap->addPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHEMBARQUE', 'CaFchembarque', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHARRIBO', 'CaFcharribo', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'int', CreoleTypes::INTEGER, 'tb_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_MOTONAVE', 'CaMotonave', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CICLO', 'CaCiclo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MBLS', 'CaMbls', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCONFIRMACION', 'CaFchconfirmacion', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_HORACONFIRMACION', 'CaHoraconfirmacion', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('CA_REGISTROADU', 'CaRegistroadu', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_REGISTROCAP', 'CaRegistrocap', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_BANDERA', 'CaBandera', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHLIBERACION', 'CaFchliberacion', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_NROLIBERACION', 'CaNroliberacion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ANULADO', 'CaAnulado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHLIQUIDADO', 'CaFchliquidado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USULIQUIDADO', 'CaUsuliquidado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MENSAJE', 'CaMensaje', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHDESCONSOLIDACION', 'CaFchdesconsolidacion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MNLLEGADA', 'CaMnllegada', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHREGISTROADU', 'CaFchregistroadu', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCONFIRMADO', 'CaFchconfirmado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCONFIRMADO', 'CaUsuconfirmado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ASUNTO_OTM', 'CaAsuntoOtm', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MENSAJE_OTM', 'CaMensajeOtm', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHLLEGADA_OTM', 'CaFchllegadaOtm', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CIUDAD_OTM', 'CaCiudadOtm', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCONFIRMA_OTM', 'CaFchconfirmaOtm', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCONFIRMA_OTM', 'CaUsuconfirmaOtm', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PROVISIONAL', 'CaProvisional', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CA_SITIODEVOLUCION', 'CaSitiodevolucion', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // InoMaestraSeaMapBuilder
