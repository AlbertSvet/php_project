<?php 

function dump($data): void
{
    echo "<pre>" . print_r($data, 1) . "</pre>";
}

// защита от инъекций 

function h(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES);
}

// Функция регистрации 

function register(array $data): bool
{
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    if ($stmt->fetchColumn()) {
        $_SESSION['errors'] = 'This email is already taken';
        return false;
    }

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    // подготовка запроса
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    // отправка запроса
    $stmt->execute($data);
    $_SESSION['success'] = 'You have successfully registered';
    return true;
}

// редирект 

function redirect(string $url = ''): never
{
    header("Location: {$url}");
    die;
}

// вывод ошибок 
function get_erorrs( array $errors) { 
    $html = '<ul class="list-unstyled">';
    foreach ($errors as $error_group) {
       
        foreach ($error_group as $error) {
            $html .= "<li>{$error}</li>";
           
        }
    }
    $html .= '</ul>';
    return $html;
}

// авторизация login 

function login(array $data): bool
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    if ($row = $stmt->fetch()) {
        if (!password_verify($data['password'], $row['password'])) {
            $_SESSION['errors'] = 'Wrong email or password';
            return false;
        }
    } else {
        $_SESSION['errors'] = 'Wrong email or password';
        return false;
    }

    $_SESSION['user'] = $row;
    
    // foreach ($row as $key => $value) {
    //     if ($key != 'password') {
    //         $_SESSION['user'][$key] = $value;
    //     }
    // }
    $_SESSION['success'] = 'Successfully login';
    return true;
}

// Проверка авторизован ли пользователь 

function check_auth(): bool
{
    return isset($_SESSION['user']);
}
