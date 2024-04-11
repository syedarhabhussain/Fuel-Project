<?php
use PHPUnit\Framework\TestCase;

class ProfileFormTest extends TestCase
{
    public function testProfileInclude()
    {
        ob_start();
        include __DIR__ . '/../src/profile.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<head', $output);
        $this->assertStringContainsString('<body', $output);
    }
}
