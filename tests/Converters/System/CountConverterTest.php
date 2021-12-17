<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\Types\Common\Converters\System\CountConverter;
use Mediagone\Types\Common\System\Count;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\System\CountConverter
 */
final class CountConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new CountConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Count::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => '20']);
        $param = new ParamConverter(['name' => 'param'], Count::class);
        
        (new CountConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Count::class, $convertedParam);
        self::assertSame(20, $convertedParam->toInteger());
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => '-1']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Count::class);
        
        (new CountConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => '-1']);
        $param = new ParamConverter(['name' => 'param'], Count::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new CountConverter())->apply($request, $param);
    }
    
    
    
}
