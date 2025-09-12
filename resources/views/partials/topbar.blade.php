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