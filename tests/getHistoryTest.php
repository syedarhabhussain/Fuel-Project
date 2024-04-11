<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class GetHistoryTest extends TestCase
{
    public function testGetHistoryInclude()
    {
        $_SESSION['username'] = 'testUser';
        $mysqli = $this->createMock(mysqli::class);
        $connector = new DatabaseConnector();
        $connector->setConnection($mysqli);
        ob_start();
        include __DIR__ . '/../src/get_history.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('session_start();', $output);
        session_unset();
    }
}
