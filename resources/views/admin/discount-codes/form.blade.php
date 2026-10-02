<x-admin-layout>
    <x-slot name="title">{{ $code->exists ? 'Edit Discount Code' : 'New Discount Code' }}</x-slot>
    <x-slot name="breadcrumb">Discount Codes</x-slot>

    <form method="POST" action="{{ $code->exists ? route('admin.discount-codes.update', $code) : route('admin.discount-codes.store') }}"
          class="max-w-xl border border-gray-200 rounded-lg bg-white p-6 space-y-5">
        @csrf
        @if ($code->exists) @method('PATCH') @endif

        <div>
            <x-input-label for="code" value="Code" />
            <x-text-input id="code" name="code" class="mt-1 block w-full font-mono uppercase focus:border-brand-orange focus:ring-brand-orange" :value="old('code', $code->code)" required autofocus placeholder="WELCOME10" />
            <p class="mt-1 text-xs text-gray-400">Letters, numbers, dashes and underscores only. Stored in uppercase.</p>
            <x-input-error class="mt-1" :messages="$errors->get('code')" />
        </div>

        <div>
            <x-input-label for="percent_off" value="Percent off" />
            <x-text-input id="percent_off" type="number" step="0.01" min="0" max="100" name="percent_off" class="mt-1 block w-32 focus:border-brand-orange focus:ring-brand-orange" :value="old('percent_off', $code->percent_off)" required />
            <p class="mt-1 text-xs text-gray-400">Applies to the caps &amp; decoration subtotal only — not setup fees or shipping.</p>
            <x-input-error class="mt-1" :messages="$errors->get('percent_off')" />
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="active" name="active" value="1" {{ old('active', $code->active) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-brand-orange focus:ring-brand-orange">
            <x-input-label for="active" value="Active" class="!mb-0" />
        </div>

        <div class="flex items-center gap-3 pt-2">
            <x-primary-button>{{ $code->exists ? 'Save Changes' : 'Create Code' }}</x-primary-button>
            <a href="{{ route('admin.discount-codes.index') }}" class="text-sm text-gray-500 hover:text-brand-orange">Cancel</a>
        </div>
    </form>
</x-admin-layout>
