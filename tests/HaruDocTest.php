<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class HaruDocTest extends TestCase
{
    public function testCreateDoc(): void
    {
        $pdf_doc = new Haru\HaruDoc();
        $this->assertInstanceOf("Haru\HaruDoc", $pdf_doc);
    }

    public function testSetCompressionMode(): void
    {
        $pdf_doc = new Haru\HaruDoc();
        $ret = $pdf_doc->setCompressionMode(Haru\HaruDoc::COMP_ALL);
        $this->assertNull($ret);
    }

    public function testAddPageLabel(): void
    {
        $pdf_doc = new Haru\HaruDoc();
        $ret = $pdf_doc->addPageLabel('foo', 'bar', 'biz');
        $this->assertNull($ret);
    }

}
