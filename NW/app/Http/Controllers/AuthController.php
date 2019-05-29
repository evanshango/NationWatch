<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Client;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    private $client;

    public function __construct() {
        $this->client = Client::find(1);
    }

    public function index(){
        $user = User::orderBy('id', 'desc')->get();
        return UserCollection::collection($user);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function register(Request $request){

        $this->validate($request, [
            'name' => 'required|unique:users',
            'email' => 'required|email|string:255|unique:users',
            'location_id' => 'required|integer',
            'yob' => 'required|integer|max:'.date('Y'),
            'gender' => 'required',
            'description' => 'nullable|string:255',
            'profile_pic' => 'nullable|max:50128',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->location_id = $request->location_id;
        $user->yob = $request->yob;
        $user->gender = $request->gender;
        $user->description = $request->description;
        $user->profile_pic = $request->profile_pic;
        $user->password = $request->password;

        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            $filename = time() . '.' . $profile_pic->getClientOriginalExtension();
            $request->file('profile_pic')->storeAS('public/profile', $filename);
            $user->profile_pic = 'profile/' .$filename;
        }
        $user->save();

        return $this->issueToken($request, 'password');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        return $this->issueToken($request, 'password');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function refresh(Request $request){
        $this->validate($request, [
            'refresh_token' => 'required'
        ]);

        return $this->issueToken($request, 'refresh_token');
    }

    /**
     * @return JsonResponse
     */
    public function logout(){
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);

        $accessToken->revoke();

        return response()->json([
            'message' => 'logged out'
        ], Response::HTTP_OK);
    }

    protected function issueToken(Request $request, $grantType, $scope = "*"){
        $params = [
            'grant_type' => $grantType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->username ?: $request->email,
            'scope' => $scope
        ];

        $request->request->add($params);
        $proxy = Request::create('oauth/token', 'POST');
        return Route::dispatch($proxy);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id){
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $user->delete();

        return response()->json([
            'message' => 'Account deleted'
        ]);
    }

}
