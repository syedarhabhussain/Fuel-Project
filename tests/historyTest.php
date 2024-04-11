<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class HistoryFormTest extends TestCase
{
    public function testHistoryInclude()
    {
        $_SESSION['username'] = 'testUser';
        $mysqli = $this->createMock(mysqli::class);
        $connector = new DatabaseConnector();
        $connector->setConnection($mysqli);
        ob_start();
        include __DIR__ . '/../src/history.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<head', $output);
        $this->assertStringContainsString('<body', $output);
    }
}
