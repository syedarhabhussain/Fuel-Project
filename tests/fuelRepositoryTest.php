<?php
use PHPUnit\Framework\TestCase;

class FuelQuoteRepositoryTest extends TestCase
{
    private $conn;
    private $repository;

    protected function setUp(): void
    {
        $this->conn = $this->createMock(mysqli::class);
        $this->repository = new FuelQuoteRepository($this->conn);
    }

    public function testGetFuelQuotesByUserReturnsData()
    {
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('get_result')->willReturn($resultMock);
        $resultMock->method('fetch_assoc')->will($this->onConsecutiveCalls(
            ['delivery_date' => '2021-01-01', 'gallons' => 100, 'address' => '123 Main St', 'price' => 2.50, 'total' => 250],
            null
        ));
        $this->conn->expects($this->once())->method('prepare')->willReturn($stmtMock);
        $fuelQuotes = $this->repository->getFuelQuotesByUser('testUser');
        $this->assertCount(1, $fuelQuotes);
        $this->assertEquals('2021-01-01', $fuelQuotes[0]['delivery_date']);
    }

    public function testGetFuelQuotesByUserReturnsEmptyWhenNoData()
    {
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);
        $resultMock->method('fetch_assoc')->willReturn(false);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('get_result')->willReturn($resultMock);
        $this->conn->expects($this->once())->method('prepare')->willReturn($stmtMock);
        $fuelQuotes = $this->repository->getFuelQuotesByUser('testUser');
        $this->assertIsArray($fuelQuotes);
        $this->assertEmpty($fuelQuotes);
    }
}
