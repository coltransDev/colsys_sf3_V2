<?php


abstract class BaseEmail extends BaseObject  implements Persistent {


  const PEER = 'EmailPeer';

	
	protected static $peer;

	
	protected $ca_idemail;

	
	protected $ca_fchenvio;

	
	protected $ca_usuenvio;

	
	protected $ca_tipo;

	
	protected $ca_idcaso;

	
	protected $ca_from;

	
	protected $ca_fromname;

	
	protected $ca_cc;

	
	protected $ca_replyto;

	
	protected $ca_address;

	
	protected $ca_attachment;

	
	protected $ca_subject;

	
	protected $ca_body;

	
	protected $ca_bodyhtml;

	
	protected $ca_readreceipt;

	
	protected $collEmailAttachments;

	
	private $lastEmailAttachmentCriteria = null;

	
	protected $collNotificacions;

	
	private $lastNotificacionCriteria = null;

	
	protected $collRepStatuss;

	
	private $lastRepStatusCriteria = null;

	
	protected $collInoAvisosSeas;

	
	private $lastInoAvisosSeaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getCaIdemail()
	{
		return $this->ca_idemail;
	}

	
	public function getCaFchenvio($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchenvio === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchenvio);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchenvio, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuenvio()
	{
		return $this->ca_usuenvio;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaIdcaso()
	{
		return $this->ca_idcaso;
	}

	
	public function getCaFrom()
	{
		return $this->ca_from;
	}

	
	public function getCaFromname()
	{
		return $this->ca_fromname;
	}

	
	public function getCaCc()
	{
		return $this->ca_cc;
	}

	
	public function getCaReplyto()
	{
		return $this->ca_replyto;
	}

	
	public function getCaAddress()
	{
		return $this->ca_address;
	}

	
	public function getCaAttachment()
	{
		return $this->ca_attachment;
	}

	
	public function getCaSubject()
	{
		return $this->ca_subject;
	}

	
	public function getCaBody()
	{
		return $this->ca_body;
	}

	
	public function getCaBodyhtml()
	{
		return $this->ca_bodyhtml;
	}

	
	public function getCaReadreceipt()
	{
		return $this->ca_readreceipt;
	}

	
	public function setCaIdemail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = EmailPeer::CA_IDEMAIL;
		}

