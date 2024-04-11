<?php
use PHPUnit\Framework\TestCase;

class LogoutTest extends TestCase
{
    public function testLogoutInclude()
    {
        $_SESSION['username'] = 'testUser';
        ob_start();
        include __DIR__ . '/../src/logout.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('session_destroy();', $output);
    }
}
