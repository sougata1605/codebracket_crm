<section class="space-y-6">

    <!-- HEADER -->
    <header>
        <h2 class="text-lg font-semibold text-gray-900 tracking-tight">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">

        @csrf
        @method('patch')

        <!-- NAME -->
        <div>
            <x-input-label for="name" class="text-sm font-medium text-gray-700" :value="__('Name')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                :value="old('name', $user->name)"
                required
                autofocus />
            <x-input-error class="mt-1 text-sm" :messages="$errors->get('name')" />
        </div>

        <!-- EMAIL -->
        <div>
            <x-input-label for="email" class="text-sm font-medium text-gray-700" :value="__('Email')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                :value="old('email', $user->email)"
                required />

            <x-input-error class="mt-1 text-sm" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 flex items-start gap-2 text-sm text-amber-700">
                    <svg class="w-4 h-4 mt-0.5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M8.257 3.099c.765-1.36 2.72-1.36 3.486 0l6.514 11.59c.75 1.334-.213 3.01-1.742 3.01H3.485c-1.53 0-2.492-1.676-1.742-3.01L8.257 3.1z"
                              clip-rule="evenodd" />
                    </svg>

                    <span>
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline font-medium hover:text-amber-800">
                            {{ __('Resend verification') }}
                        </button>
                    </span>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-1 text-sm text-green-600">
                        {{ __('Verification link sent.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-4 pt-1">
            <x-primary-button class="px-6 py-2">
                {{ __('Save changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >
                    {{ __('Saved successfully') }}
                </span>
            @endif
        </div>

    </form>
</section>
