<?php
use PHPUnit\Framework\TestCase;

class InsertQuoteTest extends TestCase
{
    public function testInsertQuoteInclude()
    {
        $_SESSION['username'] = 'testUser';
        ob_start();
        include __DIR__ . '/../src/insert_quote.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('$stmt->execute()', $output);
    }
}
