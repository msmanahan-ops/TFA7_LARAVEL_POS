<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Exceptions\DecoderException;
use Intervention\Image\ImageManager;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.form', [
            'user' => new User(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateUser($request);

        User::create([
            'name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validateUser($request, $user);

        $changes = [
            'name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $changes['password'] = $data['password'];
        }

        $oldAvatar = $user->avatar;
        $newAvatar = null;

        if ($request->hasFile('avatar')) {
            try {
                $manager = new ImageManager(new Driver());

                $thumbnail = $manager
                    ->read($request->file('avatar')->getRealPath())
                    ->cover(256, 256)
                    ->toPng();
            } catch (DecoderException $exception) {
                throw ValidationException::withMessages([
                    'avatar' => 'The image could not be processed.',
                ]);
            }

            $newAvatar = 'avatars/' . Str::uuid() . '.png';

            $saved = Storage::disk('public')->put(
                $newAvatar,
                (string) $thumbnail
            );

            if (!$saved) {
                throw ValidationException::withMessages([
                    'avatar' => 'Unable to save the image. Please try again.',
                ]);
            }

            $changes['avatar'] = $newAvatar;
        }

        try {
            $user->update($changes);
        } catch (\Throwable $exception) {
            if ($newAvatar) {
                Storage::disk('public')->delete($newAvatar);
            }

            throw $exception;
        }

        if ($newAvatar && $oldAvatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    private function validateUser(
        Request $request,
        ?User $user = null
    ): array {
        $usernameRule = Rule::unique('users', 'username');
        $emailRule = Rule::unique('users', 'email');

        if ($user) {
            $usernameRule->ignore($user);
            $emailRule->ignore($user);
        }

        return $request->validate([
            'full_name' => ['required', 'string', 'max:255'],

            'username' => [
                'required',
                'string',
                'alpha_dash',
                'max:100',
                $usernameRule,
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                $emailRule,
            ],

            'password' => [
                $user ? 'nullable' : 'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
                'dimensions:max_width=4096,max_height=4096',
            ],
        ]);
    }
}