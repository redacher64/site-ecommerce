document.addEventListener('DOMContentLoaded', function() {
    initCart();
    initVariantSelectors();
    initQuantitySelectors();
});

function initCart() {
    const cartButtons = document.querySelectorAll('.add-to-cart-btn');
    cartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });
}

function initVariantSelectors() {
    const variants = document.querySelectorAll('.variant-option');
    variants.forEach(variant => {
        variant.addEventListener('click', function() {
            const container = this.parentElement;
            container.querySelectorAll('.variant-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            this.classList.add('selected');
        });
    });
}

function initQuantitySelectors() {
    const quantityButtons = document.querySelectorAll('.quantity-btn');
    quantityButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            if (this.textContent === '+') {
                input.value = parseInt(input.value) + 1;
            } else if (this.textContent === '-' && input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
    });
}

function addToCart(event) {
    event.preventDefault();

    const productName = document.querySelector('h1')?.textContent || 'Product';
    const price = document.querySelector('.product-price')?.textContent || '$0.00';
    const quantity = document.querySelector('.quantity-input')?.value || 1;

    const selectedSize = document.querySelector('.variant-selector')?.querySelector('.variant-option.selected')?.textContent || '';
    const selectedColor = document.querySelectorAll('.variant-selector')[1]?.querySelector('.variant-option.selected')?.textContent || '';

    console.log('Product added:', {
        name: productName,
        price: price,
        quantity: quantity,
        size: selectedSize,
        color: selectedColor
    });

    alert('Product added to cart!');
}

function updateCart() {
    fetch(`${wpApiSettings.root}wens-track/v1/cart`)
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.cart-icon-badge');
            if (badge && data.count) {
                badge.textContent = data.count;
            }
        });
}
