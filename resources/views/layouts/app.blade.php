 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">

         <!-- CSRF Token -->
         <meta name="csrf-token" content="{{ csrf_token() }}">

         <title>{{ config('app.name', 'Laravel') }}</title>

         <!-- iconos -->
         <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

         <!-- Styles -->
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

         <script src="{{ asset('js/app.js') }}" defer></script>

         <style>
             *{
                 box-sizing: border-box;
                 padding: 0;
                 margin: 0;
             }
         </style>
     </head>
     <body class="h-full">
         <div class="wrapper" id="app">
             <div class="flex fixed top-0 left-0 w-full bg-white border-b">
                 <div class="flex-none text-gray-900 text-center bg-gray-500 hover:bg-gray-600 py-2" :class="[iconIsExpand ? 'active' : 'w-16']" v-on:click="iconIsExpand = !iconIsExpand">
                   <a href="#">
                     <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
                   </a>
                 </div>
                 <div class="flex-1 text-gray-700 text-center bg-transparent p-2">
                     <div class="flex justify-end">
                         {{-- <span>{{ Auth::user()->name }}</span> --}}
                         <div id="profilePic">
                            <a href="https://codepen.io/Varo" target="_blank"><img src="{{ asset('images/avatar.jpg') }}" class="w-8 rounded-full" /></a>
                          </div>
                     </div>
                 </div>
             </div>
             <div class="options absolute bg-gray-300 w-64 auto py-2 rounded shadow-lg border" style="top:50px; right:5px">
                <a href="">Cerrar Sesión</a>
              </div>
             <div class="sidebar fixed z-10 left-0 border-r p-0 h-full overflow-hidden bg-gray-800 text-white border border-gray-800" :class="[iconIsExpand ? 'active' : 'w-16']" style="top:50px">
                 <ul class="m-0 p-0 list-none">
                     <li class="block">
                         <a href="#" class="block relative whitespace-no-wrap border-b overflow-hidden text-left">
                             <i class="icon-sidebar inline-block w-16 py-4 text-center leading-normal fa fa-desktop"></i>
                             <span class="inline-block leading-normal">
                                 Dashboard
                             </span>
                         </a>
                     </li>
                     <li class="block">
                         <a href="#" class="block relative whitespace-no-wrap border-b overflow-hidden text-left">
                             <i class="icon-sidebar inline-block w-16 py-4 text-center leading-normal fa fa-server"></i>
                             <span class="inline-block leading-normal">
                                 Pedidos
                             </span>
                         </a>
                     </li>
                     <li class="block">
                         <a href="#" class="block relative whitespace-no-wrap border-b overflow-hidden text-left">
                             <i class="icon-sidebar inline-block w-16 py-4 text-center leading-normal fa fa-calendar"></i>
                             <span class="inline-block leading-normal">
                                 Clientes
                             </span>
                         </a>
                     </li>
                     <li class="block">
                         <a href="#" class="block relative whitespace-no-wrap border-b overflow-hidden text-left">
                             <i class="icon-sidebar inline-block w-16 py-4 text-center leading-normal fa fa-envelope-o"></i>
                             <span class="inline-block leading-normal">
                                 Inventario
                             </span>
                         </a>
                     </li>
                     <li class="block">
                         <a href="#" class="block relative whitespace-no-wrap border-b overflow-hidden text-left">
                             <i class="icon-sidebar inline-block w-16 py-4 text-center leading-normal fa fa-table"></i>
                             <span class="inline-block leading-normal">

                             </span>
                         </a>
                     </li>
                 </ul>
             </div>
             <!-- sidebar end -->

             <!-- Content -->
             <div class="main relative block left-0" :class="[iconIsExpand ? 'active-main' : 'pl-16']" style="top: 50px">
                 <div class="content-main p-2">
                     @yield('content')
                 </div>
             </div>
             <!-- content end -->
         </div>
     </body>
 </html>
