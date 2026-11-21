  <?php

  use App\Http\Controllers\Auth\ChangePasswordController;
  use App\Http\Controllers\Auth\ForgotPasswordController;
  use App\Http\Controllers\Auth\RegisteredUserController;
  use App\Http\Controllers\Auth\ResetPasswordController;
  use App\Http\Controllers\Auth\SessionController;
  use App\Http\Controllers\Auth\SignInWithGoogleController;
  use Illuminate\Support\Facades\Route;

  /*
  |--------------------------------------------------------------------------
  | Guest routes
  |--------------------------------------------------------------------------
  */

  Route::middleware(['guest', 'nocache'])
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
      // Login route 
      Route::controller(SessionController::class)
        ->group(function () {
          Route::get('login', 'create')
            ->name('login');
          Route::post('login', 'store')
            ->middleware('throttle:5,1')
            ->name('login.store');
        });

      // Register
      Route::controller(RegisteredUserController::class)
        ->group(function () {
          Route::get('register', 'create')
            ->name('register');
          Route::post('register', 'store')
            ->name('register.store');
        });

      // Forgot password: send reset link
      Route::controller(ForgotPasswordController::class)
        ->group(function () {
          Route::get('forgot-password', 'create')
            ->name('password.request');
          Route::post('forgot-password', 'store')
            ->middleware('throttle:5,1')
            ->name('password.email');
        });

      // Reset Password : request reset password
      Route::controller(ResetPasswordController::class)
        ->group(function () {
          Route::get('reset-password/{token}', 'create')
            ->name('password.reset');
          Route::post('reset-password', 'store')
            ->name('password.reset.store');
        });

      // google service 
      Route::controller(SignInWithGoogleController::class)
        ->group(function () {
          // redirect to google page 
          Route::get('google', 'redirect')
            ->name('google.redirect');
          // callback 
          Route::get('google/callback', 'callback')
            ->name('google.callback');
        });
    });

  /*
  |--------------------------------------------------------------------------
  | Authenticated routes
  |--------------------------------------------------------------------------
  */
  Route::middleware('auth')
    ->prefix('auth')
    ->name('auth.')->group(function () {
      Route::delete('logout', [SessionController::class, 'destroy'])
        ->name('logout');

      // Change password while logged in
      Route::controller(ChangePasswordController::class)
        ->group(function () {
          Route::get('password', 'edit')
            ->name('password.edit');
          Route::put('password', 'update')
            ->name('password.update');
        });
    });
