<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\Types\Common\Converters\System\DurationConverter;
use Mediagone\Types\Common\System\Duration;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\System\DurationConverter
 */
final class DurationConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new DurationConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Duration::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => '20']);
        $param = new ParamConverter(['name' => 'param'], Duration::class);
        
        (new DurationConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Duration::class, $convertedParam);
        self::assertSame(20, $convertedParam->toSeconds());
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => '-1']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Duration::class);
        
        (new DurationConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => '-1']);
        $param = new ParamConverter(['name' => 'param'], Duration::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new DurationConverter())->apply($request, $param);
    }
    
    
    
}
