<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        return view('pages.profile.show',[
            'you' => Auth::user(),
        ]);
    }

    /**
     * Update a user's profile.
     *
     * @param \App\Http\Requests\UpdateUserProfile $request
     * @param $username
     *
     * @throws Laracasts\Validation\FormValidationException
     *
     * @return mixed
     */
    public function update(StoreUserRequest $request)
    {
        $input = $request->only('theme_id', 'location', 'bio', 'twitter_username', 'github_username', 'avatar_status');

        $ipAddress = new CaptureIpTrait();

        if ($user->profile === null) {
            $profile = new Profile();
            $profile->fill($input);
            $user->profile()->save($profile);
        } else {
            $user->profile->fill($input)->save();
        }

        $user->updated_ip_address = $ipAddress->getClientIp();
        $user->save();

        return redirect('profile/'.$user->name.'/edit')->with('success', trans('profile.updateSuccess'));
    }
}
