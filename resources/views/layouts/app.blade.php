@extends('layouts.base')

@section('app')
    <!-- Rain Effect -->
    <div class="rain-effect"></div>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="toggleSidebar()"></div>

    <div class="dashboard-container flex min-h-screen">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="main-content flex-1 transition-all duration-400 lg:ml-64" id="mainContent">
            <!-- Topbar -->
            @include('partials.topbar')

            <!-- Content Wrapper -->
            <div class="content-wrapper p-5 lg:p-8">
                @yield('content')
            </div>
        </div>
    </div>

    
@endsection
@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    
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
@endpush
@push('scripts')
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
<script>
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
@endpush