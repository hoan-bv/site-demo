<?php

namespace App\Services;

use App\Models\Language;
use App\Models\Notification;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService {

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function findOne($bearerToken) {
        return JWTAuth::authenticate($bearerToken);
    }

    public function login(Request $request) {
        $result      = [];
        $credentials = $request->only('email', 'password');
        try {
            $validator = Validator::make($credentials, [
                'email'    => 'required|email',
                'password' => 'required|string|min:6|max:50',
            ]);
            if ($validator->fails()) {
                $result['error'] = $validator->messages();
            }
            if (!$result['token'] = JWTAuth::attempt($credentials)) {
                $result['error'] = 'Login credentials are invalid.';
            }
        } catch (JWTException $e) {
            return $result['error'] = $e->getMessage();
        }
        //Token created, return with success response and jwt token
        $currentUser = Auth::user();
        $language    = Language::find($request['lang']);
        if ($currentUser && $language) {
            $currentUser->lang_id = $language->id;
            $currentUser->save();
        }
        return $result;
    }

    public function notify(?string $bearerToken) {
        $user   = JWTAuth::authenticate($bearerToken);
        $result = [];
        if ($user) {
            $count_notify = Notification::where([
                [
                    'user_id',
                    '=',
                    $user->id,
                ],
                [
                    'status',
                    '=',
                    Notification::UN_READ,
                ],
            ])->select('notifiable_type', DB::raw('count(*) as total'))->groupBy('notifiable_type')->get();
            $result       = $count_notify;
        } else {
            $result['error'] = 'Login credentials are invalid.';
        }
        return $result;
    }

    public function read(Request $request) {

        $user = JWTAuth::authenticate($request->bearerToken());
        if ($user) {
            $noty         = Notification::find($request['notify_id']);
            $noty->status = Notification::READ;
            $noty->save();
            $result = 'Read';
        } else {
            $result['error'] = 'Login credentials are invalid.';
        }
        return $result;
    }
}
