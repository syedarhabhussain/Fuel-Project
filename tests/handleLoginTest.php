<?php
use PHPUnit\Framework\TestCase;

class HandleLoginTest extends TestCase
{
    public function testHandleLoginInclude()
    {
        $_SESSION['username'] = 'testUser';
        ob_start();
        include __DIR__ . '/../src/handle_login.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<?php', $output);
    }
}
