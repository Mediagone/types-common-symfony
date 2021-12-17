<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\Types\Common\Converters\Geo\AddressConverter;
use Mediagone\Types\Common\Geo\Address;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;
use function str_repeat;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Geo\AddressConverter
 */
final class AddressConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new AddressConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Address::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => '123456']);
        $param = new ParamConverter(['name' => 'param'], Address::class);
        
        (new AddressConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Address::class, $convertedParam);
        self::assertSame('123456', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => str_repeat('a', Address::MAX_LENGTH + 1)]);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Address::class);
        
        (new AddressConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => str_repeat('a', Address::MAX_LENGTH + 1)]);
        $param = new ParamConverter(['name' => 'param'], Address::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new AddressConverter())->apply($request, $param);
    }
    
    
    
}
