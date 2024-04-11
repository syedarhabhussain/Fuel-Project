<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class HistoryFormTest extends TestCase
{
    public function testHistoryInclude()
    {
        global $conn;
        global $repository;
        $_SESSION['username'] = 'testUser';
        $conn = $this->createMock(mysqli::class);
        $repository = $this->createMock(FuelQuoteRepository::class);
        $repository->method('getFuelQuotesByUser')->willReturn([
            [
                'delivery_date' => '2021-01-01',
                'gallons' => 100,
                'address' => '123 Main St',
                'price' => 2.50,
                'total' => 250
            ]
        ]);
        ob_start();
        include __DIR__ . '/../src/history.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<head', $output);
        $this->assertStringContainsString('<body', $output);
    }
}
