@extends('layouts.app')
@section('content')
    <!-- macOS Window -->
        <div class="mac-window rounded-xl shadow-2xl overflow-hidden transition-colors duration-400" 
                style="background-color: var(--module-bg);">
            <!-- macOS Titlebar -->
            <div class="mac-titlebar h-10 bg-gradient-to-b from-gray-200 to-gray-300 rounded-t-xl flex items-center px-4 border-b border-gray-400">
                <div class="mac-buttons flex gap-2">
                    <a href="{{ url()->previous() }}" class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-red"></a>
                    {{-- <div class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-yellow"></div>
                    <div class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-green"></div> --}}
                </div>
                <span class="ml-3 text-gray-700 font-medium">Create Course</span>
            </div>
            
            <!-- Course Content -->
            <div class="p-8">
                <!-- Course Basic Info -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-6" style="color: var(--topbar-text);">Course Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Title</label>
                            <input type="text" name='course_title'
                                    class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                    style="border-color: var(--module-border); color: black;"
                                    placeholder="Enter course title">
                        </div>  
                        <div class="form-group">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Featured Video</label>
                            <input type="text" name='course_video'
                                    class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                    style="border-color: var(--module-border);  color: black"
                                    placeholder="video url only">
                        </div>  
                        <div class="form-group">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Thumbnail</label>
                            <input type="text" name='course_image'
                                    class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                    style="border-color: var(--module-border);  color: black "
                                    placeholder="Enter thumnail">
                        </div>  
                        <div class="form-group">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Price</label>
                            <input type="text" name='price'
                                    class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                    style="border-color: var(--module-border);  color: black"
                                    placeholder="Enter course title">
                        </div>  
                        <div class="form-group">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Level</label>
                            <select class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                    style="border-color: var(--module-border);  color: black">
                                <option>Select Level</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Category</label>
                            <select class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                    style="border-color: var(--module-border);  color: black">
                                <option>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group md:col-span-2">
                            <label for="name" class="block mb-2 text-base font-medium text-gray-700">Course Summary</label>

                            <input id="text" type="hidden" name="text" value="{{ old('text') }}">
                            <trix-editor input="text"  
                            style="border-color: var(--module-border);  color: black"
                            {{-- style="border-color: var(--module-border); background-color: var(--module-bg);" --}}
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
                        <button class="btn-add bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer" 
                                onclick="addModule()">
                            <i class="fas fa-plus mr-2"></i>Add Module
                        </button>
                    </div>
                    
                    <div id="modulesContainer">
                        <!-- Modules will be added here dynamically -->
                    </div>
                </div>

                <!-- Save Course Button -->
                <div class="flex justify-end gap-4">
                    <button class="px-6 py-3 border border-gray-300 rounded-md font-medium transition-colors duration-200 hover:bg-gray-50" 
                            style="color: var(--topbar-text); border-color: var(--module-border);">
                        Save as Draft
                    </button>
                    <button class="btn-primary text-white px-6 py-3 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer" 
                            style="background-color: var(--button-primary);" 
                            onmouseover="this.style.backgroundColor='var(--button-hover)'" 
                            onmouseout="this.style.backgroundColor='var(--button-primary)'">
                        Publish Course
                    </button>
                </div>
            </div>
        </div>
@endsection

@push('style-stack')
    {{-- Trix Editor CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
@endpush

@push('script-stack')
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>

    <script>
        
        let moduleCount = 0;
        let contentCount = 0;

        

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
                                    <button class="btn-primary text-white px-3 py-2 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer text-sm" 
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
                module.remove();
            }
        }

        function toggleModule(moduleId) {
            const module = document.getElementById(`module-${moduleId}`);
            module.classList.toggle('open');
        }

        function addContent(moduleId, type) {
            contentCount++;
            let contentHtml = '';
            
            const iconMap = {
                'video': 'fas fa-video',
                'text': 'fas fa-file-text',
                'quiz': 'fas fa-question-circle'
            };
            const SOURCES = @json($sources);
            console.log(SOURCES);

            if (type === 'video') {
                // Build options dynamically from SOURCES
                let sourceOptions = `<option value="">Select Source</option>`;
                SOURCES.forEach(src => {
                    sourceOptions += `<option value="${src}">${src.charAt(0).toUpperCase() + src.slice(1)}</option>`;
                });
                console.log(sourceOptions);
                contentHtml = `
                    <div class="content-item relative p-4 border rounded-lg mb-4 transition-all duration-400" 
                        style="background-color: rgba(255, 255, 255, 0.5); border-color: var(--module-border);" 
                        id="content-${contentCount}">
                        <div class="content-header flex justify-between items-center cursor-pointer py-2" 
                            onclick="toggleContent(${contentCount})">
                            <div class="content-title flex items-center gap-3">
                                <i class="${iconMap[type]} text-red-500"></i>
                                <span class="font-medium" style="color: var(--topbar-text);">Video Content</span>
                            </div>
                            <div class="content-actions flex items-center gap-2">
                                <i class="fas fa-chevron-down accordion-arrow transition-transform duration-300" style="color: var(--topbar-text);"></i>
                                <button class="content-remove w-5 h-5 rounded-full flex items-center justify-center text-white text-xs font-bold cursor-pointer border-none p-0 bg-mac-red" 
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

                                    <!-- Source (SELECT instead of input) -->
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
                                        <input type="url" name="modules[${moduleId}][contents][${contentCount}][url]"
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
            

            } else if (type === 'text') {
                contentHtml = `
                    <div class="content-item relative p-4 border rounded-lg mb-4 transition-all duration-400" 
                         style="background-color: rgba(255, 255, 255, 0.5); border-color: var(--module-border);" 
                         id="content-${contentCount}">
                        <div class="content-header flex justify-between items-center cursor-pointer py-2" 
                             onclick="toggleContent(${contentCount})">
                            <div class="content-title flex items-center gap-3">
                                <i class="${iconMap[type]} text-blue-500"></i>
                                <span class="font-medium" style="color: var(--topbar-text);">Text Content</span>
                            </div>
                            <div class="content-actions flex items-center gap-2">
                                <i class="fas fa-chevron-down accordion-arrow transition-transform duration-300" style="color: var(--topbar-text);"></i>
                                <button class="content-remove w-5 h-5 rounded-full flex items-center justify-center text-white text-xs font-bold cursor-pointer border-none p-0 bg-mac-red" 
                                        onclick="removeContent(${contentCount}); event.stopPropagation();">×</button>
                            </div>
                        </div>
                        <div class="content-body p-0 transition-all duration-300">
                            <div class="pt-4">
                                <div class="form-group">
                                    <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Content Title</label>
                                    <input type="text" 
                                           class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                           style="border-color: var(--module-border);"
                                           placeholder="Enter content title">
                                </div>
                                <div class="form-group">
                                    <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Content Body</label>
                                    <textarea rows="6" 
                                              class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                              style="border-color: var(--module-border);"
                                              placeholder="Enter your content here..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else if (type === 'quiz') {
                contentHtml = `
                    <div class="content-item relative p-4 border rounded-lg mb-4 transition-all duration-400" 
                         style="background-color: rgba(255, 255, 255, 0.5); border-color: var(--module-border);" 
                         id="content-${contentCount}">
                        <div class="content-header flex justify-between items-center cursor-pointer py-2" 
                             onclick="toggleContent(${contentCount})">
                            <div class="content-title flex items-center gap-3">
                                <i class="${iconMap[type]} text-green-500"></i>
                                <span class="font-medium" style="color: var(--topbar-text);">Quiz Content</span>
                            </div>
                            <div class="content-actions flex items-center gap-2">
                                <i class="fas fa-chevron-down accordion-arrow transition-transform duration-300" style="color: var(--topbar-text);"></i>
                                <button class="content-remove w-5 h-5 rounded-full flex items-center justify-center text-white text-xs font-bold cursor-pointer border-none p-0 bg-mac-red" 
                                        onclick="removeContent(${contentCount}); event.stopPropagation();">×</button>
                            </div>
                        </div>
                        <div class="content-body p-0 transition-all duration-300">
                            <div class="pt-4">
                                <div class="form-group">
                                    <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Quiz Title</label>
                                    <input type="text" 
                                           class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                           style="border-color: var(--module-border);"
                                           placeholder="Enter quiz title">
                                </div>
                                <div class="form-group">
                                    <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Question</label>
                                    <textarea rows="3" 
                                              class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                              style="border-color: var(--module-border);"
                                              placeholder="Enter your question"></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Option A</label>
                                        <input type="text" 
                                               class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                               style="border-color: var(--module-border);"
                                               placeholder="Enter option A">
                                    </div>
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Option B</label>
                                        <input type="text" 
                                               class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                               style="border-color: var(--module-border);"
                                               placeholder="Enter option B">
                                    </div>
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Option C</label>
                                        <input type="text" 
                                               class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                               style="border-color: var(--module-border);"
                                               placeholder="Enter option C">
                                    </div>
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Correct Answer</label>
                                        <select class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                                style="border-color: var(--module-border);">
                                            <option>Select correct answer</option>
                                            <option>Option A</option>
                                            <option>Option B</option>
                                            <option>Option C</option>
                                        </select>
                                    </div>
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
                content.remove();
            }
        }

        function toggleContent(contentId) {
            const content = document.getElementById(`content-${contentId}`);
            content.classList.toggle('open');
        }

       
    </script>
@endpush