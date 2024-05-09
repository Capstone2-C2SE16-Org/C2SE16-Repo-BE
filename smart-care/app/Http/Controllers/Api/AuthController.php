<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ManagerResource;
use App\Models\Manager;
use App\Models\PasswordResetToken;
use App\Models\Student;
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

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful!',
            'user' => new ManagerResource(auth()->user()),
        ]);
    }

    public function studentLogin(LoginRequest $request)
    {
        $student = Student::where('username', $request->username)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            $token = $student->createToken('Token')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'student_id' => $student->id,
                    'name' => $student->name,
                    'address' => $student->address,
                    'date_of_birth' => $student->date_of_birth,
                    'email' => $student->email,
                    'gender' => $student->gender,
                    'profile_image' => $student->profile_image,
                    'phone_number' => $student->phone_number,
                    'username' => $student->username,
                    'is_enable' => $student->is_enable,
                    'token' => $token,
                ]
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username or Password is incorrect.'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function forgetPassword(Request $request)
    {
        try {

            $request->validate(['email' => 'required|email']);

            $user = Manager::where('email', $request->email)->first() ?? Student::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['success' => false, 'msg' => 'Email not found!']);
            }

            $token = Str::random(40);
            $domain = URL::to('/');
            $url = $domain . '/reset-password?token=' . $token . '&email=' . $user->email;

            $data['url'] = $url;
            $data['email'] = $user->email;
            $data['title'] = "Đặt lại mật khẩu";
            $data['body'] = "Vui lòng nhấp vào liên kết bên dưới để đặt lại mật khẩu của bạn.";

            Mail::send('forgetPasswordMail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

            $datetime = Carbon::now()->format('Y-m-d H:i:s');
            PasswordResetToken::updateOrCreate(
                ['email' => $user->email],
                [
                    'token' => $token,
                    'created_at' => $datetime
                ]
            );
            return response()->json(['success' => true, 'msg' => 'Please check your email to reset your password.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function resetPasswordLoad(Request $request)
    {
        $token = $request->token;
        $resetData = PasswordResetToken::where('token', $token)->first();

        if (!$resetData) {
            return view('404');
        }

        return view('resetPassword', ['resetData' => $resetData]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $resetData = PasswordResetToken::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetData) {
            return response()->json(['success' => false, 'msg' => 'Invalid token or email.']);
        }

        if (Carbon::parse($resetData->created_at)->addMinutes(60)->isPast()) {
            return response()->json(['success' => false, 'msg' => 'The token has expired.']);
        }

        $user = Manager::where('email', $resetData->email)->first() ?? Student::where('email', $resetData->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            PasswordResetToken::where('email', $user->email)->delete();

            return response()->json(['success' => true, 'msg' => 'Your password has been reset successfully.']);
        } else {
            return response()->json(['success' => false, 'msg' => 'User not found.']);
        }
    }
}
