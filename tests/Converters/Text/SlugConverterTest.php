<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\Types\Common\Converters\Text\SlugConverter;
use Mediagone\Types\Common\Text\Slug;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Text\SlugConverter
 */
final class SlugConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new SlugConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Slug::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'a-valid-slug']);
        $param = new ParamConverter(['name' => 'param'], Slug::class);
        
        (new SlugConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Slug::class, $convertedParam);
        self::assertSame('a-valid-slug', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'an invalid slug']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Slug::class);
        
        (new SlugConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'an invalid slug']);
        $param = new ParamConverter(['name' => 'param'], Slug::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new SlugConverter())->apply($request, $param);
    }
    
    
    
}
