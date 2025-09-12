@extends('layouts.app')
@section('content')
    <!-- macOS Window -->
        <div class="mac-window rounded-xl shadow-2xl overflow-hidden transition-colors duration-400" 
                style="background-color: var(--module-bg);">
            <!-- macOS Titlebar -->
            <div class="mac-titlebar h-10 bg-gradient-to-b from-gray-200 to-gray-300 rounded-t-xl flex items-center px-4 border-b border-gray-400">
                <div class="mac-buttons flex gap-2">
                    <div class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-red"></div>
                    {{-- <div class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-yellow"></div>
                    <div class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-green"></div> --}}
                </div>
            </div>

            <!-- Course Content -->
            <div class="p-8">
                <!-- Course Basic Info -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-6" style="color: var(--topbar-text);">Course Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Title</label>
                            <input type="text" 
                                    class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                    style="border-color: var(--module-border); background-color: var(--module-bg);"
                                    placeholder="Enter course title">
                        </div>
                        <div class="form-group">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Category</label>
                            <select class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                    style="border-color: var(--module-border); background-color: var(--module-bg);">
                                <option>Select Category</option>
                                <option>Programming</option>
                                <option>Design</option>
                                <option>Business</option>
                                <option>Marketing</option>
                            </select>
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Course Description</label>
                            <textarea rows="4" 
                                        class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                        style="border-color: var(--module-border); background-color: var(--module-bg);"
                                        placeholder="Enter course description"></textarea>
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