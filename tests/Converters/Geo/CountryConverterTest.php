<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\Types\Common\Converters\Geo\CountryConverter;
use Mediagone\Types\Common\Geo\Country;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Geo\CountryConverter
 */
final class CountryConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new CountryConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Country::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'FRA']);
        $param = new ParamConverter(['name' => 'param'], Country::class);
        
        (new CountryConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Country::class, $convertedParam);
        self::assertSame('FRA', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'ZZZ']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Country::class);
        
        (new CountryConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'ZZZ']);
        $param = new ParamConverter(['name' => 'param'], Country::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new CountryConverter())->apply($request, $param);
    }
    
    
    
}
