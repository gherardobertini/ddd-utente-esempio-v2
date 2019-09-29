<?php

namespace Tests\UtenteDDD\Utente\Domain\Service;

use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\UtenteDDD\Utente\Domain\Aggregate\InMemory\InMemoryUtenti;
use UtenteDDD\Utente\Domain\Aggregate\EmailUtente;
use UtenteDDD\Utente\Domain\Aggregate\IdUtente;
use UtenteDDD\Utente\Domain\Aggregate\Password\HashedPassword;
use UtenteDDD\Utente\Domain\Aggregate\Utente;
use UtenteDDD\Utente\Domain\Aggregate\Utenti;
use UtenteDDD\Utente\Domain\Service\RegistraUtente;
use UtenteDDD\Utente\Infrastructure\Domain\Service\BasicPasswordHashing;

class RegistraUtenteTest extends TestCase
{
   /** @var Utenti */
   private $utenti;
   private $registraUtente;

   /**
    * @test
    * @group utente
    * @expectedException \UtenteDDD\Utente\Domain\Exception\EmailUtenteIsNotUniqueException
    * @expectedExceptionMessage Email già presente user@dominio.it
    */
   public function la_mail_deve_essere_univoca()
   {
      $utente = Mockery::mock(Utente::class);

      $this->utenti->shouldReceive('byEmail')->andReturn($utente);

      $this->registraUtente->crea(
         'user@dominio.it',
         'secure_psw',
         'admin'
      );
   }

   /**
    * @test
    * @group utente
    */
   public function registra_un_nuovo_utente()
   {
      $this->utenti->shouldReceive('byEmail')->andReturn(null);
      $this->utenti->shouldReceive('nextIdentity')->andReturn(IdUtente::create());
      $this->utenti->shouldReceive('aggiungi');

      $utente = $this->registraUtente->crea(
         'user@dominio.it',
         'secure_psw',
         'admin',
         [
            'raccogli foglie',
            'raccogli aghi di pino'
         ]
      );

      $this->assertInstanceOf(Utente::class, $utente);
      $this->assertInstanceOf(HashedPassword::class, $utente->password());
      $this->assertNotEquals((string)$utente->password(), 'secure_psw');
   }

   /**
    * @test
    * @group utente
    */
   public function registra_un_nuovo_utente_in_memoria()
   {
      $utenti = new InMemoryUtenti();
      $registraUtente = new RegistraUtente($utenti, new BasicPasswordHashing());

      $utente = $registraUtente->crea(
         'user@dominio.it',
         'secure_psw',
         'user'
      );

      $this->assertInstanceOf(Utente::class, $utente);
      $utente = $utenti->byEmail(EmailUtente::crea('user@dominio.it'));
      $this->assertInstanceOf(Utente::class, $utente);
   }

   protected function setUp()
   {
      parent::setUp();

      $this->utenti = Mockery::mock(Utenti::class);

      $this->registraUtente = new RegistraUtente($this->utenti, new BasicPasswordHashing());
   }
}
