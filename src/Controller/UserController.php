<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use \DateTime;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    #[Route('/user/{id}', name: 'get_user', methods: ['GET'])]
    public function getUser(int $id): JsonResponse
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], 404);
        }

        return new JsonResponse($user);
    }

    #[Route('/user', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        // todo create user
    }

    #[Route('/user/{email}', name: 'user_by_email', methods: ['GET'])]
    public function getUserByEmail(string $email): JsonResponse
    {
        $user = $this->userRepository->findByEmail($email);

        return new JsonResponse($user);
    }

    #[Route('/users/role/{role}', name: 'users_by_role', methods: ['GET'])]
    public function getUsersByRole(string $role): JsonResponse
    {
        $users = $this->userRepository->findByRole($role);

        return new JsonResponse($users);
    }

    #[Route('/users/created-after', name: 'users_created_after', methods: ['GET'])]
    public function getUsersCreatedAfter(Request $request): JsonResponse
    {
        $date = new DateTime($request->query->get('date'));
        $users = $this->userRepository->findCreatedAfter($date);

        return new JsonResponse($users);
    }
}
