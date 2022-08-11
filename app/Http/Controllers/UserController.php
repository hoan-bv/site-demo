<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        echo '<pre>';
        print_r('index');
        die;
        $users = User::paginate();
        return view('user.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = new User();
        return view('user.create', compact('user'));
    }

    public function store(Request $request) {

        request()->validate(User::RULES);
        $request['password'] = Hash::make($request->password);
        $user                = User::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data'    => $user,
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * @param Request $request
     *
     * @return false|string
     */
    public function edit(Request $request) {

        $user = JWTAuth::authenticate($request->bearerToken());
        if ($user) {
            $rule_update          = User::RULES;
            $rule_update['email'] = 'required|email|min:6|max:255|unique:users,email,' . $user->id;
            request()->validate($rule_update);
            $request['password'] = Hash::make($request->password);
            $user->update($request->all());
            return $user;
        } else {
            return response()->json(['error' => 'Not found user'], 200);
        }
        //        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User                     $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        request()->validate(User::$rules);
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id) {
        $user = User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function register() {
        echo '<pre>';
        print_r(111111);
        die;
    }

    public function authenticate(Request $request) {

        $credentials = $request->only('email', 'password');
        //valid credential
        $validator = Validator::make($credentials, [
            'email'    => 'required|email',
            'password' => 'required|string|min:6|max:50',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        //Request is validated
        //Crean token
        try {

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
            //            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }
        //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token'   => $token,
        ]);
    }

    public function logout(Request $request) {

        //Request is validated, do logout
        try {
            JWTAuth::invalidate($request->bearerToken());
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out',
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function detail(Request $request) {

        $user = JWTAuth::authenticate($request->bearerToken());
        return response()->json(['user' => $user]);
    }
}
