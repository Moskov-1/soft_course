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