<?php

namespace UtenteDDD\Common\Infrastructure\Communication\Http\Symfony\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UtenteDDD\Utente\Application\Service\RegistraUtenteFromRequest;

class IndexController
{
   public function index(Request $request, RegistraUtenteFromRequest $registraUtenteFromRequest)
   {
      return new JsonResponse(['project_name' => 'Domain Driven Design - Esempio Utente']);
   }
}
