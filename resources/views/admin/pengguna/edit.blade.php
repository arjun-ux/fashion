@extends('components.admin-app')

@section('content')
<div class="py-12 bg-[#1A1A1A] min-h-screen w-full" style="background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)), url('/images/bg-pattern.png')">
    <div class="max-w-2xl mx-auto px-4">
        <div class="backdrop-blur-sm bg-[#1A1A1A]/80 overflow-hidden shadow-2xl rounded-lg border border-[#DAA520]/30">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-[#DAA520] mb-6">Edit User</h2>

                @if ($errors->any())
                <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full rounded-lg border border-[#DAA520]/20 bg-gray-800/50 px-4 py-2 focus:outline-none focus:border-[#DAA520] text-gray-200" 
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full rounded-lg border border-[#DAA520]/20 bg-gray-800/50 px-4 py-2 focus:outline-none focus:border-[#DAA520] text-gray-200" 
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">User Type</label>
                            <select name="usertype" 
                                    class="w-full rounded-lg border border-[#DAA520]/20 bg-gray-800/50 px-4 py-2 focus:outline-none focus:border-[#DAA520] text-gray-200">
                                <option value="kasir" {{ $user->usertype == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="owner" {{ $user->usertype == 'owner' ? 'selected' : '' }}>Owner</option>
                                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">New Password (leave blank to keep current)</label>
                            <input type="password" 
                                   name="password" 
                                   class="w-full rounded-lg border border-[#DAA520]/20 bg-gray-800/50 px-4 py-2 focus:outline-none focus:border-[#DAA520] text-gray-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Confirm New Password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="w-full rounded-lg border border-[#DAA520]/20 bg-gray-800/50 px-4 py-2 focus:outline-none focus:border-[#DAA520] text-gray-200">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-4">
                        <a href="{{ route('admin.pengguna.index') }}" 
                           class="px-6 py-2 bg-gray-700/50 hover:bg-gray-700/70 rounded-lg transition-colors text-gray-300">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="glow-effect px-6 py-2 bg-[#DAA520]/20 hover:bg-[#DAA520]/30 border border-[#DAA520]/50 rounded-lg transition-all duration-300 text-[#DAA520]">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes glow {
    0% { box-shadow: 0 0 5px #DAA520, 0 0 10px #DAA520, 0 0 15px #DAA520; }
    100% { box-shadow: 0 0 10px #DAA520, 0 0 20px #DAA520, 0 0 30px #DAA520; }
}

.glow-effect:hover {
    animation: glow 1.5s infinite alternate;
}
</style>
@endsection