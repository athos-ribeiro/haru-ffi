<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class HaruDocTest extends TestCase {

  public function testCreateDoc(): void {
    $pdf_doc = new Haru\HaruDoc();
    $this->assertInstanceOf("Haru\HaruDoc", $pdf_doc);
  }

}
