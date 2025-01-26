<template>
  <form @submit.prevent="updatePassword">
    <div class="form-floating mb-3">
      <input
        type="password"
        class="form-control"
        v-model="data.current_password"
        id="current_password"
        :class="{ 'is-invalid': errors.hasOwnProperty('current_password') }"
        name="current_password"
        placeholder="Current Password"
      />
      <label for="current_password"> Current Password </label>
      <div
        class="invalid-feedback"
        v-if="errors.hasOwnProperty('current_password')"
      >
        {{ errors.current_password[0] }}
      </div>
    </div>

    <div class="form-floating mb-3">
      <input
        type="password"
        class="form-control"
        v-model="data.new_password"
        id="new_password"
        :class="{ 'is-invalid': errors.hasOwnProperty('new_password') }"
        name="new_password"
        placeholder="New Password"
      />
      <label for="new_password"> New Password </label>
      <div
        class="invalid-feedback"
        v-if="errors.hasOwnProperty('new_password')"
      >
        {{ errors.new_password[0] }}
      </div>
    </div>

    <div class="form-floating mb-3">
      <input
        type="password"
        class="form-control"
        v-model="data.new_password_confirmation"
        id="new_password_confirmation"
        :class="{
          'is-invalid': errors.hasOwnProperty('new_password_confirmation'),
        }"
        name="new_password_confirmation"
        placeholder="Confirm Password"
      />
      <label for="new_password_confirmation"> Confirm Password </label>
      <div
        class="invalid-feedback"
        v-if="errors.hasOwnProperty('new_password_confirmation')"
      >
        {{ errors.new_password_confirmation[0] }}
      </div>
    </div>

    <button type="submit" class="btn btn-primary px-4 mb-3" :disabled="loading">
      Save
    </button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      data: {
        current_password: "",
        new_password: "",
        new_password_confirmation: "",
        _method: "PUT",
      },
      errors: {},
      loading: false,
    };
  },
  mounted() {},
  methods: {
    updatePassword() {
      this.errors = {};
      topbar.show();
      this.loading = true;

      axios
        .post("/admin/password", this.data)
        .then((response) => {
          if (response.status === 200) {
            Swal.fire("", "Password has been updated", "success");
            this.data.current_password = "";
            this.data.new_password = "";
            this.data.new_password_confirmation = "";
          }
        })
        .catch(({ response }) => {
          if (response.status === 422 || response.status === 429) {
            this.errors = response.data.errors;
          } else {
            Swal.fire(`Error ${response.status}`, response.data, "error");
          }
        })
        .then(() => {
          topbar.hide();
          this.loading = false;
        });
    },
  },
  created: function () {},
  computed: {},
};
</script>