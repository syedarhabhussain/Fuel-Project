<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class LogoutTest extends TestCase
{
    public function testLogoutInclude()
    {
        $_SESSION['username'] = 'testUser';
        $mysqli = $this->createMock(mysqli::class);
        $connector = new DatabaseConnector();
        $connector->setConnection($mysqli);
        ob_start();
        include __DIR__ . '/../src/logout.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('session_destroy();', $output);
    }
}
