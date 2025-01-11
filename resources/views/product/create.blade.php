
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create') }} product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Create') }} product</h1>
                            <p class="mt-2 text-sm text-gray-700">Add a new {{ __('product') }}.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('products.index') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="max-w-xl py-2 align-middle">
                                <form method="POST" action="{{ route('products.store') }}"  role="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="space-y-6">

                                        <div>
                                            <x-input-label for="category_id" :value="__('Category')"/>
                                            <x-select-dropdown-option name="category_id" id="category_id" :options="$categories" :selected="old('category_id')" />
                                            <x-input-error class="mt-2" :messages="$errors->get('category_id')"/>
                                        </div>

                                        <div>
                                            <x-input-label for="name" :value="__('Name')"/>
                                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product?->name)" autocomplete="name" placeholder="Name"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                                        </div>
                                        <div>
                                            <x-input-label for="description" :value="__('Description')"/>
                                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $product?->description)" autocomplete="description" placeholder="Description"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                                        </div>
                                        <div>
                                            <x-input-label for="price" :value="__('Price')"/>
                                            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" :value="old('price', $product?->price)" autocomplete="price" placeholder="Price"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('price')"/>
                                        </div>
                                        <div>
                                            <x-input-label for="qty" :value="__('Quantity')"/>
                                            <x-text-input id="qty" name="qty" type="text" class="mt-1 block w-full" :value="old('qty', $product?->qty)" autocomplete="qty" placeholder="Quantity"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('qty')"/>
                                        </div>
                                        <div>
                                            <x-input-label for="image" :value="__('Image')"/>
                                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
                                            <x-input-error class="mt-2" :messages="$errors->get('image')"/>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <x-primary-button>Submit</x-primary-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
