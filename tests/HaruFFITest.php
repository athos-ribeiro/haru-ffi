<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class HaruFFITest extends TestCase
{
    public function testLoadHeader(): void
    {
        $ffi = Haru\HaruFFI::get_ffi();
        $this->assertInstanceOf("\FFI", $ffi);
    }
}
