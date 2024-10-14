<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|min:3|max:255',
            'username' => 'required|string|unique:user|min:3|max:24',
            'alamat' => 'nullable|string',
            'email' => 'required|string|email|unique:user',
            'level' => 'required|string',
            'password' => 'required|string|min:8|max:24',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 24 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 24 karakter.',
        ]);

        User::create([
            'NamaLengkap' => $request->nama_lengkap,
            'Username' => $request->username,
            'Alamat' => $request->alamat,
            'Email' => $request->email,
            'Password' => bcrypt($request->password),
            'Level' => $request->level,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }


    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Gunakan kolom 'Email' dan 'Password' sesuai struktur tabel
        if (Auth::attempt(['Email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Login berhasil');
        }

        // Jika login gagal
        return back()->with('error', 'The provided credentials do not match our records.');
    }



    public function profile($username) // Change the parameter to better reflect its purpose
    {
        $auth_user = Auth::user();

        // Fetch the user using the correct column name (assuming 'Username' is the correct column)
        $user = User::with(['post.user'])
                    ->where('Username', $username) // Change 'name' to 'Username'
                    ->firstOrFail(); // This will throw a 404 if not found

        return Inertia::render('Profile', [
            'user' => $user,
            'auth_user' => $auth_user
        ]);
    }


    public function edit()
    {
        $user = auth()->user();
        return Inertia::render('editProfile', [
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function post($name, $id)
    {
        $user = user::where('name', $name)->firstOrFail();

        $post = Post::with(["user", "comment.reply", "like"])->where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
        return view('/post', [
            "post" => $post,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Use findOrFail for safety

        // Validate input
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required|string|min:3|max:24',
            'email' => 'required|email|max:255', // Validate email
            'namaLengkap' => 'nullable|max:150', // Validate NamaLengkap
            'alamat' => 'nullable|max:255', // Validate Alamat
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($user->image) {
                Storage::delete($user->image);
            }
            // Store new image and get the path
            $imagePath = $request->file('image')->store('avatar');
        } else {
            // Retain existing image if no new one is uploaded
            $imagePath = $user->image;
        }

        // Update user data
        $user->Username = $request->input('username'); // Update Username
        $user->Email = $request->input('email'); // Update Email
        $user->NamaLengkap = $request->input('namaLengkap'); // Update NamaLengkap
        $user->Alamat = $request->input('alamat'); // Update Alamat
        $user->Image = $imagePath; // Update image path
        $user->save(); // Save changes

        return redirect()->route('profile', ['name' => $user->Username])->with('success', 'Profil berhasil diperbarui');
    }



    public function user()
    {
        $users = user::all();
        return view('user', compact('users'));
    }

    public function follow($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        Follow::create([
            'follower_id' => auth()->id(),
            'following_id' => $user->id
        ]);
        return back();
    }

    public function unfollow($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        Follow::where('follower_id', auth()->id())->where('following_id', $user->id)->delete();
        return back();
    }
}
