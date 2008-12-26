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
class ReporteMapBuilder implements MapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap(ReportePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ReportePeer::TABLE_NAME);
		$tMap->setPhpName('Reporte');
		$tMap->setClassname('Reporte');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_reportes_ca_idreporte_seq');

		$tMap->addPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', true, null);

		$tMap->addColumn('CA_FCHREPORTE', 'CaFchreporte', 'DATE', false, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'VARCHAR', false, 10);

		$tMap->addColumn('CA_VERSION', 'CaVersion', 'INTEGER', false, null);

		$tMap->addColumn('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER', false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHDESPACHO', 'CaFchdespacho', 'DATE', false, null);

		$tMap->addForeignKey('CA_IDAGENTE', 'CaIdagente', 'INTEGER', 'tb_agentes', 'CA_IDAGENTE', false, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MERCANCIA_DESC', 'CaMercanciaDesc', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDPROVEEDOR', 'CaIdproveedor', 'VARCHAR', 'tb_terceros', 'CA_IDTERCERO', false, null);

		$tMap->addColumn('CA_ORDEN_PROV', 'CaOrdenProv', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDCONCLIENTE', 'CaIdconcliente', 'INTEGER', false, null);

		$tMap->addColumn('CA_ORDEN_CLIE', 'CaOrdenClie', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONFIRMAR_CLIE', 'CaConfirmarClie', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDREPRESENTANTE', 'CaIdrepresentante', 'INTEGER', false, null);

		$tMap->addColumn('CA_INFORMAR_REPR', 'CaInformarRepr', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDCONSIGNATARIO', 'CaIdconsignatario', 'INTEGER', false, null);

		$tMap->addColumn('CA_INFORMAR_CONS', 'CaInformarCons', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDNOTIFY', 'CaIdnotify', 'INTEGER', false, null);

		$tMap->addColumn('CA_INFORMAR_NOTI', 'CaInformarNoti', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NOTIFY', 'CaNotify', 'INTEGER', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SEGURO', 'CaSeguro', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LIBERACION', 'CaLiberacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIEMPOCREDITO', 'CaTiempocredito', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PREFERENCIAS_CLIE', 'CaPreferenciasClie', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INSTRUCCIONES', 'CaInstrucciones', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'INTEGER', 'tb_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_IDCONSIGNAR', 'CaIdconsignar', 'INTEGER', false, null);

		$tMap->addColumn('CA_IDCONSIGNARMASTER', 'CaIdconsignarmaster', 'INTEGER', false, null);

		$tMap->addForeignKey('CA_IDBODEGA', 'CaIdbodega', 'INTEGER', 'tb_bodegas', 'CA_IDBODEGA', false, null);

		$tMap->addColumn('CA_MASTERSAME', 'CaMastersame', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTINUACION', 'CaContinuacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTINUACION_DEST', 'CaContinuacionDest', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTINUACION_CONF', 'CaContinuacionConf', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETAPA_ACTUAL', 'CaEtapaActual', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHANULADO', 'CaFchanulado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUANULADO', 'CaUsuanulado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COLMAS', 'CaColmas', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PROPIEDADES', 'CaPropiedades', 'VARCHAR', false, null);

	} // doBuild()

} // ReporteMapBuilder
