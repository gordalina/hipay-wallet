<?php
/**
 * Hipay
 *
 * NOTICE OF LICENSE
 *
 * Copyright (c) 2010, HPME - HI-MEDIA PORTE MONNAIE ELECTRONIQUE (Groupe Hi-Media, Seed Factory, 19 Avenue des Volontaires, 1160 Bruxelles - Belgium)
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 * 
 *  - Redistributions of source code must retain the above copyright notice, 
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice, 
 *    this list of conditions and the following disclaimer in the documentation 
 *    and/or other materials provided with the distribution.
 *  - Neither the name of the Hipay and HPME - HI-MEDIA PORTE MONNAIE ELECTRONIQUE 
 *    nor the names of its contributors may be used to endorse or promote products 
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Paymentnetwork
 * @package    Paymentnetwork_Hipay
 * @copyright  Copyright (c) 2010 HPME - HI-MEDIA PORTE MONNAIE ELECTRONIQUE
 * @license    http://www.opensource.org/licenses/bsd-license.php  The BSD License
 */ 

/**
 * Objet représentant un affilié
 * montant de base : montant à partir duquel est calculé le montant qui sera distribué à l'affilié
 * cible : si l'affiliation est un piurcentage, la cible indique sur quels montant de la transaction
 * s'applique ce pourcentage
 * montant calculé : montant reversé à l'affilié
 *
 *
 */
class HIPAY_MAPI_Affiliate extends HIPAY_MAPI_lockable {
	/**
	 * Numéro de client
	 *
	 * @var int
	 */
	protected $customerId;

	/**
	 * Numéro de compte
	 *
	 * @var unknown_type
	 */
	protected $accountId;

	/**
	 * Valeur de l'affiliation (montant fixe ou pourcentage)
	 *
	 * @var float
	 */
	protected $val;

	/**
	 * Si >0, $val est un pourcentage et $percentageTarget détermine
	 * sur quels montants appliquer le pourcentage
	 *
	 * @var unknown_type
	 */
	protected $percentageTarget;

	/**
	 * Montant à reversé à l'affilié
	 *
	 * @var unknown_type
	 */
	protected $_amount;

	/**
	 * Montant de base sur lequel est calculé le montant
	 * reversé à l'affilié
	 *
	 * @var unknown_type
	 */
	protected $_baseAmount;


	/**
	 * Assigne le numéro de client
	 *
	 * @param int $customerId
	 * @return boolean
	 */
	public function setCustomerId($customerId) {
		if ($this->_locked)
			return false;

		$customerId = (int)$customerId;
		if ($customerId<=0)
			return false;
		$this->customerId = $customerId;
		return true;
	}

	/**
	 * Retourne le numéro de client
	 *
	 * @return int
	 */
	public function getCustomerId() {
		return $this->customerId;
	}

	/**
	 * Assigne le numéro de compte
	 *
	 * @param int $accountId
	 * @return boolean
	 */
	public function setAccountId($accountId) {
		if ($this->_locked)
			return false;

		$accountId = (int)$accountId;
		if ($accountId<=0)
			return false;
		$this->accountId = $accountId;
		return true;
	}

	/**
	 * Retourne le numéro de compte
	 *
	 * @return int
	 */
	public function getAccountId() {
		return $this->accountId;
	}

	/**
	 * Assigne le valeur de l'affiliation, qui est un montant fixe ou un pourcentage
	 * S'il s'agit d'un pourcentage, $percentageTarget représente la cible, c'est à dire sur quels
	 * montants est basé le montant de l'affiliation
	 *
	 * @param float $val
	 * @param int $percentageTarget
	 * @return boolean
	 */
	public function setValue($val,$percentageTarget=0) {
		if ($this->_locked)
			return false;

		$val = sprintf('%.02f',(float)$val);
		$percentageTarget = (int)$percentageTarget;
		if ($val<=0 || $percentageTarget<0)
			return false;
		if ($percentageTarget>0 && $val>100)
			return false;
		if ($percentageTarget>0 && $percentageTarget>HIPAY_MAPI_TTARGET_ALL)
			return false;
		$this->val = $val;
		$this->percentageTarget = $percentageTarget;
		$this->setAmount();
		return true;
	}

	/**
	 * Retourne la valeur de l'affiliation
	 *
	 * @return float
	 */
	public function getValue() {
		return $this->val;
	}

	/**
	 * Retourne sur quoi s'applique le pourcentage
	 *
	 * @return int
	 */
	public function getPercentageTarget() {
		return $this->percentageTarget;
	}

	/**
	 * Assigne le montant sur lequel sera calculé l'affiliation
	 *
	 * @param float $baseAmount
	 * @return boolean
	 */
	public function setBaseAmount($baseAmount) {
		if ($this->_locked)
			return false;

		$baseAmount = sprintf('%.02f',(float)$baseAmount);

		if ($baseAmount<0)
			return false;
		$this->_baseAmount = $baseAmount;
		$this->setAmount();
		return true;
	}

	/**
	 * Retourne le montant sur lequel sera calculé l'affiliation
	 *
	 * @return int
	 */
	public function getBaseAmount() {
		return $this->_baseAmount;
	}


	/**
	 * Retourne le montant calculé de l'affiliation
	 *
	 * @return float
	 */
	public function getAmount() {
		return $this->_amount;
	}

	/**
	 * Assigne le montant calculé de l'affiliation
	 *
	 */
	protected function setAmount() {
		if ($this->percentageTarget>0) {
			$this->_amount = sprintf('%.02f',($this->_baseAmount/100)*$this->val);
		} else {
			$this->_amount = sprintf('%.02f',$this->_baseAmount);
		}
	}

	/**
	 * Vérifie que l'objet est bien initialisé
	 *
	 * @return boolean
	 */
	public function check() {
		if ($this->customerId<=0 || $this->accountId<=0 || $this->val<=0 || $this->percentageTarget<0)
			throw new Exception('Numéro de client, numéro de compte, valeur ou cible incorrects');
		return true;
	}

	protected function init() {
		$this->customerId = 0;
		$this->accountId = 0;
		$this->_amount = 0;
		$this->_baseAmount = 0;
		$this->val = 0;
		$this->percentageTarget = 0;
	}


	function __construct() {
		$this->init();
		parent::__construct();
	}
}
?>