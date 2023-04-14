<?php

declare(strict_types=1);

namespace Haru;

use PHPUnit\Framework\TestCase;

final class UsageExamplesTest extends TestCase
{
    public function testPECLExtDocExample(): void
    {
        $doc = new HaruDoc();
        $doc->setPageMode(HaruDoc::PAGE_MODE_USE_THUMBS);
        $page = $doc->addPage();
        $page->setSize(HaruPage::SIZE_A4, HaruPage::LANDSCAPE);
        $courier = $doc->getFont("Courier-Bold");
        $page->setRGBStroke(0, 0, 0);
        $page->setRGBFill(0.7, 0.8, 0.9);
        $page->rectangle(150, 150, 550, 250);
        $page->fillStroke();
        $page->setDash(array(3, 3), 0);
        $page->setFontAndSize($courier, 60);
        $page->setRGBStroke(0.5, 0.5, 0.1);
        $page->setRGBFill(1, 1, 1);
        $page->setTextRenderingMode(HaruPage::FILL_THEN_STROKE);
        $page->beginText();
        $page->textOut(210, 270, "Hello, haru!");
        $page->endText();
        $pdf_file = tempnam(sys_get_temp_dir(), 'haru-ffi.testPECLExtDocExample.pdf.');
        $doc->save($pdf_file);
        $this->assertFileExists($pdf_file);
        $this->assertEquals("application/pdf", mime_content_type($pdf_file));
        unlink($pdf_file);
    }

    public function testPECLExtUpstreamCheck(): void
    {
        $doc = new HaruDoc();
        $p = $doc->addPage();
        $p->setRGBFill(0.2, 0.2, 0.5);
        $p->rectangle(150, 400, 300, 200);
        $p->fill();
        $p->setRGBFill(1, 1, 1);
        $p->beginText();
        $font = $doc->getFont("Helvetica");
        $p->setFontAndSize($font, 35);
        $p->moveTextPos(200, 500);
        $p->showText("Hello, haru!");
        $p->endText();
        $pdf_file = tempnam(sys_get_temp_dir(), 'haru-ffi.testPECLExtUpstreamCheck.pdf.');
        $doc->save($pdf_file);
        $this->assertFileExists($pdf_file);
        $this->assertEquals("application/pdf", mime_content_type($pdf_file));
        unlink($pdf_file);
    }
}
