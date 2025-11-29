# E-Commerce Theme - Professional Setup

## Overview
This WordPress theme has been transformed into a professional e-commerce platform with support for product variants and a Supabase database backend.

## Features

### 1. Database Schema
- **Products**: Store product information with prices, images, and metadata
- **Product Variants**: Multiple variants per product (Size, Color, etc.)
- **Categories**: Product categorization
- **Orders**: Customer orders and order history
- **Carts**: Shopping cart management
- **Cart Items**: Individual items in carts

### 2. Product Management
- Product listing with grid layout
- Individual product pages with gallery
- Multiple variant selection (size, color, etc.)
- Stock tracking
- Rating and review system
- Discount/sale pricing

### 3. Shopping Features
- Interactive variant selector
- Quantity selector with increment/decrement
- Shopping cart preview
- Order summary with pricing
- Checkout flow

### 4. Templates

#### Front Page
- Hero section with welcome message
- Featured products grid
- Benefits showcase (3 columns)
- Responsive design

#### Single Product
- Product gallery with thumbnail navigation
- Detailed product information
- Multiple variant selection system
- Quantity selector
- Related products section
- Product specifications

#### Shopping Cart
- Cart items list
- Edit quantities
- Remove items
- Order summary with totals
- Checkout button

### 5. Styling
- Professional blue color scheme (#2563EB, #F59E0B)
- Responsive mobile design
- Hover effects and animations
- Clean typography with Montserrat and Rubik fonts
- Product cards with shadow effects
- Smooth transitions

## Database Tables

### categories
- id (UUID)
- name
- slug
- description
- image_url
- created_at

### products
- id (UUID)
- name
- slug
- description
- short_description
- category_id
- base_price
- image_url
- gallery (array)
- is_active
- created_at / updated_at

### product_variants
- id (UUID)
- product_id
- name
- sku
- price
- stock_quantity
- attributes (JSON: size, color, etc.)
- created_at

### carts
- id (UUID)
- user_id
- session_id
- created_at / updated_at

### cart_items
- id (UUID)
- cart_id
- product_id
- variant_id
- quantity
- price
- created_at

### orders
- id (UUID)
- user_id
- order_number
- total_amount
- status
- customer details
- shipping address
- created_at / updated_at

## API Endpoints

### GET /wp-json/wens-track/v1/products
Get all products with pagination

**Parameters:**
- `page` (default: 1)
- `per_page` (default: 12)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Product Name",
      "price": 29.99,
      "image": "url",
      "variants": [],
      "stock": 245
    }
  ]
}
```

### GET /wp-json/wens-track/v1/products/:id
Get single product details

### GET /wp-json/wens-track/v1/cart
Get current user's cart

### POST /wp-json/wens-track/v1/cart
Add item to cart

**Body:**
```json
{
  "product_id": 1,
  "quantity": 1,
  "variant_id": null
}
```

## CSS Classes

### Product Display
- `.product-card` - Product card container
- `.product-price` - Price display
- `.product-old-price` - Strikethrough price
- `.product-badge` - Sale/new badge
- `.product-rating` - Star rating display
- `.product-grid` - Grid layout

### Variants
- `.variant-selector` - Container for variant options
- `.variant-option` - Individual variant option
- `.variant-option.selected` - Selected state

### Cart
- `.quantity-selector` - Quantity control container
- `.quantity-btn` - Plus/minus buttons
- `.quantity-input` - Quantity input field
- `.cart-icon-badge` - Cart item count badge
- `.add-to-cart-btn` - Add to cart button
- `.checkout-btn` - Checkout button

## Getting Started

### 1. Enable the Theme
- Login to WordPress admin
- Go to Appearance > Themes
- Activate the WENS Track theme

### 2. Configure Products
- Add categories via the database
- Create products with variants
- Upload product images

### 3. Customize
- Update company info in header
- Add your logo
- Customize colors via theme.json
- Edit footer content

### 4. Database Connection
The Supabase database is automatically configured via environment variables. Ensure `.env` file contains:
```
SUPABASE_URL=your_url
SUPABASE_ANON_KEY=your_key
SUPABASE_SERVICE_ROLE_KEY=your_role_key
```

## Responsive Design
- Desktop: Full layout with all features
- Tablet (781px-1024px): 2-column product grid
- Mobile (<600px): 1-column product grid, optimized navigation

## Security
- Row Level Security (RLS) enabled on all database tables
- Public read access for products and categories
- Authenticated access for cart and orders
- Proper permission checks on all operations

## Performance
- Database indexes on frequently queried columns
- Optimized image handling
- Lazy loading support
- Responsive images

## Next Steps
1. Add payment gateway integration (Stripe)
2. Implement checkout flow
3. Add customer authentication
4. Configure email notifications
5. Set up inventory management
6. Add admin dashboard
