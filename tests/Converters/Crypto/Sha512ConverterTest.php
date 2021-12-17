<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Crypto;

use Mediagone\Symfony\Types\Common\Converters\Crypto\Sha512Converter;
use Mediagone\Types\Common\Crypto\Sha512;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Crypto\Sha512Converter
 */
final class Sha512ConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new Sha512Converter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Sha512::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $hash = (string)Sha512::fromString('s3cr3t');
        $request = new Request(['param' => $hash]);
        $param = new ParamConverter(['name' => 'param'], Sha512::class);
        
        (new Sha512Converter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Sha512::class, $convertedParam);
        self::assertSame($hash, (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An invalid hash']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Sha512::class);
        
        (new Sha512Converter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An invalid hash']);
        $param = new ParamConverter(['name' => 'param'], Sha512::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new Sha512Converter())->apply($request, $param);
    }
    
    
    
}
