<?php


/**
 * This class adds structure of 'tb_reportes' table to 'propel' DatabaseMap object.
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
class ReporteMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.ReporteMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_reportes');
		$tMap->setPhpName('Reporte');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_reportes_SEQ');

		$tMap->addPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_FCHREPORTE', 'CaFchreporte', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('CA_VERSION', 'CaVersion', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_IDCOTIZACION', 'CaIdcotizacion', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHDESPACHO', 'CaFchdespacho', 'int', CreoleTypes::DATE, false, null);

		$tMap->addForeignKey('CA_IDAGENTE', 'CaIdagente', 'int', CreoleTypes::INTEGER, 'tb_agentes', 'CA_IDAGENTE', false, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MERCANCIA_DESC', 'CaMercanciaDesc', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDPROVEEDOR', 'CaIdproveedor', 'string', CreoleTypes::VARCHAR, 'tb_terceros', 'CA_IDTERCERO', false, null);

		$tMap->addColumn('CA_ORDEN_PROV', 'CaOrdenProv', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDCONCLIENTE', 'CaIdconcliente', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_ORDEN_CLIE', 'CaOrdenClie', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONFIRMAR_CLIE', 'CaConfirmarClie', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDREPRESENTANTE', 'CaIdrepresentante', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_INFORMAR_REPR', 'CaInformarRepr', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDCONSIGNATARIO', 'CaIdconsignatario', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_INFORMAR_CONS', 'CaInformarCons', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDNOTIFY', 'CaIdnotify', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_INFORMAR_NOTI', 'CaInformarNoti', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NOTIFY', 'CaNotify', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SEGURO', 'CaSeguro', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_LIBERACION', 'CaLiberacion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TIEMPOCREDITO', 'CaTiempocredito', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PREFERENCIAS_CLIE', 'CaPreferenciasClie', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_INSTRUCCIONES', 'CaInstrucciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'int', CreoleTypes::INTEGER, 'tb_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_IDCONSIGNAR', 'CaIdconsignar', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_IDCONSIGNARMASTER', 'CaIdconsignarmaster', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('CA_IDBODEGA', 'CaIdbodega', 'int', CreoleTypes::INTEGER, 'tb_bodegas', 'CA_IDBODEGA', false, null);

		$tMap->addColumn('CA_MASTERSAME', 'CaMastersame', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTINUACION', 'CaContinuacion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTINUACION_DEST', 'CaContinuacionDest', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTINUACION_CONF', 'CaContinuacionConf', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ETAPA_ACTUAL', 'CaEtapaActual', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'string', CreoleTypes::VARCHAR, 'control.tb_usuarios', 'CA_LOGIN', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHANULADO', 'CaFchanulado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUANULADO', 'CaUsuanulado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_COLMAS', 'CaColmas', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PROPIEDADES', 'CaPropiedades', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // ReporteMapBuilder
