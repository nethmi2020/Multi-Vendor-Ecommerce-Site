<div class="space-y-6">
    
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
    <div>
        <x-input-label for="description" :value="__('Description')"/>
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $category?->description)" autocomplete="description" placeholder="Description"/>
        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
    </div>
    <div>
        <x-input-label for="image" :value="__('Image')"/>
        <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />


        @if($category->category_image)
            <img src="{{asset('storage/' .$category->category_image )}}" alt="Product Image" class="m-2 w-32 h-32 object-cover">
        @else
            <p class="mt-2 text-gray-500">No image available</p>
        @endif
            <x-input-error class="mt-2" :messages="$errors->get('image')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>