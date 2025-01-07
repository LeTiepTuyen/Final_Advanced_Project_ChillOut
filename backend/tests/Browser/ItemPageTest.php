<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ItemPageTest extends DuskTestCase
{
    public function test_item_page_displays_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/item/5')
                ->pause(7000) // Chờ trang tải nội dung
                ->assertSee('40th Hudson St. Lounge Chair') // Kiểm tra tiêu đề sản phẩm
                ->assertSee('Extra 5% off') // Kiểm tra ưu đãi
                ->assertSee('262.74') // Kiểm tra giá sản phẩm (bỏ dấu $ nếu không có)
                ->assertSee('5,213 Reviews') // Kiểm tra đánh giá
                ->assertSee('Free Shipping') // Kiểm tra thông tin vận chuyển
                ->screenshot('item_page_display'); // Chụp màn hình
        });
    }

    public function test_thumbnail_changes_main_image()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/item/5') // Truy cập trang sản phẩm với ID = 5
                ->waitFor('.rounded-md.object-cover.cursor-pointer') // Đợi thumbnail tải đầy đủ
                ->mouseover('.rounded-md.object-cover.cursor-pointer') // Hover vào thumbnail
                ->pause(2000) // Chờ hình ảnh chính thay đổi
                ->assertAttribute('img.rounded-lg', 'src', 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-AI60200402A015_alternate1?$rl_enh_1x1_zoom$') // Kiểm tra src của ảnh chính
                ->screenshot('thumbnail_changes_main_image'); // Chụp màn hình
        });
    }

    // public function test_add_to_cart_updates_cart_count()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $initialCount = 1; // Số lượng ban đầu
    //         $browser->visit('/item/5') // Truy cập trang sản phẩm
    //             ->waitFor('#add-to-cart-button') // Đợi nút Add to Cart xuất hiện
    //             ->assertSeeIn('span.cart-count-badge', $initialCount) // Kiểm tra số lượng ban đầu
    //             ->click('#add-to-cart-button') // Nhấn nút Add to Cart
    //             ->pause(2000) // Chờ DOM cập nhật
    //             ->assertSeeIn('span.cart-count-badge', $initialCount + 1) // Kiểm tra số lượng tăng lên
    //             ->screenshot('cart_count_updated'); // Chụp màn hình kết quả
    //     });
    // }
}
