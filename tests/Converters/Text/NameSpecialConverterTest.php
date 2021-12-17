<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\Types\Common\Converters\Text\NameSpecialConverter;
use Mediagone\Types\Common\Text\NameSpecial;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Text\NameSpecialConverter
 */
final class NameSpecialConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new NameSpecialConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], NameSpecial::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'A_valid_name']);
        $param = new ParamConverter(['name' => 'param'], NameSpecial::class);
        
        (new NameSpecialConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(NameSpecial::class, $convertedParam);
        self::assertSame('A_valid_name', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An*invalid*name']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], NameSpecial::class);
        
        (new NameSpecialConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An*invalid*name']);
        $param = new ParamConverter(['name' => 'param'], NameSpecial::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new NameSpecialConverter())->apply($request, $param);
    }
    
    
    
}
