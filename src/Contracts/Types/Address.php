<?php

/**
 * This file is part of web3.php package.
 * 
 * (c) Kuan-Cheng,Lai <alk03073135@gmail.com>
 * 
 * @author Peter Lai <alk03073135@gmail.com>
 * @license MIT
 */

namespace Web3\Contracts\Types;

use InvalidArgumentException;
use Web3\Contracts\SolidityType;
use Web3\Contracts\Types\IType;
use Web3\Utils;
use Web3\Formatters\Integer as IntegerFormatter;

class Address extends SolidityType implements IType
{
    /**
     * construct
     * 
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * isType
     * 
     * @param string $name
     * @return bool
     */
    public function isType($name)
    {
        return (preg_match('/address(\[([0-9]*)\])*/', $name) === 1);
    }

    /**
     * isDynamicType
     * 
     * @return bool
     */
    public function isDynamicType()
    {
        return false;
    }

    /**
     * inputFormat
     * to do: iban
     * 
     * @param mixed $value
     * @param string $name
     * @return string
     */
    public function inputFormat($value, $name)
    {
        $value = (string) $value;

        if (Utils::isAddress($value)) {
            $value = mb_strtolower($value);

            if (Utils::isZeroPrefixed($value)) {
                // return '000000000000000000000000' . Utils::stripZero($value);
                $value = Utils::stripZero($value);
            }
            // return '000000000000000000000000' . $value;
        }
        $value = IntegerFormatter::format($value);

        return $value;
        // throw new InvalidArgumentException('The value to inputFormat must be string.');
    }
}