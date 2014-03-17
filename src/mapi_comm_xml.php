<?php
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
