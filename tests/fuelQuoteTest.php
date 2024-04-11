<?php
use PHPUnit\Framework\TestCase;

class FuelQuoteFormTest extends TestCase
{
    public function testFuelQuoteInclude()
    {
        $_SESSION['username'] = 'testUser';
        ob_start();
        include __DIR__ . '/../src/fuel-quote-form.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<head', $output);
        $this->assertStringContainsString('<body', $output);
    }
}
