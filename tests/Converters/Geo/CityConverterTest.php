<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\Types\Common\Converters\Geo\CityConverter;
use Mediagone\Types\Common\Geo\City;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;
use function str_repeat;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Geo\City
 */
final class CityConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new CityConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], City::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'A valid city']);
        $param = new ParamConverter(['name' => 'param'], City::class);
        
        (new CityConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(City::class, $convertedParam);
        self::assertSame('A valid city', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_value() : void
    {
        $request = new Request(['param' => str_repeat('a', City::MAX_LENGTH + 1)]);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], City::class);
        
        (new CityConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_value() : void
    {
        $request = new Request(['param' => str_repeat('a', City::MAX_LENGTH + 1)]);
        $param = new ParamConverter(['name' => 'param'], City::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new CityConverter())->apply($request, $param);
    }
    
    
    
}
