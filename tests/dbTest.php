<?php
use PHPUnit\Framework\TestCase;

class footerTest extends TestCase
{
    public function testFooterInclude()
    {
        ob_start();
        include __DIR__ . '/../src/db.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<?php', $output);
    }
}