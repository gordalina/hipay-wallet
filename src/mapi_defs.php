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
 * Définition des montants sur lesquels s'appliquent les taxes
 *
 */
define('HIPAY_MAPI_TTARGET_TAX', 1);
define('HIPAY_MAPI_TTARGET_INSURANCE', 2);
define('HIPAY_MAPI_TTARGET_FCOST', 4);
define('HIPAY_MAPI_TTARGET_SHIPPING', 8);
define('HIPAY_MAPI_TTARGET_ITEM', 16);
define('HIPAY_MAPI_TTARGET_ALL',HIPAY_MAPI_TTARGET_TAX+HIPAY_MAPI_TTARGET_INSURANCE+HIPAY_MAPI_TTARGET_FCOST+HIPAY_MAPI_TTARGET_SHIPPING+HIPAY_MAPI_TTARGET_ITEM);

/**
 * Type de paiements possibles
 *
 */
define('HIPAY_MAPI_METHOD_SIMPLE',0);
define('HIPAY_MAPI_METHOD_MULTI',1);

/**
 * Valeurs par défaut
 *
 */
define('HIPAY_MAPI_DEFLANG','fr_FR');
define('HIPAY_MAPI_DEFMEDIA','WEB');

define('HIPAY_MAPI_MAX_INFO_LENGTH',200);
define('HIPAY_MAPI_MAX_TITLE_LENGTH',80);

define('HIPAY_MAPI_MAX_LOGIN_LENGTH',20);
define('HIPAY_MAPI_MAX_PASSWORD_LENGTH',20);

define('HIPAY_MAPI_MAX_RATING_LENGTH',8);

define('HIPAY_MAPI_MAX_MDATAS_LENGTH',200);

define('HIPAY_MAPI_MAX_ACKWD_LENGTH',8);

define('HIPAY_MAPI_MAX_ACKMAIL_LENGTH',64);

define('HIPAY_MAPI_MAX_PRODUCT_NAME_LENGTH',100);

define('HIPAY_MAPI_MAX_PRODUCT_INFO_LENGTH',100);

define('HIPAY_MAPI_MAX_PRODUCT_REF_LENGTH',35);

define('HIPAY_MAPI_MAX_TAX_NAME_LENGTH',32);

/**
 * Valeurs particulières pour le délai de capture
 *
 */
define('HIPAY_MAPI_CAPTURE_MANUAL',-1);
define('HIPAY_MAPI_CAPTURE_IMMEDIATE',0);
define('HIPAY_MAPI_CAPTURE_MAX_DAYS',7);

define('HIPAY_MAPI_OPE_AUTH','authorization');
define('HIPAY_MAPI_OPE_CANCEL','cancellation');
define('HIPAY_MAPI_OPE_REFUND','refund');
define('HIPAY_MAPI_OPE_CAPTURE','capture');
define('HIPAY_MAPI_OPE_REJECT','rejet');

define('HIPAY_MAPI_STATUS_OK','ok');
define('HIPAY_MAPI_STATUS_NOK','nok');

// Nombre de secondes avant le timeout de curl avec le serveur Hipay
// A régler en fonction de votre rapidité d'accès à la plate forme hipay
define('HIPAY_MAPI_CURL_TIMEOUT', 30);

// Configuration d'un serveur proxy
// activer cette option a true pour demander au curl de passer par un proxy
define('HIPAY_MAPI_CURL_PROXY_ON', false);
// Adresse du proxy
define('HIPAY_MAPI_CURL_PROXY', 'http://');
// port du proxy
define('HIPAY_MAPI_CURL_PROXYPORT','');

// Configuration d'un fichier de log pour curl en cas de pb de connexion avec le serveur Hipay
define('HIPAY_MAPI_CURL_LOG_ON', false);
// fichier de log de curl (sous environnement windows, le chemin du fichier pourra être de type C:\tmp\mapicurl.log)
define('HIPAY_MAPI_CURL_LOGFILE', '/tmp/curl.log');

define('MAPI_VERSION','1.0');

define('HIPAY_GATEWAY_URL','https://payment.hipay.com/order/');
?>