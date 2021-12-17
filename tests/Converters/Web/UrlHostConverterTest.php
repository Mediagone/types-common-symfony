<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Web;

use Mediagone\Symfony\Types\Common\Converters\Web\UrlHostConverter;
use Mediagone\Types\Common\Web\UrlHost;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Web\UrlHostConverter
 */
final class UrlHostConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new UrlHostConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], UrlHost::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'http://domain.com']);
        $param = new ParamConverter(['name' => 'param'], UrlHost::class);
        
        (new UrlHostConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(UrlHost::class, $convertedParam);
        self::assertSame('http://domain.com', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'an/invalid/url']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], UrlHost::class);
        
        (new UrlHostConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'an/invalid/url']);
        $param = new ParamConverter(['name' => 'param'], UrlHost::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new UrlHostConverter())->apply($request, $param);
    }
    
    
    
}
