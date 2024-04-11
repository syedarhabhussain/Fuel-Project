<?php
use PHPUnit\Framework\TestCase;

class UpdateProfileTest extends TestCase
{
    public function testUpdateProfileInclude()
    {
        ob_start();
        include __DIR__ . '/../src/update_profile.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('$stmt->bind_param', $output);
    }
}
