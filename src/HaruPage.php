<?php

namespace Haru;

class HaruPage
{
    public const NUM_STYLE_DECIMAL = 0;

    public const SIZE_LETTER = 0;
    public const SIZE_LEGAL = 1;
    public const SIZE_A3 = 2;
    public const SIZE_A4 = 3;
    public const SIZE_A5 = 4;
    public const SIZE_B4 = 5;
    public const SIZE_B5 = 6;
    public const SIZE_EXECUTIVE = 7;
    public const SIZE_US4x6 = 8;
    public const SIZE_US4x8 = 9;
    public const SIZE_US5x7 = 10;
    public const SIZE_COMM10 = 11;
    public const SIZE_EOF = 12;

    public const PORTRAIT = 0;
    public const LANDSCAPE = 1;

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

    public function __construct($page_ref)
    {
        $this->ffi = HaruFFI::get_ffi();
        $this->h = $page_ref;
        if(is_null($this->h)) {
            throw new HaruException('Cannot create HaruPage handle');
        }
    }

    public function setTextRenderingMode($mode)
    {
        $status = $this->ffi->HPDF_Page_SetTextRenderingMode($this->h, $mode);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function setRGBStroke($r, $g, $b)
    {
        $status = $this->ffi->HPDF_Page_SetRGBStroke($this->h, $r, $g, $b);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function setRGBFill($r, $g, $b)
    {
        $status = $this->ffi->HPDF_Page_SetRGBFill($this->h, $r, $g, $b);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function setSize($size, $direction)
    {
        $status = $this->ffi->HPDF_Page_SetSize($this->h, $size, $direction);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function setFontAndSize($font, $size)
    {
        $font_ref = $font->h;
        $status = $this->ffi->HPDF_Page_SetFontAndSize($this->h, $font_ref, $size);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function beginText()
    {
        $status = $this->ffi->HPDF_Page_BeginText($this->h);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function getCharSpace()
    {
        $char_space = $this->ffi->HPDF_Page_GetCharSpace($this->h);
        return $char_space;
    }

    public function getWordSpace()
    {
        $word_space = $this->ffi->HPDF_Page_GetWordSpace($this->h);
        return $word_space;
    }

    public function textOut($x, $y, $text)
    {
        $status = $this->ffi->HPDF_Page_TextOut($this->h, $x, $y, (string)$text);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function getTextWidth($text)
    {
        $width = $this->ffi->HPDF_Page_TextWidth($this->h, (string)$text);
        return $width;
    }

    public function endText()
    {
        $status = $this->ffi->HPDF_Page_EndText($this->h);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function createDestination()
    {
        $dest_ref = $this->ffi->HPDF_Page_CreateDestination($this->h);
        if(is_null($dest_ref)) {
            throw new HaruException('Cannot create HaruDestination handle');
        }
        $dest = new HaruDestination($dest_ref);
        return $dest;
    }

    public function getHeight()
    {
        $height = $this->ffi->HPDF_Page_GetHeight($this->h);
        return $height;
    }

    public function setLineWidth($width)
    {
        $status = $this->ffi->HPDF_Page_SetLineWidth($this->h, $width);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function setDash($pattern, $phase)
    {
        $num_param = 0;
        if($pattern) {
            $num_param = count($pattern);
            $pat_ref_type = \FFI::arrayType($this->ffi->type("HPDF_UINT16"), [$num_param]);
            $pat_ref = $this->ffi->new($pat_ref_type);
            for($i = 0; $i < $num_param; $i++) {
                $pat_ref[$i] = $pattern[$i];
            }
            $pattern = $pat_ref;
        }
        $status = $this->ffi->HPDF_Page_SetDash($this->h, $pattern, $num_param, $phase);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function moveTo($x, $y)
    {
        $status = $this->ffi->HPDF_Page_MoveTo($this->h, $x, $y);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function lineTo($x, $y)
    {
        $status = $this->ffi->HPDF_Page_LineTo($this->h, $x, $y);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function stroke($close_path = false)
    {
        if(!$close_path) {
            $status = $this->ffi->HPDF_Page_Stroke($this->h);
        } else {
            $status = $this->ffi->HPDF_Page_ClosePathStroke($this->h);
        }
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function createURLAnnotation($rectangle, $url)
    {
        $rect_type = $this->ffi->type("HPDF_Rect");
        $hpdf_rectangle = $this->ffi->new($rect_type);
        $hpdf_rectangle->left = $rectangle[0];
        $hpdf_rectangle->bottom = $rectangle[1];
        $hpdf_rectangle->right = $rectangle[2];
        $hpdf_rectangle->top = $rectangle[3];
        $annotation_ref = $this->ffi->HPDF_Page_CreateURILinkAnnot($this->h, $hpdf_rectangle, $url);
        if(is_null($annotation_ref)) {
            throw new HaruException('Cannot create HaruAnnotation handle');
        }
        $annotation = new HaruAnnotation($annotation_ref);
        return $annotation;
    }

    public function rectangle($x, $y, $width, $height)
    {
        $status = $this->ffi->HPDF_Page_Rectangle($this->h, $x, $y, $width, $height);
        if($status) {
            throw new HaruException('', $status);
        }
    }

    public function createLinkAnnotation($rectangle, $dest)
    {
        $rect_type = $this->ffi->type("HPDF_Rect");
        $hpdf_rectangle = $this->ffi->new($rect_type);
        $hpdf_rectangle->left = $rectangle[0];
        $hpdf_rectangle->bottom = $rectangle[1];
        $hpdf_rectangle->right = $rectangle[2];
        $hpdf_rectangle->top = $rectangle[3];
        $annotation_ref = $this->ffi->HPDF_Page_CreateLinkAnnot($this->h, $hpdf_rectangle, $dest->h);
        if(is_null($annotation_ref)) {
            throw new HaruException('Cannot create HaruAnnotation handle');
        }
        $annotation = new HaruAnnotation($annotation_ref);
        return $annotation;
    }

    public function fill()
    {
        $status = $this->ffi->HPDF_Page_Fill($this->h);
        if($status) {
            // TODO: handle errors
        }
        return true;
    }

    public function fillStroke($close_path = false)
    {
        if(!$close_path) {
            $status = $this->ffi->HPDF_Page_FillStroke($this->h);
        } else {
            $status = $this->ffi->HPDF_Page_ClosePathFillStroke($this->h);
        }
    }

    public function moveTextPos($x, $y, $set_leading = false)
    {
        if(!$set_leading) {
            $status = $this->ffi->HPDF_Page_MoveTextPos($this->h, $x, $y);
        } else {
            $status = $this->ffi->HPDF_Page_MoveTextPos2($this->h, $x, $y);
        }
        if($status) {
            // TODO: handle errors
        }
        return true;
    }

    public function showText($text)
    {
        $status = $this->ffi->HPDF_Page_ShowText($this->h, $text);
        if($status) {
            throw new HaruException('', $status);
        }
        return true;
    }
}
