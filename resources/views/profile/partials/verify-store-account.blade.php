<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Verify Store Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Your account will become a Store Account that can edit, delete, and add your own products.') }}
        </p>
    </header>

    <x-primary-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-verify-store')">{{ __('Verify Store Account') }}</x-primary-button>

    <x-modal name="confirm-verify-store" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('verifyAccount') }}" class="p-6">
            @csrf
            @method('put')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Created Store Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Reap your benefits here! Your account will become a Store Account that can edit, delete, and add your own products.') }}
            </p>

            <div class="mt-5 gap-5">
                <label for="store_name">Store Name</label>
                <x-text-input
                    id="store_name"
                    name="store_name"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Input Your Store Name') }}"
                />
            </div>

            <div class="mt-5 gap-5">
                <label for="store_address">Store Address</label>
                <x-text-input
                    id="store_address"
                    name="store_address"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Input Your Store Address') }}"
                />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Verify Account') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
