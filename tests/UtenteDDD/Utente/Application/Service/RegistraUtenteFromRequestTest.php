<?php

namespace Tests\UtenteDDD\Utente\Application\Service;

use Mockery;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Support\Builder\UtenteBuilder;
use UtenteDDD\Utente\Application\DataTransformer\UtenteArrayDataTransformer;
use UtenteDDD\Utente\Application\Service\RegistraUtenteFromRequest;
use UtenteDDD\Utente\Application\Service\RegistraUtenteFromRequestRequest;
use UtenteDDD\Utente\Domain\Service\RegistraUtente;

class RegistraUtenteFromRequestTest extends KernelTestCase
{
   /** @var RegistraUtenteFromRequest */
   private $registraUtenteFromRequest;

   /**
    * @test
    * @group utente
    */
   public function registra_un_utente_tramite_una_richiesta()
   {
      $utenteArray = $this->registraUtenteFromRequest->execute(
         new RegistraUtenteFromRequestRequest('utente@domain.it', 'lapassword', 'user', true, [])
      );

      $this->assertIsArray($utenteArray);
      $this->assertNotEmpty($utenteArray);
   }

   /**
    * @test
    * @group utente
    * @group integration
    */
   public function registra_un_utente_tramite_una_richiesta_integration()
   {
      /** @var RegistraUtenteFromRequest $registraUtenteFromRequest */
      $registraUtenteFromRequest = self::$container->get(RegistraUtenteFromRequest::class);

      $utenteArray = $registraUtenteFromRequest->execute(
         new RegistraUtenteFromRequestRequest('utente@domain.it', 'lapassword', 'user', true, [])
      );

      $this->assertIsArray($utenteArray);
      $this->assertNotEmpty($utenteArray);
   }

   protected function setUp()
   {
      parent::setUp();

      self::bootKernel();

      $utenteArray = (new UtenteArrayDataTransformer())
         ->write(UtenteBuilder::crea()->build())
         ->read();

      $registraUtente = Mockery::mock(RegistraUtente::class);
      $registraUtente->shouldReceive('crea');

      $dataTransformer = Mockery::mock(UtenteArrayDataTransformer::class);
      $dataTransformer->shouldReceive('write')->andReturn($dataTransformer);
      $dataTransformer->shouldReceive('read')->andReturn($utenteArray);

      $this->registraUtenteFromRequest = new RegistraUtenteFromRequest($registraUtente, $dataTransformer);
   }
}
