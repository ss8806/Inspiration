<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ChangeEmailController extends Controller
{
    public function sendChangeEmailLink(Request $request)
    {
        $new_email = $request->new_email;

        // トークン生成
        $token = hash_hmac(
            'sha256',
            Str::random(40) . $new_email,
            config('app.key')
        );

        // トークンをDBに保存
        DB::beginTransaction();
        try {
            $param = [];
            $param['user_id'] = Auth::id();
            $param['new_email'] = $new_email;
            $param['token'] = $token;
            $email_reset = EmailReset::create($param);

            DB::commit();

            $email_reset->sendEmailResetNotification($token);

            return redirect('/home')->with('flash_message', '確認メールを送信しました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/home')->with('flash_message', 'メール更新に失敗しました。');
        }
    }
}
