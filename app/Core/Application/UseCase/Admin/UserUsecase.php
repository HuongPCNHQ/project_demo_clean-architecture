<?php

namespace App\Core\Application\UseCase\Admin;

use App\Core\Domain\Repositories\UserRepositoryInterface;
use App\Core\Domain\Entities\UserEntity;
use Illuminate\Support\Facades\Hash;

class UserUseCase
{
    private UserRepositoryInterface $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById(int $id){
        return $this->userRepository->findById($id);
    }

    public function listUser(){
        return $this->userRepository->getAll();
    }
    
    public function listUserByRole(string $role){
        return $this->userRepository->getByRole($role);
    }
    
    public function listUserByIsActive(int $isActive){
        return $this->userRepository->getByIsActive($isActive);
    }

    public function listUserByIsLock(int $isLock){
        return $this->userRepository->getByIsLock($isLock);
    }

    public function addUser(array $data): UserEntity
    {
        $user = new UserEntity([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => $data['role'], // 'admin' hoặc 'user'
            'password' => Hash::make($data['password']),
            'email_verified_at' => null,
            'two_fa_enabled' => true,
            'two_fa_secret' => null,
            'otp_code' => null,
            'otp_expires_at' => now()->addMinutes(5),
            'is_active' => 1, // mặc định kích hoạt
        ]);

        return $this->userRepository->save($user);
    }

    public function updateUser(int $id, array $data): array
    {
        $user = $this->userRepository->updateInfor($id, $data);

        if (!$user) {
            throw new \Exception("Người dùng không tồn tại");
        }

        return [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role'  => $user->role
        ];
    }

    public function lockAndUnlock(int $id){
        return $this->userRepository->lockAndUnlock($id);
    }

    public function removeUser(int $id){
        return $this->userRepository->removeUser($id);
    }
}
