<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    public function create(
        Request $request,
        UserPasswordEncoder $passwordEncoder,
        ValidatorInterface $validator
    )
    {
        $data = json_decode($request->getContent(), true, JSON_THROW_ON_ERROR);
        $user = new User();

        if (isset($data['username'])) {
            $user->setUsername($data['username']);
        }

        if (isset($data['password'])) {
            $user->setPassword($passwordEncoder->encodePassword($user, $data['password']));
        }

        if (isset($data['isAdmin']) && $data['isAdmin']) {
            $user->setRoles([User::ROLE_ADMIN]);
        }

        $validator->validate($user);

        return $this->json(['id' => $user->getId()]);
    }
}