<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Graphics;

use Mediagone\Symfony\Types\Common\Converters\Graphics\ColorConverter;
use Mediagone\Types\Common\Graphics\Color;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Graphics\ColorConverter
 */
final class ColorConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new ColorConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Color::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => '#ffcc00']);
        $param = new ParamConverter(['name' => 'param'], Color::class);
        
        (new ColorConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Color::class, $convertedParam);
        self::assertSame('#ffcc00', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_value() : void
    {
        $request = new Request(['param' => 'invalid color']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Color::class);
        
        (new ColorConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_value() : void
    {
        $request = new Request(['param' => 'invalid color']);
        $param = new ParamConverter(['name' => 'param'], Color::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new ColorConverter())->apply($request, $param);
    }
    
    
    
}
