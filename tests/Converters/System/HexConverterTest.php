<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\Types\Common\Converters\System\HexConverter;
use Mediagone\Types\Common\System\Hex;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\System\HexConverter
 */
final class HexConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new HexConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Hex::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => '0123456789abcdef']);
        $param = new ParamConverter(['name' => 'param'], Hex::class);
        
        (new HexConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Hex::class, $convertedParam);
        self::assertSame('0123456789abcdef', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'YXZ']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Hex::class);
        
        (new HexConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'YXZ']);
        $param = new ParamConverter(['name' => 'param'], Hex::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new HexConverter())->apply($request, $param);
    }
    
    
    
}
