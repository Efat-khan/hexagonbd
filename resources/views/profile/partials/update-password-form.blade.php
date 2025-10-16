<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="email" class="h5">Current Password</label>
            <x-text-input id="update_password_current_password" name="current_password" placeholder="Enter Current Password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="pt-4">
            <label for="email" class="h5">New Password</label>
            <x-text-input id="update_password_password" name="password" type="password" placeholder="Enter New Password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="pt-4">
            <label for="email" class="h5">Confirm Password</label>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="th-btn">Save</button>
        </div>
    </form>
</section>
