<?php

namespace Tests\UtenteDDD\Utente\Infrastructure\Communication\Http\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use UtenteDDD\Ruolo\Domain\Aggregate\Ruolo;

class UtenteControllerTest extends WebTestCase
{
   /** @var KernelBrowser */
   private $client;

   /**
    * @test
    * @group integration
    * @group controller
    */
   public function registra_utente()
   {
      $post = json_encode([
         "email" => "utente@dominio.it",
         "password" => "verde",
         "ruolo" => "admin"
      ]);

      $this->client->request('POST', 'v1/utente', [], [], [], $post);

      $response = $this->client->getResponse();
      $this->assertEquals(200, $response->getStatusCode());
      $this->assertEquals('application/json', $response->headers->get('Content-Type'));

      $utente = json_decode($response->getContent(), true);

      $this->assertArrayHasKey('email', $utente);
      $this->assertArrayHasKey('id', $utente);
      $this->assertArrayHasKey('ruolo', $utente);
      $this->assertArrayHasKey('enabled', $utente);
      $this->assertArrayHasKey('locked', $utente);
      $this->assertArrayHasKey('competenze', $utente);

      $this->assertFalse($utente['locked']);
      $this->assertFalse($utente['enabled']);
      $this->assertEquals(Ruolo::ROLE_ADMIN, $utente['ruolo']);
      $this->assertEquals('utente@dominio.it', $utente['email']);
   }

   protected function setUp()
   {
      parent::setUp();

      self::bootKernel();

      $this->client = static::createClient();
   }
}
