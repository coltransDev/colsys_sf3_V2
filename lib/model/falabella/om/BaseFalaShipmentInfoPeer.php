<?php

/**
 * Base static class for performing query and update operations on the 'tb_falashipmentinfo' table.
 *
 * 
 *
 * @package    lib.model.falabella.om
 */
abstract class BaseFalaShipmentInfoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_falashipmentinfo';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.falabella.FalaShipmentInfo';

	/** The total number of columns. */
	const NUM_COLUMNS = 41;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDDOC field */
	const CA_IDDOC = 'tb_falashipmentinfo.CA_IDDOC';

	/** the column name for the CA_BEGIN_WINDOW field */
	const CA_BEGIN_WINDOW = 'tb_falashipmentinfo.CA_BEGIN_WINDOW';

	/** the column name for the CA_END_WINDOW field */
	const CA_END_WINDOW = 'tb_falashipmentinfo.CA_END_WINDOW';

	/** the column name for the CA_COMMODITIES field */
	const CA_COMMODITIES = 'tb_falashipmentinfo.CA_COMMODITIES';

	/** the column name for the CA_PARTIAL field */
	const CA_PARTIAL = 'tb_falashipmentinfo.CA_PARTIAL';

	/** the column name for the CA_PAYMENT_TERMS field */
	const CA_PAYMENT_TERMS = 'tb_falashipmentinfo.CA_PAYMENT_TERMS';

	/** the column name for the CA_INCOTERMS field */
	const CA_INCOTERMS = 'tb_falashipmentinfo.CA_INCOTERMS';

	/** the column name for the CA_CONTAINER_TYPE field */
	const CA_CONTAINER_TYPE = 'tb_falashipmentinfo.CA_CONTAINER_TYPE';

	/** the column name for the CA_UTV field */
	const CA_UTV = 'tb_falashipmentinfo.CA_UTV';

	/** the column name for the CA_ETV field */
	const CA_ETV = 'tb_falashipmentinfo.CA_ETV';

	/** the column name for the CA_LINE field */
	const CA_LINE = 'tb_falashipmentinfo.CA_LINE';

	/** the column name for the CA_CONTACT_LINE field */
	const CA_CONTACT_LINE = 'tb_falashipmentinfo.CA_CONTACT_LINE';

	/** the column name for the CA_CONTACT_IMPORTER field */
	const CA_CONTACT_IMPORTER = 'tb_falashipmentinfo.CA_CONTACT_IMPORTER';

	/** the column name for the CA_UPPO field */
	const CA_UPPO = 'tb_falashipmentinfo.CA_UPPO';

	/** the column name for the CA_EB field */
	const CA_EB = 'tb_falashipmentinfo.CA_EB';

	/** the column name for the CA_EDD field */
	const CA_EDD = 'tb_falashipmentinfo.CA_EDD';

	/** the column name for the CA_PORT field */
	const CA_PORT = 'tb_falashipmentinfo.CA_PORT';

	/** the column name for the CA_TRANSSHIPMENT field */
	const CA_TRANSSHIPMENT = 'tb_falashipmentinfo.CA_TRANSSHIPMENT';

	/** the column name for the CA_TRANSSHIPMENT_PORT field */
	const CA_TRANSSHIPMENT_PORT = 'tb_falashipmentinfo.CA_TRANSSHIPMENT_PORT';

	/** the column name for the CA_SHIPPING_ORG field */
	const CA_SHIPPING_ORG = 'tb_falashipmentinfo.CA_SHIPPING_ORG';

	/** the column name for the CA_ORIGINAL_ORG field */
	const CA_ORIGINAL_ORG = 'tb_falashipmentinfo.CA_ORIGINAL_ORG';

	/** the column name for the CA_FWD_COPY_ORG field */
	const CA_FWD_COPY_ORG = 'tb_falashipmentinfo.CA_FWD_COPY_ORG';

	/** the column name for the CA_FCR_ORG field */
	const CA_FCR_ORG = 'tb_falashipmentinfo.CA_FCR_ORG';

	/** the column name for the CA_SHIPPING_DST field */
	const CA_SHIPPING_DST = 'tb_falashipmentinfo.CA_SHIPPING_DST';

	/** the column name for the CA_ORIGINAL_DST field */
	const CA_ORIGINAL_DST = 'tb_falashipmentinfo.CA_ORIGINAL_DST';

	/** the column name for the CA_FWD_COPY_DST field */
	const CA_FWD_COPY_DST = 'tb_falashipmentinfo.CA_FWD_COPY_DST';

	/** the column name for the CA_FCR_DST field */
	const CA_FCR_DST = 'tb_falashipmentinfo.CA_FCR_DST';

	/** the column name for the CA_TRANSPORT_VIA field */
	const CA_TRANSPORT_VIA = 'tb_falashipmentinfo.CA_TRANSPORT_VIA';

	/** the column name for the CA_INVOICE_ORG field */
	const CA_INVOICE_ORG = 'tb_falashipmentinfo.CA_INVOICE_ORG';

	/** the column name for the CA_PACKING_LIST_ORG field */
	const CA_PACKING_LIST_ORG = 'tb_falashipmentinfo.CA_PACKING_LIST_ORG';

	/** the column name for the CA_DOCUMENT_ORG field */
	const CA_DOCUMENT_ORG = 'tb_falashipmentinfo.CA_DOCUMENT_ORG';

	/** the column name for the CA_OC_ORG field */
	const CA_OC_ORG = 'tb_falashipmentinfo.CA_OC_ORG';

	/** the column name for the CA_OTHERS_DOCS_ORG field */
	const CA_OTHERS_DOCS_ORG = 'tb_falashipmentinfo.CA_OTHERS_DOCS_ORG';

	/** the column name for the CA_INVOICE_CPS field */
	const CA_INVOICE_CPS = 'tb_falashipmentinfo.CA_INVOICE_CPS';

	/** the column name for the CA_PACKING_LIST_CPS field */
	const CA_PACKING_LIST_CPS = 'tb_falashipmentinfo.CA_PACKING_LIST_CPS';

	/** the column name for the CA_DOCUMENT_CPS field */
	const CA_DOCUMENT_CPS = 'tb_falashipmentinfo.CA_DOCUMENT_CPS';

	/** the column name for the CA_OC_CPS field */
	const CA_OC_CPS = 'tb_falashipmentinfo.CA_OC_CPS';

	/** the column name for the CA_OTHERS_DOCS_CPS field */
	const CA_OTHERS_DOCS_CPS = 'tb_falashipmentinfo.CA_OTHERS_DOCS_CPS';

	/** the column name for the CA_FINAL_PORT field */
	const CA_FINAL_PORT = 'tb_falashipmentinfo.CA_FINAL_PORT';

	/** the column name for the CA_ALTER_PORT field */
	const CA_ALTER_PORT = 'tb_falashipmentinfo.CA_ALTER_PORT';

	/** the column name for the CA_LIMIT_DATE field */
	const CA_LIMIT_DATE = 'tb_falashipmentinfo.CA_LIMIT_DATE';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaBeginWindow', 'CaEndWindow', 'CaCommodities', 'CaPartial', 'CaPaymentTerms', 'CaIncoterms', 'CaContainerType', 'CaUtv', 'CaEtv', 'CaLine', 'CaContactLine', 'CaContactImporter', 'CaUppo', 'CaEb', 'CaEdd', 'CaPort', 'CaTransshipment', 'CaTransshipmentPort', 'CaShippingOrg', 'CaOriginalOrg', 'CaFwdCopyOrg', 'CaFcrOrg', 'CaShippingDst', 'CaOriginalDst', 'CaFwdCopyDst', 'CaFcrDst', 'CaTransportVia', 'CaInvoiceOrg', 'CaPackingListOrg', 'CaDocumentOrg', 'CaOcOrg', 'CaOthersDocsOrg', 'CaInvoiceCps', 'CaPackingListCps', 'CaDocumentCps', 'CaOcCps', 'CaOthersDocsCps', 'CaFinalPort', 'CaAlterPort', 'CaLimitDate', ),
		BasePeer::TYPE_COLNAME => array (FalaShipmentInfoPeer::CA_IDDOC, FalaShipmentInfoPeer::CA_BEGIN_WINDOW, FalaShipmentInfoPeer::CA_END_WINDOW, FalaShipmentInfoPeer::CA_COMMODITIES, FalaShipmentInfoPeer::CA_PARTIAL, FalaShipmentInfoPeer::CA_PAYMENT_TERMS, FalaShipmentInfoPeer::CA_INCOTERMS, FalaShipmentInfoPeer::CA_CONTAINER_TYPE, FalaShipmentInfoPeer::CA_UTV, FalaShipmentInfoPeer::CA_ETV, FalaShipmentInfoPeer::CA_LINE, FalaShipmentInfoPeer::CA_CONTACT_LINE, FalaShipmentInfoPeer::CA_CONTACT_IMPORTER, FalaShipmentInfoPeer::CA_UPPO, FalaShipmentInfoPeer::CA_EB, FalaShipmentInfoPeer::CA_EDD, FalaShipmentInfoPeer::CA_PORT, FalaShipmentInfoPeer::CA_TRANSSHIPMENT, FalaShipmentInfoPeer::CA_TRANSSHIPMENT_PORT, FalaShipmentInfoPeer::CA_SHIPPING_ORG, FalaShipmentInfoPeer::CA_ORIGINAL_ORG, FalaShipmentInfoPeer::CA_FWD_COPY_ORG, FalaShipmentInfoPeer::CA_FCR_ORG, FalaShipmentInfoPeer::CA_SHIPPING_DST, FalaShipmentInfoPeer::CA_ORIGINAL_DST, FalaShipmentInfoPeer::CA_FWD_COPY_DST, FalaShipmentInfoPeer::CA_FCR_DST, FalaShipmentInfoPeer::CA_TRANSPORT_VIA, FalaShipmentInfoPeer::CA_INVOICE_ORG, FalaShipmentInfoPeer::CA_PACKING_LIST_ORG, FalaShipmentInfoPeer::CA_DOCUMENT_ORG, FalaShipmentInfoPeer::CA_OC_ORG, FalaShipmentInfoPeer::CA_OTHERS_DOCS_ORG, FalaShipmentInfoPeer::CA_INVOICE_CPS, FalaShipmentInfoPeer::CA_PACKING_LIST_CPS, FalaShipmentInfoPeer::CA_DOCUMENT_CPS, FalaShipmentInfoPeer::CA_OC_CPS, FalaShipmentInfoPeer::CA_OTHERS_DOCS_CPS, FalaShipmentInfoPeer::CA_FINAL_PORT, FalaShipmentInfoPeer::CA_ALTER_PORT, FalaShipmentInfoPeer::CA_LIMIT_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_begin_window', 'ca_end_window', 'ca_commodities', 'ca_partial', 'ca_payment_terms', 'ca_incoterms', 'ca_container_type', 'ca_utv', 'ca_etv', 'ca_line', 'ca_contact_line', 'ca_contact_importer', 'ca_uppo', 'ca_eb', 'ca_edd', 'ca_port', 'ca_transshipment', 'ca_transshipment_port', 'ca_shipping_org', 'ca_original_org', 'ca_fwd_copy_org', 'ca_fcr_org', 'ca_shipping_dst', 'ca_original_dst', 'ca_fwd_copy_dst', 'ca_fcr_dst', 'ca_transport_via', 'ca_invoice_org', 'ca_packing_list_org', 'ca_document_org', 'ca_oc_org', 'ca_others_docs_org', 'ca_invoice_cps', 'ca_packing_list_cps', 'ca_document_cps', 'ca_oc_cps', 'ca_others_docs_cps', 'ca_final_port', 'ca_alter_port', 'ca_limit_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaBeginWindow' => 1, 'CaEndWindow' => 2, 'CaCommodities' => 3, 'CaPartial' => 4, 'CaPaymentTerms' => 5, 'CaIncoterms' => 6, 'CaContainerType' => 7, 'CaUtv' => 8, 'CaEtv' => 9, 'CaLine' => 10, 'CaContactLine' => 11, 'CaContactImporter' => 12, 'CaUppo' => 13, 'CaEb' => 14, 'CaEdd' => 15, 'CaPort' => 16, 'CaTransshipment' => 17, 'CaTransshipmentPort' => 18, 'CaShippingOrg' => 19, 'CaOriginalOrg' => 20, 'CaFwdCopyOrg' => 21, 'CaFcrOrg' => 22, 'CaShippingDst' => 23, 'CaOriginalDst' => 24, 'CaFwdCopyDst' => 25, 'CaFcrDst' => 26, 'CaTransportVia' => 27, 'CaInvoiceOrg' => 28, 'CaPackingListOrg' => 29, 'CaDocumentOrg' => 30, 'CaOcOrg' => 31, 'CaOthersDocsOrg' => 32, 'CaInvoiceCps' => 33, 'CaPackingListCps' => 34, 'CaDocumentCps' => 35, 'CaOcCps' => 36, 'CaOthersDocsCps' => 37, 'CaFinalPort' => 38, 'CaAlterPort' => 39, 'CaLimitDate' => 40, ),
		BasePeer::TYPE_COLNAME => array (FalaShipmentInfoPeer::CA_IDDOC => 0, FalaShipmentInfoPeer::CA_BEGIN_WINDOW => 1, FalaShipmentInfoPeer::CA_END_WINDOW => 2, FalaShipmentInfoPeer::CA_COMMODITIES => 3, FalaShipmentInfoPeer::CA_PARTIAL => 4, FalaShipmentInfoPeer::CA_PAYMENT_TERMS => 5, FalaShipmentInfoPeer::CA_INCOTERMS => 6, FalaShipmentInfoPeer::CA_CONTAINER_TYPE => 7, FalaShipmentInfoPeer::CA_UTV => 8, FalaShipmentInfoPeer::CA_ETV => 9, FalaShipmentInfoPeer::CA_LINE => 10, FalaShipmentInfoPeer::CA_CONTACT_LINE => 11, FalaShipmentInfoPeer::CA_CONTACT_IMPORTER => 12, FalaShipmentInfoPeer::CA_UPPO => 13, FalaShipmentInfoPeer::CA_EB => 14, FalaShipmentInfoPeer::CA_EDD => 15, FalaShipmentInfoPeer::CA_PORT => 16, FalaShipmentInfoPeer::CA_TRANSSHIPMENT => 17, FalaShipmentInfoPeer::CA_TRANSSHIPMENT_PORT => 18, FalaShipmentInfoPeer::CA_SHIPPING_ORG => 19, FalaShipmentInfoPeer::CA_ORIGINAL_ORG => 20, FalaShipmentInfoPeer::CA_FWD_COPY_ORG => 21, FalaShipmentInfoPeer::CA_FCR_ORG => 22, FalaShipmentInfoPeer::CA_SHIPPING_DST => 23, FalaShipmentInfoPeer::CA_ORIGINAL_DST => 24, FalaShipmentInfoPeer::CA_FWD_COPY_DST => 25, FalaShipmentInfoPeer::CA_FCR_DST => 26, FalaShipmentInfoPeer::CA_TRANSPORT_VIA => 27, FalaShipmentInfoPeer::CA_INVOICE_ORG => 28, FalaShipmentInfoPeer::CA_PACKING_LIST_ORG => 29, FalaShipmentInfoPeer::CA_DOCUMENT_ORG => 30, FalaShipmentInfoPeer::CA_OC_ORG => 31, FalaShipmentInfoPeer::CA_OTHERS_DOCS_ORG => 32, FalaShipmentInfoPeer::CA_INVOICE_CPS => 33, FalaShipmentInfoPeer::CA_PACKING_LIST_CPS => 34, FalaShipmentInfoPeer::CA_DOCUMENT_CPS => 35, FalaShipmentInfoPeer::CA_OC_CPS => 36, FalaShipmentInfoPeer::CA_OTHERS_DOCS_CPS => 37, FalaShipmentInfoPeer::CA_FINAL_PORT => 38, FalaShipmentInfoPeer::CA_ALTER_PORT => 39, FalaShipmentInfoPeer::CA_LIMIT_DATE => 40, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_begin_window' => 1, 'ca_end_window' => 2, 'ca_commodities' => 3, 'ca_partial' => 4, 'ca_payment_terms' => 5, 'ca_incoterms' => 6, 'ca_container_type' => 7, 'ca_utv' => 8, 'ca_etv' => 9, 'ca_line' => 10, 'ca_contact_line' => 11, 'ca_contact_importer' => 12, 'ca_uppo' => 13, 'ca_eb' => 14, 'ca_edd' => 15, 'ca_port' => 16, 'ca_transshipment' => 17, 'ca_transshipment_port' => 18, 'ca_shipping_org' => 19, 'ca_original_org' => 20, 'ca_fwd_copy_org' => 21, 'ca_fcr_org' => 22, 'ca_shipping_dst' => 23, 'ca_original_dst' => 24, 'ca_fwd_copy_dst' => 25, 'ca_fcr_dst' => 26, 'ca_transport_via' => 27, 'ca_invoice_org' => 28, 'ca_packing_list_org' => 29, 'ca_document_org' => 30, 'ca_oc_org' => 31, 'ca_others_docs_org' => 32, 'ca_invoice_cps' => 33, 'ca_packing_list_cps' => 34, 'ca_document_cps' => 35, 'ca_oc_cps' => 36, 'ca_others_docs_cps' => 37, 'ca_final_port' => 38, 'ca_alter_port' => 39, 'ca_limit_date' => 40, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.falabella.map.FalaShipmentInfoMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FalaShipmentInfoPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. FalaShipmentInfoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(FalaShipmentInfoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_IDDOC);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_BEGIN_WINDOW);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_END_WINDOW);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_COMMODITIES);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PARTIAL);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PAYMENT_TERMS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_INCOTERMS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_CONTAINER_TYPE);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_UTV);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_ETV);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_LINE);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_CONTACT_LINE);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_CONTACT_IMPORTER);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_UPPO);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_EB);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_EDD);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PORT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_TRANSSHIPMENT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_TRANSSHIPMENT_PORT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_SHIPPING_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_ORIGINAL_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FWD_COPY_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FCR_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_SHIPPING_DST);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_ORIGINAL_DST);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FWD_COPY_DST);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FCR_DST);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_TRANSPORT_VIA);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_INVOICE_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PACKING_LIST_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_DOCUMENT_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_OC_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_OTHERS_DOCS_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_INVOICE_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PACKING_LIST_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_DOCUMENT_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_OC_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_OTHERS_DOCS_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FINAL_PORT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_ALTER_PORT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_LIMIT_DATE);

	}

	const COUNT = 'COUNT(tb_falashipmentinfo.CA_IDDOC)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_falashipmentinfo.CA_IDDOC)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FalaShipmentInfoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaShipmentInfoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FalaShipmentInfoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     FalaShipmentInfo
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = FalaShipmentInfoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FalaShipmentInfoPeer::populateObjects(FalaShipmentInfoPeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = FalaShipmentInfoPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related FalaHeader table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinFalaHeader(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FalaShipmentInfoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaShipmentInfoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FalaShipmentInfoPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = FalaShipmentInfoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of FalaShipmentInfo objects pre-filled with their FalaHeader objects.
	 *
	 * @return     array Array of FalaShipmentInfo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinFalaHeader(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaShipmentInfoPeer::addSelectColumns($c);
		$startcol = (FalaShipmentInfoPeer::NUM_COLUMNS - FalaShipmentInfoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FalaHeaderPeer::addSelectColumns($c);

		$c->addJoin(FalaShipmentInfoPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FalaShipmentInfoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FalaHeaderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFalaHeader(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addFalaShipmentInfo($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFalaShipmentInfos();
				$obj2->addFalaShipmentInfo($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FalaShipmentInfoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaShipmentInfoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FalaShipmentInfoPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = FalaShipmentInfoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of FalaShipmentInfo objects pre-filled with all related objects.
	 *
	 * @return     array Array of FalaShipmentInfo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaShipmentInfoPeer::addSelectColumns($c);
		$startcol2 = (FalaShipmentInfoPeer::NUM_COLUMNS - FalaShipmentInfoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FalaHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FalaHeaderPeer::NUM_COLUMNS;

		$c->addJoin(FalaShipmentInfoPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FalaShipmentInfoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined FalaHeader rows
	
			$omClass = FalaHeaderPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFalaHeader(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFalaShipmentInfo($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initFalaShipmentInfos();
				$obj2->addFalaShipmentInfo($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return FalaShipmentInfoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a FalaShipmentInfo or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaShipmentInfo object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from FalaShipmentInfo object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a FalaShipmentInfo or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaShipmentInfo object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(FalaShipmentInfoPeer::CA_IDDOC);
			$selectCriteria->add(FalaShipmentInfoPeer::CA_IDDOC, $criteria->remove(FalaShipmentInfoPeer::CA_IDDOC), $comparison);

		} else { // $values is FalaShipmentInfo object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_falashipmentinfo table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(FalaShipmentInfoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a FalaShipmentInfo or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or FalaShipmentInfo object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof FalaShipmentInfo) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given FalaShipmentInfo object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      FalaShipmentInfo $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(FalaShipmentInfo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FalaShipmentInfoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FalaShipmentInfoPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(FalaShipmentInfoPeer::DATABASE_NAME, FalaShipmentInfoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FalaShipmentInfoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     FalaShipmentInfo
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(FalaShipmentInfoPeer::DATABASE_NAME);

		$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $pk);


		$v = FalaShipmentInfoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $pks, Criteria::IN);
			$objs = FalaShipmentInfoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseFalaShipmentInfoPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseFalaShipmentInfoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.falabella.map.FalaShipmentInfoMapBuilder');
}
