<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OtpRequest;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
    }
    public function sendOtp() {
        if (backpack_auth()->check()) {
            SEOMeta::setTitle('تفعيل الحساب' . ' - ' . $this->settings->title);
            OpenGraph::setTitle('تفعيل الحساب' . ' - ' . $this->settings->title);
            JsonLd::setTitle('تفعيل الحساب' . ' - ' . $this->settings->title);

            \General::seoCommon();
            $user = backpack_auth()->user();
            if ($user->otp != null && $user->is_verified == false) {
                \General::sendOTP('2' . $user->phone, $user->otp);
            }
        }
    }
    public function resendOtp() {
        if (backpack_auth()->check()) {
            $user = backpack_auth()->user();

            if ($user->otp != null && $user->is_verified == false) {
                if ($user->otp_expiration != null) {
                    $now = Carbon::now();
                    $time = Carbon::parse($user->otp_expiration);
                    $length = $time->diffInMinutes($now);

                    if ($length < 5) {
                        return response()->json(['msg' => 'برجاء الانتظار 5 دقائق لإرسال رمز التأكيد مرة أخري', 'status' => 0, 'data' => null]);
                    } else {
                        $user->otp = rand(1111, 9999);
                        $user->save();
                        \General::sendOTP('2' . $user->phone, $user->otp);
                        $user->otp_expiration = Carbon::now();
                        $user->save();
                        return response()->json(['msg' => 'تم إرسال رمز التأكيد', 'status' => 1, 'data' => null]);
                    }
                } else {
                    \General::sendOTP('2' . $user->phone, $user->otp);
                    $user->otp_expiration = Carbon::now();
                    $user->save();
                    return response()->json(['msg' => 'تم إرسال رمز التأكيد', 'status' => 1, 'data' => null]);
                }
            }
        }
    }

    public function verifying() {
        if (backpack_auth()->check()) {
            SEOMeta::setTitle('تفعيل الحساب' . ' - ' . $this->settings->title);
            OpenGraph::setTitle('تفعيل الحساب' . ' - ' . $this->settings->title);
            JsonLd::setTitle('تفعيل الحساب' . ' - ' . $this->settings->title);

            \General::seoCommon();
            $user = backpack_auth()->user();
            if ($user->otp != null && $user->is_verified == false) {
                $phone = $user->phone;
                if ($user->otp_expiration != null) {
                    $now = Carbon::now();
                    $time = Carbon::parse($user->otp_expiration);
                    $length = $time->diffInMinutes($now);

                    if ($length < 5) {
                        $wait = "برجاء الانتظار 5 دقائق لإرسال رمز التأكيد مرة أخري";
                        return view('front.pages.auth.verify', compact('phone', 'wait'));
                    } else {
                        $user->otp = rand(1111, 9999);
                        $user->save();
                        \General::sendOTP('2' . $user->phone, $user->otp);
                        $user->otp_expiration = Carbon::now();
                        $user->save();
                        return view('front.pages.auth.verify', compact('phone'));
                    }
                } else {
                    \General::sendOTP('2' . $user->phone, $user->otp);
                    $user->otp_expiration = Carbon::now();
                    $user->save();
                    return view('front.pages.auth.verify', compact('phone'));
                }
            } else {
                return redirect()->route('site.home')->with(['error' => 'error']);
            }
        } else {
            return redirect('site.home');
        }
    }
    public function verifyPost(OtpRequest $request) {
        //phone
        if (backpack_auth()->check()) {
            $user = backpack_auth()->user();
            if ($user->phone != $request->phone) {
                return redirect()->back()->with(['error' => 'حدث خطأ ما .. برجاء المحاولة فيما بعد']);
            }
            if ($user->otp != $request->otp) {
                return redirect()->back()->with(['error' => 'برجاء التأكد من رمز التفعيل .. وإعادة المحاولة']);
            }
            $user->is_verified = true;
            $user->save();
            return redirect()->route('site.home')->with(['success' => 'تم تفعيل الحساب بنجاح']);
        } else {
            return redirect(url('login'))->with(['error' => 'برجاء تسجيل الدخول']);
        }

    }
}
