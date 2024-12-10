@extends('components.admin-app')

@section('content')
<div class="py-12 min-h-screen w-full relative">
    <div class="absolute inset-0 bg-[#0F172A]/95 z-0"></div>
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/29625971/pexels-photo-29625971.jpeg')] bg-center bg-cover opacity-10"></div>

    <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="bg-red-500/20 border border-red-500/50 text-red-500 px-4 py-3 rounded-lg mb-4 backdrop-blur-sm animate-fade-in">
            {{ session('success') }}
        </div>
        @endif

        <div class="backdrop-blur-md bg-gray-900/80 overflow-hidden shadow-2xl rounded-lg border border-red-500/30">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <h2 class="text-2xl font-bold text-red-500">Manage Users</h2>
                    

                        <a href="{{ route('admin.pengguna.create') }}" 
                           class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-all duration-300 flex items-center gap-2 shadow-lg hover:shadow-red-500/20">
                            <i class="fas fa-plus"></i>
                            <span>Add New User</span>
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-lg border border-red-500/20">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-800/50">
                                <th class="px-6 py-3 text-red-500 font-semibold">Name</th>
                                <th class="px-6 py-3 text-red-500 font-semibold">Email</th>
                                <th class="px-6 py-3 text-red-500 font-semibold">Role</th>
                                <th class="px-6 py-3 text-red-500 font-semibold">Created At</th>
                                <th class="px-6 py-3 text-center text-red-500 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="border-t border-red-500/10 hover:bg-red-500/5 transition-colors">
                                <td class="px-6 py-4 text-gray-200">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-gray-200">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm
                                        @if($user->usertype === 'admin') bg-red-500/20 text-red-500
                                        @elseif($user->usertype === 'owner') bg-red-500/20 text-red-500
                                        @else bg-red-500/20 text-red-500
                                        @endif">
                                        {{ ucfirst($user->usertype) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-200">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.pengguna.edit', $user->id) }}" 
                                           class="p-2 bg-gray-800 hover:bg-red-500/20 rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-red-500/10">
                                            <i class="fas fa-edit text-red-500"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.pengguna.destroy', $user->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this user?');" 
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 bg-gray-800 hover:bg-red-500/20 rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-red-500/10">
                                                <i class="fas fa-trash text-red-500"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes glow {
    0% { box-shadow: 0 0 5px rgb(239 68 68 / 0.2), 0 0 10px rgb(239 68 68 / 0.2); }
    100% { box-shadow: 0 0 10px rgb(239 68 68 / 0.3), 0 0 20px rgb(239 68 68 / 0.3); }
}

.hover\:glow:hover {
    animation: glow 1.5s infinite alternate;
}
</style>
@endsection