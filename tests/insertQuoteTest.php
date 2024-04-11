<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class InsertQuoteTest extends TestCase
{
    public function testInsertQuoteInclude()
    {
        $_SESSION['username'] = 'testUser';
        $mysqli = $this->createMock(mysqli::class);
        $connector = new DatabaseConnector();
        $connector->setConnection($mysqli);
        ob_start();
        include __DIR__ . '/../src/insert_quote.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('$stmt->execute()', $output);
    }
}
