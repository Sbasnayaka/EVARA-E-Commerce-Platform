document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');
    document.getElementById('checkoutBtn').addEventListener('click', handleCheckout);
    loadCart();
});

function loadCart() {
    console.log('Loading cart');
    fetch('cart.php?action=load')
    .then(response => response.json())
    .then(data => {
        console.log('Cart data:', data);
        const cartSection = document.querySelector('.cart');
        cartSection.innerHTML = '';

        let totalAmount = 0;

        Object.keys(data).forEach(id => {
            const item = data[id];
            totalAmount += item.quantity * item.price;

            const cartItem = document.createElement('tr');
            cartItem.classList.add('cart-item');
            cartItem.dataset.id = id;
            cartItem.innerHTML = `
            
                        <td><img src="pics/${item.image}" alt="${item.name}" class="cart-image"   /></td>
                        <td class="item-name" >${item.name}</td>
                        <td class="item-description">${item.description}</td>
                        <td class="item-price"> Rs ${item.price}</td>
                        <td class="item-quantity"><input type="number" min="1" value="${item.quantity}" onchange="updateQuantity('${id}', this.value)" /></td>
                        <td><button class="remove-from-cart" onclick="removeFromCart('${id}')">Remove</button></td>
            `;
            cartSection.appendChild(cartItem);
        });

        document.getElementById('totalAmount').textContent = `Rs ${totalAmount}`;
    })
    .catch(error => console.error('Error:', error));
}

function updateQuantity(id, quantity) {
    console.log(`Updating item ${id} to quantity ${quantity}`);
    fetch(`cart.php?action=update&id=${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ quantity })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response from cart.php after update:', data);
        loadCart();
    })
    .catch(error => console.error('Error:', error));
}

function removeFromCart(id) {
    console.log(`Removing item ${id} from cart`);
    fetch(`cart.php?action=remove&id=${id}`)
    .then(response => response.json())
    .then(data => {
        console.log('Response from cart.php after remove:', data);
        loadCart();
    })
    .catch(error => console.error('Error:', error));
}

function handleCheckout(event) {
    event.preventDefault();

    const orderForm = document.getElementById('orderForm');
    const formData = new FormData(orderForm);

    console.log('Submitting order form');
    
    fetch('cart.php?action=placeOrder', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response from cart.php after checkout:', data);
        if (data.success) {
            alert('Order placed successfully!');
            window.location.reload();
        } else {
            alert('Failed to place order. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error submitting order:', error);
        alert('An error occurred while placing your order.');
    });
}
