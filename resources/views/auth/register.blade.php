<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>
            <div class="mt-4">
                <img src="{{ URL('storage/admin/images/profile/no-dp.png') }}" id="file-dp-1-preview" style="height: 100px; width: 100px;" class="rounded float-right inline mb-4" alt="...">
                <x-label for="image" :value="__('Profile image (optional)')" class="font-bold text-sm inline" />
                <x-input id="image" accept="image/*" class=" mt-1 inline w-48" type="file" name="image" onchange="showPreview(event);" :value="old('image')"
                    autofocus />
            </div>

            <div class="mt-4">
                <x-label for="role" :value="__('You are a:')" />
                
                <select name="" id="" class="w-full">
                    <option value="">Business Owner</option>
                    <option value="">Client</option>
                </select>
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                    required />
            </div>

            <!-- Location -->
            <div class="mt-4">
                <x-label for="location" :value="__('Location')" />

                <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')"
                    required />
            </div>

            <!-- Ocupation -->
            <div class="mt-4">
                <x-label for="ocupation" :value="__('Ocupation')" />

                <x-input id="ocupation" class="block mt-1 w-full" type="text" name="ocupation" :value="old('ocupation')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <!-- Timezone -->
            <div class="mt-4">
                <x-label for="timezone" :value="__('Select timezone (optional)')" />
                <select name="timezone" id="" class="w-full">
                    <option value="">Select a timezone</option>
                    @foreach ($tzs as $tz)
                        <option value="{{ $tz }}">{{ $tz }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
