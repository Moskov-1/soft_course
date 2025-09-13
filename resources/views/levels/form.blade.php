@extends('layouts.app')
@section('content')
    <div class="mac-window rounded-xl shadow-2xl w-1/2  overflow-hidden transition-colors duration-400 bg-white">
        <!-- macOS Titlebar -->
        <div class="mac-titlebar h-10 bg-gradient-to-b from-gray-200 to-gray-300 rounded-t-xl flex items-center px-4 border-b border-gray-400">
            <div class="mac-buttons flex gap-2">
                <a href="{{ route('levels.index') }}" class="mac-btn w-4 h-4 rounded-full bg-mac-red"></a>
            </div>
            <span class="ml-3 text-gray-700 font-medium">Create Levels</span>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            <form method="POST" action="{{ @$level ? route('levels.update', $level->id) : route('levels.store') }}">
                @csrf
                @if (@$level)
                    @method('PUT')
                @endif
                <div class="grid grid-cols-1">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block mb-1 text-gray-700 font-medium">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name', @$level->name) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Text -->
                    <div>
                        <label for="name" class="block mb-2 text-base font-medium text-gray-700">Content</label>

                        <input id="text" type="hidden" name="text" value="{{ old('text',@$level->text) }}">
                        <trix-editor input="text"
                                    class="trix-text w-full rounded-md border @error('text') border-red-500 @else border-gray-300 @enderror bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </trix-editor>
                        @error('text')
                            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- Submit -->
                <div class="mt-4">
                    <button type="submit"
                        class="w-full py-2 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 transition-colors">
                        Save
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection

@push('style-stack')
    {{-- Trix Editor CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
@endpush

@push('script-stack')    
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
@endpush