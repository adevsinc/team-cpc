<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function access_login(Request $request)
    {
        // Logic for handling access login
        return view('frontend.pages.login');
    }

    public function register(Request $request)
    {
        // Logic for handling register
        return view('frontend.pages.register');
    }




    public function requestOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Please enter valid cell phone #.'
            ]);
        }

        $phone = str_replace(['-', ' ', '(', ')'], '', $request->phone);

        if (strlen($phone) != 10) {
            return response()->json([
                'error' => true,
                'message' => 'Please enter valid cell phone #.'
            ]);
        }

        $user = AdminUser::where('status', 1)
            ->where('is_deleted', 0)
            ->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(phone, '-', ''), ' ', ''), '(', ''), ')', '') = ?", [$phone])
            ->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Uh oh! The number entered below does not match any account on file. Please check with your manager to ensure your info is correct in our system.'
            ]);
        }

        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        $user->update([
            'login_otp' => $otp,
            'login_otp_date' => now()
        ]);

        // Send SMS (implement your SMS service here)
        $this->sendSms($phone, $otp);

        return response()->json([
            'success' => true,
            'secure_token' => $user->secure_id,
            'message' => 'A one time passcode has just been sent to ' . $request->phone . '.'
        ]);
    }

    /**
     * Request OTP via Email
     */
    public function requestEmailOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Please enter valid email.'
            ]);
        }

        $user = AdminUser::where('status', 1)
            ->where('is_deleted', 0)
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Uh oh! The email entered below does not match any account on file. Please check with your manager to ensure your info is correct in our system.'
            ]);
        }

        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        $user->update([
            'login_otp' => $otp,
            'login_otp_date' => now(),
            'updated_at' => now()
        ]);

        // Send Email (implement your email service here)
        $this->sendEmail($user->email, $otp);

        return response()->json([
            'success' => true,
            'secure_token' => $user->secure_id,
            'message' => 'A one time passcode has just been sent to your email successfully.'
        ]);
    }

    /**
     * Employee Login with OTP verification
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secure_token' => 'required|string',
            'otp' => 'required|string|size:4',
            'step' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Please enter valid OTP.'
            ]);
        }

        $step = (int) $request->step;
        $secureId = $request->secure_token;
        $otp = $request->otp;
        $phone = str_replace(['-', ' ', '(', ')'], '', $request->phone ?? '');
        $email = $request->email;
        $pin = $request->pin;
        $resetPin = $request->reset_pin === 'true' || $request->reset_pin === true;

        // Find user by phone or email with OTP verification
        $user = null;
        if (!empty($phone)) {
            $user = AdminUser::where('status', 1)
                ->where('is_deleted', 0)
                ->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(phone, '-', ''), ' ', ''), '(', ''), ')', '') = ?", [$phone])
                ->where('login_otp', $otp)
                ->where('secure_id', $secureId)
                ->first();
        } elseif (!empty($email)) {
            $user = AdminUser::where('status', 1)
                ->where('is_deleted', 0)
                ->where('email', $email)
                ->where('login_otp', $otp)
                ->where('secure_id', $secureId)
                ->first();
        }

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Entered OTP is not valid.'
            ]);
        }

        // Handle PIN reset
        if ($resetPin && $step === 4) {
            // Check if PIN is already in use
            $existingPinUser = AdminUser::where('pin', $pin)
                ->where('admin_user_id', '!=', $user->admin_user_id)
                ->first();

            if ($existingPinUser) {
                return response()->json([
                    'error' => true,
                    'message' => 'The pin you entered is already in use. Please try again with a different pin.'
                ]);
            }

            $user->update(['pin' => $pin]);
            $user->refresh();
        }

        // Validate PIN
        $userPin = $user->pin;
        $pinValid = preg_match('/^\d{4,6}$/', $userPin);

        if (!$pinValid) {
            return response()->json([
                'pin_reset' => true
            ]);
        }

        // Check for duplicate PINs
        $duplicatePinCount = AdminUser::where('pin', $userPin)->count();
        if ($duplicatePinCount > 1) {
            return response()->json([
                'pin_reset' => true
            ]);
        }

        // Login the user using admin guard
        Auth::guard('admin')->login($user);

        // Set session data
        session(['employee' => $this->getUserSessionData($user)]);

        // Clear OTP after successful login
        $user->update([
            'login_otp' => null,
            'login_otp_date' => null,
            'updated_at' => now()
        ]);

        // Get additional user data
        $userSessionData = $this->getUserSessionData($user);

        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully.',
            'authuser' => $userSessionData,
            'fields' => $this->getRequiredFields($user),
            'authuserpolicy' => $this->getUserPolicyCount($user->admin_user_id),
            'redirect_url' => route('app.social')
        ]);
    }

    /**
     * Send SMS using your preferred SMS service
     */
    private function sendSms($phone, $otp)
    {
        // Implement your SMS service here (Twilio, AWS SNS, etc.)
        // Example with Twilio:
        /*
        try {
            $twilio = new \Twilio\Rest\Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );

            $twilio->messages->create(
                '+1' . $phone,
                [
                    'from' => config('services.twilio.phone'),
                    'body' => 'Your one time security passcode for Crust: ' . $otp
                ]
            );
        } catch (\Exception $e) {
            Log::error('SMS Error: ' . $e->getMessage());
        }
        */

        // For now, just log the OTP (remove in production)
        Log::info("OTP for phone {$phone}: {$otp}");
    }

    /**
     * Send Email using your preferred email service
     */
    private function sendEmail($email, $otp)
    {
        // Implement your email service here
        /*
        try {
            Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($email) {
                $message->to($email)
                        ->subject('Crust One Time Security Passcode');
            });
        } catch (\Exception $e) {
            Log::error('Email Error: ' . $e->getMessage());
        }
        */

        // For now, just log the OTP (remove in production)
        Log::info("OTP for email {$email}: {$otp}");
    }

    /**
     * Get user session data
     */
    private function getUserSessionData($user)
    {
        $sessionData = [
            'id' => $user->admin_user_id,
            'email' => $user->email,
            'name' => $user->name,
            'phone' => $user->phone,
            'position_ids' => explode(',', $user->position_ids ?? ''),
            'is_admin_access' => '0',
            'user_image' => asset('assets/img/avatar-large.jpg'),
            'is_mit_user' => '0'
        ];

        // Check admin access
        if (in_array('1', $sessionData['position_ids'])) {
            $sessionData['is_admin_access'] = '1';
        }

        // Set user image if exists
        if (!empty($user->image)) {
            $sessionData['user_image'] = "https://crustpizza-media-bucket.s3.amazonaws.com/admin_user/image/" . $user->image;
        }

        // Check MIT user access
        $mitPositionIds = $this->getMITPositionIds();
        foreach ($sessionData['position_ids'] as $posId) {
            if (in_array($posId, $mitPositionIds)) {
                $sessionData['is_mit_user'] = '1';
                break;
            }
        }

        return $sessionData;
    }

    /**
     * Get required fields for user setup
     */
    private function getRequiredFields($user)
    {
        return [
            'pin' => empty($user->pin),
            'schedule_notify_format' => empty($user->schedule_notify_format),
            'prior_shift_reminder' => empty($user->prior_shift_reminder)
        ];
    }

    /**
     * Get user policy count
     */
    private function getUserPolicyCount($userId)
    {
        // Implement based on your employee timeoff policy table
        return 0; // Placeholder
    }

    /**
     * Get MIT position IDs
     */
    private function getMITPositionIds()
    {
        // Implement based on your position management system
        return []; // Placeholder
    }

    public function logout(Request $request)
    {
        // Logout from admin guard
        Auth::guard('admin')->logout();

        // Clear all session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear specific session data
        session()->forget('employee');

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ])->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
          ->header('Pragma', 'no-cache')
          ->header('Expires', '0');
    }
}
