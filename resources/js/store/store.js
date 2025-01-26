import { createStore } from "vuex";
import { Cart } from "@/services/cart";
const store = createStore({
    state() {
        return {
            cartTotal: Cart.total(),
            cartTotalItems: Cart.totalItems(),
        };
    },
});

export default store;