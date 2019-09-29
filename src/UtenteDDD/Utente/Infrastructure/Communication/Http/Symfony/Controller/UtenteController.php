<?php

namespace UtenteDDD\Utente\Infrastructure\Communication\Http\Symfony\Controller;

use Symfony\Component\HttpFoundation\Request;
use UtenteDDD\Common\Infrastructure\Communication\Http\Symfony\Controller\DDDUtenteController;
use UtenteDDD\Utente\Application\Service\RegistraUtenteFromRequest;
use UtenteDDD\Utente\Application\Service\RegistraUtenteFromRequestRequest;

class UtenteController extends DDDUtenteController
{
   public function registraUtente(Request $request, RegistraUtenteFromRequest $service)
   {
      $content = json_decode($request->getContent(), true);

      $competenze = isset($content['competenze']) ? $content['competenze'] : [];

      return $this->executeService($service, new RegistraUtenteFromRequestRequest(
         $content['email'],
         $content['password'],
         $content['ruolo'],
         false,
         $competenze
      ));
   }
}
