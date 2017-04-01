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
 * Représente un paiement récurrent
 * Un paiement simple contient :
 * - 1 objet paramètres HIPAY_MAPI_PaymentParams
 * - 1 objet order pour le premier paiement HIPAY_MAPI_Order
 * - 1 objet installment pour le premier paiement HIPAY_MAPI_Installment
 * - 1 objet order pour le second paiement HIPAY_MAPI_Order
 * - 1 objet installment pour le second paiement HIPAY_MAPI_Installment
 *
 */

class HIPAY_MAPI_MultiplePayment extends HIPAY_MAPI_Payment {
	function __construct(HIPAY_MAPI_PaymentParams $paymentParams,HIPAY_MAPI_Order $firstOrder,HIPAY_MAPI_Installment $firstInstallment,HIPAY_MAPI_Order $nextOrder,HIPAY_MAPI_Installment $nextInstallment) {
		if ($firstInstallment->getFirst()===$nextInstallment->getFirst() || !$firstInstallment->getFirst()) {
			throw new Exception('Vous devez définir un objet installment pour le premier et les paiements suivants');
		}
		$firstInstallment->setDelayTS();
		$nextInstallment->setDelayTS( $firstInstallment->getDelayTS() );
		try {
			parent::__construct($paymentParams,array($firstOrder,$nextOrder),array($firstInstallment,$nextInstallment));
		} catch(Exception $e) {
			throw new Exception($e->getMessage());
		}

	}
	
	/**
	 * Retourne le montant total de la somme devant être
	 * distribuée aux affiliés
	 */
	protected function _getTotalAmountForAffiliates($installement_nr) {
		$affiliates=$this->order[0]->getAffiliate();
		if (!HIPAY_MAPI_UTILS::is_an_array_of($affiliates,'HIPAY_MAPI_Affiliate'))
			return false;
		$total_aff = 0;	
		foreach($affiliates as $aff) {
			$total_aff+=$aff->getAmount();
		}
		return $total_aff;
	}
	
	
}
?>