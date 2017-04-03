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

class HIPAY_MAPI_COMM_XML
{
	/**
	 * Traitement de la réponse de la plateforme après l'envoi du
	 * flux représentant un paiement
	 *
	 * @param string $xml
	 * @param string $url
	 * @param string $err_msg
	 * @return boolean
	 */
	public static function analyzeResponseXML($xml, &$url, &$err_msg)
        {
		$url='';
		$err_msg='';
		try {
			$obj = @new SimpleXMLElement(trim($xml));
		} catch (Exception $e) {
			return false;
		}
		if (isset($obj->result[0]->url)) {
			$url = $obj->result[0]->url;
			return true;
		}
		if (isset($obj->result[0]->message))
			$err_msg = $obj->result[0]->message;

		return false;

	}

	/**
	 * Traitement du flux XML envoyé par HiPay notifiant le résultat d'une action sur une transaction
	 *
	 * @param string $xml
	 * @param string $status
	 * @param string $date
	 * @param string $time
	 * @param string $transid
	 * @param string $origAmount
	 * @param string $origCurrency
	 * @param string $idformerchant
	 * @param array $merchantdatas
         * @param string $emailClient
	 * @param string $subscriptionId
         * @param array $refProduct
	 * @return boolean
	 */
	public static function analyzeNotificationXML($xml,&$operation,&$status,&$date,&$time,&$transid,&$origAmount,&$origCurrency,&$idformerchant,&$merchantdatas,&$emailClient,&$subscriptionId,&$refProduct)
        {
		$operation='';
		$status='';
		$date='';
		$time='';
                $transid='';
		$origAmount='';
		$origCurrency='';
		$idformerchant='';
		$merchantdatas=array();
                $emailClient='';
		$subscriptionId='';
		$refProduct=array();
		try {
			$obj = new SimpleXMLElement(trim($xml));
		} catch (Exception $e) {
			return false;
		}
		if (isset($obj->result[0]->operation))
			$operation=$obj->result[0]->operation;
		else return false;

		if (isset($obj->result[0]->status))
			$status=$obj->result[0]->status;
		else return false;

		if (isset($obj->result[0]->date))
			$date=$obj->result[0]->date;
		else return false;

		if (isset($obj->result[0]->time))
			$time=$obj->result[0]->time;
		else return false;

                if (isset($obj->result[0]->transid))
                    $transid=$obj->result[0]->transid;
                else return false;

		if (isset($obj->result[0]->origAmount))
			$origAmount=$obj->result[0]->origAmount;
		else return false;

		if (isset($obj->result[0]->origCurrency))
			$origCurrency=$obj->result[0]->origCurrency;
		else return false;

		if (isset($obj->result[0]->idForMerchant))
			$idformerchant=$obj->result[0]->idForMerchant;
		else return false;

		if (isset($obj->result[0]->merchantDatas)) {
                    $d = $obj->result[0]->merchantDatas->children();
                    foreach($d as $xml2) {
                        if (preg_match('#^_aKey_#i',$xml2->getName())) {
                                $indice = substr($xml2->getName(),6);
                                $xml2 = (array)$xml2;
                                $valeur = (string)$xml2[0];
                                $merchantdatas[$indice]=$valeur;
                        }
                    }

		}

                if (isset($obj->result[0]->emailClient))
                    $emailClient=$obj->result[0]->emailClient;
		else return false;

                if (isset($obj->result[0]->subscriptionId))
                    $subscriptionId=$obj->result[0]->subscriptionId;

                foreach($obj->result[0] as $key=>$value)
                {
                    if(preg_match('#^refProduct[\d]#', $key)) {
                        $refProduct[] = (string)$value;
                    }
                }

		return true;
	}
}
?>
