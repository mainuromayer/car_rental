<aside id="sidebar" class="fixed top-0 left-0 w-64 min-h-screen bg-white overflow-hidden shadow-sm sm:rounded-lg transform -translate-x-full transition-transform duration-300 md:translate-x-0 md:relative">
    <!-- Sidebar Header -->
    <div class="p-4 text-xl font-bold bg-white border-gray-100">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center ">
                            <a href="{{ route('dashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        </div>
                        <button id="sidebar-close" class="md:hidden float-right text-2xl">&times;</button>
                        </div>

                        <!-- Sidebar Navigation -->
                        <nav class="bg-white">
                            <div class="py-2.5 px-4">
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            </div>
                            <div class="py-2.5 px-4">
                                <x-nav-link :href="route('customer.index')" :active="request()->routeIs('customer.index')">
                                    {{ __('Customer') }}
                                </x-nav-link>
                            </div>
                            <div class="py-2.5 px-4">
                                <x-nav-link :href="route('car.list')" :active="request()->routeIs('car.index')">
                                    {{ __('Car') }}
                                </x-nav-link>
                            </div>
                            <div class="py-2.5 px-4">
                                <x-nav-link :href="route('rental.index')" :active="request()->routeIs('rental.index')">
                                    {{ __('Rental') }}
                                </x-nav-link>
                            </div>
                        </nav>
</aside>

<!-- Sidebar Toggle Button -->
<button id="sidebar-toggle" class="absolute top-4 left-4 p-2 rounded-md md:hidden">
    ☰
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');

        // Open Sidebar
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            sidebarToggle.classList.add('hidden'); // Hide the navicon
        });

        // Close Sidebar
        sidebarClose.addEventListener('click', function() {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            sidebarToggle.classList.remove('hidden'); // Show the navicon
        });
    });
</script>
