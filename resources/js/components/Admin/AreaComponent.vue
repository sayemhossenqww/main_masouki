<template>
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <button
            class="btn btn-primary btn-sm float-end px-4 ms-2"
            data-bs-toggle="modal"
            data-bs-target="#areaModal"
          >
            <MtIcon icon="add"></MtIcon> Add New Area
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
              <th>Area Name</th>
              <th>Delivery Charge</th>
              <th>Delivery Time</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="area in areaList" :key="area.id">
              <td>{{ area.name }}</td>
              <td>{{ area.view_fee }}</td>
              <td>{{ area.view_time }}</td>
              <td>
                <div class="form-check form-switch">
                  <input
                    class="form-check-input cursor-pointer"
                    type="checkbox"
                    id="flexSwitchCheckChecked"
                    :checked="area.active"
                    v-on:change="updateStatus(area.id)"
                  />
                  <label class="form-check-label" for="flexSwitchCheckChecked">
                    {{ area.status }}
                  </label>
                </div>
              </td>
              <td>
                <button
                  class="btn btn-info btn-xs"
                  data-bs-toggle="modal"
                  data-bs-target="#editAreaModal"
                  v-on:click="openEditModal(area)"
                >
                 <MtIcon icon="edit"></MtIcon>
                  Edit
                </button>

                <button
                  class="btn btn-danger btn-xs"
                  v-on:click="deleteArea(area.id)"
                >
                  <MtIcon icon="delete"></MtIcon>
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="text-center" v-if="areaList.length == 0">
          <h6>No Data</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Create -->
  <div
    class="modal fade"
    id="areaModal"
    tabindex="-1"
    aria-labelledby="areaModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="areaModalLabel">Add New Area</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restorFormControl"
          ></button>
        </div>
        <form @submit.prevent="storeArea">
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Area Name</label>
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
            <div class="mb-3">
              <label for="fee" class="form-label"> Delivery Charge <span class="small text-muted">(LBP)</span></label>
              <input
                type="number"
                class="form-control"
                v-model="data.fee"
                step="0.1"
                min="0"
                id="fee"
                :class="{ 'is-invalid': errors.hasOwnProperty('fee') }"
              />
              <div class="invalid-feedback" v-if="errors.hasOwnProperty('fee')">
                {{ errors.fee[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="time" class="form-label"> Delivery time <span class="small text-muted">(in minutes)</span> </label>
              <input
                type="number"
                class="form-control"
                v-model="data.time"
                step="1"
                min="0"
                id="time"
                :class="{ 'is-invalid': errors.hasOwnProperty('time') }"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('time')"
              >
                {{ errors.time[0] }}
              </div>
            </div>
          </div>
           <div class="row p-0 m-0 border-top">
              <div class="col-6 p-0">
                <button
                  type="button"
                  class="btn btn-link w-100 m-0 text-danger btn-lg text-decoration-none rounded-0 border-end"
                  data-bs-dismiss="modal"
                  v-on:click="restorFormControl"
                >
                  Cancel
                </button>
              </div>
              <div class="col-6 p-0">
                <button
                  type="submit"
                  class="btn btn-link w-100 m-0 text-black btn-lg text-decoration-none rounded-0 border-start"
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
    id="editAreaModal"
    tabindex="-1"
    aria-labelledby="editAreaModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editAreaModalLabel">Edit Area</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restorFormControl"
          ></button>
        </div>
        <form @submit.prevent="updateArea(editData.id)">
          <div class="modal-body">
            <div class="mb-3">
              <label for="name-edit" class="form-label">Area Name</label>
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
            <div class="mb-3">
              <label for="fee-edit" class="form-label">Delivery Charge <span class="small text-muted">(LBP)</span></label>
              <input
                type="number"
                class="form-control"
                v-model="editData.fee"
                step="0.1"
                min="0"
                id="fee-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('fee') }"
              />
              <div class="invalid-feedback" v-if="errors.hasOwnProperty('fee')">
                {{ errors.fee[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="time-edit" class="form-label">Delivery Time <span class="small text-muted">(in minutes)</span></label>
              <input
                type="number"
                class="form-control"
                v-model="editData.time"
                step="1"
                min="0"
                id="time-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('time') }"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('time')"
              >
                {{ errors.time[0] }}
              </div>
            </div>
          </div>
            <div class="row p-0 m-0 border-top">
              <div class="col-6 p-0">
                <button
                  type="button"
                  class="btn btn-link w-100 m-0 text-danger btn-lg text-decoration-none rounded-0 border-end"
                  data-bs-dismiss="modal"
                  v-on:click="restorFormControl"
                >
                  Cancel
                </button>
              </div>
              <div class="col-6 p-0">
                <button
                  type="submit"
                  class="btn btn-link w-100 m-0 text-black btn-lg text-decoration-none rounded-0 border-start"
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
      areas: [],
      search: "",
      data: {
        name: "",
        fee: 0,
        time: 0,
      },

      editData: {
        id: "",
        name: "",
        fee: 0,
        time: 0,
        _method: "PUT",
      },
      errors: {},
      loading: false,
    };
  },
  mounted() {},
  methods: {
    fetchAreas() {
      topbar.show();
      axios
        .get("/admin/areas/all")
        .then((response) => {
          this.areas = response.data.data;
          // Set the initial number of items
          //this.totalRows = this.items.length;
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .then(() => {
          topbar.hide();
        });
    },
    refreshTable() {
      this.fetchAreas();
    },

    deleteArea(id) {
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
            .delete("/admin/areas/" + id)
            .then((response) => {
              if (response.status == 200) {
                this.fetchAreas();
                this.$toast.success("Area has been deleted");
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
    storeArea() {
      this.errors = {};
      topbar.show();
      this.loading = true;

      axios
        .post("/admin/areas", this.data)
        .then((response) => {
          this.fetchAreas();
          this.data.name = "";
          this.data.fee = 0;
          this.data.time = 0;
          this.$toast.success("New area added");
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

    updateArea(id) {
      this.errors = {};
      topbar.show();
      this.loading = true;

      axios
        .post("/admin/areas/" + id, this.editData)
        .then((response) => {
          this.fetchAreas();
          this.$toast.success("Area has been updated");
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
    openEditModal(area) {
      this.editData.id = area.id;
      this.editData.name = area.name;
      this.editData.fee = area.fee;
      this.editData.time = area.time;
    },

    updateStatus(id) {
      topbar.show();
      axios
        .put("/admin/areas/status/" + id)
        .then((response) => {
          this.fetchAreas();
          this.$toast.success("Area has been updated");
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
    this.fetchAreas();
  },
  computed: {
    areaList() {
      const search = this.search.toLowerCase();
      if (!search) return this.areas;
      return this.areas.filter((area) => {
        return (
          area.name.toLowerCase().includes(search) ||
          area.view_fee.toString().toLowerCase().includes(search) ||
          area.time.toString().toLowerCase().includes(search)
        );
      });
    },
  },
};
</script>
