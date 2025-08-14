<?php 

namespace App\Core\Application\UseCase\Frontend;

use App\Core\Domain\Contracts\UserContract;
use App\Core\Domain\Entities\UserEntity;
use App\Core\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;



class UserUsecase {
    private UserRepositoryInterface $userRepository;
    private UserContract $userContract;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserContract $userContract,
    ){
        $this->userRepository = $userRepository;
        $this->userContract = $userContract;
    }

    //usecase frontend
    public function showInfor(int $id): array
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            throw new \Exception('Không tìm thấy người dùng');
        }

        return [
            'user' => $user
        ];
    }

    public function updateInfor(int $id, array $data): array
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

    public function changePassword(int $userId, string $currentPassword, string $newPassword): bool
    {
        $user = $this->userRepository->findById($userId);

        $this->userContract->validateChangePassword($user, $currentPassword, $newPassword);

        return $this->userRepository->changePassword($userId, bcrypt($newPassword));
    }


}