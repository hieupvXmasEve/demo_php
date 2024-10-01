<?php

use Core\Response;
use Core\Session;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
function p($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}
function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if ($condition) {
        abort($status);
    }
}

function base_path($path = '')
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    // Hàm extract() được sử dụng để giải nén mảng $attributes thành các biến riêng lẻ.
    // Mỗi khóa trong mảng sẽ trở thành tên của một biến, và giá trị tương ứng sẽ được gán cho biến đó.
    // Điều này cho phép sử dụng các giá trị từ $attributes một cách trực tiếp trong file view,
    // mà không cần phải truy cập thông qua mảng $attributes.
    // Ví dụ: nếu $attributes là ['name' => 'John', 'age' => 30], sau khi gọi extract($attributes),
    // ta có thể sử dụng $name và $age trong file view.
    extract($attributes);

    require base_path("views/{$path}");
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}
function old($key)
{
    return Session::get('old')[$key] ?? null;
}
