<template>
  <div
    class="
      btn-back-to-top
      bg-body-color
      text-light
      bottom-0
      end-0
      m-3
      position-fixed
      justify-content-center
      rounded-circle
      align-items-center
      user-select-none
    "
    id="back_to_top"
    @click="scrollToTop"
  >
   <MtIcon icon="keyboard_arrow_up"></MtIcon>
  </div>
</template>

<script>
export default {
  data() {
    return {
      menu: [],
      windowHeight: window.innerHeight / 3,
    };
  },
  created() {
    window.addEventListener("scroll", this.handleScroll);
  },
  methods: {
    handleScroll(event) {
      var backToTopButton = document.querySelector("#back_to_top");
      var displayStyle = window.scrollY > this.windowHeight ? "flex" : "none";
      backToTopButton.style.display = displayStyle;
    },
    scrollToTop() {
      window.scrollTo(0, 0);
    },
  },
  mounted() {},
};
</script>
<style>
.btn-back-to-top {
  display: none;
  width: 40px;
  height: 40px;
  z-index: 1000;
  transition: all 0.4s;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.3s;
}

.btn-back-to-top:hover {
  cursor: pointer;
  background-color: #EC1D25;
}
</style>