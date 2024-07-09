<template>
  <div class="table-responsive">
    <table class="table table-borderless tableMobie">
      <thead class="">
        <tr class="text-center headCart">
          <td class="product">Sản phẩm</td>
          <td class="">Đơn giá</td>
          <td class="">Số lượng</td>
          <td class="">Số tiền</td>
          <td class="">Thao tác</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in cart" :key="item.id" class="itemcart">
          <td class="">
            <div class="imgName">
              <img
                :src="`uploads/{${item.product.image}`"
                class="imgCart"
                alt=""
              />
              <h6 class="ps-3">{{ item.product.name }}</h6>
            </div>
          </td>
          <td class="">
            <p class="card-text text-center"></p>
          </td>

          <td class="">
            <div class="input-group">
              <span class="input-group-btn">
                <button
                  type="button"
                  class="btn btn-number"
                  @click="decreaseQuantity(index)"
                >
                  -
                </button>
              </span>
              <input
                type="text"
                class="input-number border"
                v-model="item.quantity"
                min="1"
                max="10"
              />
              <span class="input-group-btn">
                <button
                  type="button"
                  class="btn btn-number"
                  @click="increaseQuantity(index)"
                >
                  +
                </button>
              </span>
            </div>
          </td>
          <td class="text-center">
            <span class="price"
              >{{ number_format(item.thanhtien, 0, ",", ",") }}đ</span
            >
          </td>
          <td class="">
            <span
              ><a
                href="{{ route('deleteItem', $item['id']) }}"
                class="text-black d-flex justify-content-center text-decoration-none"
                ><i class="fa-solid fa-trash" style="color: #0286e7"></i></a
            ></span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      cart: [],
      userGroup: 1,
    };
  },
  created() {
    this.fetchCartAll();
  },
  fetchCart() {
    axios
      .get("/api/cart")
      .then((response) => {
        this.cart = response.data;
      })
      .catch((error) => {
        console.error("Error fetching cart:", error);
      });
  },
};
</script>

