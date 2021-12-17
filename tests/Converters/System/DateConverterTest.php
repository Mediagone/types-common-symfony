<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\Types\Common\Converters\System\DateConverter;
use Mediagone\Types\Common\System\Date;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\System\DateConverter
 */
final class DateConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new DateConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Date::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => '2021-12-01']);
        $param = new ParamConverter(['name' => 'param'], Date::class);
        
        (new DateConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Date::class, $convertedParam);
        self::assertSame('2021-12-01', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => '']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Date::class);
        
        (new DateConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => '']);
        $param = new ParamConverter(['name' => 'param'], Date::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new DateConverter())->apply($request, $param);
    }
    
    
    
}
