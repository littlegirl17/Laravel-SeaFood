import { createApp } from 'vue';
import AddToCartComponent from './components/AddToCartComponent.vue';


const app = createApp({
    methods: {
        initializeOwlCarousel() {
            this.$nextTick(() => {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 5
                        }
                    }
                });CartComponent
            });
        }
    },
    mounted() {
        this.initializeOwlCarousel();
    },
    updated() {
        this.initializeOwlCarousel();
    }
});

app.component('add-to-cart-component', AddToCartComponent);

app.mount('#mainApp');

