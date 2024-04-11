<?php
use PHPUnit\Framework\TestCase;

class ProfileTest extends TestCase
{
    private $originalSession;

    protected function setUp(): void
    {
        $this->originalSession = $_SESSION;
    }

    protected function tearDown(): void
    {
        $_SESSION = $this->originalSession; 
    }
    public function testUserNotLoggedIn()
    {
        
        unset($_SESSION['username']);

        ob_start();
        include __DIR__ . '/../src/profile.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('Not logged in.', $output);
    }

    public function testUserProfileRetrieved()
    {
        $_SESSION['username'] = 'testUser';

        global $conn;
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_assoc')->willReturn([
            'username' => 'testUser',
            'full_name' => 'Test User',
            'address1' => '123 Test Lane',
            'address2' => '',
            'city' => 'Testville',
            'state' => 'TX',
            'zip_code' => '12345'
        ]);

        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('get_result')->willReturn($mockResult);

        $conn = $this->getMockBuilder(mysqli::class)
                    ->disableOriginalConstructor()
                    ->getMock();
        $conn->method('prepare')->willReturn($stmtMock);

        ob_start();
        include __DIR__ . '/../src/profile.php';
        $output = ob_get_clean();

        
        $this->assertStringContainsString('Test User', $output);
        $this->assertStringContainsString('123 Test Lane', $output);
        
    }
}
