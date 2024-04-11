<?php
use PHPUnit\Framework\TestCase;

class HistoryFormTest extends TestCase
{
    public function testHistoryInclude()
    {
        ob_start();
        include __DIR__ . '/../src/history.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<head', $output);
        $this->assertStringContainsString('<body', $output);
    }
}
