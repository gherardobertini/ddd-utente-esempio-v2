<?php

namespace Tests\UtenteDDD\Utente\Infrastructure\Domain\Aggregate\Doctrine;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Support\Builder\UtenteBuilder;
use UtenteDDD\Utente\Domain\Aggregate\EmailUtente;
use UtenteDDD\Utente\Domain\Aggregate\Utente;
use UtenteDDD\Utente\Domain\Aggregate\Utenti;

class DoctrineUtentiTest extends KernelTestCase
{
   /** @var Utenti */
   private $utenti;

   /**
    * @test
    * @group integration
    */
   public function salvo_un_utente_nel_db()
   {
      $utente = UtenteBuilder::crea()
         ->withEmail('utente@email.it')
         ->build();

      $this->utenti->aggiungi($utente);

      $utenteDb = $this->utenti->byEmail(EmailUtente::crea('utente@email.it'));

      $this->assertInstanceOf(Utente::class, $utenteDb);
   }

   protected function setUp()
   {
      self::bootKernel();

      $this->utenti = self::$container->get(Utenti::class);
   }
}
