<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/db.php';

class DBTest extends TestCase
{
    public function testDBInclude()
    {
        $mysqli = $this->createMock(mysqli::class);
        $connector = new DatabaseConnector();
        $connector->setConnection($mysqli);
        $reflection = new ReflectionClass(DatabaseConnector::class);
        $method = $reflection->getMethod('connect');
        $method->setAccessible(true);
        $result = $method->invokeArgs($connector, []);
        $this->assertInstanceOf(mysqli::class, $result);
    }
}