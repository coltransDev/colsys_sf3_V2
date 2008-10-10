<?php

/**
 * Subclass for representing a row from the 'tb_pricrecargosxconcepto' table.
 *
 * 
 *
 * @package lib.model.pricing
 */ 
class PricRecargoxConcepto extends BasePricRecargoxConcepto
{
	/**
	 * Get the associated Concepto object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Concepto The associated Concepto object.
	 * @throws     PropelException
	 */
	public function getConcepto($con = null)
	{
		if ($this->aConcepto === null && ($this->ca_idconcepto !== null)) {
			// include the related Peer class
			$this->aConcepto = ConceptoPeer::retrieveByPK($this->ca_idconcepto, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptoPeer::retrieveByPK($this->ca_idconcepto, $con);
			   $obj->addConceptos($this);
			 */
		}
		return $this->aConcepto;
	}
	
	/**
	 * Get the associated Trayecto object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Trayecto The associated Trayecto object.
	 * @throws     PropelException
	 */
	public function getTrayecto($con = null)
	{
		if ($this->aTrayecto === null && ($this->ca_idtrayecto !== null)) {
			// include the related Peer class
			$this->aTrayecto = TrayectoPeer::retrieveByPK($this->ca_idtrayecto, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TrayectoPeer::retrieveByPK($this->ca_idtrayecto, $con);
			   $obj->addTrayectos($this);
			 */
		}
		return $this->aTrayecto;
	}
}
