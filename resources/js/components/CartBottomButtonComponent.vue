<template>
 <a href="/cart" v-if="totalItems > 0"
        class="bottom-0 end-0 position-fixed justify-content-center align-items-center w-100 btn-lg btn btn-danger rounded-0 d-block d-sm-none">
        Cart - {{ total }} <span class="badge rounded-pill bg-light text-dark">{{ totalItems }}</span>

  </a>
</template>
<script>
import { usd_money_format } from "@/services/utils";

export default {
  data() {
    return {};
  },
  methods: {},
  created: function () {},
  computed: {
    total() {
      return usd_money_format(this.$store.state.cartTotal);
    },
    totalItems() {
      return this.$store.state.cartTotalItems;
    },
  },
};
</script>