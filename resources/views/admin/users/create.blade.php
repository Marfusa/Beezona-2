<x-app-layout>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <input name="name" placeholder="Name"><br><br>
            <input name="email" placeholder="Email"><br><br>
            <input name="password" type="password" placeholder="Password"><br><br>

            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br><br>

            <button>Add</button>
        </form>
    </div>
</x-app-layout>
