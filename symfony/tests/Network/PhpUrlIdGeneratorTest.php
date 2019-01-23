<?php declare(strict_types = 1);

namespace App\Tests\Network;

use App\Connection\DBConnection;
use PHPUnit\Framework\TestCase;
use App\Network\PhpUrlIdGenerator;
use App\Network\UrlIdGenerator;

//require_once ('../../src/Connection/DBConnection.php');
require_once ('src/Connection/DBConnection.php');

final class PhpUrlIdGeneratorTest extends TestCase
{
    public static $conn = null;
    function setUp()
    {
        if(self::$conn == null){
            self::$conn = DBConnection::getInstance()->dbConnect();
        }
    }

    /**
     * @test
     */
    public function instantiation_works() : void
    {
        $generator = new PhpUrlIdGenerator();
        self::assertInstanceOf(PhpUrlIdGenerator::class, $generator);
        self::assertInstanceOf(UrlIdGenerator::class, $generator);
    }

    /**
     * @return mixed[]
     */
    public function provideGeneratorExpectations() : array
    {
        $providers = [];
        $file = \fopen(__DIR__.'/../Resources/url_ids.txt', 'r');
        if (false !== $file) {
            while (($line = \fgets($file)) !== false) {
                $providers[] = \explode("\t|\t", \trim($line));
            }
            \fclose($file);
        }
        return $providers;
    }

    /**
     * @test
     * @dataProvider provideGeneratorExpectations
     * @param string $url
     * @param string $expectedId
     */
    public function generate_withValidUrl_returnsUrlId(string $url, string $expectedId) : void
    {
        $generatedId = (new PhpUrlIdGenerator())->generate($url);
        $this->assertEquals(
            $expectedId,
            $generatedId,
            \sprintf('Expected URL ID generator to return ID [%s], got [%s] instead.', $expectedId, $generatedId)
        );
    }

    public static function tearDownAfterClass()
    {
        self::$conn = DBConnection::getInstance()->dbClose();
    }




}
