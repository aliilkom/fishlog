<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return Response
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Edit the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'no_hp' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:255',
            'password' => 'nullable|confirmed|min:6',
            'logo_number' => 'required|in:' . implode(',', Utils::getLogosNumber()),
        ]);

        $updateValues = [
            'name' => $request->input('name', $user->name),
            'email' => $request->input('email', $user->email),
            'no_hp' => $request->input('no_hp', $user->name),
            'alamat' => $request->input('alamat', $user->email),
            'logo_number' => Utils::getValidLogoNumber($request->input('logo_number', $user->logo_number)),
        ];
        $password = $request->input('password', null);
        if (!empty($password)) {
            $updateValues['password'] = Hash::make($password);
        }

        if ($user->update($updateValues)) {
            flash()->success('Profile updated successfully.');
        } else {
            flash()->info('Profile was not updated.');
        }

        return redirect(route('dashboard::profile'));
    }
}
