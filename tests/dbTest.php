<?php
use PHPUnit\Framework\TestCase;

class DBTest extends TestCase
{
    public function testDBInclude()
    {
        $mysqli = $this->createMock(mysqli::class);
        $mysqli->expects($this->once())
               ->method('__construct')
               ->with('localhost', 'root', '', 'fuel_quote')
               ->willReturn(null);

        $mysqli->connect_error = null;
        $connector = new DatabaseConnector();
        $reflection = new ReflectionClass(DatabaseConnector::class);
        $method = $reflection->getMethod('connect');
        $method->setAccessible(true);
        $result = $method->invokeArgs($connector, []);
        $this->assertInstanceOf(mysqli::class, $result);
    }
}
