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

define('MAPI_EXCEPTION_AFFILIATE_BASE_ERROR',101);
define('MAPI_EXCEPTION_AFFILIATE_UNKNOWN_AFFILIATE',102);
define('MAPI_EXCEPTION_AFFILIATE_INCORRECT_EU',103);
define('MAPI_EXCEPTION_AFFILIATE_CUSTOMER_ID_ERROR',104);
define('MAPI_EXCEPTION_AFFILIATE_ACCOUNT_ID_ERROR',105);
define('MAPI_EXCEPTION_AFFILIATE_VALUE_ERROR',106);
define('MAPI_EXCEPTION_AFFILIATE_INCORRECT_TAG',107);


define('MAPI_EXCEPTION_INSTALLMENT_BASE_ERROR',201);
define('MAPI_EXCEPTION_INSTALLMENT_SETFIRST_ERROR',202);
define('MAPI_EXCEPTION_INSTALLMENT_FIRST_BOOLEAN',203);
define('MAPI_EXCEPTION_INSTALLMENT_PRICE_ERROR',204);
define('MAPI_EXCEPTION_INSTALLMENT_INCORRECT_TAG',205);
define('MAPI_EXCEPTION_INSTALLMENT_TAX_ERROR',206);


define('MAPI_EXCEPTION_MULTIPLEP_ORDER_TAG_CONTENT_ERROR',301);
define('MAPI_EXCEPTION_MULTIPLEP_ORDER_TAG_TOO_MANY_OBJECTS',302);
define('MAPI_EXCEPTION_MULTIPLEP_ITEMS_TAG_CONTENT_ERROR',303);
define('MAPI_EXCEPTION_MULTIPLEP_ITEMS_TAG_TOO_MANY_OBJECTS',304);
define('MAPI_EXCEPTION_MULTIPLEP_INCORRECT_TAG',305);
define('MAPI_EXCEPTION_MULTIPLEP_CONSTRUCT_ERROR',306);


define('MAPI_EXCEPTION_ORDER_BASE_ERROR',401);
define('MAPI_EXCEPTION_ORDER_UNKNOWN_CATEGORY',402);
define('MAPI_EXCEPTION_ORDER_TITLE_ERROR',403);
define('MAPI_EXCEPTION_ORDER_INFO_ERROR',404);
define('MAPI_EXCEPTION_ORDER_UNKNOWN_TAG',405);
define('MAPI_EXCEPTION_ORDER_SHIPPING_ERROR',406);
define('MAPI_EXCEPTION_ORDER_INSURANCE_ERROR',407);
define('MAPI_EXCEPTION_ORDER_FCOST_ERROR',408);
define('MAPI_EXCEPTION_ORDER_AFFILIATE_ERROR',409);


define('MAPI_EXCEPTION_SIMPLEP_ORDER_TAG_CONTENT_ERROR',501);
define('MAPI_EXCEPTION_SIMPLEP_ITEMS_TAG_CONTENT_ERROR',502);
define('MAPI_EXCEPTION_SIMPLEP_INCORRECT_TAG',503);
define('MAPI_EXCEPTION_SIMPLEP_CONSTRUCT_ERROR',504);

