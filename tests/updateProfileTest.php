<?php
use PHPUnit\Framework\TestCase;

class UserProfileUpdateTest extends TestCase
{
    private $originalServer;
    private $originalSession;
    private $originalPost;

    protected function setUp(): void
    {
        $this->originalServer = $_SERVER;
        $this->originalSession = $_SESSION;
        $this->originalPost = $_POST;
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_SESSION['username'] = 'testUser'; 
        $_POST = [
            'fullName' => 'John Doe',
            'address1' => '123 Street Lane',
            'address2' => 'Apt 4',
            'city' => 'Cityville',
            'state' => 'StateLand',
            'zipCode' => '12345'
        ];

        global $conn;
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('execute')->willReturn(true);

        $conn = $this->getMockBuilder(mysqli::class)
                     ->disableOriginalConstructor()
                     ->getMock();
        $conn->method('prepare')->willReturn($stmtMock);
    }

    protected function tearDown(): void
    {
        $_SERVER = $this->originalServer;
        $_SESSION = $this->originalSession;
        $_POST = $this->originalPost;
    }

    public function testSuccessfulProfileUpdate()
    {
        ob_start();
        include __DIR__ . '/../src/update_profile.php'; 
        $output = ob_get_clean();
        $this->assertEmpty($output);
    }

    public function testProfileUpdateFailure()
    {
        global $conn;
        $conn->method('prepare')->willReturnCallback(function() {
            $stmtMock = $this->createMock(mysqli_stmt::class);
            $stmtMock->method('execute')->willReturn(false); 
            return $stmtMock;
        });

        ob_start();
        include __DIR__ . '/../src/update_profile.php'; 
        $output = ob_get_clean();
        $this->assertStringContainsString('Error: Some database error', $output);
    }

    public function testAccessWithoutLogin()
    {
        unset($_SESSION['username']); 
        ob_start();
        include __DIR__ . '/../src/update_profile.php'; 
        $output = ob_get_clean();
        $this->assertEmpty($output);
    }
}
