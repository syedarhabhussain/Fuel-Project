<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class UpdateProfileTest extends TestCase
{
    public function testUpdateProfileInclude()
    {
        $_SESSION['username'] = 'testUser';
        $mysqli = $this->createMock(mysqli::class);
        $connector = new DatabaseConnector();
        $connector->setConnection($mysqli);
        ob_start();
        include __DIR__ . '/../src/update_profile.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('$stmt->bind_param', $output);
    }
}
