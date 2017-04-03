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

class HIPAY_MAPI_UTF8 {
	/**
	 * Test si une chaine est en UTF-8
	 *
	 * @param string $string
	 * @return boolean
	 */
	public static function is_utf8($string) {
	    // From http://w3.org/International/questions/qa-forms-utf-8.html
	    return preg_match('%^(?:
          	[\x09\x0A\x0D\x20-\x7E]            # ASCII
        	| [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
        	|  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
        	| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
        	|  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
        	|  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
        	| [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
        	|  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
    	)*$%xs', $string);
	}


	/**
	 * Encode une chaine en UTF-8 si elle ne l'est pas déjà
	 *
	 * @param string $string
	 * @return string
	 */
	public static function forceUTF8($string) {
		if (!self::is_utf8($string))
			return utf8_encode($string);
		else return $string;
	}


	/**
	 * Longueur d'une chaine UTF-8
	 *
	 * @param string $str
	 * @return int longueur de la chaine
	 */
	public static function strlen_utf8 ($str) {
	    $i = 0;
	    $count = 0;
	    $len = strlen ($str);
	    while ($i < $len)
	    {
	    $chr = ord ($str[$i]);
	    $count++;
	    $i++;
	    if ($i >= $len)
	        break;

	    if ($chr & 0x80)
	    {
	        $chr <<= 1;
	        while ($chr & 0x80)
	        {
	        $i++;
	        $chr <<= 1;
	        }
	    }
	    }
	    return $count;
	}
}
?>