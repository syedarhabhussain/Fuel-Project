<?php
use PHPUnit\Framework\TestCase;

class HandleLoginTest extends TestCase
{
    private $originalServer;
    private $originalSession;

    protected function setUp(): void
    {       
        $this->originalServer = $_SERVER;
        $this->originalSession = $_SESSION;
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['username'] = 'testUser';
        $_POST['password'] = 'password123';
        global $conn;
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_assoc')->willReturn(['username' => 'testUser', 'password' => 'password123']);
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
        $mockStmt->method('get_result')->willReturn($mockResult);
        $conn = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();
        $conn->method('prepare')->willReturn($mockStmt);
    }

    protected function tearDown(): void
    {
        $_SERVER = $this->originalServer;
        $_SESSION = $this->originalSession;
    }

    public function testSuccessfulLogin()
    {
        ob_start();
        include __DIR__ . '/../src/handle_login.php';
        $output = ob_get_clean();
        $this->assertEquals('testUser', $_SESSION['username']);
    }
}
