<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthPageTest extends DuskTestCase
{
    /**
     * Test the registration functionality.
     *
     * @return void
     */
    public function test_register_functionality()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth') // Truy cập trang Auth
                ->waitForText('Register', 10) // Chờ chữ "Register" xuất hiện
                ->screenshot('before_register_click') // Chụp màn hình trước khi nhấn nút Register
                ->click('button[data-testid="register-button"]') // Nhấn nút Register
                ->pause(2000) // Chờ giao diện chuyển đổi
                ->screenshot('after_register_click') // Chụp màn hình sau khi nhấn nút Register
                ->waitFor('input[placeholder="Name"]', 10) // Chờ form đăng ký hiển thị
                ->type('input[placeholder="Name"]', 'Tuyen') // Nhập tên
                ->type('input[placeholder="Email"]', 'tuyen' . time() . '@example.com') // Nhập email duy nhất
                ->type('input[placeholder="Password"]', '123456789') // Nhập mật khẩu
                ->type('input[placeholder="Confirm Password"]', '123456789') // Nhập lại mật khẩu
                ->press('Register') // Nhấn nút Register
                ->screenshot('after_press_register'); // Chụp màn hình sau khi nhấn nút Register
            // ->pause(5000) // Tăng thời gian chờ để API xử lý và chuyển hướng
            // ->assertPathIs('/') // Kiểm tra đường dẫn chính xác
            // ->assertSee('ChillOut') // Kiểm tra nội dung ChillOut trên MainLayout
            // ->screenshot('register_success'); // Chụp màn hình kết quả thành công
        });
    }


    /**
     * Test registration with mismatched passwords.
     *
     * @return void
     */
    public function test_register_with_mismatched_passwords()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth') // Truy cập trang Auth
                ->waitFor('[data-testid="register-button"]', 10) // Chờ nút "Register" xuất hiện
                ->click('[data-testid="register-button"]') // Nhấn nút "Register"
                ->waitFor('form', 10) // Chờ form đăng ký xuất hiện
                ->type('input[placeholder="Name"]', 'Tuyen') // Nhập tên
                ->type('input[placeholder="Email"]', 'letrungtuyen2002@gmail.com') // Nhập email
                ->type('input[placeholder="Password"]', '123456789') // Nhập mật khẩu
                ->type('input[placeholder="Confirm Password"]', '123123123') // Nhập lại mật khẩu không khớp
                ->press('[data-testid="register-button-submit"]') // Nhấn nút Đăng ký
                ->pause(2000) // Chờ DOM cập nhật
                ->screenshot('debug_after_register') // Chụp DOM sau khi nhấn nút
                ->waitForText('Passwords do not match', 10)  // Chờ thông báo lỗi xuất hiện
                ->assertSee('Passwords do not match') // Kiểm tra thông báo lỗi
                ->screenshot('register_mismatched_passwords'); // Chụp màn hình kết quả
        });
    }

    public function test_login_functionality()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth')
                ->waitFor('[data-testid="login-button"]', 10) // Chờ nút "Login" xuất hiện
                ->click('[data-testid="login-button"]') // Nhấn nút "Login"
                ->waitFor('form', 10) // Chờ form đăng nhập xuất hiện
                ->type('input[placeholder="Email"]', 'god@example.com') // Nhập email hợp lệ
                ->type('input[placeholder="Password"]', '123123123') // Nhập mật khẩu hợp lệ
                ->press('[data-testid="login-button-submit"]') // Nhấn nút Đăng nhập
                ->pause(10000) // Chờ DOM cập nhật
                ->visit('/') // Kiểm tra xem đã chuyển hướng đến trang 
                ->click('li.relative.flex.items-center') // Hover vào menu Account
                ->pause(10000) // Tạm dừng để chờ dropdown hiển thị
                ->screenshot('debug_after_pass_login') // Chụp DOM sau khi nhấn nút
                ->assertSee('My Orders') // Kiểm tra tiêu đề dropdown
                // ->waitForText('Sign out', 20)  // Chờ nút đăng xuất xuất hiện
                // ->assertSee('Sign out') // Kiểm tra nút đăng nhập/đăng ký
                ->screenshot('login_successful'); // Chụp màn hình kết quả
        });
    }

    /**
     * Test login functionality with invalid credentials
     */
    public function test_login_with_invalid_credentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth')
                ->waitFor('[data-testid="login-button"]', 10) // Chờ nút "login" xuất hiện
                ->click('[data-testid="login-button"]') // Nhấn nút "Login"
                ->waitFor('form', 10) // Chờ form đăng ký xuất hiện
                ->type('input[placeholder="Email"]', 'god@gmail.com') // Nhập email 
                ->type('input[placeholder="Password"]', '123456789') // Nhập mật khẩu sai
                ->press('[data-testid="login-button-submit"]') // Nhấn nút Đăng nhập
                ->pause(10000) // Chờ DOM cập nhật
                ->screenshot('debug_after_login') // Chụp DOM sau khi nhấn nút
                ->waitForText('Invalid credentials.', 10)  // Chờ thông báo lỗi xuất hiện
                ->assertSee('Invalid credentials.') // Kiểm tra thông báo lỗi
                ->screenshot('login_invalid_credentials'); // Chụp màn hình kết quả
        });
    }
}
