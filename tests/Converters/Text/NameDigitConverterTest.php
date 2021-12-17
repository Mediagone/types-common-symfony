<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\Types\Common\Converters\Text\NameDigitConverter;
use Mediagone\Types\Common\Text\NameDigit;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Text\NameDigitConverter
 */
final class NameDigitConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new NameDigitConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], NameDigit::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'A valid n4me']);
        $param = new ParamConverter(['name' => 'param'], NameDigit::class);
        
        (new NameDigitConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(NameDigit::class, $convertedParam);
        self::assertSame('A valid n4me', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An_invalid_n4me']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], NameDigit::class);
        
        (new NameDigitConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An_invalid_n4me']);
        $param = new ParamConverter(['name' => 'param'], NameDigit::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new NameDigitConverter())->apply($request, $param);
    }
    
    
    
}