define('MAPI_EXCEPTION_PARAMS_BASE_ERROR',601);
define('MAPI_EXCEPTION_PARAMS_INCORRECT_LOGIN',602);
define('MAPI_EXCEPTION_PARAMS_INCORRECT_PASSWORD',603);
define('MAPI_EXCEPTION_PARAMS_INCORRECT_LOGIN_2',604);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_ITEM_ACCT',605);
define('MAPI_EXCEPTION_PARAMS_FORBIDDEN_ITEM_ACCT',606);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_ITEM_ACCT_2',607);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_TAX_ACCT',608);
define('MAPI_EXCEPTION_PARAMS_FORBIDDEN_TAX_ACCT',609);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_TAX_ACCT_2',610);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_INS_ACCT',611);
define('MAPI_EXCEPTION_PARAMS_FORBIDDEN_INS_ACCT',612);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_INS_ACCT_2',613);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_FCOST_ACCT',614);
define('MAPI_EXCEPTION_PARAMS_FORBIDDEN_FCOST_ACCT',615);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_FCOST_ACCT_2',616);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_SHIP_ACCT',617);
define('MAPI_EXCEPTION_PARAMS_FORBIDDEN_SHIP_ACCT',618);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_SHIP_ACCT_2',619);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_EU_ID',620);
define('MAPI_EXCEPTION_PARAMS_NO_LANG_AVAILABLE',621);
define('MAPI_EXCEPTION_PARAMS_LANG_NOT_SUPPORTED',622);
define('MAPI_EXCEPTION_PARAMS_NO_MEDIA_AVAILABLE',623);
define('MAPI_EXCEPTION_PARAMS_MEDIA_NOT_SUPPORTED',624);
define('MAPI_EXCEPTION_PARAMS_INCORRECT_RATING',625);
define('MAPI_EXCEPTION_PARAMS_INCORRECT_PAYMENT_METHOD',626);
define('MAPI_EXCEPTION_PARAMS_INCORRECT_CURRENCY',627);
define('MAPI_EXCEPTION_PARAMS_INCORRECT_MERCH_SITE_ID',628);
define('MAPI_EXCEPTION_PARAMS_LANG_ERROR',629);
define('MAPI_EXCEPTION_PARAMS_MEDIA_ERROR',630);
define('MAPI_EXCEPTION_PARAMS_RATING_ERROR',631);
define('MAPI_EXCEPTION_PARAMS_METHOD_ERROR',632);
define('MAPI_EXCEPTION_PARAMS_CAPTURE_DAY_ERROR',633);
define('MAPI_EXCEPTION_PARAMS_CURRENCY_ERROR',634);
define('MAPI_EXCEPTION_PARAMS_ID_MERCHANT_ERROR',635);
define('MAPI_EXCEPTION_PARAMS_SITE_ID_ERROR',636);
define('MAPI_EXCEPTION_PARAMS_URLOK_ERROR',637);
define('MAPI_EXCEPTION_PARAMS_URLNOK_ERROR',638);
define('MAPI_EXCEPTION_PARAMS_URLCAN_ERROR',639);
define('MAPI_EXCEPTION_PARAMS_URLACK_ERROR',640);
define('MAPI_EXCEPTION_PARAMS_ACKWD_ERROR',641);
define('MAPI_EXCEPTION_PARAMS_EMAILACK_ERROR',642);
define('MAPI_EXCEPTION_PARAMS_BGCOLOR_ERROR',643);
define('MAPI_EXCEPTION_PARAMS_URLLOGO_ERROR',644);
define('MAPI_EXCEPTION_PARAMS_MDATAS_ERROR',645);
define('MAPI_EXCEPTION_PARAMS_UNKNOWN_TAG',646);
define('MAPI_EXCEPTION_PARAMS_LOGIN_ERROR',647);
define('MAPI_EXCEPTION_PARAMS_ACCTS_ERROR',648);
define('MAPI_EXCEPTION_PARAMS_ID_GROUP_ERROR',649);


define('MAPI_EXCEPTION_PRODUCT_BASE_ERROR',701);
define('MAPI_EXCEPTION_PRODUCT_NAME_ERROR',702);
define('MAPI_EXCEPTION_PRODUCT_INFO_ERROR',703);
define('MAPI_EXCEPTION_PRODUCT_QUANTITY_ERROR',704);
define('MAPI_EXCEPTION_PRODUCT_REF_ERROR',705);
define('MAPI_EXCEPTION_PRODUCT_CATEGORY_ERROR',706);
define('MAPI_EXCEPTION_PRODUCT_PRICE_ERROR',707);
define('MAPI_EXCEPTION_PRODUCT_INCORRECT_TAG',708);
define('MAPI_EXCEPTION_PRODUCT_TAX_ERROR',709);

define('MAPI_EXCEPTION_TAX_BASE_ERROR',801);
define('MAPI_EXCEPTION_TAX_NAME_ERROR',802);
define('MAPI_EXCEPTION_TAX_ACCOUNT_ERROR',803);
define('MAPI_EXCEPTION_TAX_PERCENTAGE_NOT_BOOLEAN_ERROR',804);
define('MAPI_EXCEPTION_TAX_VALUE_ERROR',805);
define('MAPI_EXCEPTION_TAX_INCORRECT_TAG',806);

class MAPI_Exception extends Exception {
	private $keyword;
	private $value;
	function __construct($keyword,$value,$msg,$code=0) {
		$this->keyword=$keyword;
		$this->value=$value;
		parent::__construct($msg,$code);
	}
	
	public function getKeyword() {
		return $this->keyword;
	}
	public function getValue() {
		return $this->value;
	}
}
?>