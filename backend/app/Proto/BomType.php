<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: storeman.proto

namespace App\Proto;

use UnexpectedValueException;

/**
 * Protobuf type <code>BomType</code>
 */
class BomType
{
    /**
     * Generated from protobuf enum <code>BOM_UNRECOGNISED = 0;</code>
     */
    const BOM_UNRECOGNISED = 0;
    /**
     * Generated from protobuf enum <code>BOM_MERGE = 1;</code>
     */
    const BOM_MERGE = 1;
    /**
     * Generated from protobuf enum <code>BOM_EXPLODE = 2;</code>
     */
    const BOM_EXPLODE = 2;

    private static $valueToName = [
        self::BOM_UNRECOGNISED => 'BOM_UNRECOGNISED',
        self::BOM_MERGE => 'BOM_MERGE',
        self::BOM_EXPLODE => 'BOM_EXPLODE',
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

