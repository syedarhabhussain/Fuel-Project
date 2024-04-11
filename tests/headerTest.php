<?php
use PHPUnit\Framework\TestCase;

class headerTest extends TestCase
{
    public function testHeaderInclude()
    {
        ob_start();
        include __DIR__ . '/../src/header.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<header', $output);
    }
}
