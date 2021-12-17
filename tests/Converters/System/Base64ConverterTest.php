<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\Types\Common\Converters\System\Base64Converter;
use Mediagone\Types\Common\System\Base64;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\System\Base64Converter
 */
final class Base64ConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new Base64Converter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Base64::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'base64==']);
        $param = new ParamConverter(['name' => 'param'], Base64::class);
        
        (new Base64Converter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Base64::class, $convertedParam);
        self::assertSame('base64==', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => '-1']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Base64::class);
        
        (new Base64Converter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => '-1']);
        $param = new ParamConverter(['name' => 'param'], Base64::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new Base64Converter())->apply($request, $param);
    }
    
    
    
}
