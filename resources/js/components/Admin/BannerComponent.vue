<template>
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <button
            class="btn btn-primary btn-sm float-end px-4 ms-2"
            data-bs-toggle="modal"
            data-bs-target="#itemModal"
          >
            <MtIcon icon="add"></MtIcon> Add New Banner
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
          <div class="position-relative w-auto float-end d-none">
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
              <th>Image</th>
              <th>Sort Order</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="banner in bannerList" :key="banner.id">
              <td>
                <img
                  :src="banner.image_url"
                  alt="banner"
                  class="object-fit-cover rounded-3"
                  style="width: 570px; height: 190px"
                />
              </td>
              <td>{{ banner.sort_order }}</td>
              <td>
                <div class="form-check form-switch">
                  <input
                    class="form-check-input cursor-pointer"
                    type="checkbox"
                    id="flexSwitchCheckChecked"
                    :checked="banner.active"
                    v-on:change="updateStatus(banner.id)"
                  />
                  <label class="form-check-label" for="flexSwitchCheckChecked">
                    {{ banner.status }}
                  </label>
                </div>
              </td>
              <td>
                <button
                  class="btn btn-info btn-xs me-md-2"
                  data-bs-toggle="modal"
                  data-bs-target="#editBannerModal"
                  v-on:click="openEditModal(banner)"
                >
                  Edit
                </button>

                <button
                  class="btn btn-danger btn-xs"
                  v-on:click="deleteBanner(banner.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="text-center" v-if="bannerList.length == 0">
          <h6>No Data</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Create -->
  <div
    class="modal fade"
    id="itemModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">Add New Banner</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restoreFormControl"
          ></button>
        </div>

        <form @submit.prevent="storeBanner">
          <div class="modal-body">
            <div class="mb-3 text-center">
              <label
                for="input-image"
                class="cursor-pointer position-relative rounded-3"
                :class="{
                  'border border-dark': !imageUrl,
                }"
                style="width: 570px; height: 190px"
              >
                <img
                  :src="imageUrl"
                  class="rounded-3 object-fit-cover border border-dark"
                  alt="placeholder-image"
                  style="width: 570px; height: 190px"
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
              <label for="link" class="form-label fw-bold">Link</label>
              <input
                type="text"
                class="form-control"
                v-model="data.link"
                id="link"
                :class="{ 'is-invalid': errors.hasOwnProperty('link') }"
                name="link"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('link')"
              >
                {{ errors.link[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="sort_order" class="form-label fw-bold">
                Sort Order
              </label>
              <input
                type="number"
                class="form-control"
                v-model="data.sort_order"
                step="1"
                min="0"
                F
                id="sort_order"
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
    id="editBannerModal"
    tabindex="-1"
    aria-labelledby="editBannerModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBannerModalLabel">Edit Banner</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restoreFormControl"
          ></button>
        </div>
        <form @submit.prevent="updateBanner(editData.id)">
          <div class="modal-body">
            <div class="mb-3 text-center">
              <label
                for="input-image-edit"
                class="cursor-pointer position-relative rounded-3"
                :class="{
                  'border border-dark': !editData.image_url,
                }"
                style="width: 570px; height: 190px"
              >
                <img
                  :src="editData.image_url"
                  class="rounded-3 object-fit-cover border border-dark"
                  alt="placeholder-image"
                  style="width: 570px; height: 190px"
                  v-if="editData.image_url"
                />
                <div
                  class="position-absolute top-50 start-50 translate-middle"
                  v-if="!editData.image_url"
                >
                  Choose Image
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
              <label for="link-edit" class="form-label fw-bold">Link</label>
              <input
                type="text"
                class="form-control"
                v-model="editData.link"
                id="link-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('link') }"
                name="link"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('link')"
              >
                {{ errors.link[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="sort_order-edit" class="form-label fw-bold">
                Sort Order
              </label>
              <input
                type="number"
                class="form-control"
                v-model="editData.sort_order"
                step="0.1"
                min="0"
                id="sort_order-edit"
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import PropertyBadgeComponent from "../Shared/PropertyBadgeComponent";
import FileUpload from "primevue/fileupload";

export default {
  components: { PropertyBadgeComponent, FileUpload },
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
      banners: [],
      pageOfItems: [],
      search: "",
      data: {
        image: "",
        link: "",
        sort_order: 1,
      },
      imageUrl: "",
      editData: {
        image_url: "",
        image_path: "",
        image: "",
        link: "",
        sort_order: 1,
      },
      errors: {},
      loading: false,
      loadingData: true,
    };
  },
  mounted() {},
  methods: {
    fetchBanners() {
      topbar.show();
      axios
        .get("/admin/bnrs/all")
        .then((response) => (this.banners = response.data.data))
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
        .get("/admin/categories/all")
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch(({ response }) => {
          Swal.fire("Error ", "Could not fetch categories", "error");
        });
    },
    refreshTable() {
      this.fetchBanners();
    },

    deleteBanner(id) {
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
            .delete(`/admin/bnrs/${id}`)
            .then((response) => {
              if (response.status == 200) {
                this.fetchBanners();
                this.$toast.success("Banner deleted");
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
    storeBanner() {
      this.errors = {};
      topbar.show();
      this.loading = true;
      const formData = new FormData();
      formData.append("image", this.data.image);
      formData.append("sort_order", this.data.sort_order);
      formData.append("link", this.data.link || "");

      const config = { headers: { "Content-Type": "multipart/form-data" } };
      axios
        .post("/admin/bnrs", formData, config)
        .then((response) => {
          this.fetchBanners();
          this.resetForm();
          this.$toast.success("Banner has been added");
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

    updateBanner(id) {
      this.errors = {};
      topbar.show();
      this.loading = true;
      const formData = new FormData();
      formData.append("image", this.editData.image);
      formData.append("sort_order", this.editData.sort_order);
      formData.append("link", this.editData.link);
      formData.append("_method", "PUT");

      const config = { headers: { "Content-Type": "multipart/form-data" } };
      axios
        .post(`/admin/bnrs/${id}`, formData, config)
        .then((response) => {
          this.fetchBanners();
          this.$toast.success("Banner updated");
          let updatedItem = response.data.data;
          this.openEditModal(updatedItem);
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
    openEditModal(banner) {
      this.editData.id = banner.id;
      this.editData.link = banner.link || "";
      this.editData.sort_order = banner.sort_order;
      this.editData.image = "";
      this.editData.image_url = banner.image_url;
      this.editData.image_path = banner.image_path;
    },

    updateStatus(id) {
      topbar.show();
      axios
        .put(`/admin/bnrs/status/${id}`)
        .then((response) => {
          this.fetchBanners();
          this.$toast.success("Banner updated");
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .finally(() => topbar.hide());
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

    resetForm() {
      this.data.link = "";
      this.data.image = "";
      this.data.sort_order = 1;
      this.imageUrl = "";
    },
  },

  created: function () {
    this.fetchBanners();
  },
  computed: {
    bannerList() {
      return this.banners;
      // const search = this.search.toLowerCase();
      // if (!search) return this.banners;
      // return this.banners.filter((banner) => {
      //   return (
      //     item.name.toLowerCase().includes(search) ||
      //     item.category.name.toLowerCase().includes(search)
      //   );
      // });
    },
  },
};
</script>