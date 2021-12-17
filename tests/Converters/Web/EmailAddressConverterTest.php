<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Web;

use Mediagone\Symfony\Types\Common\Converters\Web\EmailAddressConverter;
use Mediagone\Types\Common\Web\EmailAddress;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Web\EmailAddressConverter
 */
final class EmailAddressConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new EmailAddressConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], EmailAddress::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'test@domain.com']);
        $param = new ParamConverter(['name' => 'param'], EmailAddress::class);
        
        (new EmailAddressConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(EmailAddress::class, $convertedParam);
        self::assertSame('test@domain.com', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => 'Invalid email']);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], EmailAddress::class);
        
        (new EmailAddressConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => 'Invalid email']);
        $param = new ParamConverter(['name' => 'param'], EmailAddress::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new EmailAddressConverter())->apply($request, $param);
    }
    
    
    
}
