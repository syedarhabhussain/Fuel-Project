<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/db.php';

class GetHistoryTest extends TestCase
{
    public function testGetHistoryInclude()
    {
        global $conn;
        $_SESSION['username'] = 'testUser';
        
        $result = $this->createMock(mysqli_result::class);
        $result->method('fetch_assoc')->will($this->onConsecutiveCalls([
            'delivery_date' => '2021-01-01', 
            'gallons' => 100, 
            'address' => '123 Main St', 
            'price' => 2.50, 
            'total' => 250
        ], null));
        $result->num_rows = 1;

        $stmt = $this->createMock(mysqli_stmt::class);
        $stmt->method('bind_param')->willReturn(true);
        $stmt->method('execute')->willReturn(true);
        $stmt->method('get_result')->willReturn($result);
        
        $conn = $this->getMockBuilder(mysqli::class)
                     ->disableOriginalConstructor()
                     ->getMock();
        $conn->method('prepare')->willReturn($stmt);
        
        ob_start();
        include __DIR__ . '/../src/get_history.php';
        $output = ob_get_clean();
        $this->assertNotEmpty($fuelQuotes);
        // $this->assertStringContainsString('session_start();', $output);
        session_unset();
    }
}
