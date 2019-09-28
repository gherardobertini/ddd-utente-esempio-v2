<?php

namespace UtenteDDD\Utente\Application\Service;

use DDDStarterPack\Application\DataTransformer\DataTransformer;
use DDDStarterPack\Application\Service\ApplicationService;
use UtenteDDD\Utente\Domain\Service\RegistraUtente;

class RegistraUtenteFromRequest implements ApplicationService
{
   private $registraUtente;
   private $dataTransformer;

   public function __construct(RegistraUtente $registraUtente, DataTransformer $dataTransformer)
   {
      $this->registraUtente = $registraUtente;
      $this->dataTransformer = $dataTransformer;
   }

   public function execute($request = null): array
   {
      return $this->doExecute($request)->read();
   }

   private function doExecute(RegistraUtenteFromRequestRequest $request): DataTransformer
   {
      $email = $request->getEmail();
      $password = $request->getPassword();
      $competenze = $request->getCompetenze();
      $ruolo = $request->getRuolo();
      $enabled = $request->getEnabled();

      $utente = $this->registraUtente->crea(
         $email,
         $password,
         $ruolo,
         $competenze,
         $enabled
      );

      return $this->dataTransformer->write($utente);
   }
}
