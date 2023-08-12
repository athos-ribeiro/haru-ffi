<?php

declare(strict_types=1);

namespace Haru;

class HaruDoc
{
    public const COMP_ALL = 0x0F;

    public const PAGE_NUM_STYLE_DECIMAL = 0;
    public const PAGE_NUM_STYLE_UPPER_ROMAN = 1;
    public const PAGE_NUM_STYLE_LOWER_ROMAN = 2;
    public const PAGE_NUM_STYLE_UPPER_LETTERS = 3;
    public const PAGE_NUM_STYLE_LOWER_LETTERS = 4;
    public const PAGE_NUM_STYLE_EOF = 1;

    public const PAGE_MODE_USE_NONE = 0;
    public const PAGE_MODE_USE_OUTLINE = 1;
    public const PAGE_MODE_USE_THUMBS = 2;
    public const PAGE_MODE_FULL_SCREEN = 3;

    public const FILL = 0;
    public const STROKE = 1;
    public const FILL_THEN_STROKE = 2;
    public const INVISIBLE = 3;
    public const FILL_CLIPPING = 4;
    public const STROKE_CLIPPING = 5;
    public const FILL_STROKE_CLIPPING = 6;
    public const CLIPPING = 7;
    public const RENDERING_MODE_EOF = 8;

    private $h = null;
    private $ffi = null;

    public function __construct()
    {
        $this->ffi = HaruFFI::get_ffi();
        $this->h = $this->ffi->HPDF_New(null, null);
        if(is_null($this->h)) {
            throw new HaruException('Cannot create HaruDoc handle');
        }
    }

    public function setCompressionMode($mode)
    {
        $status = $this->ffi->HPDF_SetCompressionMode($this->h, $mode);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function addPageLabel($first_page, $style, $first_num, $string_prefix = null)
    {
        $status = $this->ffi->HPDF_AddPageLabel($this->h, $first_page, $style, $first_num, $string_prefix);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function setPageMode($mode)
    {
        $status = $this->ffi->HPDF_SetPageMode($this->h, $mode);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function setPagesConfiguration($page_per_pages)
    {
        $status = $this->ffi->HPDF_SetPagesConfiguration($this->h, $page_per_pages);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function getFont($font_name, $encoding_name = null)
    {
        $font_ref = $this->ffi->HPDF_GetFont($this->h, $font_name, $encoding_name);
        if(is_null($font_ref)) {
            throw new HaruException('Cannot create HaruFont handle');
        }
        $font = new HaruFont($font_ref);
        return $font;
    }

    public function save($file_name)
    {
        $status = $this->ffi->HPDF_SaveToFile($this->h, $file_name);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    // Note that the order of params differ from the underlying function
    public function createOutline($title, $parent = null, $encoder = null)
    {
        if($parent) {
            $parent = $parent->h;
        }
        $outline_ref = $this->ffi->HPDF_CreateOutline($this->h, $parent, $title, $encoder);
        if(is_null($outline_ref)) {
            throw new HaruException('Cannot create HaruOutline handle');
        }
        $outline = new HaruOutline($outline_ref);
        return $outline;
    }

    public function addPage()
    {
        $page_ref = $this->ffi->HPDF_AddPage($this->h);
        if(is_null($page_ref)) {
            throw new HaruException('Cannot create HaruPage handle');
        }
        $page = new HaruPage($page_ref);
        return $page;
    }

    // TODO: this should return a new HaruImage instance
    public function loadPNG($filename)
    {
        $image_ref = $this->ffi->HPDF_LoadPngImageFromFile($this->h, $filename);
        return $image_ref;
    }

    // TODO: this should return a new HaruImage instance
    public function loadJPEG()
    {
        $image_ref = $this->ffi->HPDF_LoadJpegImageFromFile($this->h, $filename);
        return $image_ref;
    }
}
