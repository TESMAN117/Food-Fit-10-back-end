@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg text-left">
            {{ $title }}
        </div>

        <div class="mt-4 text-left">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-center">
        {{ $footer }}
    </div>
</x-jet-modal>
