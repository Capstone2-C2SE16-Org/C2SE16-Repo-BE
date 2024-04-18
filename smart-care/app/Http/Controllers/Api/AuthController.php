<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ManagerResource;
use App\Models\Manager;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            Helper::sendError('Username or Password is woring !!!');
        }

        return new ManagerResource(auth()->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function forgetPassword(Request $request)
    {
        try {

            $manager = Manager::where('email', $request->email)->get();

            if (count($manager) > 0) {
                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/reset-password?token=' . $token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = "Đặt lại mật khẩu";
                $data['body'] = "Vui lòng nhấp vào liên kết bên dưới để đặt lại mật khẩu của bạn.";

                Mail::send('forgetPasswordMail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                $datetime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordResetToken::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );
                return response()->json(['success' => true, 'msg' => 'Please check your mail to reset your password.']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Manager not found!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // Reset password view load
    public function resetPasswordLoad(Request $request)
    {
        $resetData =  PasswordResetToken::where('token', $request->token)->get();
        if (isset($request->token) && count($resetData) > 0) {

            $manager =  Manager::where('email', $resetData[0]['email'])->get();
            return view('resetPassword', compact('manager'));
        } else {
            return view('404');
        }
    }

    // Password reset functionality

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $manager = Manager::find($request->id);
        $manager->password = Hash::make($request->password);
        $manager->save();

        PasswordResetToken::where('email', $manager->email)->delete();

        return "<h1>Mật khẩu của bạn đã được đặt lại thành công.</h1>";
    }
}
