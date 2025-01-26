<template>
  <div
    class="modal fade"
    id="itemModal"
    ref="itemModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
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
        <div class="modal-header py-2 shadow-sm">
          <button
            type="button"
            class="btn-close m-0 me-auto p-1"
            data-bs-dismiss="modal"
            aria-label="Close"
            ref="itemModalCloseButton"
          ></button>
          <div class="dropdown">
            <button
              class="btn btn-link text-black m-0 ms-auto p-1"
              type="button"
              id="dropdownMenuButton1"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
             <MtIcon icon="share"></MtIcon>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li>
                <button class="dropdown-item" @click="shareToFacebook()">
                  <img src="/images/webp/social-icons/facebook.webp" class="me-1" width="20" height="20"
                        alt="facebook"> Share on Facebook
                </button>
              </li>
              <li>
                <button class="dropdown-item" @click="tweet()">
                   <img src="/images/webp/social-icons/twitter.webp" class="me-1" width="20" height="20"
                        alt="twitter"> Tweet about this
                </button>
              </li>
              <li>
                <button class="dropdown-item" @click="sendViaWhatsApp()">
                   <img src="/images/webp/social-icons/whatsapp.webp" class="me-1" width="20" height="20"
                        alt="whatsapp"> Share via WhatsApp
                </button>
              </li>
            </ul>
          </div>
        </div>

        <div class="modal-body">
          <div>
            <a
              :href="item.url"
              class="
                fs-3
                text-decoration-none text-black
                fw-bold
                text-break
                item-name
              "
              :id="`${item.slug}ModalLabel`"
            >
              {{ item.name }}
            </a>
          </div>
          <div class="text-muted small mb-3">
            {{ item.category_name }}
          </div>

          <div class="mb-3">
            <property-badge-component :item="item"></property-badge-component>
          </div>
          <div class="modal-item-image-wrapper mb-3">
            <img
              :src="item.modal_image_url"
              :alt="item.name"
              class="w-100 object-fit-cover rounded-main"
            />
          </div>

          <div class="mb-3" v-html="item.des"></div>
          <textarea
            class="form-control"
            placeholder="Any comment?"
            rows="3"
            v-model="comments"
            :maxlength="maxCharecters"
          ></textarea>
          <span class="text-muted float-end">
            {{ comments.length }}/{{ maxCharecters }}
          </span>
        </div>
        <div class="modal-footer shadow">
          <div class="item-qty-cart">
            <span
              class="prod__q-minus"
              @click="decrement()"
            >
            </span>
            <input type="tel" class="item-qty-field" :value="quantity" readonly />
            <span
              class="prod__q-plus"
              @click="increment()"
            >
            </span>
          </div>
          <button
            type="button"
            class="btn btn-danger px-3"
            v-on:click="addToCart()"
          >
            Add - {{ price }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { Cart } from "@/services/cart";
import { blr_money_format, usd_money_format } from "@/services/utils";
import PropertyBadgeComponent from "./Shared/PropertyBadgeComponent.vue";

export default {
  props: ["item"],
  components: { PropertyBadgeComponent },
  data() {
    return {
      quantity: 1,
      comments: "",
      maxCharecters: 155,
      modal: null,
    };
  },
  mounted() {
    this.modal = new bootstrap.Modal(this.$refs.itemModal);
    this.$refs.itemModal.addEventListener("shown.bs.modal", function () {
      window.location.hash = "item";
    });
    this.$refs.itemModal.addEventListener("hidden.bs.modal", function () {
      window.location.href.split("#")[0];
    });
    var itemModal = this.modal;
    window.addEventListener("hashchange", function () {
      if (window.location.hash != `#item`) {
        itemModal.hide();
      }
    });
  },
  methods: {
    addToCart() {
      topbar.show();
      Cart.add(this.item, this.quantity, this.comments);
      this.$store.state.cartTotal = Cart.total();
      this.$store.state.cartTotalItems = Cart.totalItems();
      this.quantity = 1;
      this.comments = "";
      topbar.hide();
      this.modal.hide();
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
    shareToFacebook() {
      window.open(
        `https://www.facebook.com/sharer/sharer.php?u=${this.item.url}`,
        "_blank"
      );
    },
    tweet() {
      window.open(
        `https://twitter.com/intent/tweet?text=${this.item.url}`,
        "_blank"
      );
    },
    sendViaWhatsApp() {
      window.open(`https://wa.me/?text=${this.item.url}`, "_blank");
    },
  },
  computed: {
    price() {
      return usd_money_format(
        parseFloat(this.item.base_price_usd) * parseInt(this.quantity)
      );
    },
  },
};
</script>
