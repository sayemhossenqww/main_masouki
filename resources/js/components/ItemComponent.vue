<template>
    <div class="d-flex align-items-center">
        <div class="flex-shrink-0">
            <div class="item-image-wrapper">
                <picture>
                    <source type="image/jpg" :data-srcset="item.image_url" />
                    <img
                        :alt="item.name"
                        :data-src="item.image_url"
                        aria-hidden="true"
                        class="item-image lazy rounded-main"
                    />
                </picture>
            </div>
        </div>
        <div class="flex-grow-1 card-body py-0">
            <span class="text-black fw-bold text-break fs-7">
                {{ item.name }}

                <Icon icon="leaf" styleName="me-1" v-if="item.is_vegan"></Icon>
                <Icon
                    icon="leaf_right"
                    styleName="me-1"
                    v-if="item.is_vegetarian"
                ></Icon>
                <Icon
                    icon="gluten_free"
                    styleName="me-1"
                    v-if="item.is_gluten_free"
                ></Icon>
                <Icon icon="chili" styleName="me-1" v-if="item.is_spicy"></Icon>
                <Icon
                    icon="leaves"
                    styleName="me-1"
                    v-if="item.is_low_carb"
                ></Icon>
                <Icon
                    icon="sugar_free"
                    styleName="me-1"
                    v-if="item.is_sugar_free"
                ></Icon>
                <Icon
                    icon="lactose_free"
                    styleName="me-1"
                    v-if="item.is_lactose_free"
                ></Icon>
            </span>

            <div class="text-muted d-none d-md-block fs-7 mb-3">
                {{ item.preview_des }}
            </div>
            <div class="text-black align-items-center mb-2 fs-7">
                {{ basePrice }}
                <s class="ms-1" v-if="item.has_discount">
                    {{ item.view_original_price_usd }}
                </s>
                <DiscountBadge v-if="item.has_discount"></DiscountBadge>
            </div>
        </div>
    </div>
</template>

<script>
import { blr_money_format, usd_money_format } from "@/services/utils";
export default {
    props: ["item"],
    data() {
        return {
            qty: 1,
            comment: "",
            maxCharecters: 155,
        };
    },
    mounted() {},
    methods: {},
    computed: {
        basePrice() {
            return usd_money_format(parseFloat(this.item.base_price_usd));
        },
    },
};
</script>
