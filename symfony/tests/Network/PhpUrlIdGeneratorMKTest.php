<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: Mateo
 * Date: 13.1.2019.
 * Time: 4:42
 */

namespace App\Tests\Network;
use PHPUnit\Framework\TestCase;
use App\Network\PhpUrlIdGeneratorMK;
use App\Network\UrlIdGenerator;


class PhpUrlIdGeneratorMKTest extends TestCase
{
    /**
     * @test
     */
    public function instantiation_works() : void
    {
        $generator = new PhpUrlIdGeneratorMK();
        self::assertInstanceOf(PhpUrlIdGeneratorMK::class, $generator);
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
    public function generate_withValidUrl_returnsUrlIdMK(string $url, string $expectedId) : void
    {
        $generatedId = (new PhpUrlIdGeneratorMK())->generate($url);
        $this->assertEquals(
            $expectedId,
            $generatedId,
            \sprintf('Expected URL ID generator to return ID [%s], got [%s] instead.', $expectedId, $generatedId)
        );
    }



}
