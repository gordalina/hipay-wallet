<?php
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