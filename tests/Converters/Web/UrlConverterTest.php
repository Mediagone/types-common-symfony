<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Web;

use Mediagone\Symfony\Types\Common\Converters\Web\UrlConverter;
use Mediagone\Types\Common\Web\Url;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Web\UrlConverter
 */
final class UrlConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new UrlConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Url::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'http://domain.com/some/url']);
        $param = new ParamConverter(['name' => 'param'], Url::class);
        
        (new UrlConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Url::class, $convertedParam);
        self::assertSame('http://domain.com/some/url', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'an/invalid/url']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Url::class);
        
        (new UrlConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'an/invalid/url']);
        $param = new ParamConverter(['name' => 'param'], Url::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new UrlConverter())->apply($request, $param);
    }
    
    
    
}
