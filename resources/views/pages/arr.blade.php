<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course - Learning Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'mac-red': '#ff5f56',
                        'mac-yellow': '#ffbd2e',
                        'mac-green': '#27c93f',
                        'sidebar-bg': '#1f2937',
                        'sidebar-text': '#f3f4f6',
                        'topbar-bg': '#ffffff',
                        'topbar-text': '#374151',
                        'content-bg': '#f9fafb',
                        'module-bg': '#f8fafc',
                        'module-border': '#e2e8f0',
                        'focus-ring': '#3b82f6',
                        'button-primary': '#4f46e5',
                        'button-hover': '#4338ca'
                    },
                    transitionDuration: {
                        '400': '400ms'
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --mac-red: #ff5f56;
            --mac-yellow: #ffbd2e;
            --mac-green: #27c93f;
            --module-bg: #f8fafc;
            --module-border: #e2e8f0;
            --focus-ring: #3b82f6;
            --button-primary: #4f46e5;
            --button-hover: #4338ca;
            --sidebar-bg: #1f2937;
            --sidebar-text: #f3f4f6;
            --topbar-bg: #ffffff;
            --topbar-text: #374151;
            --content-bg: #f9fafb;
            --transition-time: 0.4s;
        }

        [data-theme="dark"] {
            --module-bg: #374151;
            --module-border: #4b5563;
            --sidebar-bg: #111827;
            --sidebar-text: #f3f4f6;
            --topbar-bg: #1f2937;
            --topbar-text: #f3f4f6;
            --content-bg: #1f2937;
            --button-primary: #6366f1;
            --button-hover: #818cf8;
        }

        [data-theme="rain"] {
            --module-bg: #dcf0fdff;
            --module-border: #bae6fd;
            --sidebar-bg: #0c4a6e;
            --sidebar-text: #e0f2fe;
            --topbar-bg: #0369a1;
            --topbar-text: #e0f2fe;
            --content-bg: #f0f9ff;
            --button-primary: #0284c7;
            --button-hover: #0369a1;
        }

        /* Custom animations and effects */
        .accordion-arrow {
            transition: transform 0.3s ease;
        }

        .module.open .accordion-arrow {
            transform: rotate(180deg);
        }

        .module-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .module.open .module-content {
            max-height: 2000px;
        }

        .content-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .content-item.open .content-body {
            max-height: 500px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user-dropdown.active {
            animation: fadeIn 0.3s ease;
        }

        /* Rain animation */
        .rain-effect {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: -1;
            display: none;
        }

        [data-theme="rain"] .rain-effect {
            display: block;
        }

        .rain-drop {
            position: absolute;
            width: 2px;
            height: 15px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.1));
            border-radius: 0 0 5px 5px;
            animation: rain linear infinite;
        }

        @keyframes rain {
            from { transform: translateY(-100px); }
            to { transform: translateY(calc(100vh + 100px)); }
        }
    </style>
