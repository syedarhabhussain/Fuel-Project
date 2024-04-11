<?php
use PHPUnit\Framework\TestCase;

class footerTest extends TestCase
{
    public function testFooterInclude()
    {
        ob_start();
        include __DIR__ . '/../src/footer.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<footer', $output);
    }
}
