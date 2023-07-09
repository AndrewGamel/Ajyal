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
        <x-form.input label="Category Name" class="form-control-lg" role="input" name="name" :value="$user->name" />

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
