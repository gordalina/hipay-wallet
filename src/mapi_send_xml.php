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

class HIPAY_MAPI_SEND_XML {

    /**
     * Envoi le flux XML et retourne la réponse du serveur
     *
     * un timeout trop bas
     * Une mauvaise url
     * un proxy mal configuré s'il existe
     *
     * peuvent engendrer une erreur de connexion
     *
     * @param string $xml
     * @return string
     */
    public static function sendXML($xml, $url="") {
        $xml=self::prepare($xml);

        if ($url=="")
            $turl=parse_url(HIPAY_GATEWAY_URL);
        else $turl=parse_url($url);
        if (!isset($turl['path']))
            $turl['path']='/';

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_TIMEOUT, HIPAY_MAPI_CURL_TIMEOUT);
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_USERAGENT,"HIPAY");
        curl_setopt($curl,CURLOPT_URL, $turl['scheme'].'://'.$turl['host'].$turl['path']);
        curl_setopt($curl,CURLOPT_POSTFIELDS,'xml='.urlencode($xml));

        if(HIPAY_MAPI_CURL_PROXY_ON === true)
        {
            curl_setopt($curl, CURLOPT_PROXY, HIPAY_MAPI_CURL_PROXY);
            curl_setopt($curl, CURLOPT_PROXYPORT, HIPAY_MAPI_CURL_PROXYPORT);
        }

        if(HIPAY_MAPI_CURL_LOG_ON === true)
        {
            $errorFileLog = fopen(HIPAY_MAPI_CURL_LOGFILE, "a+");
            curl_setopt($curl, CURLOPT_VERBOSE, true);
            curl_setopt($curl, CURLOPT_STDERR, $errorFileLog);
        }

        curl_setopt($curl, CURLOPT_HEADER, 0);

        ob_start();
        if (curl_exec($curl) !== true)
        {
            $output = $turl['scheme'].'://'.$turl['host'].$turl['path'].' is not reachable';
            $output .= '<br />Network problem ? Verify your proxy configuration in mapi_defs.php';
        }
        else $output = ob_get_contents();
        ob_end_clean();
        curl_close($curl);
        if(HIPAY_MAPI_CURL_LOG_ON === true)
        {
            fclose($errorFileLog);
        }
        return $output;
    }

    /**
     * Prépare le flux XML
     *
     * @param string $xml
     * @return string
     */
    public static function prepare($xml) {
        $cleanXML='';
        $xml = trim($xml);
        $md5 = hash('md5',$xml);
        $cleanXML="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
        $cleanXML.="<mapi>\n";
        $cleanXML.="<mapiversion>".MAPI_VERSION."</mapiversion>\n";
        $cleanXML.='<md5content>'.$md5."</md5content>\n";
        $cleanXML.=$xml;
        $cleanXML.="\n</mapi>\n";
        return trim($cleanXML);
    }
}
?>