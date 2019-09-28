<?php

namespace Tests\UtenteDDD\Utente\Application\DataTransformer;

use PHPUnit\Framework\TestCase;
use Tests\Support\Builder\UtenteBuilder;
use UtenteDDD\Utente\Application\DataTransformer\UtenteArrayDataTransformer;

class UtenteArrayDataTransformerTest extends TestCase
{
   /**
    * @test
    * @group utente
    * @group data-transformer
    */
   public function trasforma_un_utente_in_array()
   {
      $utente = UtenteBuilder::crea()->build();

      $utenteArray = (new UtenteArrayDataTransformer())->write($utente)->read();

      $this->assertIsArray($utenteArray);
      $this->assertNotEmpty($utenteArray);

      $this->assertArrayHasKey('id', $utenteArray);
      $this->assertArrayHasKey('email', $utenteArray);
      $this->assertArrayHasKey('ruolo', $utenteArray);
      $this->assertArrayHasKey('enabled', $utenteArray);
      $this->assertArrayHasKey('locked', $utenteArray);
      $this->assertArrayHasKey('competenze', $utenteArray);
   }
}
