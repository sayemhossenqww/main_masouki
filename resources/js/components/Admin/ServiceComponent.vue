<template>
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <button
            class="btn btn-primary btn-sm float-end px-4 ms-2"
            data-bs-toggle="modal"
            data-bs-target="#serviceModal"
          >
            <MtIcon icon="add"></MtIcon> Add New Service
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
      <DataTable
        :value="serviceList"
        stripedRows
        showGridlines
        responsiveLayout="scroll"
        :paginator="true"
        :rows="20"
        :loading="loadingData"
      >
        <template #empty>
          <div class="text-center">
            <h6>No Data</h6>
          </div>
        </template>

        <template #loading>
          <div class="text-center">
            <h6>Loading...</h6>
          </div>
        </template>

        <Column
          field="name"
          header="Service name"
          :sortable="true"
        ></Column>
        <Column
          field="category_name"
          header="Category"
          :sortable="true"
        ></Column>
        <Column field="cost" header="Cost in US Dollar" :sortable="true">
          <template #body="slotProps">
            {{ slotProps.data.cost }}
            <DiscountBadge v-if="slotProps.data.has_discount"></DiscountBadge>
          </template>
        </Column>
        <Column field="price" header="Price in US Dollar" :sortable="true">
          <template #body="slotProps">
            {{ slotProps.data.price }}
            <DiscountBadge v-if="slotProps.data.has_discount"></DiscountBadge>
          </template>
        </Column>
        <Column header=" " :sortable="false">
          <template #body="slotProps">
            <div class="dropdown">
              <button
                class="btn btn-link text-dark"
                type="button"
                id="dropdownMenuButton"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <MtIcon icon="more_vert"></MtIcon>
              </button>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                  <button
                    class="dropdown-item text-info"
                    data-bs-toggle="modal"
                    data-bs-target="#editServiceModal"
                    v-on:click="openEditModal(slotProps.data)"
                  >
                    <MtIcon icon="edit" styleName="me-2"></MtIcon> Edit
                  </button>
                </li>
                <li>
                  <button
                    class="dropdown-item text-danger"
                    v-on:click="deleteService(slotProps.data.id)"
                  >
                    <MtIcon icon="delete" styleName="me-2"></MtIcon> Delete
                  </button>
                </li>
              </ul>
            </div>
          </template>
        </Column>
      </DataTable>
    </div>
  </div>

  <!-- Modal Create -->
  <div
    class="modal fade"
    id="serviceModal"
    tabindex="-1"
    aria-labelledby="serviceModalLabel"
    aria-hidden="true"
  >
    <div
      class="
        modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down
      "
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="serviceModalLabel">Add New Service</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restoreFormControl"
          ></button>
        </div>

        <form @submit.prevent="storeService">
          <div class="modal-body">

            <div class="mb-3">
              <label for="category_name" class="form-label">Category</label>
              <input
                type="text"
                class="form-control"
                v-model="data.category_name"
                id="category_name"
                :class="{ 'is-invalid': errors.hasOwnProperty('category_name') }"
                name="category_name"
                list="category_name-list"
              />
              <datalist
                id="category_name-list"
              >
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.category_name }}
                </option>
              </datalist>

              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('category_name')"
              >
                {{ errors.category_name[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="name" class="form-label">Service Name</label>
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

            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="price" class="form-label">
                  Price (US Dollar)
                </label>
                <input
                  type="number"
                  class="form-control"
                  v-model="data.price"
                  step="0.01"
                  min="0"
                  id="price"
                  :class="{ 'is-invalid': errors.hasOwnProperty('price') }"
                />
                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('price')"
                >
                  {{ errors.price[0] }}
                </div>
              </div>
              <div class="col-md-12 mb-3">
                Price Preview: <span class="fw-bold">{{ pricePreview }}</span>
              </div>

              <div class="col-md-12 mb-3">
                <label for="cost" class="form-label"> Cost (US Dollar) </label>
                <input
                  type="number"
                  class="form-control"
                  v-model="data.cost"
                  step="0.01"
                  min="0"
                  id="cost"
                  :class="{ 'is-invalid': errors.hasOwnProperty('cost') }"
                />
                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('cost')"
                >
                  {{ errors.cost[0] }}
                </div>
              </div>
              <div class="col-md-12 mb-3">
                Cost Preview: <span class="fw-bold">{{ costPreview }}</span>
              </div>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label"> Description </label>
              <ckeditor
                :editor="editor"
                v-model="data.description"
                :config="editorConfig"
              ></ckeditor>
              <div class="text-danger" v-if="errors.hasOwnProperty('description')">
                {{ errors.description[0] }}
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
                v-on:click="restoreFormControl"
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
    id="editServiceModal"
    tabindex="-1"
    aria-labelledby="editServiceModalLabel"
    aria-hidden="true"
  >
    <div
      class="
        modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down
      "
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editServiceModalLabel">Edit Item</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restoreFormControl"
          ></button>
        </div>
        <form @submit.prevent="updateService(editData.id)">
          <div class="modal-body">

            <div class="mb-3">
              <label for="category_name-edit" class="form-label">Category</label>
              <input
                type="text"
                class="form-control"
                v-model="editData.category_name"
                id="category_name-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('category_name') }"
                name="category_name"
                list="category_name-list"
              />
              <datalist
                id="category_name-list"
              >
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.category_name }}
                </option>
              </datalist>

              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('category_name')"
              >
                {{ errors.category_name[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="name-edit" class="form-label">Service Name</label>
              <input
                type="text"
                class="form-control"
                v-model="editData.name"
                id="name-edit"
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

            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="price-edit" class="form-label">
                  Price (US Dollar)
                </label>
                <input
                  type="number"
                  class="form-control"
                  v-model="editData.price"
                  step="0.01"
                  min="0"
                  id="price-edit"
                  :class="{ 'is-invalid': errors.hasOwnProperty('price') }"
                />
                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('price')"
                >
                  {{ errors.price[0] }}
                </div>
              </div>

              <div class="col-md-12 mb-3">
                Price Preview:
                <span class="fw-bold">{{ pricePreviewEdit }}</span>
              </div>
              <div class="col-md-12 mb-3">
                <label for="cost-edit" class="form-label">
                  Cost (US Dollar)
                </label>
                <input
                  type="number"
                  class="form-control"
                  v-model="editData.cost"
                  step="0.01"
                  min="0"
                  id="cost-edit"
                  :class="{ 'is-invalid': errors.hasOwnProperty('cost') }"
                />
                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('cost')"
                >
                  {{ errors.cost[0] }}
                </div>
              </div>
              <div class="col-md-12 mb-3">
                Cost Preview:
                <span class="fw-bold">{{ costPreviewEdit }}</span>
              </div>
            </div>

            <div class="mb-3">
              <label for="description-edit" class="form-label"> Description </label>
              <ckeditor
                :editor="editor"
                v-model="editData.des"
                :config="editorConfig"
              ></ckeditor>
              <div class="text-danger" v-if="errors.hasOwnProperty('description')">
                {{ errors.description[0] }}
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
                v-on:click="restoreFormControl"
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import PropertyBadgeComponent from "../Shared/PropertyBadgeComponent";
export default {
  components: { PropertyBadgeComponent },
  props: ["usdRateValue"],
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        toolbar: [
          "heading",
          "|",
          "bold",
          "italic",
          "link",
          "bulletedList",
          "numberedList",
          "blockQuote",
        ],
      },
      services: [],
      categories: [],
      search: "",
      data: {
        name: "",
        category_name: "",
        price: 0,
        cost: 0,
      },
      editData: {
        name: "",
        category_name: "",
        price: 0,
        cost: 0,
      },
      errors: {},
      loading: false,
      loadingData: true,
    };
  },
  mounted() {},
  methods: {
    fetchServices() {
      topbar.show();
      axios
        .get("/admin/services/all")
        .then((response) => (this.services = response.data.data))
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .finally(() => {
          topbar.hide();
          this.loadingData = false;
        });
    },

    fetchCategories() {
      axios
        .get("/admin/services/getCategories")
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch(({ response }) => {
          Swal.fire("Error ", "Could not fetch categories", "error");
        });
    },

    refreshTable() {
      this.fetchServices();
      this.fetchCategories();
    },

    resetForm() {
      this.data.name = "";
      this.data.price = 0;
      this.data.cost = 0;
      this.data.desription = "";
      this.data.category_name = "";
    },

    storeService() {
      this.errors = {};
      topbar.show();
      this.loading = true;
      const formData = new FormData();
      formData.append("name", this.data.name);
      formData.append("category_name", this.data.category_name);
      formData.append("price", this.data.price);
      formData.append("cost", this.data.cost);
      formData.append("desription", this.data.desription || "");

      axios
        .post("/admin/services", formData)
        .then((response) => {
          this.fetchServices();
          this.resetForm();
          this.$toast.success("Service has been created.");
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

    updateService(id) {
      this.errors = {};
      topbar.show();
      this.loading = true;
      const formData = new FormData();
      formData.append("name", this.editData.name);
      formData.append("category_name", this.editData.category_name);       
      formData.append("price", this.editData.price);
      formData.append("cost", this.editData.cost);
      formData.append("desription", this.editData.desription || "");
      formData.append("_method", "PUT");

      axios
        .post(`/admin/services/${id}`, formData)
        .then((response) => {
          this.fetchServices();
          this.$toast.success("Service updated");
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
    openEditModal(service) {
      this.editData.id = service.id;
      this.editData.name = service.name;
      this.editData.price = service.price;
      this.editData.cost = service.cost;
      this.editData.description = service.description;
      this.editData.category_name = service.category_name;
    },

    deleteService(id) {
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
            .delete(`/admin/services/${id}`)
            .then((response) => {
              if (response.status == 200) {
                this.fetchServices();
                this.$toast.success("Serivce deleted");
              }
            })
            .catch(({ response }) => {
              Swal.fire(
                "Error " + response.status,
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
  },
  created: function () {
    console.log(this.usdRateValue);
    this.fetchServices();
    console.log(this.categories);
    this.fetchCategories();
    console.log("Categories");
    console.log(this.categories);
  },
  computed: {
    serviceList() {
      const search = this.search.toLowerCase();
      if (!search) return this.services;
      return this.services.filter((service) => {
        return (
          service.name.toLowerCase().includes(search) ||
          service.category_name.toLowerCase().includes(search)
        );
      });
    },
  }
};
</script>
