<!-- CSS Styling -->
<style>
    /* Body background */
    body {
        background-image: url('/images/admin.jpg'); /* Path ke gambar latar */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        font-family: 'Courier New', Courier, monospace;
        color: #eaeaea;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)),
                    url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1974');
    }

    /* Outer container for centering content */
    .center-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.6); /* Transparansi latar belakang */
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        width: 90%;
        max-width: 400px;
    }

    /* Header title styling */
    .login-header {
        font-size: 1.8rem;
        font-weight: bold;
        color: #f39c12;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
        text-align: center;
        text-shadow: 0 0 10px rgba(243, 156, 18, 0.5);
    }

    .login-header .subtitle {
        font-size: 1rem;
        font-weight: normal;
        color: #eaeaea;
        margin-top: 0.2rem;
    }

    /* Form container styling */
    form {
        background-color: rgba(43, 43, 43, 0.85);
        padding: 2rem;
        border: 1px solid #333;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        border-radius: 8px;
        width: 100%;
    }

    /* Form label and input alignment */
    form div {
        display: flex;
        flex-direction: column;
        margin-bottom: 1rem;
    }

    label {
        color: #b3b3b3;
        font-weight: bold;
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 0.6rem;
        background-color: #333;
        border: 1px solid #555;
        color: #eaeaea;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #f39c12;
        box-shadow: 0 0 10px rgba(243, 156, 18, 0.2);
        outline: none;
    }

    /* Button styling */
    .x-primary-button {
        background-color: #f39c12;
        color: #1b1b1b;
        padding: 0.6rem 1.2rem;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
        margin-left: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .x-primary-button:hover {
        background-color: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 0 15px rgba(243, 156, 18, 0.4);
    }

    /* Inline link styling */
    .underline {
        color: #f39c12;
        font-size: 0.9rem;
        text-decoration: none;
        margin-left: auto;
    }

    .underline:hover {
        text-decoration: underline;
    }

    /* Remember Me styling */
    .inline-flex {
        display: flex;
        align-items: center;
    }

    /* Align buttons in a row */
    .button-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<!-- HTML Structure with Title Above Form -->
<div class="center-container">
    <!-- Website Name and Tagline -->
    <div class="login-header">
        Farhan Fashion Store
        <div class="subtitle">Sign in to start your session</div>
    </div>

    <!-- Form Structure -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="inline-flex items-center">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me" class="ms-2">{{ __('Remember me') }}</label>
        </div>

        <!-- Login, Register Buttons and Forgot Password Link -->
        <div class="button-group mt-4">
            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <a class="underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <div>
                <!-- Register Button -->
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="x-primary-button">
                        {{ __('Register') }}
                    </a>
                @endif

                <!-- Log in Button -->
                <button type="submit" class="x-primary-button">
                    {{ __('Log in') }}
                </button>
            </div>
        </div>
    </form>
</div>