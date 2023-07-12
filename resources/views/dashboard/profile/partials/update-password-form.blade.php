<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="profile-pic">
            <label class="-label"  for="file">
              <span class="glyphicon glyphicon-camera"></span>
              <span>Change Image</span>
            </label>
            <input id="file" type="file" name="image" accept="image/*" onchange="loadFile(event)" />
            <img src="{{ $user->profile->image ??  asset('assets/dashboard/dist/img/user1-128x128.jpg') }}" id="output" width="200" />
          </div>
        {{-- First Name --}}
        <div class="form-group">
            <x-input-label for="first_name" :value="__('First Name')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('name', $user->profile->first_name)"
                autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- Last Name --}}
        <div class="form-group">
            <x-input-label for="last_name" :value="__('Last Name')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('name', $user->profile->last_name)"
                autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- Brithday --}}
        <div class="form-group">
            <x-input-label for="birthday" :value="__('Brithday')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('name', $user->profile->birthday)"
                autofocus autocomplete="birthday" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- Gender --}}
        <div class="form-group">
            <x-input-label for="gender" :value="__('Gender')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-radio id="gender" name="gender" type="radio" class="mt-1 " :value="old('name', $user->profile->gender)" :options="['male' => 'Male', 'female' => 'Female']"
                :checked="$user->profile->gender" required autofocus autocomplete="gender" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- Street Address --}}
        <div class="form-group">
            <x-input-label for="street_address" :value="__('Street Address')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="street_address" name="street_address" type="text" class="mt-1 block w-full"
                :value="old('name', $user->profile->street_address)" autofocus autocomplete="street_address" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- city --}}
        <div class="form-group">
            <x-input-label for="city" :value="__('City')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('name', $user->profile->city)"
                autofocus autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- State --}}
        <div class="form-group">
            <x-input-label for="state" :value="__('State')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('name', $user->profile->state)"
                autofocus autocomplete="state" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- postal_code --}}
        <div class="form-group">
            <x-input-label for="postal_code" :value="__('postal_code')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('name', $user->profile->postal_code)"
                autofocus autocomplete="postal_code" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- Country --}}
        <div class="form-group">
            <x-input-label for="country" :value="__('Country')" class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
            <x-select id="country" name="country" type="text" class="mt-1 block w-full" :value="old('name', $user->profile->country)"
                autofocus autocomplete="first_name" :options="$countries" :selected="$user->profile->country" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- locale --}}
        <div class ="form-group">
            <x-input-label for="locale" :value="__('Locale')"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300" />
                <x-select id="locale" name="locale" type="text" class="mt-1 block w-full" :value="old('name', $user->profile->locale)"
                    autofocus autocomplete="locale" :options="$locales" :selected="$user->profile->locale" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
<script >
    var loadFile = function (event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
  };
</script>




{{-- <x-form.select id="parent_id" name="parent_id" label="Parent" :options="$parents->pluck('name', 'id')"  /> --}}
    {{-- <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select> --}}