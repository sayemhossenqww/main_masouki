<template>
  <div class="form-check form-switch" v-if="!loading">
    <input
      class="form-check-input cursor-pointer text-secondary"
      type="checkbox"
      id="flexSwitchCheckStatus"
      :checked="isOpen"
      v-on:change="updateStoreStatus"
    />
    <label class="form-check-label" for="flexSwitchCheckStatus">
      {{ isOpen ? "Open" : "Closed" }}
    </label>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isOpen: "",
      loading: true,
    };
  },
  created() {
    this.getStoreStatus();
  },
  methods: {
    updateStoreStatus() {
      topbar.show();
      let data = {
        status: !this.isOpen,
        _method: "PUT",
      };
      axios
        .post("/admin/store/status", data)
        .then((response) => {
          this.getStoreStatus();
          this.$toast.success("Store status has been changed");
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .then(() => {
          topbar.hide();
        });
    },

    getStoreStatus() {
      axios
        .get("/admin/store/status")
        .then((response) => {
          this.isOpen = response.data.is_open;
          this.loading = false;
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        });
    },
  },
  mounted() {},
};
</script>
