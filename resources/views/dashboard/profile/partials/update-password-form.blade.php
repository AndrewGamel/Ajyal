<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>
{{--
     '', 'last_name',
        'birthday', 'gender',
        'image', 'city', 'street_address',
        'state', 'postal_code', 'country', 'locale'
    --}}
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
        <x-input-label for="first_name" :value="__('First Name')"  class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
        <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('name', $user->profile->first_name)" required autofocus autocomplete="first_name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
        <x-input-label for="last_name" :value="__('Last Name')"  class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('name', $user->last_name)" required autofocus autocomplete="last_name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="first_name" :value="__('First Name')"  class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="first_name" name="first_name" type="date" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="gender" :value="__('Gender')"  class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-radio id="gender" name="gender" type="radio" class="mt-1 " :value="old('name', $user->profile->gender)" :options="['male' => 'Male', 'female' => 'Female']"  :checked="$user->profile->gender" required autofocus autocomplete="gender" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="street_address" :value="__('Street Address')"  class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="street_address" name="street_address" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="street_address" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="form-group">
            <x-input-label for="first_name" :value="__('First Name')"  class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="form-group">
            <x-input-label for="first_name" :value="__('First Name')"  class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
