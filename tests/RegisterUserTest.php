<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->request('get','/inscription');
        $client->submitForm('register_user_type_form_submit', [
            'register_user_type_form[email]' => 'test6@hotmail.com',
            'register_user_type_form[plainPassword][first]' => 'mohamed',
            'register_user_type_form[plainPassword][second]' => 'mohamed',
            'register_user_type_form[firstname]' => 'mohamed',
            'register_user_type_form[lastname]' => 'akrouche'
        ]);
       $this->assertResponseRedirects('/connexion');
        $client->followRedirect();
        $this->assertSelectorExists('div:contains("Votre compte a bien été créer, vous pouvez vous connecté")');
    }
}
