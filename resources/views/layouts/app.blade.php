 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">

         <!-- CSRF Token -->
         <meta name="csrf-token" content="{{ csrf_token() }}">

         <title>{{ config('app.name', 'Laravel') }}</title>

         <!-- iconos -->
         <link rel="stylesheet" href="{{ asset('dripicons/webfont.css') }}">

         <!-- Styles -->
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

         <script src="{{ asset('js/app.js') }}" defer></script>

         <style>
             *, :after, :before {
                box-sizing: border-box;
            }
         </style>
     </head>
     <body class="h-full bg-gray-200">
         <div class="wrapper flex flex-stretch overflow-hidden w-full relative" id="app">
             <div class="sidebar fixed z-30 left-0 top-0 p-0 h-full overflow-hidden bg-white text-gray-700 shadow-xl" :class="[iconIsExpand ? 'active' : 'w-16']">
                 <ul class="m-0 p-0 list-none font-bold">
                    <li class="block">
                        <a href="{{ route('customers.index') }}" class="block {{ (request()->route()->named('customers.index')) ? 'bg-gray-800 text-white' : 'hover:bg-gray-400 hover:text-gray-900'}} relative whitespace-no-wrap border-b overflow-hidden text-left">
                            <span class="icon-sidebar inline-block w-16 py-3 text-center leading-normal">&nbsp;</span>
                            <span class="inline-block leading-normal text-xl font-bold">
                                {{ config('app.name', 'Laravel') }}
                            </span>
                        </a>
                    </li>
                    <li class="block">
                        <a href="{{ route('home') }}" class="block m-1 rounded {{ (request()->route()->named('home')) ? 'bg-gray-600 text-white' : 'hover:bg-gray-400 hover:text-gray-900'}} relative whitespace-no-wrap border-b overflow-hidden text-left">
                            <span class="icon-sidebar inline-block w-16 py-3 text-center leading-normal dripicons-home"></span>
                            <span class="inline-block leading-normal">
                                @lang('general.menu-home')
                            </span>
                        </a>
                    </li>
                     <li class="block">
                         <a href="{{ route('orders.index') }}" class="block m-1 rounded {{ (request()->route()->named('orders.index')) ? 'bg-gray-600 text-white' : 'hover:bg-gray-400 hover:text-gray-900'}} relative whitespace-no-wrap border-b overflow-hidden text-left ">
                             <span class="icon-sidebar inline-block w-16 py-3 text-center leading-normal dripicons-tags"></span>
                             <span class="inline-block leading-normal">
                                 @lang('general.menu-orders')
                             </span>
                         </a>
                     </li>
                     <li class="block">
                         <a href="{{ route('customers.index') }}" class="block m-1 rounded {{ (request()->route()->named('customers.index')) ? 'bg-gray-600 text-white' : 'hover:bg-gray-400 hover:text-gray-900'}} relative whitespace-no-wrap border-b overflow-hidden text-left">
                             <span class="icon-sidebar inline-block w-16 py-3 text-center leading-normal dripicons-user-group"></span>
                             <span class="inline-block leading-normal">
                                 @lang('general.menu-customers')
                             </span>
                         </a>
                     </li>
                     <li class="block">
                         <a href="{{ route('inventories.index') }}" class="block m-1 rounded {{ (request()->route()->named('inventories.index')) ? 'bg-gray-600 text-white' : 'hover:bg-gray-400 hover:text-gray-900'}} relative whitespace-no-wrap border-b overflow-hidden text-left">
                             <span class="icon-sidebar inline-block w-16 py-3 text-center leading-normal dripicons-archive"></span>
                             <span class="inline-block leading-normal">
                                 @lang('general.menu-inventory')
                             </span>
                         </a>
                     </li>
                 </ul>
             </div>
             <!-- sidebar end -->

             <!-- Content -->
             <div class="main w-full min-h-screen min-w-0 " :class="[iconIsExpand ? 'active-main' : 'pl-16']">
                 <!-- header start -->
                 <nav class="relative flex flex-row flex-no-wrap justify-between py-2 px-4 bg-white shadow">
                    <span class=" self-center sm:invisible visible">
                        <a href="#" class="flex text-gray-800">
                            <i class="fa fa-list" aria-hidden="true"></i>
                        </a>
                    </span>
                    <div id="profilePic" class="cursor-pointer" v-on:click="formLogout = !formLogout">
                        <img src="{{ asset('images/avatar.jpg') }}" class="w-8 rounded-full inline-block" />
                        <span class=" inline-block pt-2">{{ Auth::user()->name }}</span>
                        <span class="text-sm inline-block pt-2 dripicons-chevron-down"></span>
                    </div>
                    <template v-if="formLogout">
                        <transition enter-active-class="transition duration-300 ease-out transform" enter-class="-translate-y-3 scale-95 opacity-0" enter-to-class="translate-y-0 scale-100 opacity-100" leave-active-class="transition duration-150 ease-in transform" leave-class="translate-y-0 opacity-100" leave-to-class="-translate-y-3 opacity-0">
                            <div v-on:mouseleave="formLogout = false" class="absolute w-64 options z-40" style="top: 60px; right: 5px">
                                <div class="relative py-1 bg-white rounded shadow-lg">
                                <div class="relative text-center p-2">
                                    <a href="#" class="mt-2 block w-full bg-red-500 text-white rounded px-4 py-2 font-medium whitespace-no-wrap hover:bg-red-400 focus:outline-none focus:text-white focus:shadow-outline transition duration-300 ease-in-out">
                                        <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesión
                                    </a>
                                </div>
                                </div>
                            </div>
                        </transition>
                    </template>

                 </nav>
                 <!--header end-->
                 <main class="block mt-12">
                     <div class="container mx-auto px-4 mb-6 py-0 relative">
                        <header>
                            @yield('header-content')
                        </header>
                        <div class="content-main mt-8 text-sm">
                            @yield('content')
                        </div>
                    </div>
                 </main>
             </div>
             <!-- content end -->
         </div>
     </body>
 </html>
