<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    public function run()
    {
        try {
            // Xóa dữ liệu cũ trước khi seeding mới
            Product::truncate();
            ProductImage::truncate();

            // Product data from the seed.js file
            $products = [
                [
                    'title' => "Hudson St. Lounge Chair",
                    'description' => "With sleek contours and triple-band arms, Ralph Lauren’s Hudson St. lounge chair embodies American modernism. Crafted from polished stainless steel, the streamlined frame is balanced with a deep cushioned seat and reclined back.",
                    'short_description' => "Elegant, Comfortable, Stylish",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200402A2310_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 10022,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200402A2310_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200402A2310_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200402A2310_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200402A2310_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200402A2310_alternate5?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Duke Dresser",
                    'description' => "The Duke dresser is inspired by 1930s-era styles and accented with polished stainless steel trim. The classic design features luxurious black glass panels at the top and has four drawers with soft-close glides.",
                    'short_description' => "Modern, Sleek, Ambient",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201336A4184_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 20330,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201336A4184_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201336A4184_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201336A4184_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201336a4184_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201336A4184_lifestyle?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Clivedon Carved Chair",
                    'description' => "Ralph Lauren’s Clivedon chair showcases an exquisitely carved solid wood frame inspired by the ornate style of Louis XVI. It features an upholstered seat and back with exposed arms and is punctuated with gleaming nailhead trim.",
                    'short_description' => "Functional, Adjustable, Contemporary",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200296A1830_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 22850,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200296A1830_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200296A1830_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200296A1830_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200296A1830_alternate5?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200296A1830_alternate6?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Duke Bar Cart",
                    'description' => "Inspired by 1930s-era designs, the Duke bar cart is accented with polished stainless steel trim and features casters for easy movement. Three shelves and an eight-bottle rack provide ample room for glassware and spirits.",
                    'short_description' => "Versatile, Chic, Durable",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028399794176_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 22340,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028399794176_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028399794176_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028399794176_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028399794176_alternate5?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028399794176_alternate6?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "40th Hudson St. Lounge Chair",
                    'description' => "In celebration of the 40th anniversary of Ralph Lauren’s iconic Hudson St. Lounge Chair, this limited edition updates the original’s design with burnished leather—the same leather to upholster the cushioned seat and back—expertly hand-wrapped by our bespoke craftsmen in London over its triple-band steel frame. It’s finished with double topstitching and accented with a commemorative brass plaque at the crossbar.",
                    'short_description' => "Luxurious, Cozy, Inviting",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-AI60200402A015_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 26274,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-AI60200402A015_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-AI60200402A015_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-AI60200402A015_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-AI60200402A015_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-AI60200402A015_alternate8?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Hayles Side Table",
                    'description' => "Solid oak wood provides the foundation of the Hayles side table, which features a glass inset top framed in natural leather with expertly stitched seams. The cross-style base is embellished with a subtle step-down detail that grounds the appearance, allowing for a refined profile.",
                    'short_description' => "Compact, Versatile, Modern",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200745A3194_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 78600,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200745A3194_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200745A3194_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200745A3194_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200745A3194_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200745A3194_lifestyle?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Aran Isles Chair",
                    'description' => "Casual elegance defines the Aran Isles collection, which unites solid wood with supple aniline leather. The chair is classically styled with rolled arms, brass nail-head trim, and front-facing bun feet. Premium spring-down cushions provide the perfect balance of softness and structure to the deep, comfortable seat.",
                    'short_description' => "Comfortable, Modern, Durable",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200261A2213_lifestyle?$rl_enh_1x1_dskt$',
                    'price' => 98200,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200261A2213_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200261A2213_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200261A2213_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200261A2213_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200261A2213_alternate6?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Duke Bar",
                    'description' => "The Duke bar is inspired by 1930s-era styles and accented with polished stainless steel trim. It features a removable top tray, three slender drawers, a flip-down front, and flanking end doors with shelving.",
                    'short_description' => "Stylish, Practical, Elegant",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028446210034_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 13250,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028446210034_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028446210034_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028446210034_alternate8?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028446210034_alternate9?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028446210034_alternate11?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Côte d'Azur Bed",
                    'description' => "Enveloped in supple leather upholstery, the Côte d'Azur bed is framed in solid mahogany wood and elevated upon a sloped base with polished stainless steel accents. Expertly crafted by hand, the modern profile boasts soft contours and generous padding.",
                    'short_description' => "Artistic, Unique, Functional",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200316A1785_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 92400,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200316A1785_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200316A1785_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200316A1785_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200316A1785_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200316A1785_alternate5?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Writer's Chair",
                    'description' => "Emblematic of Ralph Lauren’s iconic and enduring style, this winged club chair is masterfully constructed with hand-done tufting, pleated roll arms, and decorative bun feet crafted from solid maple wood. Upholstered in supple English cowhide, the generous seat is trimmed in oversize brass nail-heads.",
                    'short_description' => "Classic, Sturdy, Elegant",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200391A2299_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 33200,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200391A2299_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200391A2299_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200391A2299_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200391A2299_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200391A2299_alternate5?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Brook Street Tufted Sofa",
                    'description' => "Inspired by the tailored luxury inherent to London’s Savile Row, Ralph Lauren’s Brook Street sofa is upholstered in natural English cowhide, affording a soft hand and refined appearance. Set upon turned beechwood legs with front-facing casters, the elegant profile showcases a tufted back, scrolling arms, and gleaming nail-head trim.",
                    'short_description' => "Chic, Functional, Sturdy",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200330A2471_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 71200,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200330A2471_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200330A2471_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200330A2471_alternate5?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200330A2471_alternate6?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200330A2471_alternate7?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Brook Street Desk",
                    'description' => "Inspired by the tailored luxury inherent to London’s Savile Row, Ralph Lauren’s interpretation of the Napoleon III desk is crafted from solid mahogany wood with a hand-applied finish. Five slender drawers and two pull-out writing shelves are set beneath the elegant buffalo leather top, which features masterfully hand-tooled silver leafing.",
                    'short_description' => "Mobile, Stylish, Functional",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028398140189_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 61220,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028398140189_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028398140189_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028398140189_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028398140189_alternate5?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028398140189_alternate6?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Beekman Cocktail Table",
                    'description' => "The elegant silhouette of Ralph Lauren’s Beekman cocktail table is enhanced by artful hand-carved details, including an inset border motif and an intricate, lacelike apron. Set upon sculptural legs, the solid mahogany wood frame showcases a swirled grain with rich highs and lows throughout.",
                    'short_description' => "Modern, Sleek, Functional",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028397950126_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 21300,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028397950126_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028397950126_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028397950126_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028397950126_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028397950126_alternate5?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Shotwell Dresser",
                    'description' => "This campaign-style dresser merges striking design and exquisite craftsmanship, with hand-carved details and solid brass inlay complementing the rich mahogany grain. Set upon a decorative base, the four-drawer silhouette features hand-cast hardware and recessed pulls.",
                    'short_description' => 'Compact, Versatile, Modern',
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200431A2480_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 41200,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200431A2480_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200431A2480_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200431A2480_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200431A2480_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200431A2480_alternate5?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Mayfair Scroll Console Table",
                    'description' => "Ralph Lauren’s Mayfair collection is inspired by the elegance of Mediterranean design with a hint of Old Hollywood glamour. Impeccably crafted from solid mahogany wood with a rich swirled grain, the console table is set upon a stepped platform base and showcases dual scrolling legs with intricate carvings done by hand.",
                    'short_description' => "Classic, Sturdy, Elegant",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028460290035_lifestyle?$rl_enh_1x1_dskt$',
                    'price' => 33200,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028460290035_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028460290035_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028460290035_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028460290035_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-6028460290035_alternate5?$rl_enh_1x1_zoom$',
                    ],
                ],
                [
                    'title' => "Holloway Bed",
                    'description' => "Ralph Lauren’s Holloway bed reimagines the classic sleigh bed with a wraparound silhouette and a beautifully sloped back. Crafted from solid wood with olive ash burl wood veneers, the enveloping headboard and footboard are accented with hand-carved rosettes, while the side rails feature raised arrow detailing.",
                    'short_description' => "Classic, Sturdy, Elegant",
                    'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201010A3695_lifestyle?$rl_enh_1x1_zoom$',
                    'price' => 33200,
                    'images' => [
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201010A3695_alternate1?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201010A3695_alternate2?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201010A3695_alternate3?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201010A3695_alternate4?$rl_enh_1x1_zoom$',
                        'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60201010A3695_alternate5?$rl_enh_1x1_zoom$',
                    ],
                ],
            ];

            // Insert product data
            foreach ($products as $productData) {
                // Validate required fields
                if (
                    !isset($productData['title']) || !isset($productData['description']) ||
                    !isset($productData['short_description']) || !isset($productData['url']) ||
                    !isset($productData['price']) || !isset($productData['images'])
                ) {
                    throw new \Exception('Missing required product data fields');
                }

                // Create product
                $product = Product::create([
                    'title' => $productData['title'],
                    'description' => $productData['description'],
                    'short_description' => $productData['short_description'],
                    'url' => $productData['url'],
                    'price' => $productData['price'],
                ]);

                // Insert product images
                foreach ($productData['images'] as $imageUrl) {
                    if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                        throw new \Exception('Invalid image URL: ' . $imageUrl);
                    }

                    ProductImage::create([
                        'product_id' => $product->id,
                        'url' => $imageUrl,
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error seeding products: ' . $e->getMessage());
            throw $e;
        }
    }
}
