<?php declare(strict_types=1);

namespace Tests\Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\Types\Common\Converters\Text\TitleConverter;
use Mediagone\Types\Common\Text\Title;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Mediagone\Symfony\Types\Common\Converters\Foo;
use function str_repeat;


/**
 * @covers \Mediagone\Symfony\Types\Common\Converters\Text\TitleConverter
 */
final class TitleConverterTest extends TestCase
{
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_supports_specific_type_parameter() : void
    {
        $converter = new TitleConverter();
        
        self::assertTrue($converter->supports(new ParamConverter(['name' => 'param'], Title::class)));
        self::assertFalse($converter->supports(new ParamConverter(['name' => 'param'], Foo::class)));
    }
    
    
    public function test_can_converts_a_valid_value() : void
    {
        $request = new Request(['param' => 'Lorem ipsum dolor...']);
        $param = new ParamConverter(['name' => 'param'], Title::class);
        
        (new TitleConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertInstanceOf(Title::class, $convertedParam);
        self::assertSame('Lorem ipsum dolor...', (string)$convertedParam);
    }
    
    
    public function test_returns_null_on_invalid_data() : void
    {
        $request = new Request(['param' => str_repeat('a', Title::MAX_LENGTH + 1)]);
        $param = new ParamConverter(['name' => 'param', 'isOptional' => true], Title::class);
        
        (new TitleConverter())->apply($request, $param);
        $convertedParam = $request->attributes->get('param');
        
        self::assertNull($convertedParam);
    }
    
    
    public function test_throws_exception_on_invalid_data() : void
    {
        $request = new Request(['param' => str_repeat('a', Title::MAX_LENGTH + 1)]);
        $param = new ParamConverter(['name' => 'param'], Text::class);
        
        $this->expectException(NotFoundHttpException::class);
        (new TitleConverter())->apply($request, $param);
    }
    
    
    
}
