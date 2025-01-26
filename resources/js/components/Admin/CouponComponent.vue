<template>
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <button
            class="btn btn-primary btn-sm float-end px-4 ms-2"
            data-bs-toggle="modal"
            data-bs-target="#couponModal"
          >
            <MtIcon icon="add"></MtIcon> Add New Coupon
          </button>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-6">
          <button class="btn btn-dark btn-sm" v-on:click="refreshTable()">
            <MtIcon icon="refresh"></MtIcon> Refresh
          </button>
        </div>
        <div class="col-6">
          <div class="position-relative w-auto float-end">
            <input
              type="text"
              class="form-control"
              name="search"
              v-model="search"
              id="search"
              autocomplete="off"
              placeholder="Search..."
              style="padding-left: 2rem !important"
            />
            <div
              class="position-absolute top-50 start-0 translate-middle-y p-2"
            >
              <MtIcon icon="search" styleName="text-muted"></MtIcon>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Coupon Code</th>
              <th>Percentage</th>
              <th>Description</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="coupon in couponList" :key="coupon.id">
              <td>{{ coupon.code }}</td>
              <td>{{ coupon.percentage }}%</td>
              <td>{{ coupon.des }}</td>
              <td>
                <div class="form-check form-switch">
                  <input
                    class="form-check-input cursor-pointer"
                    type="checkbox"
                    id="flexSwitchCheckChecked"
                    :checked="coupon.active"
                    v-on:change="updateStatus(coupon.id)"
                  />
                  <label class="form-check-label" for="flexSwitchCheckChecked">
                    {{ coupon.status }}
                  </label>
                </div>
              </td>
              <td>
                <button
                  class="btn btn-info btn-xs"
                  data-bs-toggle="modal"
                  data-bs-target="#editCouponModal"
                  v-on:click="openEditModal(coupon)"
                >
                  <MtIcon icon="edit"></MtIcon>
                  Edit
                </button>

                <button
                  class="btn btn-danger btn-xs"
                  v-on:click="deleteCoupon(coupon.id)"
                >
                  <MtIcon icon="delete"></MtIcon>
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="text-center" v-if="couponList.length == 0">
          <h6>No Data</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Create -->
  <div
    class="modal fade"
    id="couponModal"
    tabindex="-1"
    aria-labelledby="couponModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="couponModalLabel">Add New Coupon</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restorFormControl"
          ></button>
        </div>
        <form @submit.prevent="storeCoupon">
          <div class="modal-body">
            <div class="mb-3">
              <label for="code" class="form-label fw-bold"> Coupon Code </label>
              <input
                type="text"
                class="form-control"
                v-model="data.code"
                id="code"
                :class="{ 'is-invalid': errors.hasOwnProperty('code') }"
                name="code"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('code')"
              >
                {{ errors.code[0] }}
              </div>
              <div class="form-text">Max 8 characters</div>
            </div>

            <div class="mb-3">
              <label for="percentage" class="form-label fw-bold"
                >Discount Percentage (%)</label
              >
              <input
                type="number"
                min="0"
                max="100"
                step="0.1"
                class="form-control"
                v-model="data.percentage"
                id="percentage"
                :class="{ 'is-invalid': errors.hasOwnProperty('percentage') }"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('percentage')"
              >
                {{ errors.percentage[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="des" class="form-label fw-bold">Description</label>
              <textarea
                class="form-control"
                v-model="data.des"
                id="des"
                :class="{ 'is-invalid': errors.hasOwnProperty('des') }"
              ></textarea>
              <div class="invalid-feedback" v-if="errors.hasOwnProperty('des')">
                {{ errors.des[0] }}
              </div>
              <div class="form-text">Max 190 characters</div>
            </div>
          </div>
          <div class="row p-0 m-0 border-top">
            <div class="col-6 p-0">
              <button
                type="button"
                class="
                  btn btn-link
                  w-100
                  m-0
                  text-danger
                  btn-lg
                  text-decoration-none
                  rounded-0
                  border-end
                "
                data-bs-dismiss="modal"
                v-on:click="restorFormControl"
              >
                Cancel
              </button>
            </div>
            <div class="col-6 p-0">
              <button
                type="submit"
                class="
                  btn btn-link
                  w-100
                  m-0
                  text-black
                  btn-lg
                  text-decoration-none
                  rounded-0
                  border-start
                "
                :disabled="loading"
              >
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Update -->
  <div
    class="modal fade"
    id="editCouponModal"
    tabindex="-1"
    aria-labelledby="editCouponModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCouponModalLabel">Edit categoria</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restorFormControl"
          ></button>
        </div>
        <form @submit.prevent="updateCoupon(editData.id)">
          <div class="modal-body">
            <div class="mb-3">
              <label for="code-edit" class="form-label fw-bold">
                Coupon Code
              </label>
              <input
                type="text"
                class="form-control"
                v-model="editData.code"
                id="code-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('code') }"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('code')"
              >
                {{ errors.code[0] }}
              </div>
              <div class="form-text">Max 8 characters</div>
            </div>

            <div class="mb-3">
              <label for="percentage-edit" class="form-label fw-bold">
                Discount Percentage (%)
              </label>
              <input
                type="number"
                min="0"
                max="100"
                step="0.1"
                class="form-control"
                v-model="editData.percentage"
                id="percentage-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('percentage') }"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('percentage')"
              >
                {{ errors.percentage[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="des-edit" class="form-label fw-bold">
                Description
              </label>
              <textarea
                class="form-control"
                v-model="editData.des"
                id="des-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('des') }"
              ></textarea>

              <div class="invalid-feedback" v-if="errors.hasOwnProperty('des')">
                {{ errors.des[0] }}
              </div>
              <div class="form-text">Max 190 characters</div>
            </div>
          </div>
          <div class="row p-0 m-0 border-top">
            <div class="col-6 p-0">
              <button
                type="button"
                class="
                  btn btn-link
                  w-100
                  m-0
                  text-danger
                  btn-lg
                  text-decoration-none
                  rounded-0
                  border-end
                "
                data-bs-dismiss="modal"
                v-on:click="restorFormControl"
              >
                Cancel
              </button>
            </div>
            <div class="col-6 p-0">
              <button
                type="submit"
                class="
                  btn btn-link
                  w-100
                  m-0
                  text-black
                  btn-lg
                  text-decoration-none
                  rounded-0
                  border-start
                "
                :disabled="loading"
              >
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      coupons: [],
      pageOfItems: [],
      search: "",
      data: {
        name: "",
        percentage: 0,
        des: "",
      },

      editData: {
        id: "",
        name: "",
        percentage: 0,
        des: "",
        _method: "PUT",
      },
      errors: {},
      loading: false,
    };
  },
  mounted() {},
  methods: {
    fetchCoupons() {
      topbar.show();
      axios
        .get("/admin/coupons/all")
        .then((response) => {
          this.coupons = response.data.data;
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .then(() => {
          topbar.hide();
        });
    },
    refreshTable() {
      this.fetchCoupons();
    },

    deleteCoupon(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to reverse this action!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        focusCancel: true,
        showClass: {
          popup: "",
          icon: "",
        },
        hideClass: {
          popup: "",
        },
      }).then((result) => {
        if (result.value) {
          topbar.show();
          axios
            .delete("/admin/coupons/" + id)
            .then((response) => {
              if (response.status == 200) {
                this.fetchCoupons();
                this.$toast.success("Coupon has been deleted");
              }
            })
            .catch(({ response }) => {
              Swal.fire(
                `Error ${response.status}`,
                response.statusText,
                "error"
              );
            })
            .then(() => {
              topbar.hide();
            });
        }
      });
    },
    storeCoupon() {
      this.errors = {};
      topbar.show();
      this.loading = true;

      axios
        .post("/admin/coupons", this.data)
        .then((response) => {
          this.fetchCoupons();
          this.data.code = "";
          this.data.percentage = 0;
          this.data.des = "";
          this.$toast.success("New Coupon Added");
        })
        .catch(({ response }) => {
          if (response.status === 422 || response.status === 429) {
            this.errors = response.data.errors;
          } else {
            Swal.fire(`Error ${response.status}`, response.statusText, "error");
          }
        })
        .then(() => {
          topbar.hide();
          this.loading = false;
        });
    },

    updateCoupon(id) {
      this.errors = {};
      topbar.show();
      this.loading = true;

      axios
        .post("/admin/coupons/" + id, this.editData)
        .then((response) => {
          this.fetchCoupons();
          this.$toast.success("Coupon has been updated");
        })
        .catch(({ response }) => {
          if (response.status === 422 || response.status === 429) {
            this.errors = response.data.errors;
          } else {
            Swal.fire(`Error ${response.status}`, response.statusText, "error");
          }
        })
        .then(() => {
          topbar.hide();
          this.loading = false;
        });
    },
    openEditModal(coupon) {
      this.editData.id = coupon.id;
      this.editData.code = coupon.code;
      this.editData.percentage = coupon.percentage;
      this.editData.des = coupon.des;
      this.editData.delivery = coupon.is_delivery;
    },

    updateStatus(id) {
      topbar.show();
      axios
        .put(`/admin/coupons/status/${id}`)
        .then((response) => {
          this.fetchCoupons();
          this.$toast.success("Coupon has been updated");
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .then(() => {
          topbar.hide();
        });
    },
    restorFormControl() {
      this.errors = {};
    },
  },

  created: function () {
    this.fetchCoupons();
  },
  computed: {
    couponList() {
      const search = this.search.toLowerCase();
      if (!search) return this.coupons;
      return this.coupons.filter((coupon) => {
        return (
          coupon.code.toLowerCase().includes(search) ||
          coupon.percentage.toString().toLowerCase().includes(search) ||
          coupon.des.toLowerCase().includes(search)
        );
      });
    },
  },
};
</script>          