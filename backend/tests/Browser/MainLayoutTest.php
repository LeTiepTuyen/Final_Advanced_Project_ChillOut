<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MainLayoutTest extends DuskTestCase
{
    public function test_main_layout_elements_are_displayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertPresent('#MainLayout') // Kiểm tra layout chính
                ->assertSee('Sell on ShoppingWeb') // Kiểm tra menu trên cùng
                ->assertSee('Cookie Preferences') // Kiểm tra menu Cookie
                ->assertSee('Help') // Kiểm tra menu Help
                ->assertSee('Buyer Protection') // Kiểm tra menu Buyer Protection
                ->assertPresent('button[aria-label="Search"]') // Kiểm tra nút tìm kiếm
                ->assertPresent('img[alt="ShoppingWeb Logo"]') // Kiểm tra logo
                ->screenshot('main_layout_elements'); // Chụp ảnh màn hình
        });
    }

    public function test_account_menu()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->mouseover('li.relative.flex.items-center') // Hover vào menu Account
                ->pause(3000) // Tạm dừng để chờ dropdown hiển thị
                ->assertSee('Welcome to ShoppingWebsite!') // Kiểm tra tiêu đề dropdown
                ->assertSee('Login / Register') // Kiểm tra nút đăng nhập/đăng ký
                ->screenshot('account_menu'); // Chụp ảnh màn hình
        });
    }

    public function test_search_bar()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('input[placeholder="Search for products..."]', 'Chair') // Nhập từ khóa tìm kiếm
                ->press('button[aria-label="Search"]') // Nhấn nút tìm kiếm
                ->pause(3000) // Tạm dừng để kết quả tải về
                ->assertSee('Hudson St. Lounge Chair') // Kiểm tra kết quả tìm kiếm
                ->screenshot('search_results'); // Chụp ảnh màn hình
        });
    }
}