</head>
<body class="font-sans m-0 p-0 transition-all duration-400" style="background-color: var(--content-bg); color: var(--topbar-text);">
    <!-- Rain Effect -->
    <div class="rain-effect"></div>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="toggleSidebar()"></div>

    <div class="dashboard-container flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar fixed h-screen z-50 shadow-xl transition-all duration-400 w-64 lg:w-64" 
             style="background-color: var(--sidebar-bg); color: var(--sidebar-text); transform: translateX(-100%);" 
             id="sidebar">
            <div class="sidebar-header p-5 border-b border-white border-opacity-10 flex justify-between items-center">
                <h2 class="text-xl font-bold">LMS Dashboard</h2>
                <button class="sidebar-close lg:hidden bg-transparent border-none cursor-pointer" 
                        style="color: var(--sidebar-text);" onclick="toggleSidebar()">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <nav class="sidebar-menu py-4">
                <a href="#" class="menu-item flex items-center px-5 py-3 transition-colors duration-300 hover:bg-white hover:bg-opacity-10 no-underline" 
                   style="color: var(--sidebar-text);">
                    <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
                    Dashboard
                </a>
                <a href="#" class="menu-item flex items-center px-5 py-3 transition-colors duration-300 hover:bg-white hover:bg-opacity-10 no-underline" 
                   style="color: var(--sidebar-text);">
                    <i class="fas fa-book mr-3 w-5 text-center"></i>
                    Courses
                </a>
                <a href="#" class="menu-item flex items-center px-5 py-3 transition-colors duration-300 hover:bg-white hover:bg-opacity-10 no-underline" 
                   style="color: var(--sidebar-text);">
                    <i class="fas fa-users mr-3 w-5 text-center"></i>
                    Students
                </a>
                <a href="#" class="menu-item flex items-center px-5 py-3 transition-colors duration-300 hover:bg-white hover:bg-opacity-10 no-underline" 
                   style="color: var(--sidebar-text);">
                    <i class="fas fa-chart-bar mr-3 w-5 text-center"></i>
                    Analytics
                </a>
                <a href="#" class="menu-item flex items-center px-5 py-3 transition-colors duration-300 hover:bg-white hover:bg-opacity-10 no-underline" 
                   style="color: var(--sidebar-text);">
                    <i class="fas fa-cog mr-3 w-5 text-center"></i>
                    Settings
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 transition-all duration-400 lg:ml-64" id="mainContent">
            <!-- Topbar -->
            <div class="topbar sticky top-0 z-30 px-8 py-4 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 lg:gap-0 shadow-lg transition-all duration-400" 
                 style="background-color: var(--topbar-bg); color: var(--topbar-text);">
                <div class="flex items-center gap-4 w-full lg:w-auto">
                    <button class="menu-toggle lg:hidden bg-transparent border-none text-2xl cursor-pointer" 
                            style="color: var(--topbar-text);" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-2xl font-bold">Create New Course</h1>
                </div>
                
                <div class="user-menu flex items-center gap-4 relative w-full lg:w-auto justify-between lg:justify-end">
                    <div class="theme-switcher flex items-center gap-3 order-2 lg:order-1">
                        <div class="theme-btn w-6 h-6 rounded-full cursor-pointer border-2 border-transparent transition-all duration-200 hover:scale-110 bg-gradient-to-r from-gray-100 to-gray-200" 
                             onclick="setTheme('light')" id="lightTheme"></div>
                        <div class="theme-btn w-6 h-6 rounded-full cursor-pointer border-2 border-transparent transition-all duration-200 hover:scale-110 bg-gradient-to-r from-gray-600 to-gray-800" 
                             onclick="setTheme('dark')" id="darkTheme"></div>
                        <div class="theme-btn w-6 h-6 rounded-full cursor-pointer border-2 border-transparent transition-all duration-200 hover:scale-110 bg-gradient-to-r from-sky-200 to-sky-300 relative overflow-hidden" 
                             onclick="setTheme('rain')" id="rainTheme"></div>
                    </div>
                    
                    <div class="flex items-center gap-3 order-1 lg:order-2">
                        <span class="look transition-all duration-200 hover:bg-blue-600 hover:text-white hover:px-2 hover:py-1 hover:rounded cursor-pointer">John Doe</span>
                        <div class="user-avatar w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold cursor-pointer transition-transform duration-200 hover:scale-105" 
                             onclick="toggleUserDropdown()" style="background-color: var(--button-primary);">
                            JD
                        </div>
                        <div class="user-dropdown absolute top-full right-0 mt-3 min-w-48 rounded-lg shadow-xl py-3 z-50 hidden transition-all duration-300" 
                             style="background-color: var(--topbar-bg);" id="userDropdown">
                            <div class="user-dropdown-item px-5 py-3 flex items-center cursor-pointer transition-colors duration-200 hover:bg-black hover:bg-opacity-5">
                                <i class="fas fa-user mr-3 w-5 text-center"></i>
                                Profile
                            </div>
                            <div class="user-dropdown-item px-5 py-3 flex items-center cursor-pointer transition-colors duration-200 hover:bg-black hover:bg-opacity-5">
                                <i class="fas fa-cog mr-3 w-5 text-center"></i>
                                Settings
                            </div>
                            <div class="user-dropdown-item logout px-5 py-3 flex items-center cursor-pointer transition-colors duration-200 hover:bg-black hover:bg-opacity-5 text-red-500 border-t border-black border-opacity-10 mt-2">
                                <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                                Logout
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Wrapper -->
            <div class="content-wrapper p-5 lg:p-8">
                <!-- macOS Window -->
                <div class="mac-window rounded-xl shadow-2xl overflow-hidden transition-colors duration-400" 
                     style="background-color: var(--module-bg);">
                    <!-- macOS Titlebar -->
                    <div class="mac-titlebar h-10 bg-gradient-to-b from-gray-200 to-gray-300 rounded-t-xl flex items-center px-4 border-b border-gray-400">
                        <div class="mac-buttons flex gap-2">
                            <div class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-red"></div>
                            <div class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-yellow"></div>
                            <div class="mac-btn w-4 h-4 rounded-full flex items-center justify-center text-xs font-bold cursor-default bg-mac-green"></div>
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
            </div>
        </div>
    </div>

    <script>
        
        let moduleCount = 0;
        let contentCount = 0;

        // Theme management
        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            
            // Update active theme button
            document.querySelectorAll('.theme-btn').forEach(btn => {
                btn.classList.remove('active', 'border-blue-600', 'scale-115');
            });
            
            const activeBtn = document.getElementById(theme + 'Theme');
            if (activeBtn) {
                activeBtn.classList.add('active', 'border-blue-600', 'scale-115');
            }
            
            // Start/stop rain effect
            if (theme === 'rain') {
                startRainEffect();
            } else {
                stopRainEffect();
            }
            
            localStorage.setItem('theme', theme);
        }

        // Rain effect
        function startRainEffect() {
            const rainContainer = document.querySelector('.rain-effect');
            rainContainer.innerHTML = '';
            
            for (let i = 0; i < 100; i++) {
                const drop = document.createElement('div');
                drop.className = 'rain-drop';
                drop.style.left = Math.random() * 100 + '%';
                drop.style.animationDuration = (Math.random() * 1 + 0.5) + 's';
                drop.style.animationDelay = Math.random() * 2 + 's';
                rainContainer.appendChild(drop);
            }
        }

        function stopRainEffect() {
            const rainContainer = document.querySelector('.rain-effect');
            rainContainer.innerHTML = '';
        }

        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (sidebar.style.transform === 'translateX(0px)') {
                sidebar.style.transform = 'translateX(-100%)';
                overlay.classList.remove('active');
                overlay.classList.add('hidden');
            } else {
                sidebar.style.transform = 'translateX(0px)';
                overlay.classList.add('active');
                overlay.classList.remove('hidden');
            }
        }

        // User dropdown
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('active');
        }

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
                            <input type="text" 
                                   class="module-title-input w-full p-3 border rounded-md mb-4 text-base transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                   style="border-color: var(--module-border); background-color: var(--module-bg);"
                                   placeholder="Enter module title">
                            
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-medium" style="color: var(--topbar-text);">Module Content</h4>
                                <div class="flex gap-2">
                                    <button class="btn-primary text-white px-3 py-2 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer text-sm" 
                                            style="background-color: var(--button-primary);" 
                                            onclick="addContent(${moduleCount}, 'video')">
                                        <i class="fas fa-video mr-1"></i>Add Video
                                    </button>
                                    <button class="btn-primary text-white px-3 py-2 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer text-sm" 
                                            style="background-color: var(--button-primary);" 
                                            onclick="addContent(${moduleCount}, 'text')">
                                        <i class="fas fa-file-text mr-1"></i>Add Text
                                    </button>
                                    <button class="btn-primary text-white px-3 py-2 rounded-md font-medium transition-colors duration-200 border-none cursor-pointer text-sm" 
                                            style="background-color: var(--button-primary);" 
                                            onclick="addContent(${moduleCount}, 'quiz')">
                                        <i class="fas fa-question-circle mr-1"></i>Add Quiz
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
            
            if (type === 'video') {
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
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video Title</label>
                                        <input type="text" 
                                               class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                               style="border-color: var(--module-border); background-color: var(--module-bg);"
                                               placeholder="Enter video title">
                                    </div>
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video URL</label>
                                        <input type="url" 
                                               class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                               style="border-color: var(--module-border); background-color: var(--module-bg);"
                                               placeholder="Enter video URL">
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Video Description</label>
                                    <textarea rows="3" 
                                              class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                              style="border-color: var(--module-border); background-color: var(--module-bg);"
                                              placeholder="Enter video description"></textarea>
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
                                           style="border-color: var(--module-border); background-color: var(--module-bg);"
                                           placeholder="Enter content title">
                                </div>
                                <div class="form-group">
                                    <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Content Body</label>
                                    <textarea rows="6" 
                                              class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                              style="border-color: var(--module-border); background-color: var(--module-bg);"
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
                                           style="border-color: var(--module-border); background-color: var(--module-bg);"
                                           placeholder="Enter quiz title">
                                </div>
                                <div class="form-group">
                                    <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Question</label>
                                    <textarea rows="3" 
                                              class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                              style="border-color: var(--module-border); background-color: var(--module-bg);"
                                              placeholder="Enter your question"></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Option A</label>
                                        <input type="text" 
                                               class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                               style="border-color: var(--module-border); background-color: var(--module-bg);"
                                               placeholder="Enter option A">
                                    </div>
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Option B</label>
                                        <input type="text" 
                                               class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                               style="border-color: var(--module-border); background-color: var(--module-bg);"
                                               placeholder="Enter option B">
                                    </div>
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Option C</label>
                                        <input type="text" 
                                               class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                               style="border-color: var(--module-border); background-color: var(--module-bg);"
                                               placeholder="Enter option C">
                                    </div>
                                    <div class="form-group">
                                        <label class="block mb-2 font-medium" style="color: var(--topbar-text);">Correct Answer</label>
                                        <select class="w-full px-3 py-3 border rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20" 
                                                style="border-color: var(--module-border); background-color: var(--module-bg);">
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

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            setTheme(savedTheme);
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                const userDropdown = document.getElementById('userDropdown');
                const userAvatar = document.querySelector('.user-avatar');
                
                if (!userAvatar.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                    userDropdown.classList.remove('active');
                }
            });

            // Handle responsive sidebar
            function handleResize() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.querySelector('.sidebar-overlay');
                
                if (window.innerWidth >= 1024) {
                    sidebar.style.transform = 'translateX(0px)';
                    overlay.classList.remove('active');
                    overlay.classList.add('hidden');
                } else {
                    sidebar.style.transform = 'translateX(-100%)';
                }
            }
            
            window.addEventListener('resize', handleResize);
            handleResize(); // Initial call
        });
    </script>
</body>
</html>
