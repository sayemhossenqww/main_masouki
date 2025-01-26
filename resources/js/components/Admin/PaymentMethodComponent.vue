<template>
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <button
            class="btn btn-primary btn-sm float-end px-4 ms-2"
            data-bs-toggle="modal"
            data-bs-target="#methodModal"
          >
            <MtIcon icon="add"></MtIcon> Add New Payment Method
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
              <th>Method</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="method in methodList" :key="method.id">
              <td>{{ method.name }}</td>
              <td>
                <div class="form-check form-switch">
                  <input
                    class="form-check-input cursor-pointer"
                    type="checkbox"
                    id="flexSwitchCheckChecked"
                    :checked="method.active"
                    v-on:change="updateStatus(method.id)"
                  />
                  <label class="form-check-label" for="flexSwitchCheckChecked">
                    {{ method.status }}
                  </label>
                </div>
              </td>
              <td>
                <button
                  class="btn btn-info btn-xs"
                  data-bs-toggle="modal"
                  data-bs-target="#editMethodModal"
                  v-on:click="openEditModal(method)"
                >
                 <MtIcon icon="edit"></MtIcon>
                  Edit
                </button>

                <button
                  class="btn btn-danger btn-xs"
                  v-on:click="deleteMethod(method.id)"
                >
                  <MtIcon icon="delete"></MtIcon>
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="text-center" v-if="methodList.length == 0">
          <h6>No Data</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Create -->
  <div
    class="modal fade"
    id="methodModal"
    tabindex="-1"
    aria-labelledby="methodModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="methodModalLabel">Add New Payment Method</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restorFormControl"
          ></button>
        </div>
        <form @submit.prevent="storeMethod">
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Method Name</label>
              <input
                type="text"
                class="form-control"
                v-model="data.name"
                id="name"
                :class="{ 'is-invalid': errors.hasOwnProperty('name') }"
                name="name"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('name')"
              >
                {{ errors.name[0] }}
              </div>
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
    id="editMethodModal"
    tabindex="-1"
    aria-labelledby="editMethodModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editMethodModalLabel">
            Edit categoria
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restorFormControl"
          ></button>
        </div>
        <form @submit.prevent="updateMethod(editData.id)">
          <div class="modal-body">
            <div class="mb-3">
              <label for="name-edit" class="form-label">Method Name</label>
              <input
                type="text"
                class="form-control"
                v-model="editData.name"
                id="name-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('name') }"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('name')"
              >
                {{ errors.name[0] }}
              </div>
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
      methods: [],
      pageOfItems: [],
      search: "",
      data: {
        name: "",
      },
      editData: {
        id: "",
        name: "",
        _method: "PUT",
      },
      errors: {},
      loading: false,
    };
  },
  mounted() {},
  methods: {
    fetchMethods() {
      topbar.show();
      axios
        .get("/admin/payment_methods/all")
        .then((response) => {
          this.methods = response.data.data;
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .then(() => {
          topbar.hide();
        });
    },
    refreshTable() {
      this.fetchMethods();
    },

    deleteMethod(id) {
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
            .delete(`/admin/payment_methods/${id}`)
            .then((response) => {
              if (response.status == 200) {
                this.fetchMethods();
                this.$toast.success("Method has been deleted");
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
    storeMethod() {
      this.errors = {};
      topbar.show();
      this.loading = true;

      axios
        .post("/admin/payment_methods", this.data)
        .then((response) => {
          this.fetchMethods();
          this.data.name = "";
          this.$toast.success("New Mthod Added");
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

    updateMethod(id) {
      this.errors = {};
      topbar.show();
      this.loading = true;

      axios
        .post("/admin/payment_methods/" + id, this.editData)
        .then((response) => {
          this.fetchMethods();
          this.$toast.success("Method has been updated");
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
    openEditModal(method) {
      this.editData.id = method.id;
      this.editData.name = method.name;
      this.editData.delivery = method.is_delivery;
    },

    updateStatus(id) {
      topbar.show();
      axios
        .put("/admin/payment_methods/status/" + id)
        .then((response) => {
          this.fetchMethods();
          this.$toast.success("Method has been updated");
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
    this.fetchMethods();
  },
  computed: {
    methodList() {
      const search = this.search.toLowerCase();
      if (!search) return this.methods;
      return this.methods.filter((method) => {
        return method.name.toLowerCase().includes(search);
      });
    },
  },
};
</script>