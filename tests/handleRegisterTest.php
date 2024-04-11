<?php
use PHPUnit\Framework\TestCase;

class HandleRegisterTest extends TestCase
{
    private $originalServer;
    private $originalPost;
    private $originalSession;

    protected function setUp(): void
    {
        $this->originalServer = $_SERVER;
        $this->originalPost = $_POST;
        $this->originalSession = $_SESSION;

        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['username'] = 'testUser';
        $_POST['password'] = 'password123';

        global $conn;
        $conn = $this->createMock(mysqli::class);

        $mockResult = $this->createMock(mysqli_result::class);
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
        $mockStmt->method('get_result')->willReturn($mockResult);
        $conn->method('prepare')->willReturn($mockStmt);
    }

    protected function tearDown(): void
    {
        $_SERVER = $this->originalServer;
        $_POST = $this->originalPost;
        $_SESSION = $this->originalSession;
    }

    public function testUsernameAlreadyTaken()
    {
        global $conn;
        $conn->method('prepare')->willReturnCallback(function($query) {
            $resultMock = $this->createMock(mysqli_result::class);
            if (strpos($query, 'SELECT username FROM user_login') !== false) {
                $resultMock->method('fetch_assoc')->willReturn(['username' => 'testUser']);
            }
            $stmtMock = $this->createMock(mysqli_stmt::class);
            $stmtMock->method('execute')->willReturn(true);
            $stmtMock->method('get_result')->willReturn($resultMock);
            return $stmtMock;
        });

        ob_start();
        include __DIR__ . '/../src/handle_register.php';
        ob_end_clean();

        $this->assertArrayHasKey('username', $_SESSION);
    }

    public function testSuccessfulRegistration()
    {
        global $conn;
        $conn->method('prepare')->willReturnCallback(function($query) {
            $resultMock = $this->createMock(mysqli_result::class);
            if (strpos($query, 'SELECT username FROM user_login') !== false) {
                $resultMock->method('fetch_assoc')->willReturn(null);
            }
            $stmtMock = $this->createMock(mysqli_stmt::class);
            $stmtMock->method('execute')->willReturn(true);
            $stmtMock->method('get_result')->willReturn($resultMock);
            return $stmtMock;
        });

        ob_start();
        include __DIR__ . '/../src/handle_register.php';
        ob_end_clean();

        $this->assertEquals('testUser', $_SESSION['username']);
    }
}
