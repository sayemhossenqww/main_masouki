<template>
  <badge-button-component :styleName="buttonClass" v-if="item.is_vegan">
    <Icon icon="leaf" :styleName="iconClass" /> Vegana
  </badge-button-component>

  <badge-button-component :styleName="buttonClass" v-if="item.is_vegetarian">
    <Icon icon="leaf_right" :styleName="iconClass" /> Vegetariana
  </badge-button-component>

  <badge-button-component :styleName="buttonClass" v-if="item.is_gluten_free">
    <Icon icon="gluten_free" :styleName="iconClass" /> Sem Glúten
  </badge-button-component>

  <badge-button-component :styleName="buttonClass" v-if="item.is_spicy">
    <Icon icon="chili" :styleName="iconClass" /> Picante
  </badge-button-component>

  <badge-button-component :styleName="buttonClass" v-if="item.is_low_carb">
    <Icon icon="leaves" :styleName="iconClass" /> Low Carb
  </badge-button-component>

  <badge-button-component :styleName="buttonClass" v-if="item.is_sugar_free">
    <Icon icon="sugar_free" :styleName="iconClass" /> Sem Açúcar
  </badge-button-component>

  <badge-button-component :styleName="buttonClass" v-if="item.is_lactose_free">
    <Icon icon="lactose_free" :styleName="iconClass" /> Sem Lactose
  </badge-button-component>
</template>

<script>
import BadgeButtonComponent from "./BadgeButtonComponent.vue";

export default {
  props: ["item"],
  components: { BadgeButtonComponent },

  data() {
    return {
      buttonClass: "mb-2 me-2",
      iconClass: "me-1",
    };
  },
  created() {},
  methods: {},
  mounted() {},
  computed: {},
};
</script>
