<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: storeman.proto

namespace App\Proto;

use UnexpectedValueException;

/**
 * Protobuf type <code>TransactionType</code>
 */
class TransactionType
{
    /**
     * Generated from protobuf enum <code>TRANSACTION_UNRECOGNISED = 0;</code>
     */
    const TRANSACTION_UNRECOGNISED = 0;
    /**
     * Generated from protobuf enum <code>TX_SELL = 1;</code>
     */
    const TX_SELL = 1;
    /**
     * Generated from protobuf enum <code>TX_STOCK_IN = 2;</code>
     */
    const TX_STOCK_IN = 2;

    private static $valueToName = [
        self::TRANSACTION_UNRECOGNISED => 'TRANSACTION_UNRECOGNISED',
        self::TX_SELL => 'TX_SELL',
        self::TX_STOCK_IN => 'TX_STOCK_IN',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

