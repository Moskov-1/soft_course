@extends('layouts.app')
@section('content')
    <!-- macOS Window -->
    <div class="mac-window rounded-xl shadow-2xl overflow-hidden transition-colors duration-400" 
            style="background-color: var(--module-bg);">
        <!-- macOS Titlebar -->
        <div class="mac-titlebar h-10 bg-gradient-to-b from-gray-200 to-gray-300 rounded-t-xl flex items-center px-4 border-b border-gray-400">
            <div class="mac-buttons flex gap-2">
                <a href="{{ url()->previous() }}" class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-red"></a>
            </div>
            <span class="ml-3 text-gray-700 font-medium">Edit Course</span>
        </div>
        <!-- Course Content -->
        <form class="p-8" action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Course Basic Info -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-6" style="color: var(--topbar-text);">Course Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Title</label>
                        <input type="text" name='course_title'
                                class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                style="border-color: var(--module-border); color: black;"
                                placeholder="Enter course title"
                                value="{{ old('course_title', $course->title) }}">
                    </div>  
                    <div class="form-group">
                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Featured Video</label>
                        <input type="text" name='course_video'
                                class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                style="border-color: var(--module-border);  color: black"
                                placeholder="video url only"
                                value="{{ old('course_video', $course->intro_vid) }}">
                    </div>  
                    <div class="form-group">
                        <label for="course_image" class="block mb-2 font-medium" style="color: var(--topbar-text);">
                            Thumbnail
                        </label>
                        <input type="file" name="course_image" id="course_image"
                            class="dropify"
                            data-height="150"
                            data-default-file="{{ $course->course_image ? asset('storage/' . $course->course_image) : '' }}"
                            data-allowed-file-extensions="jpg jpeg png webp">

                        @error('course_image')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Price</label>
                        <input type="text" name='price'
                                class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                style="border-color: var(--module-border);  color: black"
                                placeholder="Enter course price"
                                value="{{ old('price', $course->price) }}">
                    </div>  
                    <div class="form-group">
                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Level</label>
                        <select name="level_id"
                         class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                style="border-color: var(--module-border);  color: black">
                            <option value="" disabled>Select Level</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}" {{ $course->level_id == $level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Category</label>
                        <select name="category_id"
                        class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                style="border-color: var(--module-border);  color: black">
                            <option value="" disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
        {{-- @dd($course) --}}

                    <div class="form-group md:col-span-2">
                        <label for="name" class="block mb-2 text-base font-medium text-gray-700">Course Summary</label>

                        <input id="text" type="hidden" name="text" value="{{ old('text', $course->text) }}">
                        <trix-editor input="text"  
                        style="border-color: var(--module-border);  color: black"
                                    class="trix-text w-full rounded-md border @error('text') border-red-500 @else border-gray-300 @enderror bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </trix-editor>
                        @error('text')
                            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>
            </div>

            <!-- Course Modules -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold" style="color: var(--topbar-text);">Course Modules</h2>
                    <button type="button"  class="btn-add bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer" 
                            onclick="addModule()">
                        <i class="fas fa-plus mr-2"></i>Add Module
                    </button>
                </div>
                
                <div id="modulesContainer">
                    <!-- Existing modules will be added here -->
                    @foreach($modules as $index => $module)
                        <div class="module rounded-lg border mb-4 relative transition-all duration-400 overflow-hidden" 
                             style="background-color: var(--module-bg); border-color: var(--module-border);" 
                             id="module-{{ $index }}">
                            <div class="module-header flex justify-between items-center p-4 cursor-pointer bg-black bg-opacity-5 border-b" 
                                 style="border-color: var(--module-border);" 
                                 onclick="toggleModule({{ $index }})">
                                <div class="module-title-container flex items-center gap-3">
                                    <i class="fas fa-book text-blue-600"></i>
                                    <span class="font-medium" style="color: var(--topbar-text);">Module {{ $index + 1 }}</span>
                                </div>
                                <div class="module-actions flex items-center gap-2">
                                    <i class="fas fa-chevron-down accordion-arrow transition-transform duration-300" style="color: var(--topbar-text);"></i>
                                    <button class="btn-remove w-5 h-5 rounded-full flex items-center justify-center text-white text-sm font-bold cursor-pointer border-none p-0 bg-mac-red hover:bg-red-600" 
                                            onclick="removeModule({{ $index }}); event.stopPropagation();">×</button>
                                </div>
                            </div>
                            <div class="module-content p-0 transition-all duration-300">
                                <div class="p-4">
                                    <input type="hidden" name="modules[{{ $index }}][id]" value="{{ $module->id }}">
                                    <input type="text" name="modules[{{ $index }}][title]"
                                           class="module-title-input w-full p-3 border rounded-md mb-4 text-base transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                           style="border-color: var(--module-border);  color: black"
                                           placeholder="Enter module title"
                                           value="{{ old('modules.' . $index . '.title', $module->name) }}">
                                    
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="font-medium" style="color: var(--topbar-text);">Module Content</h4>
                                        <div class="flex gap-2">
                                            <button type='button' class="btn-primary text-white px-3 py-2 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer text-sm" 
                                                    style="background-color: var(--button-primary);" 
                                                    onclick="addContent({{ $index }}, 'video')">
                                                <i class="fas fa-video mr-1"></i>Add Video
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="content-container" id="content-container-{{ $index }}">
                                        @foreach($module->contents as $contentIndex => $content)
                                            @php
                                                $contentCount = $index * 100 + $contentIndex;
                                            @endphp
                                            <input type="hidden" name="modules[{{ $index }}][contents][{{ $contentCount }}][id]" value="{{ $content->id }}">
                                            <input type="hidden" name="modules[{{ $index }}][contents][{{ $contentCount }}][type]" value="{{ $content->type }}">
                                                                    {{-- @dd($sources, $content->contentable->source_type) --}}

                                            <div class="content-item relative p-4 border rounded-lg mb-4 transition-all duration-400" 
                                                style="background-color: rgba(255, 255, 255, 0.5); border-color: var(--module-border);" 
                                                id="content-{{ $contentCount }}">
                                                <div class="content-header flex justify-between items-center cursor-pointer py-2" 
                                                    onclick="toggleContent({{ $contentCount }})">
                                                    <div class="content-title flex items-center gap-3">
                                                        <i class="fas fa-video text-red-500"></i>
                                                        <span class="font-medium" style="color: var(--topbar-text);">Video Content</span>
                                                    </div>
                                                    <div class="content-actions flex items-center gap-2">
                                                        <i class="fas fa-chevron-down accordion-arrow transition-transform duration-300" style="color: var(--topbar-text);"></i>
                                                        <button type='button' class="content-remove w-5 h-5 rounded-full flex items-center justify-center text-white text-xs font-bold cursor-pointer border-none p-0 bg-mac-red" 
                                                                onclick="removeContent({{ $contentCount }}); event.stopPropagation();">×</button>
                                                    </div>
                                                </div>
                                                <div class="content-body p-0 transition-all duration-300">
                                                    <div class="pt-4">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <!-- Title -->
                                                            <div class="form-group">
                                                                <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video Title</label>
                                                                <input type="text" name="modules[{{ $index }}][contents][{{ $contentCount }}][title]"
                                                                    class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 
                                                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                                                    style="border-color: var(--module-border);  color: black"
                                                                    placeholder="Enter video title"
                                                                    value="{{ old('modules.' . $index . '.contents.' . $contentCount . '.title', $content->contentable->title) }}">
                                                                <input type="hidden" name="modules[{{ $index }}][contents][{{ $contentCount }}][type]" value="video">

                                                            </div>

                                                            <!-- Source -->
                                                            <div class="form-group">
                                                                <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video Source</label>
                                                                <select name="modules[{{ $index }}][contents][{{ $contentCount }}][source]"
                                                                        class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 
                                                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                                                        style="border-color: var(--module-border); color: black;">
                                                                    <option value="">Select Source</option>
                                                                    @foreach($sources as $source)
                                                                        <option value="{{ $source }}" @selected($content->contentable->source_type == $source)>
                                                                            {{ ucfirst($source) }} 
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- URL -->
                                                            <div class="form-group col-span-2">
                                                                <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video URL</label>
                                                                <input type="text" name="modules[{{ $index }}][contents][{{ $contentCount }}][url]"
                                                                    class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 
                                                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                                                    style="border-color: var(--module-border);  color: black"
                                                                    placeholder="Enter video URL"
                                                                    value="{{ old('modules.' . $index . '.contents.' . $contentCount . '.url',$content->contentable->url) }}">
                                                            </div>
                                                        </div>

                                                        <!-- Length -->
                                                        <div class="form-group mt-4">
                                                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video Length</label>
                                                            <input type="text" name="modules[{{ $index }}][contents][{{ $contentCount }}][length]"
                                                                class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 
                                                                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                                                style="border-color: var(--module-border);  color: black"
                                                                placeholder="HH:MM:SS"
                                                                value="{{ old('modules.' . $index . '.contents.' . $contentCount . '.length', gmdate('H:i:s', $content->contentable->length_in_seconds)) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Save Course Button -->
            <div class="flex justify-end gap-4">
                <button type='submit' class="btn-primary text-white px-6 py-3 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer" 
                        style="background-color: var(--button-primary);" 
                        onmouseover="this.style.backgroundColor='var(--button-hover)'" 
                        onmouseout="this.style.backgroundColor='var(--button-primary)'">
                    Update Course
                </button>
            </div>
        </form>
    </div>
    @include('partials.notifiy.alert')
