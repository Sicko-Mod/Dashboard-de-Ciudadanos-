<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit City') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-8">
            <form action="{{ route('cities.update', $city->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') {{-- Use PUT method for updates --}}

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('City Name') }}
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $city->name) }}" required
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('Description') }}
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $city->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                        class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Update City') }}
                    </button>
                </div>
            </form>
            <div class="mt-4 text-center">
                <a href="{{ route('cities.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">{{ __('Cancel') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>