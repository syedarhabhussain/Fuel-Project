<?php
use PHPUnit\Framework\TestCase;

class RegisterFormTest extends TestCase
{
    public function testRegisterInclude()
    {
        ob_start();
        include __DIR__ . '/../src/register.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<head', $output);
        $this->assertStringContainsString('<body', $output);
    }
}