@endsection

@push('style-stack')
    {{-- Trix Editor CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css" />
@endpush

@push('script-stack')
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
        
        // Initialize counters based on existing content
        let moduleCount = {{ $course->modules->count() }};
        let contentCount = {{ $course->modules->sum('contents.count') }};
        
        // Module management
        function addModule() {
            moduleCount++;
            const moduleHtml = `
                <div class="module rounded-lg border mb-4 relative transition-all duration-400 overflow-hidden" 
                     style="background-color: var(--module-bg); border-color: var(--module-border);" 
                     id="module-${moduleCount}">
                    <div class="module-header flex justify-between items-center p-4 cursor-pointer bg-black bg-opacity-5 border-b" 
                         style="border-color: var(--module-border);" 
                         onclick="toggleModule(${moduleCount})">
                        <div class="module-title-container flex items-center gap-3">
                            <i class="fas fa-book text-blue-600"></i>
                            <span class="font-medium" style="color: var(--topbar-text);">Module ${moduleCount}</span>
                        </div>
                        <div class="module-actions flex items-center gap-2">
                            <i class="fas fa-chevron-down accordion-arrow transition-transform duration-300" style="color: var(--topbar-text);"></i>
                            <button class="btn-remove w-5 h-5 rounded-full flex items-center justify-center text-white text-sm font-bold cursor-pointer border-none p-0 bg-mac-red hover:bg-red-600" 
                                    onclick="removeModule(${moduleCount}); event.stopPropagation();">×</button>
                        </div>
                    </div>
                    <div class="module-content p-0 transition-all duration-300">
                        <div class="p-4">
                            <input type="text" name="modules[${moduleCount}][title]"
                                   class="module-title-input w-full p-3 border rounded-md mb-4 text-base transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                   style="border-color: var(--module-border);  color: black"
                                   placeholder="Enter module title">
                            
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-medium" style="color: var(--topbar-text);">Module Content</h4>
                                <div class="flex gap-2">
                                    <button type='button' class="btn-primary text-white px-3 py-2 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer text-sm" 
                                            style="background-color: var(--button-primary);" 
                                            onclick="addContent(${moduleCount}, 'video')">
                                        <i class="fas fa-video mr-1"></i>Add Video
                                    </button>
                                </div>
                            </div>
                            
                            <div class="content-container" id="content-container-${moduleCount}">
                                <!-- Content items will be added here -->
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('modulesContainer').insertAdjacentHTML('beforeend', moduleHtml);
        }

        function removeModule(moduleId) {
            const module = document.getElementById(`module-${moduleId}`);
            if (module) {
                // Add a hidden input to mark this module for deletion if it exists in the database
                if (module.querySelector('input[name*="[id]"]')) {
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = `modules[${moduleId}][_delete]`;
                    deleteInput.value = '1';
                    module.appendChild(deleteInput);
                    module.style.display = 'none'; // Hide instead of removing
                } else {
                    module.remove(); // Remove if it was a newly added module
                }
            }
        }

        function toggleModule(moduleId) {
            const module = document.getElementById(`module-${moduleId}`);
            module.classList.toggle('open');
        }

        function addContent(moduleId, type) {
            contentCount++;
            let contentHtml = '';
            
            const SOURCES = @json($sources);

            if (type === 'video') {
                let sourceOptions = `<option value="">Select Source</option>`;
                SOURCES.forEach(src => {
                    sourceOptions += `<option value="${src}">${src.charAt(0).toUpperCase() + src.slice(1)}</option>`;
                });
                
                contentHtml = `
                    <input type="hidden" name="modules[${moduleId}][contents][${contentCount}][type]" value="video">
                    <div class="content-item relative p-4 border rounded-lg mb-4 transition-all duration-400" 
                        style="background-color: rgba(255, 255, 255, 0.5); border-color: var(--module-border);" 
                        id="content-${contentCount}">
                        <div class="content-header flex justify-between items-center cursor-pointer py-2" 
                            onclick="toggleContent(${contentCount})">
                            <div class="content-title flex items-center gap-3">
                                <i class="fas fa-video text-red-500"></i>
                                <span class="font-medium" style="color: var(--topbar-text);">Video Content</span>
                            </div>
                            <div class="content-actions flex items-center gap-2">
                                <i class="fas fa-chevron-down accordion-arrow transition-transform duration-300" style="color: var(--topbar-text);"></i>
                                <button type='button' class="content-remove w-5 h-5 rounded-full flex items-center justify-center text-white text-xs font-bold cursor-pointer border-none p-0 bg-mac-red" 
                                        onclick="removeContent(${contentCount}); event.stopPropagation();">×</button>
                            </div>
                        </div>
                        <div class="content-body p-0 transition-all duration-300">
                            <div class="pt-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Title -->
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video Title</label>
                                        <input type="text" name="modules[${moduleId}][contents][${contentCount}][title]"
                                            class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 
                                                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                            style="border-color: var(--module-border);  color: black"
                                            placeholder="Enter video title">
                                    </div>

                                    <!-- Source -->
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video Source</label>
                                        <select name="modules[${moduleId}][contents][${contentCount}][source]"
                                                class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 
                                                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                                style="border-color: var(--module-border); color: black;">
                                            ${sourceOptions}
                                        </select>
                                    </div>

                                    <!-- URL -->
                                    <div class="form-group col-span-2">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video URL</label>
                                        <input type="text" name="modules[${moduleId}][contents][${contentCount}][url]"
                                            class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 
                                                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                            style="border-color: var(--module-border);  color: black"
                                            placeholder="Enter video URL">
                                    </div>
                                </div>

                                <!-- Length -->
                                <div class="form-group mt-4">
                                    <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video Length</label>
                                    <input type="text" name="modules[${moduleId}][contents][${contentCount}][length]"
                                        class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 
                                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                        style="border-color: var(--module-border);  color: black"
                                        placeholder="HH:MM:SS">
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            document.getElementById(`content-container-${moduleId}`).insertAdjacentHTML('beforeend', contentHtml);
        }

        function removeContent(contentId) {
            const content = document.getElementById(`content-${contentId}`);
            if (content) {
                // Check if this content has an ID (exists in database)
                const idInput = content.querySelector('input[name*="[id]"]');
                if (idInput && idInput.value) {
                    // Add a hidden input to mark this content for deletion
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = idInput.name.replace('[id]', '[_delete]');
                    deleteInput.value = '1';
                    content.appendChild(deleteInput);
                    content.style.display = 'none'; // Hide instead of removing
                } else {
                    content.remove(); // Remove if it was a newly added content
                }
            }
        }

        function toggleContent(contentId) {
            const content = document.getElementById(`content-${contentId}`);
            content.classList.toggle('open');
        }
    </script>
@endpush