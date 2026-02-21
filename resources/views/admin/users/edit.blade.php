<x-app-layout>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <input name="name" value="{{ $user->name }}"><br><br>
            <input name="email" value="{{ $user->email }}"><br><br>

            <select name="role">
                <option value="user" @selected($user->role==='user')>User</option>
                <option value="admin" @selected($user->role==='admin')>Admin</option>
            </select><br><br>

            <button>Save</button>
        </form>
    </div>
</x-app-layout>
