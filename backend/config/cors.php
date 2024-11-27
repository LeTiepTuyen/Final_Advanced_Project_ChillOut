<?php

return [
    'paths' => ['*'], // Cho phép tất cả các endpoint
    'allowed_methods' => ['*'], // Cho phép tất cả các phương thức
    'allowed_origins' => ['http://localhost:3000 '], // Cho phép tất cả các nguồn gốc
    'allowed_origins_patterns' => [], // Không sử dụng pattern cụ thể
    'allowed_headers' => ['*'], // Cho phép tất cả các header
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Hỗ trợ cookie-based auth (nếu cần)
];