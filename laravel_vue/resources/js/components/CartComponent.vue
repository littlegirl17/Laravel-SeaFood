
<template>
    <div>
        <h2>Shopping Cart</h2>
        <div v-if="cart.length">
            <ul>
                <li v-for="item in cart" :key="item.id">
                    {{ item.name }} - {{ item.quantity }}
                    <button @click="removeFromCart(item.id)">Remove</button>
                </li>
            </ul>
        </div>
        <div v-else>
            <p>Your cart is empty.</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            cart: []
        };
    },
    created() {
        this.getCart();
    },
    methods: {
        getCart() {
            axios.get('/api/cart')
                .then(response => {
                    this.cart = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        removeFromCart(id) {
            axios.post('/api/cart/remove', { id: id })
                .then(response => {
                    this.getCart();
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>
