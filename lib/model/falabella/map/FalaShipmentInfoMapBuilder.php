<?php


/**
 * This class adds structure of 'tb_falashipmentinfo' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.falabella.map
 */
class FalaShipmentInfoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.falabella.map.FalaShipmentInfoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(FalaShipmentInfoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FalaShipmentInfoPeer::TABLE_NAME);
		$tMap->setPhpName('FalaShipmentInfo');
		$tMap->setClassname('FalaShipmentInfo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDDOC', 'CaIddoc', 'VARCHAR' , 'tb_falaheader', 'CA_IDDOC', true, null);

		$tMap->addColumn('CA_BEGIN_WINDOW', 'CaBeginWindow', 'DATE', false, null);

		$tMap->addColumn('CA_END_WINDOW', 'CaEndWindow', 'DATE', false, null);

		$tMap->addColumn('CA_COMMODITIES', 'CaCommodities', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PARTIAL', 'CaPartial', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PAYMENT_TERMS', 'CaPaymentTerms', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTAINER_TYPE', 'CaContainerType', 'VARCHAR', false, null);

		$tMap->addColumn('CA_UTV', 'CaUtv', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETV', 'CaEtv', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LINE', 'CaLine', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTACT_LINE', 'CaContactLine', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTACT_IMPORTER', 'CaContactImporter', 'VARCHAR', false, null);

		$tMap->addColumn('CA_UPPO', 'CaUppo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_EB', 'CaEb', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EDD', 'CaEdd', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PORT', 'CaPort', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSSHIPMENT', 'CaTransshipment', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSSHIPMENT_PORT', 'CaTransshipmentPort', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SHIPPING_ORG', 'CaShippingOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORIGINAL_ORG', 'CaOriginalOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FWD_COPY_ORG', 'CaFwdCopyOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCR_ORG', 'CaFcrOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SHIPPING_DST', 'CaShippingDst', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORIGINAL_DST', 'CaOriginalDst', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FWD_COPY_DST', 'CaFwdCopyDst', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCR_DST', 'CaFcrDst', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORT_VIA', 'CaTransportVia', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INVOICE_ORG', 'CaInvoiceOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PACKING_LIST_ORG', 'CaPackingListOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DOCUMENT_ORG', 'CaDocumentOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OC_ORG', 'CaOcOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OTHERS_DOCS_ORG', 'CaOthersDocsOrg', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INVOICE_CPS', 'CaInvoiceCps', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PACKING_LIST_CPS', 'CaPackingListCps', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DOCUMENT_CPS', 'CaDocumentCps', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OC_CPS', 'CaOcCps', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OTHERS_DOCS_CPS', 'CaOthersDocsCps', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FINAL_PORT', 'CaFinalPort', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ALTER_PORT', 'CaAlterPort', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LIMIT_DATE', 'CaLimitDate', 'DATE', false, null);

	} // doBuild()

} // FalaShipmentInfoMapBuilder
