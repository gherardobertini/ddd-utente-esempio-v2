<?php

namespace UtenteDDD\Common\Infrastructure\Communication\Http\Symfony\Controller;

use DDDStarterPack\Application\DataTransformer\DataTransformer;
use DDDStarterPack\Application\Exception\ApplicationException;
use DDDStarterPack\Application\Service\ApplicationService;
use DDDStarterPack\Application\Service\ApplicationServiceResponse;
use DDDStarterPack\Domain\Aggregate\EntityId;
use DDDStarterPack\Domain\Exception\DomainException;
use DDDStarterPack\Domain\Exception\DomainModelNotFoundException;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class DDDUtenteController
{
   protected function executeService(ApplicationService $service, $request = null, $status = 200, $contextPath = null): JsonResponse
   {
      try {

         $serviceResponse = $service->execute($request);

         return $this->prepareResponse($serviceResponse, $contextPath);

      } catch (DomainModelNotFoundException $e) {

         return new JsonResponse(json_encode(['message' => $e->getMessage()]), 404, [], true);

      } catch (DomainException | ApplicationException $e) {

         return new JsonResponse(json_encode(['message' => $e->getMessage()]), 500, [], true);

      } catch (Exception $exception) {

         throw $exception;
      }
   }

   private function prepareResponse($serviceResponse, $contextPath = null): JsonResponse
   {
      $response = null;
      $status = 200;

      if (is_array($serviceResponse)) {
         $response = $serviceResponse;
      }

      if (is_bool($serviceResponse)) {
         $response = ['status' => $serviceResponse];
      }

      if ($serviceResponse instanceof DataTransformer) {

         $response = $serviceResponse->read();
      }

      if ($serviceResponse instanceof ApplicationServiceResponse) {

         $response = $serviceResponse->getResponso();

         if ($response instanceof EntityId) {
            $response = ['uuid' => (string)$response];
         }

         if (!$serviceResponse->getSuccess()) {
            $status = 500;
         }
      }

      $headers = $this->prepareHeaders($contextPath, $serviceResponse);

      return new JsonResponse(json_encode($response), $status, $headers, true);
   }

   protected function prepareHeaders($contextPath, $serviceResponse): array
   {
      $headers = [];
      if ($serviceResponse instanceof EntityId) {
         $headers = [
            'Location' => $contextPath . '/' . $serviceResponse->id()
         ];
      }
      return $headers;
   }
}
