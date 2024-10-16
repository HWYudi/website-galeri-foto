<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <aside id="default-sidebar"
        class="-translate-x-full lg:translate-x-0 duration-200 fixed top-0 left-0 z-40 w-full md:w-64 h-screen bg-[#263544] text-[#CAD2CB]">
        <button onclick="toggleSidebar()" type="button"
            class="absolute right-2 mt-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.41 12L19.71 5.71C19.8983 5.5217 20.0041 5.2663 20.0041 5C20.0041 4.7337 19.8983 4.4783 19.71 4.29C19.5217 4.1017 19.2663 3.99591 19 3.99591C18.7337 3.99591 18.4783 4.1017 18.29 4.29L12 10.59L5.71 4.29C5.5217 4.1017 5.2663 3.99591 5 3.99591C4.7337 3.99591 4.4783 4.1017 4.29 4.29C4.1017 4.4783 3.99591 4.7337 3.99591 5C3.99591 5.2663 4.1017 5.5217 4.29 5.71L10.59 12L4.29 18.29C4.19627 18.383 4.12188 18.4936 4.07111 18.6154C4.02034 18.7373 3.9942 18.868 3.9942 19C3.9942 19.132 4.02034 19.2627 4.07111 19.3846C4.12188 19.5064 4.19627 19.617 4.29 19.71C4.38296 19.8037 4.49356 19.8781 4.61542 19.9289C4.73728 19.9797 4.86799 20.0058 5 20.0058C5.13201 20.0058 5.26272 19.9797 5.38458 19.9289C5.50644 19.8781 5.61704 19.8037 5.71 19.71L12 13.41L18.29 19.71C18.383 19.8037 18.4936 19.8781 18.6154 19.9289C18.7373 19.9797 18.868 20.0058 19 20.0058C19.132 20.0058 19.2627 19.9797 19.3846 19.9289C19.5064 19.8781 19.617 19.8037 19.71 19.71C19.8037 19.617 19.8781 19.5064 19.9289 19.3846C19.9797 19.2627 20.0058 19.132 20.0058 19C20.0058 18.868 19.9797 18.7373 19.9289 18.6154C19.8781 18.4936 19.8037 18.383 19.71 18.29L13.41 12Z"
                    fill="white" />
            </svg>
        </button>
        <div class="flex flex-col overflow-y-auto">
            <div class="py-10 flex flex-col items-center">
                <h1 class="text-xl font-bold">ADMINISITRATOR</h1>
                @if (auth()->check() && !empty(auth()->user()->Image))
                    <img src="{{ asset('storage/' . auth()->user()->Image) }}" alt=""
                        class="w-24 h-24 object-cover rounded-full">
                @else
                    <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png"
                        alt="" class="w-12 h-12 object-cover rounded-full">
                @endif
                <h3 class="pt-2 font-bold text-center">{{ auth()->user()->Username }}</h3>
            </div>
            <div class="px-5">
                <a href="/"
                    class="flex items-center gap-2 py-2 px-1 text-sm hover:text-white hover:bg-[#2424] @if (Route::currentRouteName() == 'home') bg-[#2424] @endif rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-house-door" viewBox="0 0 16 16">
                        <path
                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                    </svg>
                    <span>Home</span></a>
                <p class="p-1 text-xs font-bold">MAIN</p>
                <a href="/admin"
                    class="flex items-center gap-2 py-2 px-1 text-sm hover:text-white hover:bg-[#2424] @if (Route::currentRouteName() == 'dashboard') bg-[#2424] @endif rounded-lg">
                    <svg width="24" height="21" viewBox="0 0 24 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.31 0.775994C11.496 0.598713 11.743 0.499817 12 0.499817C12.2569 0.499817 12.504 0.598713 12.69 0.775994L20.69 8.39462L23.19 10.7745C23.3823 10.9575 23.494 11.2094 23.5005 11.4747C23.5071 11.7401 23.408 11.9972 23.225 12.1894C23.042 12.3817 22.7901 12.4934 22.5247 12.5C22.2594 12.5065 22.0023 12.4074 21.81 12.2244L21 11.4515V18.9991C21 19.5295 20.7893 20.0382 20.4142 20.4132C20.0391 20.7883 19.5304 20.999 19 20.999H4.99999C4.46955 20.999 3.96084 20.7883 3.58577 20.4132C3.2107 20.0382 2.99999 19.5295 2.99999 18.9991V11.4515L2.19001 12.2244C2.00898 12.4157 1.75861 12.5234 1.48523 12.5268C1.21185 12.5303 0.957226 12.4297 0.76841 12.247C0.579594 12.0643 0.470528 11.8149 0.467087 11.5416C0.463647 11.2682 0.566309 11.0136 0.748013 10.8248L3.24801 8.44487L11.31 0.775994ZM3.99999 18.9991C3.99999 19.2348 4.10536 19.4573 4.29289 19.6449C4.48043 19.8324 4.70292 19.9378 4.93868 19.9378H18.999C19.2348 19.9378 19.4573 19.8324 19.6449 19.6449C19.8324 19.4573 19.9378 19.2348 19.9378 18.9991V11.9991H14.25C13.5596 11.9991 12.8905 11.6989 12.4749 11.2833C12.0593 10.8678 11.7591 10.1987 11.7591 9.50828V3.93782L3.99999 11.8643V18.9991ZM13.5 8.49982V9.50828C13.5 9.77471 13.6054 10.0312 13.7929 10.2187C13.9804 10.4062 14.2369 10.5116 14.5033 10.5116H17.5033C17.7698 10.5116 18.0263 10.4062 18.2138 10.2187C18.4014 10.0312 18.5068 9.77471 18.5068 9.50828V8.49982H13.5Z"
                            fill="currentColor" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/foto"
                    class="flex items-center gap-2 py-2 px-1 text-sm hover:text-white hover:bg-[#2424] @if (Route::currentRouteName() == 'data.foto') bg-[#2424] @endif rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-card-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        <path
                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    <span>Data Foto</span>
                </a>

                <a href="/admin/album"
                class="flex items-center gap-2 py-2 px-1 text-sm hover:text-white hover:bg-[#2424] @if (Route::currentRouteName() == 'admin.manage.albums') bg-[#2424] @endif rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-card-image" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                    <path
                        d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                </svg>
                <span>Data Album</span>
            </a>

            </div>
        </div>
    </aside>

    <div class="sm:ml-64 px-4 lg:px-12 min-h-screen lg:pt-20 bg-[#F2F7FB] ">
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
            aria-controls="default-sidebar" onclick="toggleSidebar()" type="button"
            class="inline-flex items-center mt-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-10 h-10" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>
        <div>
            <div class="text-[#686868]">
                <h1 class="font-bold text-xl">Dashboard</h1>
                <p class="text-sm">Welcome {{ auth()->user()->Username }}</p>
            </div>
            {{-- <div class="grid grid-cols-1 lg:grid-cols-4 mt-8 gap-5 text-[#CAD2CB]">
                <div class="bg-[#1F2940] p-4 rounded-lg">
                    <h1 class="text-xl font-bold">User Total</h1>
                    <h1 class="text-xl font-bold">{{ auth()->user()->count() }}</h1>
                </div>
                <div class="bg-[#1F2940] p-4 rounded-lg">
                    <h1 class="text-xl font-bold">Postingan Total</h1>
                    <h1 class="text-xl font-bold">{{ auth()->user()->post()->count() }}</h1>
                </div>
                <div class="bg-[#1F2940] p-4 rounded-lg">
                    <h1 class="text-xl font-bold">Komen Total</h1>
                    <h1 class="text-xl font-bold">{{ auth()->user()->comment()->count() }}</h1>
                </div>
                <div class="bg-[#1F2940] p-4 rounded-lg">
                    <h1 class="text-xl font-bold">Like Total</h1>
                    <h1 class="text-xl font-bold">{{ auth()->user()->like()->count() }}</h1>
                </div>
            </div> --}}
        </div>
        @yield('content')

    </div>

</body>

</html>

<script>
    function toggleSidebar() {
        document.getElementById('default-sidebar').classList.toggle('-translate-x-full');
    }
</script>
