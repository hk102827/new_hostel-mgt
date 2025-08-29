{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Hostel Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Print optimizations so only main content prints */
        @media print {
            .no-print { display: none !important; }
            .ml-64 { margin-left: 0 !important; }
            body { background: #fff !important; }
            main { padding: 0 !important; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
       <div class="w-64 bg-gray-800 text-white fixed inset-y-0 left-0 flex flex-col justify-between no-print">
        <div>
            <div class="p-4">
                <h2 class="text-xl font-bold">Hostel Admin</h2>
            </div>
            
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                
                <a href="{{ route('admin.students.index') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.students.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-users mr-3"></i> Hostel Students
                </a>
                
                <a href="{{ route('admin.rooms.index') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.rooms.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-bed mr-3"></i> Room Management
                </a>
                
                <a href="{{ route('admin.academy.index') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.academy.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-book mr-3"></i> Japanese Academy
                </a>
                
                <a href="{{ route('admin.mess.index') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.mess.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-utensils mr-3"></i> Mess Management
                </a>

                <a href="{{ route('admin.kitchen.index') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.kitchen.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-carrot mr-3"></i> Kitchen Management
                </a>
                
                <a href="{{ route('admin.fees.index') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.fees.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-money-bill mr-3"></i> Fee Management
                </a>
                
                <a href="{{ route('admin.reports.index') }}" 
                   class="flex items-center px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.reports.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-chart-bar mr-3"></i> Reports
                </a>
            </nav>
        </div>
            <!-- Logout Button -->
    <div class="p-4 border-t border-gray-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                class="flex items-center w-full px-4 py-2 text-left hover:bg-gray-700 text-red-400">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </button>
        </form>
    </div>

        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b px-6 py-4 no-print">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('page-title')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 no-print">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 no-print">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>