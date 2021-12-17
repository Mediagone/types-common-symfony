<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\Types\Common\Converters\Geo\LatitudeConverter;
use Mediagone\Types\Common\Geo\Latitude;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Geo\LatitudeConverter
 */
final class LatitudeConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new LatitudeConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Latitude::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => '45']);
        $param = new ParamConverter(['name' => 'param'], Latitude::class);
        
        (new LatitudeConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Latitude::class, $convertedParam);
        self::assertSame(45.0, $convertedParam->toFloat());
    }
    
    
    public function test_returns_null_on_invalid_value() : void
    {
        $request = new Request(['param' => 200]);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Latitude::class);
        
        (new LatitudeConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_value() : void
    {
        $request = new Request(['param' => '200']);
        $param = new ParamConverter(['name' => 'param'], Latitude::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new LatitudeConverter())->apply($request, $param);
    }
    
    
    
}
