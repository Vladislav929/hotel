<?php
// home.php - Главная страница системы
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotel Admin | Главная</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #8B7257;
            --primary-dark: #6B5A4A;
            --secondary: #2C3E50;
            --light: #F8F5F2;
            --white: #FFFFFF;
            --text: #333333;
            --text-light: #777777;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light);
            color: var(--text);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background-color: var(--white);
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
        }
        
        .nav-links a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 0.5px;
            position: relative;
            padding: 5px 0;
            transition: color 0.3s;
        }
        
        .nav-links a:hover, 
        .nav-links a.active {
            color: var(--primary);
        }
        
        .nav-links a.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary);
        }
        
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
                        url('https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--white);
            padding-top: 80px;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: var(--white);
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid var(--primary);
        }
        
        .btn:hover {
            background-color: transparent;
            color: var(--primary);
        }
        
        .dashboard {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--secondary);
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary);
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .stat-card {
            background-color: var(--white);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        .stat-card h3 {
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }
        
        .stat-card p {
            color: var(--text-light);
        }
        
        footer {
            background-color: var(--secondary);
            color: var(--white);
            padding: 30px 0;
            text-align: center;
        }
        
        footer p {
            opacity: 0.8;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .nav-links {
                gap: 15px;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="home.php" class="logo">LUXURY HOTEL</a>
                <div class="nav-links">
                    <a href="home.php" class="active">Главная</a>
                    <a href="index.php?action=clients">Клиенты</a>
                    <a href="index.php?action=employees">Персонал</a>
                    <a href="index.php?action=rooms">Номера</a>
                    <a href="index.php?action=bookings">Бронирования</a>
                </div>
            </nav>
        </div>
    </header>
    
    <section class="hero">
        <div class="hero-content">
            <h1>Управление отелем премиум-класса</h1>
            <p>Профессиональная система для управления всеми аспектами вашего отельного бизнеса</p>
            <a href="index.php?action=bookings" class="btn">Начать работу</a>
        </div>
    </section>
    
    <section class="dashboard">
        <div class="container">
            <div class="section-title">
                <h2>Панель управления</h2>
            </div>
            
            <div class="stats">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3>1,248</h3>
                    <p>Довольных клиентов</p>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-door-open"></i>
                    <h3>85</h3>
                    <p>Номеров в отеле</p>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3>324</h3>
                    <p>Активных бронирований</p>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-star"></i>
                    <h3>4.9/5</h3>
                    <p>Средний рейтинг</p>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <p>&copy; 2025 Gryazev-Kolcov-M. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>
