<?php
use PHPUnit\Framework\TestCase;

class HandleRegisterTest extends TestCase
{
    public function testFooterInclude()
    {
        ob_start();
        include __DIR__ . '/../src/handle_register.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('$_SERVER["REQUEST_METHOD"]', $output);
    }
}
