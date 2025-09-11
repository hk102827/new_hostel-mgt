@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Teachers</h2>
    
        <a href="{{ route('admin.teachers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Add Teacher</a>
      
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CNIC</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($teachers as $t)
                    <tr>
                        <td class="px-6 py-4">{{ $t->name }}</td>
                        <td class="px-6 py-4">{{ $t->phone }}</td>
                        <td class="px-6 py-4">{{ $t->cnic }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.teachers.edit', $t->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.teachers.destroy', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this teacher?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>   
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-6 py-4" colspan="4">No teachers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $teachers->links() }}</div>
</div>

<!-- Popup Modal -->
<div id="noAccessModal" 
     class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div id="noAccessBox" 
         class="bg-white p-6 rounded shadow-lg w-80 text-center">
        <h2 class="text-lg font-bold mb-4 text-red-600">Access Denied</h2>
        <p class="text-gray-700 mb-4">You do not have permission to perform this action.</p>
        <button onclick="closeNoAccessModal()" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            OK
        </button>
    </div>
</div>

<style>
/* Bounce animation */
@keyframes bounceIn {
  0%   { transform: scale(0.7); opacity: 0; }
  50%  { transform: scale(1.1); opacity: 1; }
  70%  { transform: scale(0.9); }
  100% { transform: scale(1); opacity: 1; }
}
.animate-bounce-in {
  animation: bounceIn 0.5s ease-out forwards;
}

/* Smooth fade out when closing */
@keyframes fadeOut {
  from { opacity: 1; transform: scale(1); }
  to   { opacity: 0; transform: scale(0.7); }
}
.animate-fade-out {
  animation: fadeOut 0.4s ease-in forwards;
}
</style>

<script>
    let autoHideTimeout;

    function showNoAccessModal() {
        const modal = document.getElementById('noAccessModal');
        const box = document.getElementById('noAccessBox');
        
        modal.classList.remove('hidden');
        box.classList.remove('animate-fade-out');
        void box.offsetWidth; // reset animation
        box.classList.add('animate-bounce-in');

        // Auto hide after 5 seconds
        clearTimeout(autoHideTimeout);
        autoHideTimeout = setTimeout(() => {
            closeNoAccessModal();
        }, 5000);
    }

    function closeNoAccessModal() {
        const modal = document.getElementById('noAccessModal');
        const box = document.getElementById('noAccessBox');

        // Add fade out animation
        box.classList.remove('animate-bounce-in');
        box.classList.add('animate-fade-out');

        // Wait for animation to finish, then hide
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 400);
        
        clearTimeout(autoHideTimeout); 
    }

    // Attach to all restricted buttons
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.restricted-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault(); 
                showNoAccessModal();
            });
        });
    });
</script>

@endsection