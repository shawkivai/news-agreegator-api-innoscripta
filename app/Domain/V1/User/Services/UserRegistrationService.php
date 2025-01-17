<?php

namespace App\Domain\V1\User\Services;

use App\DataTransferObjects\ServiceResponseDTO;
use App\Domain\V1\User\Repositories\UserRepository;
use App\Enums\V1\HttpStatus;
use App\Traits\ServiceResponseTrait;
use Illuminate\Support\Facades\Hash;

class UserRegistrationService
{
    use ServiceResponseTrait;

    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    /**
     * Register user
     */
    public function execute(array $data): ServiceResponseDTO
    {
        try {
            $data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ];
            $user = $this->userRepository->create($data);

            return $this->respondSuccess($user, HttpStatus::CREATED, 'User registered successfully');
        } catch (\Throwable $th) {
            return $this->respondFailed($th->getMessage(), HttpStatus::BAD_REQUEST);
        }
    }
}
