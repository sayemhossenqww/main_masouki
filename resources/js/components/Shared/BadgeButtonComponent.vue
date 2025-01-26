<template>
  <button
    type="button"
    :class="`btn btn-light btn-xs shadow-none rounded-pill border border-dark ${styleName}`"
  >
     <slot></slot>
  </button>
</template>

<script>
export default {
props: ["styleName"],
  data() {
    return {};
  },
  created() {},
  methods: {},
  mounted() {},
  computed: {},
};
</script>
