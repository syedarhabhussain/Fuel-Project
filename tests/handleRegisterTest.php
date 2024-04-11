<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class HandleRegisterTest extends TestCase
{
    public function testHandleRegisterInclude()
    {
        $_SESSION['username'] = 'testUser';
        $mysqli = $this->createMock(mysqli::class);
        $connector = new DatabaseConnector();
        $connector->setConnection($mysqli);
        ob_start();
        include __DIR__ . '/../src/handle_register.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('$_SERVER["REQUEST_METHOD"]', $output);
    }
}
