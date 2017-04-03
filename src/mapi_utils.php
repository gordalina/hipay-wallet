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

class HIPAY_MAPI_UTILS
{

    /**
     * Vérifie si le tableau $array contient des objet $objectName
     *
     * @param array $array
     * @param string $objectName
     * @return boolean
     */
    public static function is_an_array_of($array, $objectName) {
        if (!is_array($array))
                return false;
        try {
            foreach($array as $obj) {
                if (!($obj instanceof $objectName)) {
                    return false;
                }
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * Retourne le montant calculé d'une taxe en fonction de la valeur $itemValue
     *
     * @param float $itemValue
     * @param HIPAY_MAPI_Tax $tax
     * @return float
     */
    public static function computeTax($itemValue,HIPAY_MAPI_Tax $tax) {
        $itemValue = (float) $itemValue;
        $taxAmount=0;
        if ($tax->isPercentage()) {
            $taxAmount=sprintf("%.02f",($itemValue/100)*$tax->getTaxVal());
        } else {
            $taxAmount+=sprintf("%.02f",$tax->getTaxVal());
        }
        return (float)$taxAmount;
    }

    /**
     * Vérifie la validité d'une URL
     *
     * @param string $url
     * @return boolean
     */
    public static function checkURL( $url ) {
        return preg_match( '#^(((http|https):\/\/){0,1})(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(.*)#i', $url );
    }

    /**
     * Vérifie la validité de l'email
     *
     * @param string $email
     * @return boolean
     */
    public static function checkemail( $email ) {
        return preg_match( '#^[_a-z0-9-]+(\.[_a-z0-9-]*)*@[a-z0-9-]+(\.[a-z0-9-]+)+$#i', $email );
    }

    /**
     * convertit un délai mapi en tableau
     *
     * @param string $delay
     * @return array
     */
    public static function parseDelay( $delay )
    {
        $array = array_fill_keys( array('H', 'I', 'S', 'M', 'D', 'Y'), 0 );
        $n = substr( $delay, 0, -1 );
        $r = substr( $delay, -1, 1 );
        $array[ strtoupper($r) ] = $n;

        return $array;
    }

    /**
     * Renvoie le flux xml sous forme de tableau associatif multi dimensionnel
     * php.net Julio Cesar Oliveira
     *
     * @param string $xml
     * @param boolean $recursive
     *
     * @return array
     */
    public static function xml2Array($xml, $recursive = false)
    {
        if(!$recursive)
        {
            $array = (array) simplexml_load_string($xml);
        }
        else
        {
            $array = (array) $xml;
        }

        $newArray = array();

        foreach ($array as $key => $value)
        {
            $value = (array)$value;
            if (isset($value[0]))
            {
                $newArray[$key] = trim ($value[0]);
            }
            else
            {
                $newArray[$key] = self::xml2Array($value, true);
            }
        }
        return $newArray ;
    }
}
?>