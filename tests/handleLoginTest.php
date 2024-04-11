<?php
use PHPUnit\Framework\TestCase;

class HandleLoginTest extends TestCase
{
    public function testHandleLoginInclude()
    {
        ob_start();
        include __DIR__ . '/../src/handle_login.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<?php', $output);
    }
}
