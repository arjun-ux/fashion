<!-- CSS Styling -->
<style>
    body {
        background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1974'); /* Path to the background image */
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
    }

    /* Form container styling */
    form {
        background-color: #2b2b2b;
        padding: 2rem;
        border: 1px solid #333;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        max-width: 450px;
        width: 100%;
        border-radius: 8px;
        text-align: center;
    }

    /* Heading and welcome message */
    h2 {
        color: #f39c12;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .welcome-text {
        color: #b3b3b3;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    /* Label styling */
    label, .text-sm, .underline {
        color: #b3b3b3;
    }

    label {
        font-weight: bold;
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 0.3rem;
        display: inline-block;
    }

    /* Input fields */
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 0.5rem;
        margin-top: 0.5rem;
        background-color: #333;
        border: 1px solid #555;
        color: #eaeaea;
        border-radius: 4px;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #f39c12;
        outline: none;
    }

    /* Link styling */
    a.underline {
        color: #f39c12;
        text-decoration: none;
        font-size: 0.8rem;
    }

    a.underline:hover {
        text-decoration: underline;
    }

    /* Button styling */
    .ms-4, .x-primary-button {
        background-color: #f39c12;
        color: #1b1b1b;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 1rem;
    }

    .ms-4:hover, .x-primary-button:hover {
        background-color: #e67e22;
    }

    /* Error message styling */
    .mt-2 {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }
</style>

<!-- Form Structure -->
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Welcome Heading -->
    <h2>{{ __('Create Your Account') }}</h2>
    <p class="welcome-text">Join us today for a seamless experience. Fill in your details below to get started.</p>

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email address" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Choose a secure password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter your password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <!-- Already registered link and Register button -->
    <div class="flex items-center justify-end mt-4">
        <a class="underline" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
        <button class="ms-4 x-primary-button">
            {{ __('Register') }}
        </button>
    </div>
</form>
