<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\mail\MailController;
use App\OneTimeQuestions;
use App\OneTimeVerificationCodes;
use App\Role;
use App\User;
use App\SessionToken;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api',
            [
                'except' =>
                    [
                        'login',
                        'register',
                        'resetPassword',
                        'logout'
                        // 'accessSessionData',
                        // 'storeSessionData',
                        // 'deleteSessionData'
                    ]
            ]
        );
    }

    public function resetPassword($email){
        $newpassword = $this->generateRandomString(10);
        (new MailController())->paswordReset($email,$newpassword);
        return response()->json('Kindly check email for password', 200);

    }
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function register(Request $request){
        $rules = [
            'email'=>'required',
            'password'=>'required|min:6'
        ];

        $data = request()->all();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        User::create([
            'email' => $data['email'],
            'role' => 2,
            'referral'=> isset($data['referral']) ? $data['referral'] : NULL,
            'password' => $data['password']
        ]);
        (new MailController())->sendDualSignupMail($data['email']);
        return $this->login($request);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->all();
        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'status' => '401',
                'response'=>'incorrect credentials'
                ]);
        }
        $user_token = SessionToken::where('user_id', auth()->user()['id'])->first();
        if($user_token){
            $to = Carbon::now();
            $from = Carbon::createFromFormat('Y-m-d H:s:i', $user_token['expired_at']);
            $diff_in_hours = $from->diffInHours($to);
            if($diff_in_hours >1){
                SessionToken::where('user_id', auth()->user()['id'])->update([
                    'token'=> $token,
                    'expired_at'=> Carbon::now()->addHours(1)
                ]);
            }else{
                SessionToken::where('user_id', auth()->user()['id'])->update([
                    'token'=> $token
                ]);
            }
        }else{
            $user_token = SessionToken::create([
                'user_id'=>auth()->user()['id'],
                'token'=> $token,
                'expired_at'=> Carbon::now()->addHours(1)
            ]);
        }
        User::where('id', auth()->user()['id'])->update([
            'last_logged_in'=> Carbon::now()->toDateTimeString()
        ]);
                // (new MailController())->sendLoginNotice(
                //             auth()->user()['email'],
                //             $credentials['browser'],
                //             $credentials['os'],
                //             $credentials['userAgent']
                //             );
        return $this->respondWithToken($token);
    }

    public function accessSessionData(Request $request) {
        if($request->session()->has('my_name'))
            echo $request->session()->get('my_name');
        else
           echo 'No data in the session';
     }
    //  public function storeSessionData(Request $request) {
    //     $request->session()->put('my_name','Virat Gandhi');
    //     echo "Data has been added to session";
    //  }
     public function deleteSessionData(Request $request) {
        $request->session()->forget('my_name');
        echo "Data has been removed from session.";
     }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $header = substr($request->header('Authorization'), 7);
        return response()->json($header);
        $s = SessionToken::where('token', $header)->first();
        if($s){
            auth()->logout();
            SessionToken::where('token', $header)->delete();
        }
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'status'=>'200',
            'response'=>'login successful',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
