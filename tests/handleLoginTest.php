<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class HandleLoginTest extends TestCase
{
    public function testHandleLoginInclude()
    {
        $_SESSION['username'] = 'testUser';
        $mysqli = $this->createMock(mysqli::class);
        $connector = new DatabaseConnector();
        $connector->setConnection($mysqli);
        ob_start();
        include __DIR__ . '/../src/handle_login.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<?php', $output);
    }
}
