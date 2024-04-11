<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class GetHistoryTest extends TestCase
{
    public function testGetHistoryInclude()
    {
        global $conn;
        $_SESSION['username'] = 'testUser';
        $conn = $this->createMock(mysqli::class);
        $conn->method('prepare')->willReturn($this->createMock(mysqli_stmt::class));
        ob_start();
        include __DIR__ . '/../src/get_history.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('session_start();', $output);
        session_unset();
    }
}
