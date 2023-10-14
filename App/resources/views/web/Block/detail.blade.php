<x-app-layout>
    @section('title', __('Блоки'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Блоки',
                'href' => route('blocks.index')
            ],
            [
                'name' => $block->name,
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            @foreach($block->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $blockLanguage->id !== $item->id]) href="?language={{ $item->id }}">
                                    Язык: {{ $item->language->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $block->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:Block:Update" :action="route('blocks.edit', $block->id)" :disabled="$edit"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:Block:Delete" :action="route('blocks.destroy', $block->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('blocks.update', $block->id)">
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" name="block_language_id" value="{{ $blockLanguage->id }}">

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="block.name">Наименование *</x-label>
                                    <x-input id="block.name" name="block[name]" :value="old('block.name', $block->name)" :invalid="$errors->has('block.name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('block.name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="block.key">Ключ *</x-label>
                                    <x-input id="block.key" name="block[key]" :value="old('block.key', $block->key)" :invalid="$errors->has('block.key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('block.key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="blocklanguageversion.blade">Blade</x-label>
                                    <x-codemirror id="blocklanguageversion.blade" name="blocklanguageversion[blade]" :value="old('blocklanguageversion.blade', $blockLanguage->version->blade)" :invalid="$errors->has('blocklanguageversion.blade')" :disabled="!$edit"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('blocklanguageversion.blade')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            @if($edit)
                                <div class="col-12">
                                    <div class="p-3 bg-light rounded">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <x-button class="btn-primary">
                                                Применить изменения
                                            </x-button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
