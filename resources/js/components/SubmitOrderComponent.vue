<template>
  <div class="row mt-3 mb-3">
    <div class="col-lg-9 col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="mb-3">
            <input
              type="text"
              id="name"
              v-model="data.name"
              class="form-control"
              :class="{ 'is-invalid': errors.hasOwnProperty('name') }"
              placeholder="Name*"
              aria-label="Name*"
              autocomplete="name"
            />
            <div class="invalid-feedback" v-if="errors.hasOwnProperty('name')">
              {{ errors.name[0] }}
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <input
              type="tel"
              name="phone"
              v-model="data.phone"
              class="form-control input-phone"
              :class="{ 'is-invalid': errors.hasOwnProperty('phone') }"
              placeholder="Phone number*"
              aria-label="Phone number*"
              autocomplete="tel"
            />
            <div class="invalid-feedback" v-if="errors.hasOwnProperty('phone')">
              {{ errors.phone[0] }}
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <input
              type="text"
              id="email"
              v-model="data.email"
              class="form-control"
              :class="{ 'is-invalid': errors.hasOwnProperty('email') }"
              placeholder="Email (Optional)"
              aria-label="Email (Optional)"
              autocomplete="email"
            />
            <div class="invalid-feedback" v-if="errors.hasOwnProperty('email')">
              {{ errors.email[0] }}
            </div>
            <div
              id="emailHelp"
              class="form-text"
              v-if="!errors.hasOwnProperty('email')"
            >
              You will receive the order details to your email.
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="mb-3">
            <label for="delivery" class="form-label fw-bold">Order Type*</label>
            <select
              id="delivery"
              v-model="data.delivery"
              class="form-select rounded-main cursor-pointer shadow-sm"
              :class="{ 'is-invalid': errors.hasOwnProperty('delivery') }"
              aria-label="Tipo de pedido*"
              @change="selectChange"
            >
              <option v-bind:value="true" selected>Delivery</option>
              <option v-bind:value="false">Pickup</option>
            </select>
            <div class="text-danger" v-if="errors.hasOwnProperty('delivery')">
              {{ errors.delivery[0] }}
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-3" :class="{ 'd-none': isDelivery }">
          <div class="card shadow-sm w-100 rounded-main">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-2 p-3 text-lg-center">
                  <img
                    src="/images/webp/pin.webp"
                    alt="Pin"
                    height="38"
                  />
                </div>
                <div class="col-10">
                  <h5>Our Location</h5>
                  <a
                    href="https://goo.gl/maps/wF438zKBcspYisLd7"
                    class="link-primary"
                    target="_blank"
                  >
                    Baalbek, Baalbek-Hermel, Lebanon
                    <br />
                    <span lang="ar">
                      طريق عام بعلبك الطيبة جنب مختبر لايف لاب
                    </span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12" :class="{ 'd-none': !isDelivery }">
          <div class="card shadow-sm mb-3 rounded-main">
            <div class="card-body">
              <div class="card-title fs-5 fw-bold">Delivery Address</div>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <Dropdown
                      v-model="data.area"
                      :options="areas"
                      optionLabel="name"
                      optionValue="id"
                      placeholder="Select your area*"
                      :filter="true"
                      filterPlaceholder="Search..."
                      emptyFilterMessage="No results found"
                      emptyMessage="No results found"
                      :loading="loadingAreas"
                    />

                    <div
                      class="text-danger"
                      v-if="errors.hasOwnProperty('area')"
                    >
                      {{ errors.area[0] }}
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <textarea
                      id="address"
                      v-model="data.address"
                      class="form-control"
                      :class="{
                        'is-invalid': errors.hasOwnProperty('address'),
                      }"
                      placeholder="Address*"
                      aria-label="Address*"
                      autocomplete="address"
                      rows="3"
                    >
                    </textarea>
                    <div
                      class="invalid-feedback"
                      v-if="errors.hasOwnProperty('address')"
                    >
                      {{ errors.address[0] }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3">
            <label for="payment_method" class="form-label fw-bold"
              >Payment Method*</label
            >
            <Dropdown
              v-model="data.payment_method"
              :options="paymentMethodsList"
              optionLabel="name"
              optionValue="id"
              placeholder="Payment Method*"
              emptyFilterMessage="No results found"
              emptyMessage="No results found"
              :loading="loadingPaymentMethods"
            />
            <div
              class="invalid-feedback"
              v-if="errors.hasOwnProperty('payment_method')"
            >
              {{ errors.payment_method[0] }}
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="mb-3">
            <textarea
              id="comment"
              v-model="data.comment"
              class="form-control shadow-sm"
              :class="{ 'is-invalid': errors.hasOwnProperty('comment') }"
              placeholder="Comments on the order"
              aria-label="Comments on the order"
              autocomplete="comment"
            ></textarea>
            <div
              class="invalid-feedback"
              v-if="errors.hasOwnProperty('comment')"
            >
              {{ errors.comment[0] }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-12">
      <ul class="list-group shadow-sm mb-3 rounded-main">
        <li class="list-group-item">
          <span class="text-muted">Subltotal:</span>
          <div class="text-muted">
            {{ showSubtotal }}
          </div>
        </li>

        <li class="list-group-item" v-if="couponDiscountPrice > 0">
          <span class="text-muted">Discount:</span>
          <div class="text-muted">
            {{ showDiscount }}
          </div>
        </li>

        <template v-if="isDelivery">
          <li class="list-group-item">
            <span class="text-muted">Delivery Charge:</span>
            <div class="text-muted">
              {{ showDeliveryFee }}
            </div>
          </li>
          <li class="list-group-item">
            <span class="text-muted">Delivery Time:</span>
            <div class="text-muted">{{ deliveryTime }}</div>
          </li>
        </template>

        <li class="list-group-item">
          <span class="fw-bold">Total:</span>
          <div class="fw-bold">
            {{ showTotal }}
          </div>
        </li>
        <template v-if="couponAdded">
          <li class="list-group-item">
            <span class="text-muted">Coupon:</span>
            <div class="text-muted">{{ data.coupon_code }}</div>
          </li>
          <li class="list-group-item">
            {{ coupon.des }}
          </li>
        </template>
      </ul>

      <button
        v-if="!couponAdded"
        class="btn btn-link text-danger text-decoration-none w-100 mb-3"
        type="button"
        id="coupon-add-btn"
        data-bs-toggle="modal"
        data-bs-target="#CouponModal"
        :disabled="couponAdded"
      >
        Add Coupon
      </button>
    </div>
    <div class="col-lg-9 col-sm-12 text-center">
      <button
        type="submit"
        class="btn btn-primary btn-lg px-5"
        :disabled="loading"
        @click="storeOrder"
      >
        Submit Order

        <div
          class="spinner-border spinner-border-sm text-light ms-1"
          role="status"
          v-if="loading"
        >
          <span class="visually-hidden">Loading...</span>
        </div>
      </button>
    </div>
  </div>
  <!-- Coupn Modal -->
  <div
    class="modal fade"
    id="CouponModal"
    tabindex="-1"
    aria-labelledby="CouponModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="CouponModalLabel">
            <MtIcon icon="confirmation_number" styleName="me-1"></MtIcon>
            Add Coupon
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <input
              type="text"
              id="coupon_code"
              v-model="data.coupon_code"
              :disabled="couponAdded"
              class="form-control"
              :class="{
                'is-invalid': errors.hasOwnProperty('coupon_code'),
                'is-valid': couponAdded,
              }"
              placeholder="Coupon Code"
              aria-label="Coupon Code"
              autocomplete="coupon_code"
            />
            <div
              class="invalid-feedback"
              v-if="errors.hasOwnProperty('coupon_code')"
            >
              {{ errors.coupon_code[0] }}
            </div>
            <div class="valid-feedback" v-if="couponAdded">Coupon is valid</div>
          </div>
          <button
            class="btn btn-primary w-100"
            :disabled="data.coupon_code.length == 0 || couponAdded"
            @click="addCoupon"
          >
            Apply
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { blr_money_format, usd_money_format } from "@/services/utils";
import { Cart } from "@/services/cart";
const SOURCE_WEBSITE = 1;
export default {
  data() {
    return {
      areas: [],
      payment_methods: [],
      data: {
        name: "",
        phone: "",
        email: "",
        delivery: true,

        area: "",
        address: "",

        payment_method: 0,
        coupon_code: "",
        comment: "",
        cart: { items: Cart.items(), total: Cart.total() },
        source: SOURCE_WEBSITE,
      },
      isDelivery: 1,
      couponAdded: false,
      couponDiscount: 0,
      coupon: "",
      loading: false,
      loadingAreas: false,
      loadingPaymentMethods: false,
      errors: {},
    };
  },
  methods: {
    storeOrder() {
      if (Cart.isEmpty()) {
        Swal.fire("Your bag is empty!", "", "warning").then(function () {
          window.location = "/cart";
        });
      }

      this.loading = true;
      topbar.show();
      this.errors = {};
      axios
        .post("/api/v1/order", this.data)
        .then((response) => {
          Swal.fire(
            "Order submitted successfully",
            "Thank you very much for choosing us!",
            "success"
          ).then(function () {
            Cart.clear();
            window.location = "/";
          });
        })
        .catch((error) => {
          if (error.response.status === 422 || error.response.status === 429) {
            this.errors = error.response.data.errors;
          } else {
            Swal.fire(
              "",
              "There was an error submitting your order. Please try refreshing the page or try again later",
              "error"
            );
          }
        })
        .then(() => {
          topbar.hide();
          this.loading = false;
        });
    },

    fetchAreas() {
      this.loadingAreas = true;
      axios
        .get("/api/v1/areas")
        .then((response) => {
          this.areas = response.data.data;
        })
        .catch((error) => {})
        .then(() => {
          this.loadingAreas = false;
        });
    },
    fetchPaymentMethods() {
      this.loadingPaymentMethods = true;
      axios
        .get("/api/v1/payment-methods")
        .then((response) => {
          this.payment_methods = response.data.data;
          this.data.payment_method = this.paymentMethodsList[0].id;
        })
        .catch((error) => {})
        .then(() => {
          this.loadingPaymentMethods = false;
        });
    },
    selectChange() {
      this.isDelivery = this.data.delivery;
      this.data.payment_method = this.paymentMethodsList[0].id;
      this.couponDiscount = 0;
      this.couponAdded = false;
    },
    addCoupon() {
      topbar.show();
      this.errors = {};
      let requestData = {
        coupon_code: this.data.coupon_code,
      };
      axios
        .post("/api/v1/coupon", requestData)
        .then((response) => {
          this.coupon = response.data.data;
          this.couponDiscount =
            (this.$store.state.cartTotal * this.coupon.percentage) / 100;

          this.couponAdded = true;
        })
        .catch((error) => {
          this.errors = { coupon_code: ["Coupon invalid"] };
        })
        .then(() => {
          topbar.hide();
        });
    },
    currencyFormat(number) {
      return usd_money_format(parseFloat(number));
    },
  },
  created: function () {
    this.fetchAreas();
    this.fetchPaymentMethods();
  },
  mounted() {
    if (Cart.totalItems() == 0) {
      window.location = "/cart";
    }
  },
  computed: {
    orderSubtotal() {
      return this.$store.state.cartTotal;
    },
    orderTotal() {
      console.log(this.deliveryFee, typeof(this.deliveryFee));
      console.log(this.orderSubtotal, typeof(this.orderSubtotal));
      console.log(this.couponDiscount, typeof(this.couponDiscount));
      return this.isDelivery
        ? parseFloat(this.deliveryFee) + this.orderSubtotal - this.couponDiscount
        : this.orderSubtotal - this.couponDiscount;
    },
    deliveryFee() {
      let deliveryArea = this.areas.find((area) => area.id === this.data.area);
      return deliveryArea ? deliveryArea.fee : 0;
    },
    isAreaSelected() {
      return !!this.data.area;
    },
    deliveryTime() {
      let deliveryArea = this.areas.find((area) => area.id === this.data.area);
      return deliveryArea ? deliveryArea.view_time : "0 min";
    },
    isDisable(input) {
      return input.length > 0;
    },
    couponDiscountPrice() {
      return this.couponDiscount;
    },
    paymentMethodsList() {
      return this.payment_methods;
    },
    showSubtotal() {
      return this.currencyFormat(this.orderSubtotal);
    },
    showDiscount() {
      return this.currencyFormat(this.couponDiscountPrice);
    },
    showTotal() {
      return this.currencyFormat(this.orderTotal);
    },
    showDeliveryFee() {
      return this.currencyFormat(this.deliveryFee);
    },
  },
};
</script>
