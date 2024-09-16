<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Providers\GiwuService;
use App\Models\User;
use App\Models\GiwuMenu;
use App\Models\GiwuActionmenuacces;
use App\Models\GiwuRole;
use Illuminate\Support\Facades\Redirect;

trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // 
        GiwuService::BrowserControl();
        //Ajouter par defaut un users lorsque la table est EMPTY
        if(User::count() == 0){
            $addUsers = new User();
            $addUsers->name = "Giwu";
            $addUsers->prenom = "Richard";
            $addUsers->email = "richardtohon@gmail.com";
            $addUsers->email_verified_at = null;
            $addUsers->password = Hash::make("123");
            $addUsers->tel_user = "229";
            $addUsers->image_profil = null;
            $addUsers->other_infos_user = "";
            $addUsers->is_active = 1;
            $addUsers->id_ini = 1;
            $addUsers->id_role = 1;
            $addUsers->save();
        }
        GiwuMenu::AjouterMenuParDefaut();
        // 
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $giwuR = $this->guard()->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
        if($giwuR){
            // dd($this->guard()->attempt(),$request->all(),$this->credentials($request),$request->boolean('remember'));
        }
        return $giwuR;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        
        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        //Ajouter un controle pour charger toute les sessions Rôle et actions
        $user = User::where('id',Auth::id())->first();
        if($user->is_active == 1){

            $recu_Role = GiwuRole::where('id_role',$user->id_role)->first();
            Session()->put('InfosRole', $recu_Role);
            $Role_action = GiwuActionmenuacces::getActionParRole($user->id_role);
            Session()->put('InfosAction', $Role_action);
            Session()->put('entite_idSess', $user->entite_id);
            //
            return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
        }else{
            $this->guard()->logout();
            return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckApp')]);
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        //Supprimer les sessions créées lors de la connexion
        Session()->forget('InfosAction');  
        Session()->forget('InfosRole');
        // 
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
            //old code : redirect('/login');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
