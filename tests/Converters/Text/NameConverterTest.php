<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\Types\Common\Converters\Text\NameConverter;
use Mediagone\Types\Common\Text\Name;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Text\NameConverter
 */
final class NameConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new NameConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Name::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'A valid name']);
        $param = new ParamConverter(['name' => 'param'], Name::class);
        
        (new NameConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Name::class, $convertedParam);
        self::assertSame('A valid name', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An_invalid_name']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Name::class);
        
        (new NameConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An_invalid_name']);
        $param = new ParamConverter(['name' => 'param'], Name::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new NameConverter())->apply($request, $param);
    }
    
    
    
}
