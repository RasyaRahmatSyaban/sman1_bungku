<x-auth-layout title="Login" section_title="Welcome Back" section_description="Login with your account">
    @if (session('success'))
        <div class="bg-green-50 border border-green-500 text-green-500 px-3 py-2">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('auth.authenticate') }}" method="POST" class="flex flex-col gap-4 mt-2">
        @csrf
        @method("POST")
        @error('username')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div class="flex flex-col gap-2">
            <label for="username" class="font-semibold text-sm">Username</label>
            <input type="username" id="username" name="username" class="px-3 py-2 border border-zinc-300 bg-slate-50"
                placeholder="Your username" value="{{ old('username') }}" />
        </div>
        <div class="flex flex-col gap-2">
            <label for="password" class="font-semibold text-sm">Password</label>
            <input type="password" id="password" name="password"
                class="px-3 py-2 border border-zinc-300 bg-slate-50" placeholder="Your Password" value="{{ old('password') }}" />
        </div>
        <button type="submit" class="bg-blue-500 border text-white px-3 py-2 text-center gap-2 cursor-pointer mt-4">
            <span>Login</span>
        </button>
        <p class="text-zinc-600 text-sm text-center">
            Dont have an account?
        </p>
        <p class="text-zinc-600 text-sm text-center">
            Hubungi Wali Kelas Anda
        </p>
    </form>
</x-auth-layout>
