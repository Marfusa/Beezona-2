<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Адмін-панель - Beezona</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; margin: 0; background: #f3f4f6; display: flex; height: 100vh; overflow: hidden; }
        
        /* SIDEBAR (Ліве меню) */
        .sidebar {
            width: 260px;
            background: #1e293b; /* Темно-синій */
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar h2 { font-size: 20px; margin-bottom: 40px; color: #FF9900; display: flex; align-items: center; gap: 10px; }
        
        .menu { list-style: none; padding: 0; }
        .menu li { margin-bottom: 10px; }
        .menu a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
            font-weight: 500;
        }
        .menu a:hover, .menu a.active {
            background: #334155;
            color: #fff;
            transform: translateX(5px);
        }
        .menu a i { margin-right: 12px; width: 20px; text-align: center; }

        /* Logout Button */
        .logout-btn {
            margin-top: auto; /* Притиснути до низу */
            background: #ef4444;
            color: white !important;
            justify-content: center;
        }
        .logout-btn:hover { background: #dc2626; }

        /* MAIN CONTENT (Права частина) */
        .main-content { flex: 1; padding: 40px; overflow-y: auto; }
        
        /* Заголовки сторінок */
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { margin: 0; font-size: 28px; color: #111827; }
        
        /* Стиль для кнопок */
        .btn { padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 600; display: inline-block; cursor: pointer; border: none; }
        .btn-primary { background: #3b82f6; color: white; }
        .btn-danger { background: #ef4444; color: white; }

        /* ALERT MESSAGES */
        .alert { padding: 15px; background: #d1fae5; color: #065f46; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2><i class="fa-solid fa-bee"></i> Admin Panel</h2>
        
        <ul class="menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i> Головна
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Користувачі
                </a>
            </li>
            <li>
                <a href="#" style="opacity:0.5; cursor:not-allowed;">
                    <i class="fa-solid fa-newspaper"></i> Новини (скоро)
                </a>
            </li>
        </ul>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn logout-btn" style="width:100%; display:flex; align-items:center; gap:10px;">
                <i class="fa-solid fa-right-from-bracket"></i> Вийти
            </button>
        </form>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>