		return $this;
	} 
	
	public function setCaFchenvio($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchenvio !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchenvio !== null && $tmpDt = new DateTime($this->ca_fchenvio)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchenvio = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = EmailPeer::CA_FCHENVIO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuenvio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuenvio !== $v) {
			$this->ca_usuenvio = $v;
			$this->modifiedColumns[] = EmailPeer::CA_USUENVIO;
		}

		return $this;
	} 
	
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = EmailPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaIdcaso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcaso !== $v) {
			$this->ca_idcaso = $v;
			$this->modifiedColumns[] = EmailPeer::CA_IDCASO;
		}

		return $this;
	} 
	
	public function setCaFrom($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_from !== $v) {
			$this->ca_from = $v;
			$this->modifiedColumns[] = EmailPeer::CA_FROM;
		}

		return $this;
	} 
	
	public function setCaFromname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fromname !== $v) {
			$this->ca_fromname = $v;
			$this->modifiedColumns[] = EmailPeer::CA_FROMNAME;
		}

		return $this;
	} 
	
	public function setCaCc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cc !== $v) {
			$this->ca_cc = $v;
			$this->modifiedColumns[] = EmailPeer::CA_CC;
		}

		return $this;
	} 
	
	public function setCaReplyto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_replyto !== $v) {
			$this->ca_replyto = $v;
			$this->modifiedColumns[] = EmailPeer::CA_REPLYTO;
		}

		return $this;
	} 
	
	public function setCaAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_address !== $v) {
			$this->ca_address = $v;
			$this->modifiedColumns[] = EmailPeer::CA_ADDRESS;
		}

		return $this;
	} 
	
	public function setCaAttachment($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_attachment !== $v) {
			$this->ca_attachment = $v;
			$this->modifiedColumns[] = EmailPeer::CA_ATTACHMENT;
		}

		return $this;
	} 
	
	public function setCaSubject($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_subject !== $v) {
			$this->ca_subject = $v;
			$this->modifiedColumns[] = EmailPeer::CA_SUBJECT;
		}

		return $this;
	} 
	
	public function setCaBody($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_body !== $v) {
			$this->ca_body = $v;
			$this->modifiedColumns[] = EmailPeer::CA_BODY;
		}

		return $this;
	} 
	
	public function setCaBodyhtml($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_bodyhtml !== $v) {
			$this->ca_bodyhtml = $v;
			$this->modifiedColumns[] = EmailPeer::CA_BODYHTML;
		}

		return $this;
	} 
	
	public function setCaReadreceipt($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_readreceipt !== $v) {
			$this->ca_readreceipt = $v;
			$this->modifiedColumns[] = EmailPeer::CA_READRECEIPT;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_idemail = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_fchenvio = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_usuenvio = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_tipo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idcaso = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_from = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fromname = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_cc = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_replyto = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_address = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_attachment = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_subject = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_body = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_bodyhtml = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_readreceipt = ($row[$startcol + 14] !== null) ? (boolean) $row[$startcol + 14] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Email object", $e);
		}
	}

	
	public function ensureConsistency()
	{

	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = EmailPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collEmailAttachments = null;
			$this->lastEmailAttachmentCriteria = null;

			$this->collNotificacions = null;
			$this->lastNotificacionCriteria = null;

			$this->collRepStatuss = null;
			$this->lastRepStatusCriteria = null;

			$this->collInoAvisosSeas = null;
			$this->lastInoAvisosSeaCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmail:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			EmailPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseEmail:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmail:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseEmail:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			EmailPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = EmailPeer::CA_IDEMAIL;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdemail($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EmailPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collEmailAttachments !== null) {
				foreach ($this->collEmailAttachments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotificacions !== null) {
				foreach ($this->collNotificacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepStatuss !== null) {
				foreach ($this->collRepStatuss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoAvisosSeas !== null) {
				foreach ($this->collInoAvisosSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = EmailPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEmailAttachments !== null) {
					foreach ($this->collEmailAttachments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotificacions !== null) {
					foreach ($this->collNotificacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepStatuss !== null) {
					foreach ($this->collRepStatuss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoAvisosSeas !== null) {
					foreach ($this->collInoAvisosSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdemail();
				break;
			case 1:
				return $this->getCaFchenvio();
				break;
			case 2:
				return $this->getCaUsuenvio();
				break;
			case 3:
				return $this->getCaTipo();
				break;
			case 4:
				return $this->getCaIdcaso();
				break;
			case 5:
				return $this->getCaFrom();
				break;
			case 6:
				return $this->getCaFromname();
				break;
			case 7:
				return $this->getCaCc();
				break;
			case 8:
				return $this->getCaReplyto();
				break;
			case 9:
				return $this->getCaAddress();
				break;
			case 10:
				return $this->getCaAttachment();
				break;
			case 11:
				return $this->getCaSubject();
				break;
			case 12:
				return $this->getCaBody();
				break;
			case 13:
				return $this->getCaBodyhtml();
				break;
			case 14:
				return $this->getCaReadreceipt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = EmailPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdemail(),
			$keys[1] => $this->getCaFchenvio(),
			$keys[2] => $this->getCaUsuenvio(),
			$keys[3] => $this->getCaTipo(),
			$keys[4] => $this->getCaIdcaso(),
			$keys[5] => $this->getCaFrom(),
			$keys[6] => $this->getCaFromname(),
			$keys[7] => $this->getCaCc(),
			$keys[8] => $this->getCaReplyto(),
			$keys[9] => $this->getCaAddress(),
			$keys[10] => $this->getCaAttachment(),
			$keys[11] => $this->getCaSubject(),
			$keys[12] => $this->getCaBody(),
			$keys[13] => $this->getCaBodyhtml(),
			$keys[14] => $this->getCaReadreceipt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdemail($value);
				break;
			case 1:
				$this->setCaFchenvio($value);
				break;
			case 2:
				$this->setCaUsuenvio($value);
				break;
			case 3:
				$this->setCaTipo($value);
				break;
			case 4:
				$this->setCaIdcaso($value);
				break;
			case 5:
				$this->setCaFrom($value);
				break;
			case 6:
				$this->setCaFromname($value);
				break;
			case 7:
				$this->setCaCc($value);
				break;
			case 8:
				$this->setCaReplyto($value);
				break;
			case 9:
				$this->setCaAddress($value);
				break;
			case 10:
				$this->setCaAttachment($value);
				break;
			case 11:
				$this->setCaSubject($value);
				break;
			case 12:
				$this->setCaBody($value);
				break;
			case 13:
				$this->setCaBodyhtml($value);
				break;
			case 14:
				$this->setCaReadreceipt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdemail($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchenvio($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUsuenvio($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTipo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcaso($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFrom($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFromname($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaCc($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaReplyto($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaAddress($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaAttachment($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaSubject($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaBody($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaBodyhtml($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaReadreceipt($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailPeer::CA_IDEMAIL)) $criteria->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(EmailPeer::CA_FCHENVIO)) $criteria->add(EmailPeer::CA_FCHENVIO, $this->ca_fchenvio);
		if ($this->isColumnModified(EmailPeer::CA_USUENVIO)) $criteria->add(EmailPeer::CA_USUENVIO, $this->ca_usuenvio);
		if ($this->isColumnModified(EmailPeer::CA_TIPO)) $criteria->add(EmailPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(EmailPeer::CA_IDCASO)) $criteria->add(EmailPeer::CA_IDCASO, $this->ca_idcaso);
		if ($this->isColumnModified(EmailPeer::CA_FROM)) $criteria->add(EmailPeer::CA_FROM, $this->ca_from);
		if ($this->isColumnModified(EmailPeer::CA_FROMNAME)) $criteria->add(EmailPeer::CA_FROMNAME, $this->ca_fromname);
		if ($this->isColumnModified(EmailPeer::CA_CC)) $criteria->add(EmailPeer::CA_CC, $this->ca_cc);
		if ($this->isColumnModified(EmailPeer::CA_REPLYTO)) $criteria->add(EmailPeer::CA_REPLYTO, $this->ca_replyto);
		if ($this->isColumnModified(EmailPeer::CA_ADDRESS)) $criteria->add(EmailPeer::CA_ADDRESS, $this->ca_address);
		if ($this->isColumnModified(EmailPeer::CA_ATTACHMENT)) $criteria->add(EmailPeer::CA_ATTACHMENT, $this->ca_attachment);
		if ($this->isColumnModified(EmailPeer::CA_SUBJECT)) $criteria->add(EmailPeer::CA_SUBJECT, $this->ca_subject);
		if ($this->isColumnModified(EmailPeer::CA_BODY)) $criteria->add(EmailPeer::CA_BODY, $this->ca_body);
		if ($this->isColumnModified(EmailPeer::CA_BODYHTML)) $criteria->add(EmailPeer::CA_BODYHTML, $this->ca_bodyhtml);
		if ($this->isColumnModified(EmailPeer::CA_READRECEIPT)) $criteria->add(EmailPeer::CA_READRECEIPT, $this->ca_readreceipt);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailPeer::DATABASE_NAME);

		$criteria->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdemail();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdemail($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchenvio($this->ca_fchenvio);

		$copyObj->setCaUsuenvio($this->ca_usuenvio);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaIdcaso($this->ca_idcaso);

		$copyObj->setCaFrom($this->ca_from);

		$copyObj->setCaFromname($this->ca_fromname);

		$copyObj->setCaCc($this->ca_cc);

		$copyObj->setCaReplyto($this->ca_replyto);

		$copyObj->setCaAddress($this->ca_address);

		$copyObj->setCaAttachment($this->ca_attachment);

		$copyObj->setCaSubject($this->ca_subject);

		$copyObj->setCaBody($this->ca_body);

		$copyObj->setCaBodyhtml($this->ca_bodyhtml);

		$copyObj->setCaReadreceipt($this->ca_readreceipt);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getEmailAttachments() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addEmailAttachment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getNotificacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addNotificacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepStatuss() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepStatus($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoAvisosSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoAvisosSea($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdemail(NULL); 
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
			self::$peer = new EmailPeer();
		}
		return self::$peer;
	}

	
	public function clearEmailAttachments()
	{
		$this->collEmailAttachments = null; 	}

	
	public function initEmailAttachments()
	{
		$this->collEmailAttachments = array();
	}

	
	public function getEmailAttachments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailAttachments === null) {
			if ($this->isNew()) {
			   $this->collEmailAttachments = array();
			} else {

				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);

				EmailAttachmentPeer::addSelectColumns($criteria);
				$this->collEmailAttachments = EmailAttachmentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);

				EmailAttachmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailAttachmentCriteria) || !$this->lastEmailAttachmentCriteria->equals($criteria)) {
					$this->collEmailAttachments = EmailAttachmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailAttachmentCriteria = $criteria;
		return $this->collEmailAttachments;
	}

	
	public function countEmailAttachments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collEmailAttachments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);

				$count = EmailAttachmentPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);

				if (!isset($this->lastEmailAttachmentCriteria) || !$this->lastEmailAttachmentCriteria->equals($criteria)) {
					$count = EmailAttachmentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collEmailAttachments);
				}
			} else {
				$count = count($this->collEmailAttachments);
			}
		}
		return $count;
	}

	
	public function addEmailAttachment(EmailAttachment $l)
	{
		if ($this->collEmailAttachments === null) {
			$this->initEmailAttachments();
		}
		if (!in_array($l, $this->collEmailAttachments, true)) { 			array_push($this->collEmailAttachments, $l);
			$l->setEmail($this);
		}
	}

	
	public function clearNotificacions()
	{
		$this->collNotificacions = null; 	}

	
	public function initNotificacions()
	{
		$this->collNotificacions = array();
	}

	
	public function getNotificacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
			   $this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::CA_IDEMAIL, $this->ca_idemail);

				NotificacionPeer::addSelectColumns($criteria);
				$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificacionPeer::CA_IDEMAIL, $this->ca_idemail);

				NotificacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificacionCriteria = $criteria;
		return $this->collNotificacions;
	}

	
	public function countNotificacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NotificacionPeer::CA_IDEMAIL, $this->ca_idemail);

				$count = NotificacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificacionPeer::CA_IDEMAIL, $this->ca_idemail);

				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$count = NotificacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNotificacions);
				}
			} else {
				$count = count($this->collNotificacions);
			}
		}
		return $count;
	}

	
	public function addNotificacion(Notificacion $l)
	{
		if ($this->collNotificacions === null) {
			$this->initNotificacions();
		}
		if (!in_array($l, $this->collNotificacions, true)) { 			array_push($this->collNotificacions, $l);
			$l->setEmail($this);
		}
	}


	
	public function getNotificacionsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::CA_IDEMAIL, $this->ca_idemail);

				$this->collNotificacions = NotificacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(NotificacionPeer::CA_IDEMAIL, $this->ca_idemail);

			if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
				$this->collNotificacions = NotificacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastNotificacionCriteria = $criteria;

		return $this->collNotificacions;
	}

	
	public function clearRepStatuss()
	{
		$this->collRepStatuss = null; 	}

	
	public function initRepStatuss()
	{
		$this->collRepStatuss = array();
	}

	
	public function getRepStatuss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
			   $this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				RepStatusPeer::addSelectColumns($criteria);
				$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				RepStatusPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusCriteria = $criteria;
		return $this->collRepStatuss;
	}

	
	public function countRepStatuss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				$count = RepStatusPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$count = RepStatusPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepStatuss);
				}
			} else {
				$count = count($this->collRepStatuss);
			}
		}
		return $count;
	}

	
	public function addRepStatus(RepStatus $l)
	{
		if ($this->collRepStatuss === null) {
			$this->initRepStatuss();
		}
		if (!in_array($l, $this->collRepStatuss, true)) { 			array_push($this->collRepStatuss, $l);
			$l->setEmail($this);
		}
	}


	
	public function getRepStatussJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}


	
	public function getRepStatussJoinTrackingEtapa($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}

	
	public function clearInoAvisosSeas()
	{
		$this->collInoAvisosSeas = null; 	}

	
	public function initInoAvisosSeas()
	{
		$this->collInoAvisosSeas = array();
	}

	
	public function getInoAvisosSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;
		return $this->collInoAvisosSeas;
	}

	
	public function countInoAvisosSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

				$count = InoAvisosSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$count = InoAvisosSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoAvisosSeas);
				}
			} else {
				$count = count($this->collInoAvisosSeas);
			}
		}
		return $count;
	}

	
	public function addInoAvisosSea(InoAvisosSea $l)
	{
		if ($this->collInoAvisosSeas === null) {
			$this->initInoAvisosSeas();
		}
		if (!in_array($l, $this->collInoAvisosSeas, true)) { 			array_push($this->collInoAvisosSeas, $l);
			$l->setEmail($this);
		}
	}


	
	public function getInoAvisosSeasJoinInoClientesSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoClientesSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoClientesSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	
	public function getInoAvisosSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	
	public function getInoAvisosSeasJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collEmailAttachments) {
				foreach ((array) $this->collEmailAttachments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collNotificacions) {
				foreach ((array) $this->collNotificacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepStatuss) {
				foreach ((array) $this->collRepStatuss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoAvisosSeas) {
				foreach ((array) $this->collInoAvisosSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collEmailAttachments = null;
		$this->collNotificacions = null;
		$this->collRepStatuss = null;
		$this->collInoAvisosSeas = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseEmail:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseEmail::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 