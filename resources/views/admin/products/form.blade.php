<x-admin-layout>
    <x-slot name="title">{{ $product->exists ? 'Edit Product' : 'New Product' }}</x-slot>
    <x-slot name="breadcrumb"><a href="{{ route('admin.products.index') }}" class="hover:text-brand-orange">Products</a> / {{ $product->exists ? $product->name : 'New' }}</x-slot>

    <form method="POST"
          action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
          enctype="multipart/form-data"
          x-data="{
              specs: {{ Illuminate\Support\Js::from(collect($product->specs ?? [])->map(fn ($v, $k) => ['label' => $k, 'value' => $v])->values()) }},
              colors: {{ Illuminate\Support\Js::from($product->colors->map(fn ($c) => ['id' => $c->id, 'name' => $c->name, 'slug' => $c->slug, 'hex' => $c->hex, 'existing_image' => $c->image_path, '_delete' => false])) }},
              addSpec() { this.specs.push({ label: '', value: '' }); },
              removeSpec(i) { this.specs.splice(i, 1); },
              addColor() { this.colors.push({ id: null, name: '', slug: '', hex: '#1a1a1a', existing_image: null, _delete: false }); },
          }"
          class="space-y-6 max-w-3xl">
        @csrf
        @if ($product->exists) @method('PATCH') @endif

        {{-- Basic info --}}
        <div class="border border-gray-200 rounded-lg bg-white p-6 space-y-4">
            <h2 class="font-extrabold text-sm uppercase tracking-wide text-gray-500">Basic Info</h2>

            <div>
                <x-input-label for="name" value="Name" />
                <x-text-input id="name" name="name" class="mt-1 block w-full focus:border-brand-orange focus:ring-brand-orange" :value="old('name', $product->name)" required autofocus />
                <x-input-error class="mt-1" :messages="$errors->get('name')" />
                @if ($product->exists)
                    <p class="mt-1 text-xs text-gray-400">URL slug: <span class="font-mono">{{ $product->slug }}</span> (can't be changed)</p>
                @else
                    <p class="mt-1 text-xs text-gray-400">The URL slug will be generated from this name and can't be changed afterward.</p>
                @endif
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="brand" value="Brand" />
                    <x-text-input id="brand" name="brand" class="mt-1 block w-full focus:border-brand-orange focus:ring-brand-orange" :value="old('brand', $product->brand ?? 'CapBeast')" required />
                    <x-input-error class="mt-1" :messages="$errors->get('brand')" />
                </div>
                <div>
                    <x-input-label for="card_label" value="Card label (optional override, e.g. E.SIDE)" />
                    <x-text-input id="card_label" name="card_label" class="mt-1 block w-full focus:border-brand-orange focus:ring-brand-orange" :value="old('card_label', $product->card_label)" />
                    <x-input-error class="mt-1" :messages="$errors->get('card_label')" />
                </div>
            </div>

            <div>
                <x-input-label for="sku" value="SKU" />
                <x-text-input id="sku" name="sku" class="mt-1 block w-full focus:border-brand-orange focus:ring-brand-orange" :value="old('sku', $product->sku)" required />
                <x-input-error class="mt-1" :messages="$errors->get('sku')" />
            </div>

            <div>
                <x-input-label for="description" value="Description" />
                <x-textarea id="description" name="description" rows="3" class="mt-1">{{ old('description', $product->description) }}</x-textarea>
                <x-input-error class="mt-1" :messages="$errors->get('description')" />
            </div>
        </div>

        {{-- Pricing --}}
        <div class="border border-gray-200 rounded-lg bg-white p-6 space-y-4">
            <h2 class="font-extrabold text-sm uppercase tracking-wide text-gray-500">Pricing (CAD, per cap)</h2>
            <div class="grid grid-cols-3 gap-4">
                @php($tiers = old('pricing_tiers', $product->pricing_tiers ?? [0, 0, 0]))
                @foreach (['12–72', '73–144', '145+'] as $i => $label)
                    <div>
                        <x-input-label :value="$label" />
                        <x-text-input type="number" step="0.01" min="0" name="pricing_tiers[{{ $i }}]" class="mt-1 block w-full focus:border-brand-orange focus:ring-brand-orange" :value="$tiers[$i] ?? 0" required />
                    </div>
                @endforeach
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="price" value="Entry price (shown as &quot;from $X&quot;, usually matches the 12-72 tier)" />
                    <x-text-input id="price" type="number" step="0.01" min="0" name="price" class="mt-1 block w-full focus:border-brand-orange focus:ring-brand-orange" :value="old('price', $product->price)" required />
                </div>
            </div>
            <x-input-error :messages="$errors->get('pricing_tiers')" />
        </div>

        {{-- Specs --}}
        <div class="border border-gray-200 rounded-lg bg-white p-6 space-y-3">
            <h2 class="font-extrabold text-sm uppercase tracking-wide text-gray-500">Specifications</h2>
            <template x-for="(spec, i) in specs" :key="i">
                <div class="flex gap-2 items-start">
                    <input type="text" :name="'spec_label[' + i + ']'" x-model="spec.label" placeholder="Label (e.g. Material)"
                           class="flex-1 rounded-md border-gray-300 text-sm focus:border-brand-orange focus:ring-brand-orange">
                    <input type="text" :name="'spec_value[' + i + ']'" x-model="spec.value" placeholder="Value (e.g. Cotton Twill)"
                           class="flex-1 rounded-md border-gray-300 text-sm focus:border-brand-orange focus:ring-brand-orange">
                    <button type="button" @click="removeSpec(i)" class="text-gray-400 hover:text-red-500 px-2 py-2" aria-label="Remove">&times;</button>
                </div>
            </template>
            <button type="button" @click="addSpec()" class="text-xs font-semibold text-brand-orange hover:underline">+ Add spec</button>
        </div>

        {{-- Tags --}}
        <div class="border border-gray-200 rounded-lg bg-white p-6 space-y-3">
            <h2 class="font-extrabold text-sm uppercase tracking-wide text-gray-500">Tags</h2>
            @if ($tags->isEmpty())
                <p class="text-sm text-gray-400">No tags exist yet. <a href="{{ route('admin.tags.create') }}" class="text-brand-orange hover:underline">Create one</a>.</p>
            @else
                <div class="flex flex-wrap gap-3">
                    @php($productTagIds = old('tags', $product->tags->pluck('id')->all()))
                    @foreach ($tags as $t)
                        <label class="flex items-center gap-1.5 text-sm">
                            <input type="checkbox" name="tags[]" value="{{ $t->id }}" {{ in_array($t->id, $productTagIds) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-brand-orange focus:ring-brand-orange">
                            {{ $t->label }}
                        </label>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Colors --}}
        <div class="border border-gray-200 rounded-lg bg-white p-6 space-y-4">
            <h2 class="font-extrabold text-sm uppercase tracking-wide text-gray-500">Colours</h2>
            <p class="text-xs text-gray-400">First colour in the list is the default/thumbnail image. Upload already-prepared images (ideally transparent-background PNG) — they're resized to {{ \App\Support\ProductImageUploader::TARGET_WIDTH }}px wide on upload, nothing else is processed.</p>

            <template x-for="(color, i) in colors" :key="i">
                <div class="border border-gray-200 rounded-md p-4" x-show="!color._delete">
                    <input type="hidden" :name="'colors[' + i + '][id]'" :value="color.id">
                    <div class="grid sm:grid-cols-4 gap-3 items-end">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Name</label>
                            <input type="text" :name="'colors[' + i + '][name]'" x-model="color.name" placeholder="Navy"
                                   class="w-full rounded-md border-gray-300 text-sm focus:border-brand-orange focus:ring-brand-orange">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Slug</label>
                            <input type="text" :name="'colors[' + i + '][slug]'" x-model="color.slug" :placeholder="color.name.toLowerCase().replace(/\s+/g, '-')"
                                   class="w-full rounded-md border-gray-300 text-sm focus:border-brand-orange focus:ring-brand-orange">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Hex</label>
                            <div class="flex items-center gap-2">
                                <input type="color" :name="'colors[' + i + '][hex]'" x-model="color.hex" class="h-9 w-9 rounded border-gray-300 shrink-0">
                                <span class="text-xs font-mono text-gray-500" x-text="color.hex"></span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Image</label>
                            <input type="file" :name="'colors[' + i + '][image]'" accept="image/png,image/jpeg,image/webp"
                                   class="block w-full text-xs text-gray-600 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:uppercase file:bg-brand-orange file:text-brand-dark">
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <template x-if="color.existing_image">
                            <div class="flex items-center gap-2">
                                <input type="hidden" :name="'colors[' + i + '][existing_image]'" :value="color.existing_image">
                                <img :src="'{{ asset('') }}' + color.existing_image" class="h-10 w-10 object-contain bg-brand-gray rounded border border-gray-200">
                                <span class="text-[11px] text-gray-400">Current image (upload a new one above to replace)</span>
                            </div>
                        </template>
                        <label class="flex items-center gap-1.5 text-xs text-red-500 ml-auto">
                            <input type="checkbox" :name="'colors[' + i + '][_delete]'" value="1" x-model="color._delete" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                            Remove this colour
                        </label>
                    </div>
                </div>
            </template>
            <button type="button" @click="addColor()" class="text-xs font-semibold text-brand-orange hover:underline">+ Add colour</button>
            <x-input-error :messages="$errors->get('colors.*.image')" />
        </div>

        <div class="flex items-center gap-3">
            <x-primary-button>{{ $product->exists ? 'Save Changes' : 'Create Product' }}</x-primary-button>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-brand-orange">Cancel</a>
        </div>
    </form>
</x-admin-layout>
