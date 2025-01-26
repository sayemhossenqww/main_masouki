<template>
    <div class="text-center fw-bolder text-dark h5 mb-5">
        <span> {{ price }}</span>
        <s class="ms-2" v-if="item.has_discount">{{
            item.view_original_price_usd
        }}</s>
        <DiscountBadge v-if="item.has_discount"></DiscountBadge>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3 text-center">
            <div class="item-qty-cart">
                <span class="prod__q-minus" @click="decrement()"> </span>
                <input
                    type="tel"
                    class="item-qty-field"
                    :value="quantity"
                    readonly
                />
                <span class="prod__q-plus" @click="increment()"> </span>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <button
                class="btn btn-danger w-100"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#addServiceModal"
            >
                Add
            </button>
        </div>
    </div>

    
  <!-- Add Service Modal -->
  <div
    class="modal fade"
    id="addServiceModal"
    tabindex="-1"
    aria-labelledby="addServiceModalLabel"
    aria-hidden="true"
  >
    <div
      class="
        modal-dialog modal-dialog-centered modal-md modal-fullscreen-md-down
      "
    >
      <div class="modal-content">
        <div class="modal-header">
            <div class="row w-100 gap-3">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <h5 class="modal-title" id="addServiceModalLabel">
                        {{ item.name }}
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="text-danger text" style="font-weight: bold;">
                    Price: {{  price }}
                </div>
            </div>
        </div>
        <form @submit.prevent="addToCart()">
          <div class="modal-body">
            <div class="row gap-2 mb-2">
                <div
                    v-for="(category, cIndex) in categories"
                    :key="cIndex"
                >
                    <div>{{  category.name }}</div>
                    <div class="m-2">
                        <div
                            v-for="(service, sIndex) in category.services"
                            :key="sIndex"
                        >
                            <input type="checkbox" :id="service.id" class="mx-2" v-model="service.checked"/>
                            <label :for="service.id" class="cursor-pointer">{{  service.name }} ({{ service.price }} USD)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 float-end">
              <button
                type="submit"
                class="btn btn-primary px-4"
              >
                Add
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Cart } from "@/services/cart";
import { usd_money_format } from "@/services/utils";
export default {
    props: ["item"],
    data() {
        return {
            quantity: 1,
            totalPrice: 0,
            categories: [],
        };
    },
    created() {},
    methods: {
        addToCart() {
            let services = [];
            this.categories.forEach((category) => {
                category.services.forEach((service) => {
                    if(service.checked === true) services.push(service);
                })
            });

            Cart.add(this.item, this.quantity, services);
            this.$store.state.cartTotal = Cart.total();
            this.$store.state.cartTotalItems = Cart.totalItems();
            this.$toast.show("Item added to your bag");
        },
        increment() {
            if (this.quantity > 100) return;
            this.quantity++;
        },

        decrement() {
            if (this.quantity < 2) return;
            this.quantity--;
        },
    },
    mounted() {},
    created: function () {
        this.totalPrice = this.item.price;
        console.log("ITEM", this.item);
        this.item.item_selection_option.forEach(service => {
            const currentCategory = this.categories.find((category) => {
                if(category.name === service.select_option.category_name) return true;
            });
            if(currentCategory !== undefined)
                currentCategory.services.push({...service.select_option, checked: false});
            else
                this.categories.push({name: service.select_option.category_name, services: [{...service.select_option, checked: false}]});
        });
        console.log("CATEGORIES", this.categories);
    },
    computed: {
        price() {
            let total = parseFloat(this.item.base_price_usd);
                console.log("total", total);
            this.categories.forEach((category) => {
                category.services.forEach((service) => {
                    if(service.checked === true) {
                        console.log(service.price);
                        console.log(typeof(service.price));
                        total += parseFloat(service.price);
                    }
                })
            });
                console.log("total", total);
            return usd_money_format(
                total * parseInt(this.quantity)
            );
        },
    },
};
</script>
