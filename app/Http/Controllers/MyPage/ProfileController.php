<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Mypage\Profile\EditRequest;
use App\Http\Requests\Mypage\Profile\PasswordRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function showProfileEditForm()
    {
        return view('mypage.profile_edit_form')
            ->with('user', Auth::user());
    }

    public function showProfileEditIcon()
    {
        return view('mypage.icon_edit_form')
            ->with('user', Auth::user());
    }

    public function editIcon(EditRequest $request)
    {
        $user = Auth::user();
         
// 第一引数に入力されているかを確認したいinputタグのname属性の値を指定。値が入力されている場合はtrueを返す。アバター画像が指定されているかどうかを調べている。
         if ($request->has('avatar')) { 
             $fileName = $this->saveAvatar($request->file('avatar')); //アップロードされた画像の情報を取得
             $user->avatar_file_name = $fileName; // ファイル名をDBに保存
         }

         $user->save();
 
         return redirect()->back()
             ->with('status', 'プロフィールを変更しました。');
    }

    public function showProfileEditName()
    {
        return view('mypage.name_edit_form')
            ->with('user', Auth::user());
    }

    public function editName(EditRequest $request)
    {
        $user = Auth::user();
 
        $user->name = $request->input('name');

        $user->save();
 
        return redirect()->back()
            ->with('status', 'ニックネームを変更しました。');
    }    

    public function showProfileEditEmail()
    {
        return view('mypage.email_edit_form')
            ->with('user', Auth::user());
    }

    public function editEmail(EditRequest $request)
    {
        $user = Auth::user();
 
        $user->email = $request->input('email');

        $user->save();
 
        return redirect()->back()
            ->with('status', 'メールアドレスを変更しました。');
    }
    
    public function showProfileEditPassword()
    {
        return view('mypage.password_edit_form')
            ->with('user', Auth::user());
    }

    public function editPassword(PasswordRequest $request)
    {
        $user = Auth::user();
        // パスワードをハッシュ化して変更
        $user->password = Hash::make($request->input('new-password'));

        $user->save();
 
        return redirect()->back()
            ->with('status', 'パスワードを変更しました。');
    }

    /**
      * アバター画像をリサイズして保存します
      *
      * @param UploadedFile $file アップロードされたアバター画像
      * @return string ファイル名
      */
      private function saveAvatar(UploadedFile $file): string
      {
        $tempPath = $this->makeTempPath(); //一時ファイルを生成してパスを取得する(makeTempPathメソッド)

        Image::make($file)->fit(200, 200)->save($tempPath); // Intervention Imageを使用して、画像をリサイズ後、一時ファイルに保存。

        //local用 Storageファサードを使用して画像をディスクに保存。
        //$filePath = Storage::disk('public')->putFile('avatars', new File($tempPath));
        
        //heroku用 Storageファサードを使用して画像をawsに保存しています。
        $filePath = Storage::disk('s3')->putFile('/', new File($tempPath));
  
          return basename($filePath); //basename() パスの最後にある名前の部分を返す
      }

      /**
      * 一時的なファイルを生成してパスを返します。
      *
      * @return string ファイルパス
      */
    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta   = stream_get_meta_data($tmp_fp); // 第一引数はファイルポインタを指定。返り値はメタ情報が格納された連想配列。
        return $meta["uri"]; //メタ情報からURI(ファイルのパス)を取得し、返す。
    }
}