<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Crypto;

use Mediagone\Symfony\Types\Common\Converters\Crypto\HashBcryptConverter;
use Mediagone\Types\Common\Crypto\HashBcrypt;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Crypto\HashBcryptConverter
 */
final class HashBcryptConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new HashBcryptConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], HashBcrypt::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $hash = (string)HashBcrypt::fromString('s3cr3t');
        $request = new Request(['param' => $hash]);
        $param = new ParamConverter(['name' => 'param'], HashBcrypt::class);
        
        (new HashBcryptConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(HashBcrypt::class, $convertedParam);
        self::assertSame($hash, (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An invalid hash']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], HashBcrypt::class);
        
        (new HashBcryptConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'An invalid hash']);
        $param = new ParamConverter(['name' => 'param'], HashBcrypt::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new HashBcryptConverter())->apply($request, $param);
    }
    
    
    
}
