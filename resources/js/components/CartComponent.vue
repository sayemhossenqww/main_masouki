<template>
  <div class="row mb-3" v-if="cartItems.length > 0">
    <div class="text-black fw-bold h4 px-3">Your Order</div>
    <div
      class="col-md-12 d-flex align-items-stretch mb-0 mb-md-2 p-0 px-md-3"
      v-for="cartItem in cartItems"
      :key="cartItem.slug"
    >
      <div class="card card-item rounded-0 w-100">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <a :href="cartItem.url">
              <div class="item-image-wrapper">
                <picture>
                  <source type="image/jpg" :data-srcset="cartItem.image_url" />
                  <img
                    :alt="cartItem.name"
                    :data-src="cartItem.image_url"
                    aria-hidden="true"
                    class="item-image lazy"
                  />
                </picture>
              </div>
            </a>
          </div>
          <div class="flex-grow-1 card-body py-0">
            <a
              :href="cartItem.url"
              class="
                text-black text-decoration-none
                fw-bold
                text-break
                item-name
              "
            >
              {{ cartItem.name }}

              <Icon
                icon="leaf"
                styleName="me-1"
                v-if="cartItem.is_vegan"
              ></Icon>
              <Icon
                icon="leaf_right"
                styleName="me-1"
                v-if="cartItem.is_vegetarian"
              ></Icon>
              <Icon
                icon="gluten_free"
                styleName="me-1"
                v-if="cartItem.is_gluten_free"
              ></Icon>
              <Icon
                icon="chili"
                styleName="me-1"
                v-if="cartItem.is_spicy"
              ></Icon>
              <Icon
                icon="leaves"
                styleName="me-1"
                v-if="cartItem.is_low_carb"
              ></Icon>
              <Icon
                icon="sugar_free"
                styleName="me-1"
                v-if="cartItem.is_sugar_free"
              ></Icon>
              <Icon
                icon="lactose_free"
                styleName="me-1"
                v-if="cartItem.is_lactose_free"
              ></Icon>
            </a>

            <div class="text-muted text-break">
              {{ cartItem.category_name }}
            </div>
            <div class="text-muted text-break" style="white-space: pre-wrap">
              {{ cartItem.comment }}
            </div>
            <div class="text-black align-items-center mb-2">
              {{ unitPrice(cartItem) }} x{{ cartItem.quantity }} =
              <span class="fw-bold">{{ price(cartItem) }}</span>
              <DiscountBadge
                styleName="ms-1"
                v-if="cartItem.has_discount"
              ></DiscountBadge>
            </div>
            <div>
              <button
                type="button"
                class="btn btn-link text-danger text-decoration-none p-0"
                v-on:click="removeItem(cartItem)"
              >
                Remove
              </button>
              <button
                type="button"
                class="btn btn-link text-info text-decoration-none ms-2 p-0"
                data-bs-toggle="modal"
                :data-bs-target="`#Modal${cartItem.slug}`"
              >
                Edit
              </button>
            </div>
          </div>
        </div>
      </div>
      <div
        class="modal"
        :id="`Modal${cartItem.slug}`"
        tabindex="-1"
        :aria-labelledby="`${cartItem.slug}ModalLabel`"
        aria-hidden="true"
      >
        <div
          class="
            modal-dialog
            modal-dialog-centered
            modal-dialog-scrollable
            modal-fullscreen-md-down
          "
          style="max-width: 676px !important"
        >
          <div class="modal-content">
            <div class="modal-header py-3">
              <button
                type="button"
                class="btn-close m-0 me-auto p-1"
                data-bs-dismiss="modal"
                aria-label="Close"
                ref="itemModalCloseButton"
              ></button>
            </div>

            <div class="modal-body">
              <div>
                <a
                  :href="cartItem.url"
                  class="
                    fs-3
                    text-decoration-none text-black
                    fw-bold
                    text-black text-break
                    item-name
                  "
                  :id="`${cartItem.slug}ModalLabel`"
                >
                  {{ cartItem.name }}
                </a>
              </div>
              <div class="text-muted small mb-3">
                {{ cartItem.category_name }}
              </div>

              <div class="mb-3">
                <property-badge-component
                  :item="cartItem"
                ></property-badge-component>
              </div>
              <div class="modal-item-image-wrapper mb-3">
                <img
                  :src="cartItem.image_url"
                  :alt="cartItem.name"
                  class="w-100 h-100 object-fit-cover rounded-main"
                />
              </div>

              <div class="mb-3" v-html="cartItem.des"></div>
              <textarea
                class="form-control"
                placeholder="Any comment?"
                rows="3"
                v-model="cartItem.comment"
                :maxlength="maxCharecters"
                @input="updateComment(cartItem)"
              ></textarea>
              <span class="text-muted float-end">
                {{ cartItem.comment.length }}/{{ maxCharecters }}
              </span>
            </div>
            <div class="modal-footer">
              <div class="item-qty-cart">
                <span class="prod__q-minus" @click="decrement(cartItem)">
                </span>
                <input
                  type="tel"
                  class="item-qty-field"
                  :value="cartItem.quantity"
                  readonly
                />
                <span class="prod__q-plus" @click="increment(cartItem)">
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a
    href="/order"
    class="
      bottom-0
      end-0
      position-fixed
      justify-content-center
      align-items-center
      w-100
      btn-lg btn btn-primary
      rounded-0
      d-block d-sm-none
    "
    style="z-index: 1"
    v-if="cartItems.length > 0"
  >
    Continue to checkout
  </a>

  <a
    v-if="cartItems.length > 0"
    href="/order"
    class="btn btn-lg btn-primary px-4 float-end d-none d-sm-block"
  >
    Continue to checkout <MtIcon icon="arrow_right_alt" style="ms-2"></MtIcon>
  </a>

  <div v-if="cartItems.length == 0">
    <empty-cart-component></empty-cart-component>
  </div>
</template>
<script>
import EmptyCartComponent from "@/components/EmptyCartComponent";
import { Cart } from "@/services/cart";
import { blr_money_format, usd_money_format } from "@/services/utils";

export default {
  components: { EmptyCartComponent },
  data() {
    return {
      cartItems: [],
      maxCharecters: 155,
    };
  },
  methods: {
    getCartItems() {
      this.cartItems = Cart.items();
      this.$store.state.cartTotalItems = Cart.totalItems();
    },
    removeItem(item) {
      topbar.show();
      Cart.remove(item);
      this.getCartItems();
      this.$store.state.cartTotalItems = Cart.totalItems();
      topbar.hide();
    },
    unitPrice(cartItem) {
      let total = parseFloat(cartItem.base_price_usd);
      cartItem.services.forEach((service) => {
        total += parseFloat(service.price);
      });
      return total.toFixed(2);
    },
    price(cartItem) {
      let total = this.unitPrice(cartItem);
      return usd_money_format(
        total * parseInt(cartItem.quantity)
      );
    },
    increment(cartItem) {
      Cart.increment(cartItem);
      this.getCartItems();
    },
    decrement(cartItem) {
      Cart.decrement(cartItem);
      this.getCartItems();
    },
    updateComment(cartItem) {
      Cart.updateComment(cartItem);
      this.getCartItems();
    },
  },
  created: function () {
    this.getCartItems();
  },
  computed: {
    cartTotal() {
      return blr_money_format(this.$store.state.cartTotalItems);
    },
  },
};
</script>