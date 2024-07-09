<!-- component con  ===> resources/js/components/AddToCartComponent.vue -->

<template>
  <div>
    <form @submit.prevent="addToCart">
      <input type="hidden" v-model="product_id" value="product.product_id" />
      <input type="hidden" v-model="user_id" value="product.user_id" />
      <input type="hidden" v-model="quantity" value="product.quantity" />
      <button class="btnForm" type="submit" onclick="sweetAlertAddCart()">
        <i class="fa-solid fa-cart-plus" style="color: #1f508ds"></i>
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios"; // Import thư viện axios để thực hiện các yêu cầu HTTP

export default {
  props: {
    // nhận dữ liệu từ component ch => khi cpn cha kích hoạt thì prop productData của cpn con nhận dữ liệu từ cha
    productData: Object,
    userId: Number,
  },
  data() {
    return {
      product: {
        // product là một đối tượng chứa các thông tin về sản phẩm, các giá trị product được lấy từ productData
        product_id: this.productData.id,
        user_id: this.userId,
        quantity: 1,
      },
    };
  },
  methods: {
    addToCart() {
      axios
        .post("/api/addToCart/product", this.product)
        .then((res) => {
          console.log("thêm thành công");

          // $emit : gửi thông tin của cpn con lên cpn cha
          this.$emit("add-cart", res.data);
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>

