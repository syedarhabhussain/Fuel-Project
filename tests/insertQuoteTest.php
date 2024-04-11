<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class InsertQuoteTest extends TestCase
{
    protected function setUp(): void
    {
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_SESSION["username"] = "testUser";
        $_POST['gallonsRequested'] = "100";
        $_POST['deliveryAddress'] = "123 Main St";
        $_POST['deliveryDate'] = "2023-01-01";
        $_POST['suggestedPrice'] = "$2.50";
        $_POST['totalAmountDue'] = "$250.00";

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
        session_unset();
        unset($_SERVER["REQUEST_METHOD"]);
        unset($_POST['gallonsRequested'], $_POST['deliveryAddress'], $_POST['deliveryDate'], $_POST['suggestedPrice'], $_POST['totalAmountDue']);
    }

    public function testSuccessfulInsertRedirectsToHistory()
    {
        ob_start();
        include __DIR__ . '/../src/insert_quote.php';
        $output = ob_get_clean();
        $this->assertEmpty($output);
    }

    public function testFailedInsertShowsErrorMessage()
    {
        global $conn;
        $conn->method('prepare')->willReturnCallback(function() {
            $stmtMock = $this->createMock(mysqli_stmt::class);
            $stmtMock->method('execute')->willReturn(false);
            $stmtMock->method('error')->willReturn('Some error');
            return $stmtMock;
        });

        ob_start();
        include __DIR__ . '/../src/insert_quote.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('Error: Some error', $output);
    }
}
