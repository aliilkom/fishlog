<?php

namespace App\Http\Controllers;

use Validator;
use Hash;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('settings.profile');
    }

    public function editProfile()
    {
        return view('settings.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'alamat' => 'required',
            'hp' => 'required',
            'image' => 'nullable',

        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->alamat = $request->get('alamat');
        $user->hp = $request->get('hp');

        // Isi field cover jika ada cover yang diupload
        if ($request->hasFile('image')) {

            // Mengambil cover yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('image');
            $extension = $uploaded_image->getClientOriginalExtension();

            // Membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';

            // Memindahkan file ke folder public/img
            $uploaded_image->move($destinationPath, $filename);

            // Hapus cover lama, jika ada
            if ($user->image) {
                $old_image = $user->image;

                // Jika tidak menggunakan member_image.png / admin_image.png hapus image
                if (!$old_image == "member_image.png" || "admin_image.png") {
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $user->image;

                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                    }
                }
            }

            // Ganti field cover dengan cover yang baru
            $user->image = $filename;
            $user->save();
        }

        $user->save();

        Session::flash("profile-success", "Profil berhasil diubah");
        
        return redirect('settings/profile');
    }

    public function editPassword()
    {
        return view('settings.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        Validator::extend('passcheck', function ($attribute, $value, $parameters) 
        {
            return Hash::check($value, Auth::user()->getAuthPassword());
        });

        $this->validate($request, [
            'password' => 'required|passcheck:' . $user->password,
            'new_password' => 'required|confirmed|min:6',
        ], [
            'password.passcheck' => 'Password lama tidak sesuai'
        ]);

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        Session::flash("password-success", "Password berhasil diubah");
        
        return redirect('settings/profile');
    }

}
