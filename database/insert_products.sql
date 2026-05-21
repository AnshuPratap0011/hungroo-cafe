USE boba_hungroo;

/* =========================================================
INSERT CATEGORIES
========================================================= */

INSERT INTO categories (

    name,
    slug,
    image

)

VALUES

(
    'Burger',
    'burger',
    'assets/images/categories/burger.jpg'
),

(
    'Pizza',
    'pizza',
    'assets/images/categories/pizza.jpg'
),

(
    'Drinks',
    'drinks',
    'assets/images/categories/drinks.jpg'
),

(
    'Dessert',
    'dessert',
    'assets/images/categories/dessert.jpg'
),

(
    'Pasta',
    'pasta',
    'assets/images/categories/pasta.jpg'
),

(
    'Snacks',
    'snacks',
    'assets/images/categories/snacks.jpg'
);

/* =========================================================
INSERT PRODUCTS
========================================================= */

INSERT INTO products (

    name,
    slug,
    description,
    short_description,
    category,
    price,
    old_price,
    image,
    image_2,
    image_3,
    tag,
    rating,
    total_reviews,
    stock,
    is_featured,
    is_popular,
    status

)

VALUES

/* =====================================================
BURGER
===================================================== */

(
    'Cheese Burger',

    'cheese-burger',

    'Premium grilled cheese burger with fresh lettuce, sauces and crispy bun.',

    'Premium handcrafted burger.',

    'Burger',

    349,

    399,

    'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1550547660-d9450f859349?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1571091718767-18b5b1457add?q=80&w=1400&auto=format&fit=crop',

    'Best Seller',

    4.9,

    320,

    100,

    1,

    1,

    'active'
),

/* =====================================================
PIZZA
===================================================== */

(
    'Italian Pizza',

    'italian-pizza',

    'Cheesy premium pizza with authentic Italian flavour.',

    'Cheesy authentic pizza.',

    'Pizza',

    599,

    699,

    'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1541745537411-b8046dc6d66c?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1604382355076-af4b0eb60143?q=80&w=1400&auto=format&fit=crop',

    'Hot',

    4.8,

    210,

    80,

    1,

    1,

    'active'
),

/* =====================================================
COFFEE
===================================================== */

(
    'Cold Coffee',

    'cold-coffee',

    'Luxury creamy cold coffee with premium beans and chocolate.',

    'Refreshing cold coffee.',

    'Drinks',

    229,

    279,

    'https://images.unsplash.com/photo-1517701604599-bb29b565090c?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1400&auto=format&fit=crop',

    'Popular',

    4.9,

    412,

    150,

    1,

    1,

    'active'
),

/* =====================================================
DESSERT
===================================================== */

(
    'Chocolate Dessert',

    'chocolate-dessert',

    'Rich chocolate dessert topped with premium cream and chocolate syrup.',

    'Luxury sweet dessert.',

    'Dessert',

    279,

    329,

    'https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1488477181946-6428a0291777?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1563805042-7684c019e1cb?q=80&w=1400&auto=format&fit=crop',

    'Sweet',

    4.7,

    172,

    60,

    1,

    0,

    'active'
),

/* =====================================================
PASTA
===================================================== */

(
    'Chicken Pasta',

    'chicken-pasta',

    'Creamy chicken pasta with authentic Italian herbs and cheese.',

    'Creamy pasta bowl.',

    'Pasta',

    449,

    499,

    'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1555949258-eb67b1ef0ceb?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?q=80&w=1400&auto=format&fit=crop',

    'Chef Choice',

    4.8,

    144,

    70,

    1,

    1,

    'active'
),

/* =====================================================
FRIES
===================================================== */

(
    'French Fries',

    'french-fries',

    'Crispy golden fries with delicious seasoning and dips.',

    'Crispy potato fries.',

    'Snacks',

    199,

    249,

    'https://images.unsplash.com/photo-1576107232684-1279f390859f?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1585109649139-366815a0d713?q=80&w=1400&auto=format&fit=crop',

    'Crispy',

    4.6,

    88,

    90,

    0,

    1,

    'active'
),

/* =====================================================
MOJITO
===================================================== */

(
    'Mint Mojito',

    'mint-mojito',

    'Fresh mint mojito with ice cubes and refreshing flavour.',

    'Fresh mint drink.',

    'Drinks',

    189,

    239,

    'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1544145945-f90425340c7e?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1621263764928-df1444c5e859?q=80&w=1400&auto=format&fit=crop',

    'Fresh',

    4.8,

    101,

    120,

    0,

    1,

    'active'
),

/* =====================================================
SANDWICH
===================================================== */

(
    'Club Sandwich',

    'club-sandwich',

    'Triple layered sandwich with premium veggies and cheese.',

    'Loaded sandwich.',

    'Snacks',

    259,

    299,

    'https://images.unsplash.com/photo-1528735602780-2552fd46c7af?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1539252554453-80ab65ce3586?q=80&w=1400&auto=format&fit=crop',

    'https://images.unsplash.com/photo-1509722747041-616f39b57569?q=80&w=1400&auto=format&fit=crop',

    'Tasty',

    4.7,

    92,

    100,

    0,

    1,

    'active'
);