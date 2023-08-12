<?php

declare(strict_types=1);

namespace Haru;

class HaruDestination
{
    public $h = null;
    private $ffi = null;

    public function __construct($dest_ref)
    {
        $this->ffi = HaruFFI::get_ffi();
        $this->h = $dest_ref;
        if(is_null($this->h)) {
            throw new HaruException('Cannot create HaruDestination handle');
        }
    }

    public function setXYZ($left, $top, $zoom)
    {
        $status = $this->ffi->HPDF_Destination_SetXYZ($this->h, $left, $top, $zoom);
        if($status) {
            throw new HaruException('', $status);
        }
    }
}
