@extends('admin.layout')

@section('content')
<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2>Користувачі</h2>
        <a href="#" class="btn btn-primary">➕ Додати користувача</a>
    </div>

    <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr style="background:#eee;">
                <th>ID</th>
                <th>Ім'я</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span style="{{ $user->role == 'admin' ? 'color:red; font-weight:bold;' : '' }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td>
                    <a href="#">Ред.</a> | 
                    <a href="#" style="color:red;">Видалити</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection