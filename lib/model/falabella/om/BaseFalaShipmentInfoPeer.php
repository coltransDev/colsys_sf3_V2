<?php


abstract class BaseFalaShipmentInfoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_falashipmentinfo';

	
	const CLASS_DEFAULT = 'lib.model.falabella.FalaShipmentInfo';

	
	const NUM_COLUMNS = 41;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDDOC = 'tb_falashipmentinfo.CA_IDDOC';

	
	const CA_BEGIN_WINDOW = 'tb_falashipmentinfo.CA_BEGIN_WINDOW';

	
	const CA_END_WINDOW = 'tb_falashipmentinfo.CA_END_WINDOW';

	
	const CA_COMMODITIES = 'tb_falashipmentinfo.CA_COMMODITIES';

	
	const CA_PARTIAL = 'tb_falashipmentinfo.CA_PARTIAL';

	
	const CA_PAYMENT_TERMS = 'tb_falashipmentinfo.CA_PAYMENT_TERMS';

	
	const CA_INCOTERMS = 'tb_falashipmentinfo.CA_INCOTERMS';

	
	const CA_CONTAINER_TYPE = 'tb_falashipmentinfo.CA_CONTAINER_TYPE';

	
	const CA_UTV = 'tb_falashipmentinfo.CA_UTV';

	
	const CA_ETV = 'tb_falashipmentinfo.CA_ETV';

	
	const CA_LINE = 'tb_falashipmentinfo.CA_LINE';

	
	const CA_CONTACT_LINE = 'tb_falashipmentinfo.CA_CONTACT_LINE';

	
	const CA_CONTACT_IMPORTER = 'tb_falashipmentinfo.CA_CONTACT_IMPORTER';

	
	const CA_UPPO = 'tb_falashipmentinfo.CA_UPPO';

	
	const CA_EB = 'tb_falashipmentinfo.CA_EB';

	
	const CA_EDD = 'tb_falashipmentinfo.CA_EDD';

	
	const CA_PORT = 'tb_falashipmentinfo.CA_PORT';

	
	const CA_TRANSSHIPMENT = 'tb_falashipmentinfo.CA_TRANSSHIPMENT';

	
	const CA_TRANSSHIPMENT_PORT = 'tb_falashipmentinfo.CA_TRANSSHIPMENT_PORT';

	
	const CA_SHIPPING_ORG = 'tb_falashipmentinfo.CA_SHIPPING_ORG';

	
	const CA_ORIGINAL_ORG = 'tb_falashipmentinfo.CA_ORIGINAL_ORG';

	
	const CA_FWD_COPY_ORG = 'tb_falashipmentinfo.CA_FWD_COPY_ORG';

	
	const CA_FCR_ORG = 'tb_falashipmentinfo.CA_FCR_ORG';

	
	const CA_SHIPPING_DST = 'tb_falashipmentinfo.CA_SHIPPING_DST';

	
	const CA_ORIGINAL_DST = 'tb_falashipmentinfo.CA_ORIGINAL_DST';

	
	const CA_FWD_COPY_DST = 'tb_falashipmentinfo.CA_FWD_COPY_DST';

	
	const CA_FCR_DST = 'tb_falashipmentinfo.CA_FCR_DST';

	
	const CA_TRANSPORT_VIA = 'tb_falashipmentinfo.CA_TRANSPORT_VIA';

	
	const CA_INVOICE_ORG = 'tb_falashipmentinfo.CA_INVOICE_ORG';

	
	const CA_PACKING_LIST_ORG = 'tb_falashipmentinfo.CA_PACKING_LIST_ORG';

	
	const CA_DOCUMENT_ORG = 'tb_falashipmentinfo.CA_DOCUMENT_ORG';

	
	const CA_OC_ORG = 'tb_falashipmentinfo.CA_OC_ORG';

	
	const CA_OTHERS_DOCS_ORG = 'tb_falashipmentinfo.CA_OTHERS_DOCS_ORG';

	
	const CA_INVOICE_CPS = 'tb_falashipmentinfo.CA_INVOICE_CPS';

	
	const CA_PACKING_LIST_CPS = 'tb_falashipmentinfo.CA_PACKING_LIST_CPS';

	
	const CA_DOCUMENT_CPS = 'tb_falashipmentinfo.CA_DOCUMENT_CPS';

	
	const CA_OC_CPS = 'tb_falashipmentinfo.CA_OC_CPS';

	
	const CA_OTHERS_DOCS_CPS = 'tb_falashipmentinfo.CA_OTHERS_DOCS_CPS';

	
	const CA_FINAL_PORT = 'tb_falashipmentinfo.CA_FINAL_PORT';

	
	const CA_ALTER_PORT = 'tb_falashipmentinfo.CA_ALTER_PORT';

	
	const CA_LIMIT_DATE = 'tb_falashipmentinfo.CA_LIMIT_DATE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaBeginWindow', 'CaEndWindow', 'CaCommodities', 'CaPartial', 'CaPaymentTerms', 'CaIncoterms', 'CaContainerType', 'CaUtv', 'CaEtv', 'CaLine', 'CaContactLine', 'CaContactImporter', 'CaUppo', 'CaEb', 'CaEdd', 'CaPort', 'CaTransshipment', 'CaTransshipmentPort', 'CaShippingOrg', 'CaOriginalOrg', 'CaFwdCopyOrg', 'CaFcrOrg', 'CaShippingDst', 'CaOriginalDst', 'CaFwdCopyDst', 'CaFcrDst', 'CaTransportVia', 'CaInvoiceOrg', 'CaPackingListOrg', 'CaDocumentOrg', 'CaOcOrg', 'CaOthersDocsOrg', 'CaInvoiceCps', 'CaPackingListCps', 'CaDocumentCps', 'CaOcCps', 'CaOthersDocsCps', 'CaFinalPort', 'CaAlterPort', 'CaLimitDate', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc', 'caBeginWindow', 'caEndWindow', 'caCommodities', 'caPartial', 'caPaymentTerms', 'caIncoterms', 'caContainerType', 'caUtv', 'caEtv', 'caLine', 'caContactLine', 'caContactImporter', 'caUppo', 'caEb', 'caEdd', 'caPort', 'caTransshipment', 'caTransshipmentPort', 'caShippingOrg', 'caOriginalOrg', 'caFwdCopyOrg', 'caFcrOrg', 'caShippingDst', 'caOriginalDst', 'caFwdCopyDst', 'caFcrDst', 'caTransportVia', 'caInvoiceOrg', 'caPackingListOrg', 'caDocumentOrg', 'caOcOrg', 'caOthersDocsOrg', 'caInvoiceCps', 'caPackingListCps', 'caDocumentCps', 'caOcCps', 'caOthersDocsCps', 'caFinalPort', 'caAlterPort', 'caLimitDate', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC, self::CA_BEGIN_WINDOW, self::CA_END_WINDOW, self::CA_COMMODITIES, self::CA_PARTIAL, self::CA_PAYMENT_TERMS, self::CA_INCOTERMS, self::CA_CONTAINER_TYPE, self::CA_UTV, self::CA_ETV, self::CA_LINE, self::CA_CONTACT_LINE, self::CA_CONTACT_IMPORTER, self::CA_UPPO, self::CA_EB, self::CA_EDD, self::CA_PORT, self::CA_TRANSSHIPMENT, self::CA_TRANSSHIPMENT_PORT, self::CA_SHIPPING_ORG, self::CA_ORIGINAL_ORG, self::CA_FWD_COPY_ORG, self::CA_FCR_ORG, self::CA_SHIPPING_DST, self::CA_ORIGINAL_DST, self::CA_FWD_COPY_DST, self::CA_FCR_DST, self::CA_TRANSPORT_VIA, self::CA_INVOICE_ORG, self::CA_PACKING_LIST_ORG, self::CA_DOCUMENT_ORG, self::CA_OC_ORG, self::CA_OTHERS_DOCS_ORG, self::CA_INVOICE_CPS, self::CA_PACKING_LIST_CPS, self::CA_DOCUMENT_CPS, self::CA_OC_CPS, self::CA_OTHERS_DOCS_CPS, self::CA_FINAL_PORT, self::CA_ALTER_PORT, self::CA_LIMIT_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_begin_window', 'ca_end_window', 'ca_commodities', 'ca_partial', 'ca_payment_terms', 'ca_incoterms', 'ca_container_type', 'ca_utv', 'ca_etv', 'ca_line', 'ca_contact_line', 'ca_contact_importer', 'ca_uppo', 'ca_eb', 'ca_edd', 'ca_port', 'ca_transshipment', 'ca_transshipment_port', 'ca_shipping_org', 'ca_original_org', 'ca_fwd_copy_org', 'ca_fcr_org', 'ca_shipping_dst', 'ca_original_dst', 'ca_fwd_copy_dst', 'ca_fcr_dst', 'ca_transport_via', 'ca_invoice_org', 'ca_packing_list_org', 'ca_document_org', 'ca_oc_org', 'ca_others_docs_org', 'ca_invoice_cps', 'ca_packing_list_cps', 'ca_document_cps', 'ca_oc_cps', 'ca_others_docs_cps', 'ca_final_port', 'ca_alter_port', 'ca_limit_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaBeginWindow' => 1, 'CaEndWindow' => 2, 'CaCommodities' => 3, 'CaPartial' => 4, 'CaPaymentTerms' => 5, 'CaIncoterms' => 6, 'CaContainerType' => 7, 'CaUtv' => 8, 'CaEtv' => 9, 'CaLine' => 10, 'CaContactLine' => 11, 'CaContactImporter' => 12, 'CaUppo' => 13, 'CaEb' => 14, 'CaEdd' => 15, 'CaPort' => 16, 'CaTransshipment' => 17, 'CaTransshipmentPort' => 18, 'CaShippingOrg' => 19, 'CaOriginalOrg' => 20, 'CaFwdCopyOrg' => 21, 'CaFcrOrg' => 22, 'CaShippingDst' => 23, 'CaOriginalDst' => 24, 'CaFwdCopyDst' => 25, 'CaFcrDst' => 26, 'CaTransportVia' => 27, 'CaInvoiceOrg' => 28, 'CaPackingListOrg' => 29, 'CaDocumentOrg' => 30, 'CaOcOrg' => 31, 'CaOthersDocsOrg' => 32, 'CaInvoiceCps' => 33, 'CaPackingListCps' => 34, 'CaDocumentCps' => 35, 'CaOcCps' => 36, 'CaOthersDocsCps' => 37, 'CaFinalPort' => 38, 'CaAlterPort' => 39, 'CaLimitDate' => 40, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc' => 0, 'caBeginWindow' => 1, 'caEndWindow' => 2, 'caCommodities' => 3, 'caPartial' => 4, 'caPaymentTerms' => 5, 'caIncoterms' => 6, 'caContainerType' => 7, 'caUtv' => 8, 'caEtv' => 9, 'caLine' => 10, 'caContactLine' => 11, 'caContactImporter' => 12, 'caUppo' => 13, 'caEb' => 14, 'caEdd' => 15, 'caPort' => 16, 'caTransshipment' => 17, 'caTransshipmentPort' => 18, 'caShippingOrg' => 19, 'caOriginalOrg' => 20, 'caFwdCopyOrg' => 21, 'caFcrOrg' => 22, 'caShippingDst' => 23, 'caOriginalDst' => 24, 'caFwdCopyDst' => 25, 'caFcrDst' => 26, 'caTransportVia' => 27, 'caInvoiceOrg' => 28, 'caPackingListOrg' => 29, 'caDocumentOrg' => 30, 'caOcOrg' => 31, 'caOthersDocsOrg' => 32, 'caInvoiceCps' => 33, 'caPackingListCps' => 34, 'caDocumentCps' => 35, 'caOcCps' => 36, 'caOthersDocsCps' => 37, 'caFinalPort' => 38, 'caAlterPort' => 39, 'caLimitDate' => 40, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC => 0, self::CA_BEGIN_WINDOW => 1, self::CA_END_WINDOW => 2, self::CA_COMMODITIES => 3, self::CA_PARTIAL => 4, self::CA_PAYMENT_TERMS => 5, self::CA_INCOTERMS => 6, self::CA_CONTAINER_TYPE => 7, self::CA_UTV => 8, self::CA_ETV => 9, self::CA_LINE => 10, self::CA_CONTACT_LINE => 11, self::CA_CONTACT_IMPORTER => 12, self::CA_UPPO => 13, self::CA_EB => 14, self::CA_EDD => 15, self::CA_PORT => 16, self::CA_TRANSSHIPMENT => 17, self::CA_TRANSSHIPMENT_PORT => 18, self::CA_SHIPPING_ORG => 19, self::CA_ORIGINAL_ORG => 20, self::CA_FWD_COPY_ORG => 21, self::CA_FCR_ORG => 22, self::CA_SHIPPING_DST => 23, self::CA_ORIGINAL_DST => 24, self::CA_FWD_COPY_DST => 25, self::CA_FCR_DST => 26, self::CA_TRANSPORT_VIA => 27, self::CA_INVOICE_ORG => 28, self::CA_PACKING_LIST_ORG => 29, self::CA_DOCUMENT_ORG => 30, self::CA_OC_ORG => 31, self::CA_OTHERS_DOCS_ORG => 32, self::CA_INVOICE_CPS => 33, self::CA_PACKING_LIST_CPS => 34, self::CA_DOCUMENT_CPS => 35, self::CA_OC_CPS => 36, self::CA_OTHERS_DOCS_CPS => 37, self::CA_FINAL_PORT => 38, self::CA_ALTER_PORT => 39, self::CA_LIMIT_DATE => 40, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_begin_window' => 1, 'ca_end_window' => 2, 'ca_commodities' => 3, 'ca_partial' => 4, 'ca_payment_terms' => 5, 'ca_incoterms' => 6, 'ca_container_type' => 7, 'ca_utv' => 8, 'ca_etv' => 9, 'ca_line' => 10, 'ca_contact_line' => 11, 'ca_contact_importer' => 12, 'ca_uppo' => 13, 'ca_eb' => 14, 'ca_edd' => 15, 'ca_port' => 16, 'ca_transshipment' => 17, 'ca_transshipment_port' => 18, 'ca_shipping_org' => 19, 'ca_original_org' => 20, 'ca_fwd_copy_org' => 21, 'ca_fcr_org' => 22, 'ca_shipping_dst' => 23, 'ca_original_dst' => 24, 'ca_fwd_copy_dst' => 25, 'ca_fcr_dst' => 26, 'ca_transport_via' => 27, 'ca_invoice_org' => 28, 'ca_packing_list_org' => 29, 'ca_document_org' => 30, 'ca_oc_org' => 31, 'ca_others_docs_org' => 32, 'ca_invoice_cps' => 33, 'ca_packing_list_cps' => 34, 'ca_document_cps' => 35, 'ca_oc_cps' => 36, 'ca_others_docs_cps' => 37, 'ca_final_port' => 38, 'ca_alter_port' => 39, 'ca_limit_date' => 40, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FalaShipmentInfoMapBuilder();
		}
		return self::$mapBuilder;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(FalaShipmentInfoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
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

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaShipmentInfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaShipmentInfoPeer', $criteria, $con);
    }


				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = FalaShipmentInfoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FalaShipmentInfoPeer::populateObjects(FalaShipmentInfoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseFalaShipmentInfoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(FalaShipmentInfo $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIddoc();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FalaShipmentInfo) {
				$key = (string) $value->getCaIddoc();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FalaShipmentInfo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = FalaShipmentInfoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FalaShipmentInfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FalaShipmentInfoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FalaShipmentInfoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinFalaHeader(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaShipmentInfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FalaShipmentInfoPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);


    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaShipmentInfoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinFalaHeader(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseFalaShipmentInfoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaShipmentInfoPeer::addSelectColumns($c);
		$startcol = (FalaShipmentInfoPeer::NUM_COLUMNS - FalaShipmentInfoPeer::NUM_LAZY_LOAD_COLUMNS);
		FalaHeaderPeer::addSelectColumns($c);

		$c->addJoin(array(FalaShipmentInfoPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FalaShipmentInfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FalaShipmentInfoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = FalaShipmentInfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FalaShipmentInfoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = FalaHeaderPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = FalaHeaderPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FalaHeaderPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					FalaHeaderPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->setFalaShipmentInfo($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaShipmentInfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FalaShipmentInfoPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);

    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaShipmentInfoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseFalaShipmentInfoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaShipmentInfoPeer::addSelectColumns($c);
		$startcol2 = (FalaShipmentInfoPeer::NUM_COLUMNS - FalaShipmentInfoPeer::NUM_LAZY_LOAD_COLUMNS);

		FalaHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (FalaHeaderPeer::NUM_COLUMNS - FalaHeaderPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(FalaShipmentInfoPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FalaShipmentInfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FalaShipmentInfoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = FalaShipmentInfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FalaShipmentInfoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = FalaHeaderPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = FalaHeaderPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FalaHeaderPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FalaHeaderPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj1->setFalaHeader($obj2);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return FalaShipmentInfoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFalaShipmentInfoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFalaShipmentInfoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFalaShipmentInfoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FalaShipmentInfoPeer::CA_IDDOC);
			$selectCriteria->add(FalaShipmentInfoPeer::CA_IDDOC, $criteria->remove(FalaShipmentInfoPeer::CA_IDDOC), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFalaShipmentInfoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFalaShipmentInfoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FalaShipmentInfoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												FalaShipmentInfoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof FalaShipmentInfo) {
						FalaShipmentInfoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								FalaShipmentInfoPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(FalaShipmentInfo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FalaShipmentInfoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FalaShipmentInfoPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
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
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = FalaShipmentInfoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(FalaShipmentInfoPeer::DATABASE_NAME);
		$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $pk);

		$v = FalaShipmentInfoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(FalaShipmentInfoPeer::DATABASE_NAME);
			$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $pks, Criteria::IN);
			$objs = FalaShipmentInfoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseFalaShipmentInfoPeer::DATABASE_NAME)->addTableBuilder(BaseFalaShipmentInfoPeer::TABLE_NAME, BaseFalaShipmentInfoPeer::getMapBuilder());

