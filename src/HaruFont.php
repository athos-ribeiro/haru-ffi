<?php

declare(strict_types=1);

namespace Haru;

class HaruFont
{
    public $h = null;
    private $ffi = null;

    public function __construct($font_ref)
    {
        $this->ffi = HaruFFI::get_ffi();
        $this->h = $font_ref;
        if(is_null($this->h)) {
            throw new HaruException('Cannot create HaruFont handle');
        }
    }

    public function measureText($text, $width, $font_size, $char_space, $word_space, $word_wrap = 0)
    {
        $len = strlen($text);
        if(!$len) {
            return 0;
        }
        $str_ref_type = \FFI::arrayType($this->ffi->type("HPDF_BYTE"), [$len]);
        $str_ref = $this->ffi->new($str_ref_type);
        \FFI::memcpy($str_ref, $text, $len);
        $fit_count = $this->ffi->HPDF_Font_MeasureText($this->h, $str_ref, $len, $width, $font_size, $char_space, $word_space, $word_wrap, null);
        return (int)$fit_count;
    }
}
