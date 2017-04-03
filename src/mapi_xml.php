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

class HIPAY_MAPI_XML {

	/**
	 * Cré le flux XML de cet objet.
	 * Les membres commençants par "_" sont ignorées
	 *
	 * @param int $t
	 * @return string
	 */
	public function getXML($t=0,$noshow=true) {
			$xml='';
			$xml.=str_repeat(chr(9),$t)."<".get_class($this).">\n";
			foreach($this as $name=>$value) {
				if ($noshow && substr($name,0,1)=='_')
					continue;

				if (!is_array($this->$name) && !is_object($this->$name) && !is_bool($this->$name)) {
					$xml.=str_repeat(chr(9),$t+1)."<$name>$value</$name>\n";
				} else if (is_bool($this->$name)) {
					if ($value===true)
						$xml.=str_repeat(chr(9),$t+1)."<$name>true</$name>\n";
					else
						$xml.=str_repeat(chr(9),$t+1)."<$name>false</$name>\n";
				} else if (is_object($this->$name) && method_exists($this->$name,'getXML')) {
					$xml.=$this->$name->getXml($t+1);
				} else if (is_array($this->$name)) {
					$xml.=str_repeat(chr(9),$t+1)."<$name>\n";
					$xml.=self::getXMLArray($this->$name,$t+1,$noshow);
					$xml.=str_repeat(chr(9),$t+1)."</$name>\n";
				}
				// else : no getXML method available

			}
			$xml.=str_repeat(chr(9),$t)."</".get_class($this).">\n";
			return $xml;

	}

	/**
	 * Cré le flux XML d'un tableau 
	 *
	 * @param array $array
	 * @param int $t
	 * @return string
	 */
	protected function getXMLArray($array,$t=0,$noshow=true) {
		$xml='';
		foreach($array as $name=>$value) {
				if (substr($name,0,1)=='_')
					continue;

				if (!is_array($array[$name]) && !is_object($array[$name]) && !is_bool($array[$name])) {
					$xml.=str_repeat(chr(9),$t+1)."<_aKey_$name>$value</_aKey_$name>\n";
				} else if (is_bool($array[$name])) {
					if ($value===true)
						$xml.=str_repeat(chr(9),$t+1)."<$name>true</$name>\n";
					else
						$xml.=str_repeat(chr(9),$t+1)."<$name>false</$name>\n";
				} else if (is_object($array[$name]) && method_exists($array[$name],'getXML')) {
					$xml.=$array[$name]->getXml($t+1);
				} else if (is_array($array[$name])){
					$xml.=str_repeat(chr(9),$t+1)."<$name>\n";
					$xml.=self::getXMLArray($array[$name],$t+1,$noshow);
					$xml.=str_repeat(chr(9),$t+1)."</$name>\n";
				}
		}
		return $xml;
	}

}
?>