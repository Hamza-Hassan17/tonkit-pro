<x-admin-layout>
    <x-slot name="title">{{ $tag->exists ? 'Edit Tag' : 'New Tag' }}</x-slot>
    <x-slot name="breadcrumb">Tags</x-slot>

    <form method="POST" action="{{ $tag->exists ? route('admin.tags.update', $tag) : route('admin.tags.store') }}"
          class="max-w-xl border border-gray-200 rounded-lg bg-white p-6 space-y-5">
        @csrf
        @if ($tag->exists) @method('PATCH') @endif

        <div>
            <x-input-label for="label" value="Label" />
            <x-text-input id="label" name="label" class="mt-1 block w-full focus:border-brand-orange focus:ring-brand-orange" :value="old('label', $tag->label)" required autofocus />
            <x-input-error class="mt-1" :messages="$errors->get('label')" />
        </div>

        @unless ($tag->exists)
            <div>
                <x-input-label for="key" value="Key (optional — auto-generated from the label if left blank)" />
                <x-text-input id="key" name="key" class="mt-1 block w-full focus:border-brand-orange focus:ring-brand-orange" :value="old('key')" placeholder="e.g. best-seller" />
                <x-input-error class="mt-1" :messages="$errors->get('key')" />
            </div>
        @else
            <div>
                <x-input-label value="Key" />
                <p class="mt-1 text-sm text-gray-500 font-mono">{{ $tag->key }} <span class="text-xs text-gray-400">(can't be changed)</span></p>
            </div>
        @endunless

        <div>
            <x-input-label for="badge_class" value="Badge CSS classes" />
            <x-text-input id="badge_class" name="badge_class" class="mt-1 block w-full font-mono text-xs focus:border-brand-orange focus:ring-brand-orange" :value="old('badge_class', $tag->badge_class)" required placeholder="bg-brand-dark text-white" />
            <p class="mt-1 text-xs text-gray-400">Tailwind utility classes, e.g. <code>bg-red-600 text-white</code>.</p>
            <x-input-error class="mt-1" :messages="$errors->get('badge_class')" />
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="blocks_ordering" name="blocks_ordering" value="1" {{ old('blocks_ordering', $tag->blocks_ordering) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-brand-orange focus:ring-brand-orange">
            <x-input-label for="blocks_ordering" value="Blocks ordering (prevents Add to Cart — reserved for future use)" class="!mb-0" />
        </div>

        <div class="flex items-center gap-3 pt-2">
            <x-primary-button>{{ $tag->exists ? 'Save Changes' : 'Create Tag' }}</x-primary-button>
            <a href="{{ route('admin.tags.index') }}" class="text-sm text-gray-500 hover:text-brand-orange">Cancel</a>
        </div>
    </form>
</x-admin-layout>
