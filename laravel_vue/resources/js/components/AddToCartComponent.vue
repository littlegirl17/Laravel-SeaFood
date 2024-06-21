<!-- component con  ===> resources/js/components/AddToCartComponent.vue -->

<template>
    <div>
        <form @submit.prevent="addToCart">
            <input type="hidden" v-model="id" value="{{ $item->id }}">
            <input type="hidden" v-model="name" value="{{ $item->name }}">
            <input type="hidden" v-model="image" value="{{ $item->image }}">
            <input type="hidden" v-model="price" value="{{ $item->price }}">
            <input type="hidden" v-model="quantity" value="1">
            <!-- <input type="hidden" v-model="userDefault_price_group" value="{{ $userProductDiscountDefault ? $userProductDiscountDefault->price : $item->price}}">
            <input type="hidden" v-model="user_price_group" value="{{ $userProductDiscount ? $userProductDiscount->price : $item->price}}"> -->
            <button class="btnForm" type="submit" onclick="sweetAlertAddCart()"> <i class="fa-solid fa-cart-plus" style="color: #1f508ds;"></i></button>
        </form>
    </div>
</template>

<script>
import axios from 'axios'; // Import thư viện axios để thực hiện các yêu cầu HTTP

export default {
    props: { // nhận dữ liệu từ component ch => khi cpn cha kích hoạt thì prop productData của cpn con nhận dữ liệu từ cha
        productData: Object
    },
    data() {
        return {
            product: {  // product là một đối tượng chứa các thông tin về sản phẩm, các giá trị product được lấy từ productData
                id: this.productData.id,
                name: this.productData.name,
                image: this.productData.image,
                price: this.productData.price,
                // userDefault_price_group: this.productData.userProductPriceDefault,
                // user_price_group: this.productData.userProductPrice,
                quantity: 1
            }
        };
    },
    methods: {
        addToCart() {
            axios.post('/api/addToCart/product', this.product)
                .then(res => {
                    console.log('thêm thành công');

                    // $emit : gửi thông tin của cpn con lên cpn cha
                    this.$emit('add-cart', res.data);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>

