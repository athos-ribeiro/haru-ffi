<?php

declare(strict_types=1);

namespace Haru;

class HaruAnnotation
{
    private $h = null;
    private $ffi = null;

    public function __construct($annotation_ref)
    {
        $this->ffi = HaruFFI::get_ffi();
        $this->h = $annotation_ref;
        if(is_null($this->h)) {
            throw new HaruException('Cannot create HaruAnnotation handle');
        }
    }
    public function setBorderStyle($width, $dash_on, $dash_off)
    {
        $status = $this->ffi->HPDF_LinkAnnot_SetBorderStyle($this->h, $width, $dash_on, $dash_off);
        if($status) {
            throw new HaruException('', $status);
        }
    }
}
