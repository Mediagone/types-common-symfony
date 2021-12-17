<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\Types\Common\Converters\System\BinaryConverter;
use Mediagone\Types\Common\System\Binary;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\System\BinaryConverter
 */
final class BinaryConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new BinaryConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Binary::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'binary string']);
        $param = new ParamConverter(['name' => 'param'], Binary::class);
        
        (new BinaryConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Binary::class, $convertedParam);
        self::assertSame('binary string', (string)$convertedParam);
    }
    
    
    // public function test_returns_null_on_invalid_data() : void
    // {
    //     $request = new Request(['param' => '']);
    //     $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Binary::class);
    //    
    //     (new BinaryConverter())->apply($request, $param);
    //     $convertedParam = $request->attributes->get('param');
    //    
    //     self::assertNull($convertedParam);
    // }
    
    
    // public function test_throws_exception_on_invalid_data() : void
    // {
    //     $request = new Request(['param' => '']);
    //     $param = new ParamConverter(['name' => 'param'], Binary::class);
    //    
    //     $this->expectException(NotFoundHttpException::class);
    //     (new BinaryConverter())->apply($request, $param);
    // }
    
    
    
}
