<header>
    <a href="/" class="text"><span class="logo">Blog Master</span></a>
    <nav>
        <a href="/" class="text">Головна</a>
        <a href="/contact.php" class="text">Контакти</a>
        <?php if (isset($_COOKIE['login'])) : ?>
            <a href="/add-article.php" class="text">Додати статтю</a>
            <a href="/users.php" class="text">Список користувачів</a>
            <a href="/login.php" class="btn">Кабінет користувача</a>
        <?php else : ?>
            <a href="/login.php" class="btn">Ввійти</a>
            <a href="/register.php" class="btn">Реєстрація</a>
        <?php endif; ?>
    </nav>
</header>