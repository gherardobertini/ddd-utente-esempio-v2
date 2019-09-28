<?php

namespace UtenteDDD\Utente\Infrastructure\Domain\Aggregate\Doctrine;

use DDDStarterPack\Infrastructure\Domain\Aggregate\Doctrine\Repository\DoctrineRepository;
use UtenteDDD\Utente\Domain\Aggregate\EmailUtente;
use UtenteDDD\Utente\Domain\Aggregate\IdUtente;
use UtenteDDD\Utente\Domain\Aggregate\Utente;
use UtenteDDD\Utente\Domain\Aggregate\Utenti;

class DoctrineUtenti extends DoctrineRepository implements Utenti
{
   public function nextIdentity(): IdUtente
   {
      return IdUtente::create();
   }

   public function aggiungi(Utente $utente): void
   {
      $this->em->persist($utente);
      $this->em->flush();
   }

   public function byEmail(EmailUtente $email): ?Utente
   {
      return $this->em->createQueryBuilder()
         ->select($this->getEntityAliasName())
         ->from($this->getEntityClassName(), $this->getEntityAliasName())
         ->where($this->getEntityAliasName() . '.email = :email')->setParameter('email', $email)
         ->getQuery()
         ->getOneOrNullResult();
   }

   protected function getEntityAliasName(): string
   {
      return 'u';
   }

   public function byId(IdUtente $idUtente): ?Utente
   {

   }
}
