<?php

namespace App\Service;

use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Account;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountService
{
    public function __construct(
        private readonly AccountRepository $accountRepository,
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $hasher
    ) {}

    public function saveUser(Account $account): Account
    {
        if ($this->accountRepository->findOneBy(["email" => $account->getEmail()])) {
            throw new \Exception("Le compte " . $account->getEmail() . " existe déja");
        }

        $account->setPassword($this->hasher->hashPassword(
            $account,
            $account->getPassword()
        ));

        $this->em->persist($account);
        $this->em->flush();

        return $account;
    }
}
