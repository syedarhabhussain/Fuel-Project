<?php
use PHPUnit\Framework\TestCase;

class LogoutTest extends TestCase
{
    public function testFooterInclude()
    {
        ob_start();
        include __DIR__ . '/../src/logout.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('session_destroy();', $output);
    }
}
