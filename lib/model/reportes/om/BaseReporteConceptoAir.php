<?php


abstract class BaseReporteConceptoAir extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $oid;


	
	protected $ca_idreporte;


	
	protected $ca_idconcepto;


	
	protected $ca_reportar_tar;


	
	protected $ca_reportar_min;


	
	protected $ca_reportar_idm;


	
	protected $ca_cobrar_tar;


	
	protected $ca_cobrar_min;


	
	protected $ca_cobrar_idm;

	
	protected $aReporte;

	
	protected $aConcepto;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getOid()
	{

		return $this->oid;
	}

	
	public function getCaIdreporte()
	{

		return $this->ca_idreporte;
	}

	
	public function getCaIdconcepto()
	{

		return $this->ca_idconcepto;
	}

	
	public function getCaReportarTar()
	{

		return $this->ca_reportar_tar;
	}

	
	public function getCaReportarMin()
	{

		return $this->ca_reportar_min;
	}

	
	public function getCaReportarIdm()
	{

		return $this->ca_reportar_idm;
	}

	
	public function getCaCobrarTar()
	{

		return $this->ca_cobrar_tar;
	}

	
	public function getCaCobrarMin()
	{

		return $this->ca_cobrar_min;
	}

	
	public function getCaCobrarIdm()
	{

		return $this->ca_cobrar_idm;
	}

	
	public function setOid($v)
	{

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::OID;
		}

	} 
	
	public function setCaIdreporte($v)
	{

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

	} 
	
	public function setCaIdconcepto($v)
	{

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

	} 
	
	public function setCaReportarTar($v)
	{

		if ($this->ca_reportar_tar !== $v) {
			$this->ca_reportar_tar = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::CA_REPORTAR_TAR;
		}

	} 
	
	public function setCaReportarMin($v)
	{

		if ($this->ca_reportar_min !== $v) {
			$this->ca_reportar_min = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::CA_REPORTAR_MIN;
		}

	} 
	
	public function setCaReportarIdm($v)
	{

		if ($this->ca_reportar_idm !== $v) {
			$this->ca_reportar_idm = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::CA_REPORTAR_IDM;
		}

	} 
	
	public function setCaCobrarTar($v)
	{

		if ($this->ca_cobrar_tar !== $v) {
			$this->ca_cobrar_tar = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::CA_COBRAR_TAR;
		}

	} 
	
	public function setCaCobrarMin($v)
	{

		if ($this->ca_cobrar_min !== $v) {
			$this->ca_cobrar_min = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::CA_COBRAR_MIN;
		}

	} 
	
	public function setCaCobrarIdm($v)
	{

		if ($this->ca_cobrar_idm !== $v) {
			$this->ca_cobrar_idm = $v;
			$this->modifiedColumns[] = ReporteConceptoAirPeer::CA_COBRAR_IDM;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->oid = $rs->getInt($startcol + 0);

			$this->ca_idreporte = $rs->getInt($startcol + 1);

			$this->ca_idconcepto = $rs->getInt($startcol + 2);

			$this->ca_reportar_tar = $rs->getFloat($startcol + 3);

			$this->ca_reportar_min = $rs->getFloat($startcol + 4);

			$this->ca_reportar_idm = $rs->getString($startcol + 5);

			$this->ca_cobrar_tar = $rs->getFloat($startcol + 6);

			$this->ca_cobrar_min = $rs->getFloat($startcol + 7);

			$this->ca_cobrar_idm = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ReporteConceptoAir object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReporteConceptoAirPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ReporteConceptoAirPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReporteConceptoAirPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ReporteConceptoAirPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ReporteConceptoAirPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aReporte !== null) {
				if (!$this->aReporte->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aReporte->getValidationFailures());
				}
			}

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = ReporteConceptoAirPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReporteConceptoAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getOid();
				break;
			case 1:
				return $this->getCaIdreporte();
				break;
			case 2:
				return $this->getCaIdconcepto();
				break;
			case 3:
				return $this->getCaReportarTar();
				break;
			case 4:
				return $this->getCaReportarMin();
				break;
			case 5:
				return $this->getCaReportarIdm();
				break;
			case 6:
				return $this->getCaCobrarTar();
				break;
			case 7:
				return $this->getCaCobrarMin();
				break;
			case 8:
				return $this->getCaCobrarIdm();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ReporteConceptoAirPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdreporte(),
			$keys[2] => $this->getCaIdconcepto(),
			$keys[3] => $this->getCaReportarTar(),
			$keys[4] => $this->getCaReportarMin(),
			$keys[5] => $this->getCaReportarIdm(),
			$keys[6] => $this->getCaCobrarTar(),
			$keys[7] => $this->getCaCobrarMin(),
			$keys[8] => $this->getCaCobrarIdm(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReporteConceptoAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setOid($value);
				break;
			case 1:
				$this->setCaIdreporte($value);
				break;
			case 2:
				$this->setCaIdconcepto($value);
				break;
			case 3:
				$this->setCaReportarTar($value);
				break;
			case 4:
				$this->setCaReportarMin($value);
				break;
			case 5:
				$this->setCaReportarIdm($value);
				break;
			case 6:
				$this->setCaCobrarTar($value);
				break;
			case 7:
				$this->setCaCobrarMin($value);
				break;
			case 8:
				$this->setCaCobrarIdm($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ReporteConceptoAirPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdconcepto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaReportarTar($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaReportarMin($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaReportarIdm($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaCobrarTar($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaCobrarMin($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaCobrarIdm($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ReporteConceptoAirPeer::DATABASE_NAME);

		if ($this->isColumnModified(ReporteConceptoAirPeer::OID)) $criteria->add(ReporteConceptoAirPeer::OID, $this->oid);
		if ($this->isColumnModified(ReporteConceptoAirPeer::CA_IDREPORTE)) $criteria->add(ReporteConceptoAirPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(ReporteConceptoAirPeer::CA_IDCONCEPTO)) $criteria->add(ReporteConceptoAirPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(ReporteConceptoAirPeer::CA_REPORTAR_TAR)) $criteria->add(ReporteConceptoAirPeer::CA_REPORTAR_TAR, $this->ca_reportar_tar);
		if ($this->isColumnModified(ReporteConceptoAirPeer::CA_REPORTAR_MIN)) $criteria->add(ReporteConceptoAirPeer::CA_REPORTAR_MIN, $this->ca_reportar_min);
		if ($this->isColumnModified(ReporteConceptoAirPeer::CA_REPORTAR_IDM)) $criteria->add(ReporteConceptoAirPeer::CA_REPORTAR_IDM, $this->ca_reportar_idm);
		if ($this->isColumnModified(ReporteConceptoAirPeer::CA_COBRAR_TAR)) $criteria->add(ReporteConceptoAirPeer::CA_COBRAR_TAR, $this->ca_cobrar_tar);
		if ($this->isColumnModified(ReporteConceptoAirPeer::CA_COBRAR_MIN)) $criteria->add(ReporteConceptoAirPeer::CA_COBRAR_MIN, $this->ca_cobrar_min);
		if ($this->isColumnModified(ReporteConceptoAirPeer::CA_COBRAR_IDM)) $criteria->add(ReporteConceptoAirPeer::CA_COBRAR_IDM, $this->ca_cobrar_idm);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ReporteConceptoAirPeer::DATABASE_NAME);

		$criteria->add(ReporteConceptoAirPeer::OID, $this->oid);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getOid();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setOid($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaReportarTar($this->ca_reportar_tar);

		$copyObj->setCaReportarMin($this->ca_reportar_min);

		$copyObj->setCaReportarIdm($this->ca_reportar_idm);

		$copyObj->setCaCobrarTar($this->ca_cobrar_tar);

		$copyObj->setCaCobrarMin($this->ca_cobrar_min);

		$copyObj->setCaCobrarIdm($this->ca_cobrar_idm);


		$copyObj->setNew(true);

		$copyObj->setOid(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ReporteConceptoAirPeer();
		}
		return self::$peer;
	}

	
	public function setReporte($v)
	{


		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}


		$this->aReporte = $v;
	}


	
	public function getReporte($con = null)
	{
				include_once 'lib/model/reportes/om/BaseReportePeer.php';

		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {

			$this->aReporte = ReportePeer::retrieveByPK($this->ca_idreporte, $con);

			
		}
		return $this->aReporte;
	}

	
	public function setConcepto($v)
	{


		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}


		$this->aConcepto = $v;
	}


	
	public function getConcepto($con = null)
	{
				include_once 'lib/model/public/om/BaseConceptoPeer.php';

		if ($this->aConcepto === null && ($this->ca_idconcepto !== null)) {

			$this->aConcepto = ConceptoPeer::retrieveByPK($this->ca_idconcepto, $con);

			
		}
		return $this->aConcepto;
	}

} 