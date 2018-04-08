<?php

namespace Extr\Helpers;

use PHPUnit\Framework\TestCase;

class SecurityHelperTest extends TestCase
{
	public function testDeveCriptogravarTexto()
	{
        $texto = 'Texto qualquer';
        $texto_criptografado = ( new SecurityHelper() )->encrypt( $texto );

		$this->assertNotNull( $texto_criptografado );
    }
    
	public function testDeveValidarCriptografia()
	{
        $texto = 'Texto qualquer';
        $helper = new SecurityHelper();
        $texto_criptografado = $helper->encrypt( $texto );

		$this->assertTrue( $helper->verify( $texto, $texto_criptografado ) );
	}
    
	public function testDeveInvalidarCriptografia()
	{
        $texto = 'Texto qualquer';
        $helper = new SecurityHelper();
        $texto_criptografado = $helper->encrypt( $texto );

		$this->assertFalse( $helper->verify( 'Novo texto', $texto_criptografado ) );
	}
}