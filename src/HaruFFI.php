<?php

namespace Haru;

class HaruFFI
{
    private static $ffi = null;

    public static function get_ffi()
    {
        if(!self::$ffi) {
            try {
                self::$ffi = \FFI::load(__DIR__.'/hpdf.h');
            } catch(\FFI\Exception $e) {
                die($e->getFile() . ":" . $e->getLine() . ": " . $e->getMessage() . ". Is libharu installed?\n");
            }
        }
        return self::$ffi;
    }
}
