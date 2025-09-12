<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course - Learning Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--content-bg);
            margin: 0;
            padding: 0;
            transition: background-color var(--transition-time), color var(--transition-time);
            color: var(--topbar-text);
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            transition: all var(--transition-time);
            position: fixed;
            height: 100vh;
            z-index: 100;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-close {
            display: none;
            background: none;
            border: none;
            color: var(--sidebar-text);
            cursor: pointer;
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        /* Topbar Styles */
        .topbar {
            background-color: var(--topbar-bg);
            color: var(--topbar-text);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 90;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: background-color var(--transition-time), color var(--transition-time);
        }

        .main-content {
            flex: 1;
            margin-left: 260px;
            transition: margin-left var(--transition-time);
        }

        .content-wrapper {
            padding: 20px;
        }

        /* macOS window styles */
        .mac-window {
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            background-color: var(--module-bg);
            transition: background-color var(--transition-time);
        }

        .mac-titlebar {
            background: linear-gradient(to bottom, #e8e8e8, #d0d0d0);
            height: 38px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            display: flex;
            align-items: center;
            padding: 0 16px;
            border-bottom: 1px solid #b0b0b0;
        }

        .mac-buttons {
            display: flex;
            gap: 8px;
        }

        .mac-btn {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: bold;
            cursor: default;
        }

        .mac-close {
            background-color: var(--mac-red);
            color: var(--mac-red);
        }

        .mac-minimize {
            background-color: var(--mac-yellow);
            color: var(--mac-yellow);
        }

        .mac-maximize {
            background-color: var(--mac-green);
            color: var(--mac-green);
        }

        /* Module and content styles */
        .module {
            background-color: var(--module-bg);
            border: 1px solid var(--module-border);
            border-radius: 8px;
            padding: 0;
            margin-bottom: 16px;
            position: relative;
            transition: background-color var(--transition-time), border-color var(--transition-time);
            overflow: hidden;
        }

        .module-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid var(--module-border);
        }

        .module-title-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .module-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .accordion-arrow {
            transition: transform 0.3s ease;
        }

        .module.open .accordion-arrow {
            transform: rotate(180deg);
        }

        .btn-remove {
            background-color: var(--mac-red);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            padding: 0;
        }

        .btn-remove:hover {
            background-color: #e04545;
        }

        .btn-remove::after {
            content: "×";
            margin-top: -1px;
        }

        .module-content {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .module.open .module-content {
            max-height: 2000px;
            padding: 16px;
        }

        .module-title-input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--module-border);
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .module-title-input:focus {
            outline: none;
            border-color: var(--focus-ring);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .content-item {
            position: relative;
            padding: 15px;
            border: 1px solid var(--module-border);
            border-radius: 8px;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.5);
            transition: all var(--transition-time);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 8px 0;
        }

        .content-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .content-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .content-remove {
            background-color: var(--mac-red);
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            padding: 0;
        }

        .content-remove::after {
            content: "×";
            margin-top: -1px;
        }

        .content-body {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .content-item.open .content-body {
            max-height: 500px;
            padding: 16px 0 0 0;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            ring: 2px;
            ring-color: var(--focus-ring);
            border-color: var(--focus-ring);
        }

        .btn-primary {
            background-color: var(--button-primary);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: var(--button-hover);
        }

        .btn-add {
            background-color: #10b981;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-add:hover {
            background-color: #059669;
        }

        /* Theme switcher */
        .theme-switcher {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .theme-btn {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: transform 0.2s, border-color 0.3s;
        }

        .theme-btn:hover {
            transform: scale(1.1);
        }

        .theme-btn.active {
            border-color: var(--button-primary);
            transform: scale(1.15);
        }

        .theme-light {
            background: linear-gradient(to right, #f3f4f6, #e5e7eb);
        }

        .theme-dark {
            background: linear-gradient(to right, #374151, #1f2937);
        }

        .theme-rain {
            background: linear-gradient(to right, #e0f2fe, #bae6fd);
            position: relative;
            overflow: hidden;
        }

        /* User menu */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #4f46e5;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            background-color: var(--button-primary);
        }
        .look:hover{
            background-color: var(--button-primary);
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            color: white;
        }
        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--topbar-bg);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
            min-width: 180px;
            z-index: 100;
            display: none;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .user-dropdown.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        .user-dropdown-item {
            padding: 10px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .user-dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .user-dropdown-item i {
            margin-right: 10px;
            width: 18px;
            text-align: center;
        }

        .user-dropdown-item.logout {
            color: #ef4444;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 5px;
        }

        /* Mobile menu toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--topbar-text);
        }

        /* Responsive styles */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .sidebar-close {
                display: block;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .topbar {
                padding: 15px 20px;
            }

            .content-wrapper {
                padding: 15px;
            }

            .mac-window {
                border-radius: 8px;
            }
        }

        @media (max-width: 640px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .user-menu {
                width: 100%;
                justify-content: space-between;
            }

            .theme-switcher {
                order: 2;
            }

            .content-item .grid {
                grid-template-columns: 1fr !important;
                gap: 10px;
            }

            .btn-primary, .btn-add {
                width: 100%;
                text-align: center;
            }
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Rain animation for rain theme */
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

        /* Form elements */
        input, textarea, select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--module-border);
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--focus-ring);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: var(--topbar-text);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .grid {
            display: grid;
            gap: 16px;
        }

        .grid-cols-1 {
            grid-template-columns: 1fr;
        }

        .grid-cols-2 {
            grid-template-columns: 1fr 1fr;
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Rain effect for rain theme -->
    <div class="rain-effect" id="rainEffect"></div>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2 class="text-xl font-bold">LMS Dashboard</h2>
                <button class="sidebar-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="sidebar-menu">
                <a href="#" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-book-open"></i>
                    <span>Courses</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Students</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-question-circle"></i>
                    <span>Help & Support</span>
                </a>
            </div>
        </div>

        <!-- Mobile overlay -->
        <div class="sidebar-overlay"></div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="flex items-center">
                    <button class="menu-toggle mr-4">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-xl font-semibold">Create New Course</h1>
                </div>
                <div class="user-menu">
                    <div class="theme-switcher">
                        <div class="theme-btn theme-light active" data-theme="light" title="Light theme"></div>
                        <div class="theme-btn theme-dark" data-theme="dark" title="Dark theme"></div>
                        <div class="theme-btn theme-rain" data-theme="rain" title="Rain theme"></div>
                    </div>
                    <div id="userAvatar" class="flex gap-2 look transition-colors">
                        <div class="user-avatar">JD</div>
                        <div class="user-info hidden md:block">
                            <div class="font-medium">John Doe</div>
                            <div class="text-sm">Administrator</div>
                        </div>
                    </div>
                    
                    <!-- User dropdown menu -->
                    <div class="user-dropdown" id="userDropdown">
                        <div class="user-dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </div>
                        <div class="user-dropdown-item">
                            <i class="fas fa-key"></i>
                            <span>Change Password</span>
                        </div>
                        <div class="user-dropdown-item logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content-wrapper">
                <div class="mac-window">
                    <div class="mac-titlebar">
                        <div class="mac-buttons">
                            <div class="mac-btn mac-close">×</div>
                            <div class="mac-btn mac-minimize">−</div>
                            <div class="mac-btn mac-maximize">+</div>
                        </div>
                        <div class="ml-2 text-xs text-gray-700">Create New Course</div>
                    </div>

                    <div class="p-6">
                        <form method="get">
                            <!-- Course Fields -->
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm mb-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Course Details</h2>
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="form-group">
                                        <label for="title">Course Title</label>
                                        <input type="text" name="title" id="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <input type="text" name="category" id="category">
                                    </div>
                                </div>
                            </div>

                            <!-- Modules Section -->
                            <div id="modules" class="bg-gray-50 p-6 rounded-lg shadow-sm mb-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Modules</h2>

                                <!-- Module 1 -->
                                <div class="module open">
                                    <div class="module-header">
                                        <div class="module-title-container">
                                            <i class="fas fa-chevron-down accordion-arrow"></i>
                                            <h3>Module 1</h3>
                                        </div>
                                        <div class="module-actions">
                                            <button type="button" class="btn-remove remove-module"></button>
                                        </div>
                                    </div>
                                    <div class="module-content">
                                        <input type="text" name="modules[0][title]" required placeholder="Module Title" class="module-title-input">
                                        
                                        <div class="contents-container mb-4">
                                            <h3 class="text-lg font-medium text-gray-700 mb-2">Contents</h3>

                                            <!-- Content 1 -->
                                            <div class="content-item open">
                                                <div class="content-header">
                                                    <div class="content-title">
                                                        <i class="fas fa-chevron-down accordion-arrow"></i>
                                                        <h4>Content 1</h4>
                                                    </div>
                                                    <div class="content-actions">
                                                        <button type="button" class="content-remove remove-content"></button>
                                                    </div>
                                                </div>
                                                <div class="content-body">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                                                        <div class="form-group">
                                                            <label>Type</label>
                                                            <select name="modules[0][contents][0][type]" class="content-type">
                                                                <option value="text">Text</option>
                                                                <option value="image">Image</option>
                                                                <option value="video">Video</option>
                                                                <option value="link">Link</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Content</label>
                                                            <textarea name="modules[0][contents][0][content]" class="content-value" rows="1"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="add-content btn-add">Add Content</button>
                                    </div>
                                </div>

                                <button type="button" id="add-module" class="btn-primary">Add Module</button>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-primary">Create Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Create rain drops for rain theme
            function createRainDrops() {
                const rainEffect = $('#rainEffect');
                rainEffect.empty();
                
                for (let i = 0; i < 50; i++) {
                    const left = Math.random() * 100;
                    const delay = Math.random() * 5;
                    const duration = 0.5 + Math.random() * 1.5;
                    const opacity = 0.2 + Math.random() * 0.3;
                    
                    $('<div>')
                        .addClass('rain-drop')
                        .css({
                            left: left + '%',
                            animationDelay: delay + 's',
                            animationDuration: duration + 's',
                            opacity: opacity
                        })
                        .appendTo(rainEffect);
                }
            }
            
            createRainDrops();

            // Toggle accordions
            $('.module-header').click(function() {
                $(this).parent().toggleClass('open');
            });
            
            $('.content-header').click(function(e) {
                // Don't toggle if the click was on a remove button
                if (!$(e.target).hasClass('remove-content') && !$(e.target).parent().hasClass('remove-content')) {
                    $(this).parent().toggleClass('open');
                }
            });

            // Toggle sidebar on mobile
            $('.menu-toggle, .sidebar-overlay, .sidebar-close').click(function() {
                $('.sidebar').toggleClass('open');
                $('.sidebar-overlay').toggleClass('active');
            });

            // Toggle user dropdown
            $('#userAvatar').click(function(e) {
                e.stopPropagation();
                $('#userDropdown').toggleClass('active');
            });

            // Close dropdown when clicking outside
            $(document).click(function() {
                $('#userDropdown').removeClass('active');
            });

            // Theme switching
            $('.theme-btn').click(function() {
                $('.theme-btn').removeClass('active');
                $(this).addClass('active');
                const theme = $(this).data('theme');
                
                // Add transition class for smooth theme change
                $('body').addClass('theme-transitioning');
                
                setTimeout(function() {
                    $('body').attr('data-theme', theme);
                    
                    // Recreate rain drops if rain theme is selected
                    if (theme === 'rain') {
                        createRainDrops();
                    }
                    
                    // Store theme preference
                    localStorage.setItem('theme', theme);
                    
                    // Remove transition class after change is complete
                    setTimeout(function() {
                        $('body').removeClass('theme-transitioning');
                    }, 100);
                }, 200);
            });

            // Load saved theme
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                $('.theme-btn').removeClass('active');
                $(`.theme-btn[data-theme="${savedTheme}"]`).addClass('active');
                $('body').attr('data-theme', savedTheme);
                
                if (savedTheme === 'rain') {
                    createRainDrops();
                }
            }

            // Add module
            $('#add-module').click(function () {
                let $module = $('.module:first').clone();
                let moduleIndex = $('.module').length;

                // Clear values
                $module.find('input.module-title-input').val('');
                $module.find('.content-item').not(':first').remove();
                $module.find('.content-item:first').find('select.content-type').val('text');
                $module.find('.content-item:first').find('.content-value').val('').attr('rows', 1);
                
                // Update module title in header
                $module.find('.module-header h3').text('Module ' + (moduleIndex + 1));
                
                // Update names with new index
                $module.find('input.module-title-input').attr('name', 'modules[' + moduleIndex + '][title]');
                $module.find('.content-item').each(function(index) {
                    $(this).find('select.content-type').attr('name', 'modules[' + moduleIndex + '][contents][' + index + '][type]');
                    $(this).find('.content-value').attr('name', 'modules[' + moduleIndex + '][contents][' + index + '][content]');
                    $(this).find('.content-header h4').text('Content ' + (index + 1));
                });

                // Append
                $('#modules').append($module);
            });

            // Remove module
            $('#modules').on('click', '.remove-module', function (e) {
                e.stopPropagation(); // Prevent triggering accordion toggle
                
                // Don't remove if it's the only module
                if ($('.module').length > 1) {
                    $(this).closest('.module').remove();
                    reindexModules();
                }
            });

            // Add content
            $('#modules').on('click', '.add-content', function () {
                let $module = $(this).closest('.module');
                let moduleIndex = $module.index();
                let $content = $module.find('.content-item:first').clone();
                let contentIndex = $module.find('.content-item').length;
                
                $content.find('select.content-type').val('text');
                $content.find('.content-value').val('').attr('rows', 1);
                
                // Update names with new index
                $content.find('select.content-type').attr('name', 'modules[' + moduleIndex + '][contents][' + contentIndex + '][type]');
                $content.find('.content-value').attr('name', 'modules[' + moduleIndex + '][contents][' + contentIndex + '][content]');
                $content.find('.content-header h4').text('Content ' + (contentIndex + 1));

                $module.find('.contents-container').append($content);
            });

            // Remove content
            $('#modules').on('click', '.remove-content', function (e) {
                e.stopPropagation(); // Prevent triggering accordion toggle
                
                // Don't remove if it's the only content in the module
                if ($(this).closest('.module').find('.content-item').length > 1) {
                    $(this).closest('.content-item').remove();
                    reindexModules();
                }
            });

            // Reindex modules + contents
            function reindexModules() {
                $('#modules .module').each(function (i) {
                    // Update module title in header
                    $(this).find('.module-header h3').text('Module ' + (i + 1));
                    
                    // Module title input
                    $(this).find('input.module-title-input').attr('name', 'modules[' + i + '][title]');

                    // Reindex contents
                    $(this).find('.content-item').each(function (j) {
                        $(this).find('select.content-type').attr('name', 'modules[' + i + '][contents][' + j + '][type]');
                        $(this).find('.content-value').attr('name', 'modules[' + i + '][contents][' + j + '][content]');
                        $(this).find('.content-header h4').text('Content ' + (j + 1));
                    });
                });
            }

            // Change content field type
            $('#modules').on('change', '.content-type', function () {
                let type = $(this).val();
                let $contentValue = $(this).closest('.content-item').find('.content-value');

                if (type === 'text') {
                    if (!$contentValue.is('textarea')) {
                        let value = $contentValue.val();
                        $contentValue.replaceWith(
                            '<textarea class="content-value w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="3">' +
                            value +
                            '</textarea>'
                        );
                    } else {
                        $contentValue.attr('rows', 3);
                    }
                } else {
                    if ($contentValue.is('textarea')) {
                        let value = $contentValue.val();
                        $contentValue.replaceWith(
                            '<input type="text" class="content-value w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="' +
                            value +
                            '">'
                        );
                    }
                }
            });
        });
    </script>
</body>
</html>