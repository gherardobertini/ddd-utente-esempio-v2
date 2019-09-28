<?php

namespace UtenteDDD\Utente\Infrastructure\Communication\Http\Symfony\Controller;

use Symfony\Component\HttpFoundation\Request;
use UtenteDDD\Common\Infrastructure\Communication\Http\Symfony\Controller\DDDUtenteController;
use UtenteDDD\Utente\Application\Service\RegistraUtenteFromRequest;
use UtenteDDD\Utente\Application\Service\RegistraUtenteFromRequestRequest;

class UtenteController extends DDDUtenteController
{
   public function signUpUtente(Request $request, RegistraUtenteFromRequest $service)
   {
      $content = json_decode($request->getContent(), true);

      return $this->executeService($service, new RegistraUtenteFromRequestRequest(
         $content['email'],
         $content['password'],
         $content['ruolo'],
         true
      ));
   }
}
