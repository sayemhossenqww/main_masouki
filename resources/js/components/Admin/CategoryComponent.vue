<template>
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <button
            class="btn btn-primary btn-sm float-end px-4 ms-2"
            data-bs-toggle="modal"
            data-bs-target="#categoryModal"
          >
            <MtIcon icon="add"></MtIcon> Add New Category
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
              <th>Category Name</th>
              <th>Sort Order</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="category in categoryList" :key="category.id">
              <td>
                <div class="d-flex align-items-center">
                  <div>
                    <picture>
                      <source type="image/jpg" :srcset="category.image_url" />
                      <img
                        :alt="category.name"
                        :src="category.image_url"
                        aria-hidden="true"
                        class="rounded-0 me-2"
                      />
                    </picture>
                  </div>
                  <div>
                    {{ category.name }}
                  </div>
                </div>
              </td>
              <td>{{ category.sort_order }}</td>
              <td>
                <div class="form-check form-switch">
                  <input
                    class="form-check-input cursor-pointer"
                    type="checkbox"
                    id="flexSwitchCheckChecked"
                    :checked="category.active"
                    v-on:change="updateStatus(category.id)"
                  />
                  <label class="form-check-label" for="flexSwitchCheckChecked">
                    {{ category.status }}
                  </label>
                </div>
              </td>
              <td>
                <button
                  class="btn btn-info btn-xs"
                  data-bs-toggle="modal"
                  data-bs-target="#editCategoryModal"
                  v-on:click="openEditModal(category)"
                >
                  <MtIcon icon="edit"></MtIcon>
                  Edit
                </button>

                <button
                  class="btn btn-danger btn-xs"
                  v-on:click="deleteCategory(category.id)"
                >
                  <MtIcon icon="delete"></MtIcon>
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="text-center" v-if="categoryList.length == 0">
          <h6>No Data</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Create -->
  <div
    class="modal fade"
    id="categoryModal"
    tabindex="-1"
    aria-labelledby="categoryModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restoreFormControl"
          ></button>
        </div>
        <form @submit.prevent="storeCategory">
          <div class="modal-body">
            <div class="mb-3 text-center">
              <label
                for="input-image"
                class="cursor-pointer position-relative rounded-3"
                :class="{
                  'border border-dark': !imageUrl,
                }"
                style="width: 140px; height: 140px"
              >
                <img
                  :src="imageUrl"
                  class="img-lg rounded-3 object-fit-cover border border-dark"
                  alt="placeholder-image"
                  v-if="imageUrl"
                />
                <div
                  class="position-absolute top-50 start-50 translate-middle"
                  v-if="!imageUrl"
                >
                  <div class="">
                    <MtIcon
                      icon="add_photo_alternate"
                      styleName="fs-1"
                    ></MtIcon>
                  </div>
                  <div class="fw-bold">Choose Image</div>
                </div>
              </label>

              <div class="text-danger" v-if="errors.hasOwnProperty('image')">
                {{ errors.image[0] }}
              </div>
              <input
                id="input-image"
                class="d-none"
                type="file"
                name="input-image"
                accept="image/x-png, image/jpeg, image/jpg"
                value=""
                @change="openImage"
              />
            </div>

            <div class="mb-3">
              <label for="name" class="form-label">Category Name</label>
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
              <label for="sort-order" class="form-label"> Sort Order </label>
              <input
                type="number"
                class="form-control"
                v-model="data.sort_order"
                step="1"
                min="1"
                id="sort-order"
                :class="{ 'is-invalid': errors.hasOwnProperty('sort_order') }"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('sort_order')"
              >
                {{ errors.sort_order[0] }}
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
    id="editCategoryModal"
    tabindex="-1"
    aria-labelledby="editCategoryModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restoreFormControl"
          ></button>
        </div>
        <form @submit.prevent="updateCategory(editData.id)">
          <div class="modal-body">
            <div class="mb-3 text-center">
              <label
                for="input-image-edit"
                class="cursor-pointer position-relative rounded-3"
                :class="{
                  'border border-dark': !editData.image_url,
                }"
                style="width: 140px; height: 140px"
              >
                <img
                  :src="editData.image_url"
                  class="img-lg rounded-3 object-fit-cover border border-dark"
                  alt="placeholder-image"
                  v-if="editData.image_url"
                />
                <div
                  class="position-absolute top-50 start-50 translate-middle"
                  v-if="!editData.image_url"
                >
                  <div class="">
                    <MtIcon
                      icon="add_photo_alternate"
                      styleName="fs-1"
                    ></MtIcon>
                  </div>
                  <div class="fw-bold">Choose Image</div>
                </div>
              </label>

              <div class="text-danger" v-if="errors.hasOwnProperty('image')">
                {{ errors.image[0] }}
              </div>
              <input
                id="input-image-edit"
                class="d-none"
                type="file"
                name="input-image-edit"
                accept="image/x-png, image/jpeg, image/jpg"
                value=""
                @change="openImageEdit"
              />
            </div>
            <div class="mb-3">
              <label for="name-edit" class="form-label">Category Name</label>
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
              <label for="sort-order-edit" class="form-label">Sort Order</label>
              <input
                type="number"
                class="form-control"
                v-model="editData.sort_order"
                step="1"
                min="1"
                id="sort-order-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('sort_order') }"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('sort_order')"
              >
                {{ errors.sort_order[0] }}
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
export default {
  data() {
    return {
      categories: [],
      search: "",
      data: {
        name: "",
        sort_order: 1,
        image: "",
      },
      imageUrl: "",
      editData: {
        id: "",
        name: "",
        sort_order: 1,
        image: "",
        image_url: "",
        image_path: "",
        _method: "PUT",
      },
      errors: {},
      loading: false,
    };
  },
  mounted() {},
  methods: {
    fetchCategories() {
      topbar.show();
      axios
        .get("/admin/categories/all")
        .then((response) => {
          this.categories = response.data.data;
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
      this.fetchCategories();
    },

    deleteCategory(id) {
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
            .delete(`/admin/categories/${id}`)
            .then((response) => {
              if (response.status == 200) {
                this.fetchCategories();
                this.$toast.success("Category has been deleted");
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
    storeCategory() {
      this.errors = {};
      topbar.show();
      this.loading = true;
      const formData = new FormData();
      formData.append("image", this.data.image);
      formData.append("name", this.data.name);
      formData.append("sort_order", this.data.sort_order);
      axios
        .post("/admin/categories", formData)
        .then((response) => {
          this.fetchCategories();
          this.data.name = "";
          this.data.sort_order = 1;
          this.$toast.success("New category added");
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

    updateCategory(id) {
      this.errors = {};
      topbar.show();
      this.loading = true;
      const formData = new FormData();
      formData.append("image", this.editData.image);
      formData.append("name", this.editData.name);
      formData.append("sort_order", this.editData.sort_order);
      formData.append("_method", "PUT");
      axios
        .post(`/admin/categories/${id}`, formData)
        .then((response) => {
          this.fetchCategories();
          this.$toast.success("Category has been updated");
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
    openEditModal(category) {
      this.editData.id = category.id;
      this.editData.name = category.name;
      this.editData.sort_order = category.sort_order;
      this.editData.image = "";
      if (category.image_path) {
        this.editData.image_url = category.image_url;
        this.editData.image_path = category.image_path;
      } else {
        this.editData.image_url = null;
        this.editData.image_path = null;
      }
    },

    updateStatus(id) {
      topbar.show();
      axios
        .put(`/admin/categories/status/${id}`)
        .then((response) => {
          this.fetchCategories();
          this.$toast.success("Category has been updated");
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .then(() => {
          topbar.hide();
        });
    },
    restoreFormControl() {
      this.errors = {};
    },
    openImage(event) {
      var file = event.target.files[0];
      if (file) {
        this.data.image = event.target.files[0];
        this.imageUrl = URL.createObjectURL(this.data.image);
      } else {
        this.data.image = this.data.image;
        this.imageUrl = this.imageUrl;
      }
    },
    openImageEdit(event) {
      var file = event.target.files[0];
      if (file) {
        this.editData.image = event.target.files[0];
        this.editData.image_url = URL.createObjectURL(this.editData.image);
      } else {
        this.editData.image = this.editData.image;
        this.editData.image_url = this.editData.image_url;
      }
    },
  },

  created: function () {
    this.fetchCategories();
  },
  computed: {
    categoryList() {
      const search = this.search.toLowerCase();
      if (!search) return this.categories;
      return this.categories.filter((category) => {
        return category.name.toLowerCase().includes(search);
      });
    },
  },
};
</script>
