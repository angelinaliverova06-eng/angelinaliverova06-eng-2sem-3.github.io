<?php
require_once 'includes/config.php';

// Получаем список языков для формы
$stmt = $pdo->query("SELECT id, name FROM languages ORDER BY name");
$languages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 3 — Анкета</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .form-group { margin-bottom: 20px; }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #667eea;
        }
        .radio-group {
            display: flex;
            gap: 20px;
        }
        .radio-group label { display: inline; margin-left: 5px; }
        select[multiple] { height: 150px; }
        textarea { resize: vertical; min-height: 100px; }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .checkbox-group input { width: auto; }
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover { opacity: 0.9; }
        .error {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #c33;
        }
        .success {
            background: #efe;
            color: #3c3;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #3c3;
        }
        .help-text {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Анкета</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="success">✅ Данные успешно сохранены!</div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="error">❌ Ошибка: <?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <form action="process.php" method="POST">
        <div class="form-group">
            <label for="full_name">ФИО *</label>
            <input type="text" id="full_name" name="full_name" required
                   pattern="[A-Za-zА-Яа-я\s]{2,150}"
                   title="Только буквы и пробелы, от 2 до 150 символов">
        </div>

        <div class="form-group">
            <label for="phone">Телефон *</label>
            <input type="tel" id="phone" name="phone" required
                   pattern="\+?[0-9\s\-\(\)]{10,20}"
                   title="Введите корректный номер телефона">
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required maxlength="100">
        </div>
<div class="form-group">
            <label for="birth_date">Дата рождения *</label>
            <input type="date" id="birth_date" name="birth_date" required
                   max="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="form-group">
            <label>Пол *</label>
            <div class="radio-group">
                <input type="radio" id="gender_male" name="gender" value="male" required>
                <label for="gender_male">Мужской</label>
                <input type="radio" id="gender_female" name="gender" value="female">
                <label for="gender_female">Женский</label>
                <input type="radio" id="gender_other" name="gender" value="other">
                <label for="gender_other">Другой</label>
            </div>
        </div>

        <div class="form-group">
            <label for="languages">Любимые языки программирования *</label>
            <select name="languages[]" id="languages" multiple required>
                <?php foreach ($languages as $lang): ?>
                    <option value="<?php echo $lang['id']; ?>">
                        <?php echo htmlspecialchars($lang['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="help-text">Выберите один или несколько (Ctrl/Cmd + клик)</div>
        </div>

        <div class="form-group">
            <label for="bio">Биография *</label>
            <textarea id="bio" name="bio" required maxlength="5000"></textarea>
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" id="contract" name="contract" required>
            <label for="contract">Я ознакомлен(а) с контрактом *</label>
        </div>

        <button type="submit">Сохранить</button>
    </form>
</div>
</body>
</html>
