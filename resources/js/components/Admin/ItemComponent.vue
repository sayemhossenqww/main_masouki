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
            <MtIcon icon="add"></MtIcon> Add New Item
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
        :value="itemList"
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

        <Column field="name" header="Item Name" :sortable="true">
          <template #body="slotProps">
            <div class="d-flex align-items-center mb-2">
              <div class="flex-shrink-0">
                <a :href="slotProps.data.url" target="_blank">
                  <div class="item-image-wrapper-sm">
                    <picture>
                      <source
                        type="image/jpg"
                        :srcset="slotProps.data.image_url"
                      />
                      <img
                        :alt="slotProps.data.name"
                        :src="slotProps.data.image_url"
                        aria-hidden="true"
                        class="img-sm rounded-circle"
                      />
                    </picture>
                  </div>
                </a>
              </div>
              <div class="flex-grow-1 ms-2">
                <a
                  :href="slotProps.data.url"
                  class="link-primary"
                  target="_blank"
                >
                  {{ slotProps.data.name }}
                </a>
              </div>
            </div>
            <div>
              <property-badge-component
                :item="slotProps.data"
              ></property-badge-component>
            </div>
          </template>
        </Column>
        <Column
          field="category.name"
          header="Category"
          :sortable="true"
        ></Column>
        <Column field="price" header="Price in LL" :sortable="true">
          <template #body="slotProps">
            {{ slotProps.data.view_price }}
            <DiscountBadge v-if="slotProps.data.has_discount"></DiscountBadge>
          </template>
        </Column>
        <Column field="price" header="Price in US Dollar" :sortable="true">
          <template #body="slotProps">
            {{ slotProps.data.view_price_usd }}
            <DiscountBadge v-if="slotProps.data.has_discount"></DiscountBadge>
          </template>
        </Column>
        <Column field="active" header="Status" :sortable="true">
          <template #body="slotProps">
            <div class="form-check form-switch">
              <input
                class="form-check-input cursor-pointer"
                type="checkbox"
                id="flexSwitchCheckChecked"
                :checked="slotProps.data.active"
                v-on:change="updateStatus(slotProps.data.id)"
              />
              <label class="form-check-label" for="flexSwitchCheckChecked">
                {{ slotProps.data.status }}
              </label>
            </div>
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
                    class="dropdown-item"
                    v-on:click="copyLinkToClipBoard(slotProps.data)"
                  >
                    <MtIcon icon="content_copy" styleName="me-2"></MtIcon>
                    Copie Link
                  </button>
                </li>

                <li>
                  <a
                    class="dropdown-item"
                    :href="slotProps.data.url"
                    target="_blank"
                  >
                    <MtIcon icon="open_in_new" styleName="me-2"></MtIcon> Open
                    in new tab
                  </a>
                </li>
                <li>
                  <a
                    class="dropdown-item"
                    :href="
                      'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' +
                      slotProps.data.url
                    "
                    target="_blank"
                  >
                    <MtIcon icon="qr_code" styleName="me-2"></MtIcon> QR Code
                  </a>
                </li>
                <li>
                  <button
                    class="dropdown-item"
                    @click="shareToFacebook(slotProps.data.url)"
                  >
                    <img
                      src="/images/webp/social-icons/facebook.webp"
                      height="20"
                      alt="facebook"
                      class="me-2"
                    />
                    Share on Facebook
                  </button>
                </li>
                <li>
                  <button
                    class="dropdown-item"
                    @click="tweet(slotProps.data.url)"
                  >
                    <img
                      src="/images/webp/social-icons/twitter.webp"
                      height="20"
                      alt="twitter"
                      class="me-2"
                    />
                    Tweet about this
                  </button>
                </li>
                <li>
                  <button
                    class="dropdown-item"
                    @click="sendViaWhatsApp(slotProps.data.url)"
                  >
                    <img
                      src="/images/webp/social-icons/whatsapp.webp"
                      height="20"
                      alt="whatsapp"
                      class="me-2"
                    />
                    Share via WhatsApp
                  </button>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <button
                    class="dropdown-item"
                    data-bs-toggle="modal"
                    data-bs-target="#addServiceModal"
                    v-on:click="openEditModal(slotProps.data)"
                  >
                    <MtIcon icon="post_add" styleName="me-2"></MtIcon>
                    Services
                  </button>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <button
                    class="dropdown-item text-info"
                    data-bs-toggle="modal"
                    data-bs-target="#editItemModal"
                    v-on:click="openEditModal(slotProps.data)"
                  >
                    <MtIcon icon="edit" styleName="me-2"></MtIcon> Edit
                  </button>
                </li>

                <li>
                  <button
                    class="dropdown-item"
                    v-on:click="replicate(slotProps.data.id)"
                  >
                    <MtIcon icon="copy_all" styleName="me-2"></MtIcon>
                    Replicate
                  </button>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <button
                    class="dropdown-item text-danger"
                    v-on:click="deleteItem(slotProps.data.id)"
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
    id="itemModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    <div
      class="
        modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down
      "
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">Add New Item</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restoreFormControl"
          ></button>
        </div>

        <form @submit.prevent="storeItem">
          <div class="modal-body">
            <div class="mb-3 text-center">
              <label
                for="input-image"
                class="
                  cursor-pointer
                  position-relative
                  border border-dark
                  rounded-3
                "
                style="width: 140px; height: 140px"
              >
                <img
                  :src="imageUrl"
                  class="img-lg rounded-3"
                  alt="placeholder-image"
                  v-if="imageUrl"
                />
                <div
                  class="position-absolute top-50 start-50 translate-middle"
                  v-if="!imageUrl"
                >
                  Choose Image
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
              <label for="category" class="form-label">Category </label>
              <a
                href="#"
                class="link-primary float-end"
                data-bs-toggle="modal"
                data-bs-target="#addCategoryModal"
                >+ Add New Category</a
              >
              <select
                class="form-select rounded-main"
                v-model="data.category"
                id="category"
                :class="{ 'is-invalid': errors.hasOwnProperty('category') }"
                name="category"
              >
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.name }}
                </option>
              </select>

              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('category')"
              >
                {{ errors.category[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="name" class="form-label">Item Name</label>
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
              <label for="modifiers" class="form-label">Item Modifiers (BruvsKiosk)</label>
              <input
                type="text"
                class="form-control"
                v-model="data.modifiers"
                id="modifiers"
                :class="{ 'is-invalid': errors.hasOwnProperty('modifiers') }"
                name="modifiers"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('modifiers')"
              >
                {{ errors.modifiers[0] }}
              </div>
            </div>
            <div class="mb-3">
              <label for="removable_ingredients" class="form-label">Item Removable Ingredients (BruvsKiosk)</label>
              <input
                type="text"
                class="form-control"
                v-model="data.removable_ingredients"
                id="removable_ingredients"
                :class="{ 'is-invalid': errors.hasOwnProperty('removable_ingredients') }"
                name="removable_ingredients"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('removable_ingredients')"
              >
                {{ errors.removable_ingredients[0] }}
              </div>
            </div>


            <div class="row">
              <div class="col-md-6 mb-3">
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

              <div class="col-md-6 mb-3">
                <label for="discount" class="form-label">
                  Discount Percentage (%)
                </label>
                <input
                  type="number"
                  class="form-control"
                  v-model="data.discount"
                  step="0.1"
                  min="0"
                  max="100"
                  id="discount"
                  :class="{ 'is-invalid': errors.hasOwnProperty('discount') }"
                />
                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('discount')"
                >
                  {{ errors.discount[0] }}
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
              <label for="des" class="form-label"> Description </label>
              <ckeditor
                :editor="editor"
                v-model="data.des"
                :config="editorConfig"
              ></ckeditor>
              <div class="text-danger" v-if="errors.hasOwnProperty('des')">
                {{ errors.des[0] }}
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
    id="editItemModal"
    tabindex="-1"
    aria-labelledby="editItemModalLabel"
    aria-hidden="true"
  >
    <div
      class="
        modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down
      "
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            v-on:click="restoreFormControl"
          ></button>
        </div>
        <form @submit.prevent="updateItem(editData.id)">
          <div class="modal-body">
            <div class="mb-3 text-center">
              <label
                for="input-image-edit"
                class="
                  cursor-pointer
                  position-relative
                  border border-dark
                  rounded-3
                "
                style="width: 140px; height: 140px"
              >
                <img
                  :src="editData.image_url"
                  class="img-lg rounded-3"
                  alt="placeholder-image"
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
              <div>{{  editData.category }}</div>
              <label for="category-edit" class="form-label">Category </label>

              <select
                class="form-select rounded-main"
                v-model="editData.category"
                id="category-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('category') }"
                name="category"
              >
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.name }}
                </option>
              </select>

              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('category')"
              >
                {{ errors.category[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="name-edit" class="form-label">Item Name</label>
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

            <div class="mb-3">
              <label for="modifiers-edit" class="form-label">Item Modifiers (BruvsKiosk)</label>
              <input
                type="text"
                class="form-control"
                v-model="editData.modifiers"
                id="modifiers-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('modifiers') }"
                name="modifiers"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('modifiers')"
              >
                {{ errors.modifiers[0] }}
              </div>
            </div>
            <div class="mb-3">
              <label for="removable-ingredients-edit" class="form-label">Item Removable Ingredients (BruvsKiosk)</label>
              <input
                type="text"
                class="form-control"
                v-model="editData.removable_ingredients"
                id="removable-ingredients-edit"
                :class="{ 'is-invalid': errors.hasOwnProperty('removable_ingredients') }"
                name="removable_ingredients"
              />
              <div
                class="invalid-feedback"
                v-if="errors.hasOwnProperty('removable_ingredients')"
              >
                {{ errors.removable_ingredients[0] }}
              </div>
            </div>

            <div class="mb-3">
              <label for="slug-edit" class="form-label">Item Link</label>

              <div class="input-group">
                <span class="input-group-text" id="basic-addon3">
                  www.the-bruvs.com/
                </span>
                <input
                  type="text"
                  class="form-control"
                  v-model="editData.slug"
                  id="slug-edit"
                  :class="{ 'is-invalid': errors.hasOwnProperty('slug') }"
                  name="slug"
                />
                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('slug')"
                >
                  {{ errors.slug[0] }}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
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

              <div class="col-md-6 mb-3">
                <label for="discount-edit" class="form-label">
                  Discount Percentage (%)
                </label>
                <input
                  type="number"
                  class="form-control"
                  v-model="editData.discount"
                  step="0.1"
                  min="0"
                  id="discount-edit"
                  :class="{ 'is-invalid': errors.hasOwnProperty('discount') }"
                />
                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('discount')"
                >
                  {{ errors.discount[0] }}
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
              <label for="des-edit" class="form-label"> Description </label>
              <ckeditor
                :editor="editor"
                v-model="editData.des"
                :config="editorConfig"
              ></ckeditor>
              <div class="text-danger" v-if="errors.hasOwnProperty('des')">
                {{ errors.des[0] }}
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

  <!-- Add Category Modal -->
  <div
    class="modal fade"
    id="addCategoryModal"
    tabindex="-1"
    aria-labelledby="addCategoryModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">
            Add New Category
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form @submit.prevent="storeCategory">
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Category Name</label>
              <input
                type="text"
                class="form-control"
                v-model="categoryData.name"
                id="category-name"
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
                v-model="categoryData.sort_order"
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

  <!-- Add Service Modal -->
  <div
    class="modal fade"
    id="addServiceModal"
    tabindex="-1"
    aria-labelledby="addServiceModalLabel"
    aria-hidden="true"
  >
    <div
      class="
        modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down
      "
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addServiceModalLabel">
            {{ editData.name }}
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form @submit.prevent="addService(editData)">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="service" class="form-label"
                  >Categories*</label
                >
                <select
                  class="form-select rounded-main"
                  v-model="serviceData.category_name"
                  id="category"
                  :class="{ 'is-invalid': errors.hasOwnProperty('category') }"
                  name="category"
                  @change="categoryOptionSelected"
                >
                  <option
                    v-for="category in service_categories"
                    :key="category.category_name"
                    :value="category.category_name"
                  >
                    {{ category.category_name }}
                  </option>
                </select>
                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('category')"
                >
                  {{ errors.category[0] }}
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="service" class="form-label">Services*</label>
                <select
                  class="form-select rounded-main"
                  v-model="serviceData.service_id"
                  id="service"
                  :class="{ 'is-invalid': errors.hasOwnProperty('service') }"
                  name="service"
                >
                  <option
                    v-for="service in selectedServices"
                    :key="service.id"
                    :value="service.id"
                  >
                    {{ service.name }}
                  </option>
                </select>

                <div
                  class="invalid-feedback"
                  v-if="errors.hasOwnProperty('service')"
                >
                  {{ errors.service[0] }}
                </div>
              </div>
            </div>
            <div class="mb-3">
              <button
                type="submit"
                class="btn btn-primary px-4"
                :disabled="loading"
              >
                Add
              </button>
            </div>
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Service</th>
                  <th>Cost</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="service in editData.services"
                  :key="service.id"
                >
                  <td>{{ service.select_option.category_name }}</td>
                  <td>{{ service.select_option.name }}</td>
                  <td>{{ service.select_option.cost }}</td>
                  <td>{{ service.select_option.price }}</td>
                  <td class="text-end">
                    <span
                      v-on:click="deleteService(editData, service)"
                      class="cursor-pointer text-danger user-select-none"
                    >
                      <MtIcon icon="delete"></MtIcon>
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import PropertyBadgeComponent from "../Shared/PropertyBadgeComponent";
import { blr_money_format } from "@/services/utils";
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
      master_items: [],
      units: [],
      items: [],
      categories: [],
      services: [],
      selectedServices: [],
      service_categories: [],
      pageOfItems: [],
      search: "",
      categoryData: {
        name: "",
        sort_order: 1,
      },
      serviceData: {
        category_name: "",
        service_id: "",
        unit: "",
        quantity: 0,
      },
      data: {
        name: "",
        image: "",
        des: "",
        price: 0,
        cost: 0,
        discount: 0,
        category: "",
        modifiers: "",
        removable_ingredients: "",
      },
      imageUrl: "",
      editData: {
        name: "",
        slug: "",
        image: "",
        image_url: "",
        image_path: "",
        des: "",
        price: 0,
        cost: 0,
        discount: 0,
        category: "",
        ingredients: [],
        services: [],
        modifiers: "",
        removable_ingredients: "",
      },
      errors: {},
      loading: false,
      loadingData: true,
    };
  },
  mounted() {},
  methods: {
    categoryOptionSelected() {
      this.selectedServices = this.services.filter((service) => { return service.category_name.toLowerCase() === this.serviceData.category_name.toLowerCase()});
    },
    fetchItems() {
      topbar.show();
      axios
        .get("/admin/items/all")
        .then((response) => (this.items = response.data.data))
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .finally(() => {
          topbar.hide();
          this.loadingData = false;
        });
    },
    fetchMasterItems() {
      axios
        .get(
          "https://pos.the-bruvs.com/api/master-items?access_token=$2a$12$ouKUJlDrvBJDYAmUgpxFK.JcyXLj4Tq9Y1xPtX.nOm.I./Xyt.aOq"
        )
        .then((response) => {
          this.master_items = response.data.data;
        })
        .catch(({ response }) => {
          Swal.fire("Error ", "Could not fetch master items", "error");
        });
    },
    fetchUnites() {
      axios
        .get(
          "https://pos.the-bruvs.com/api/units?access_token=$2a$12$ouKUJlDrvBJDYAmUgpxFK.JcyXLj4Tq9Y1xPtX.nOm.I./Xyt.aOq"
        )
        .then((response) => {
          this.units = response.data.data;
        })
        .catch(({ response }) => {
          Swal.fire("Error ", "Could not fetch units", "error");
        });
    },
    addService(item) {
      this.errors = {};
      if (!this.serviceData.category_name) {
        this.errors = { category: ["The category field is required."] };
        return;
      }
      topbar.show();
      var serviceItem = this.services.find(
        (service) => service.id === this.serviceData.service_id
      );
      axios
        .post(`/admin/items/${item.id}/services`, {
          service: serviceItem.id,
        })
        .then((response) => {
          if (response.status == 200) {
            this.fetchItems();
            this.editData.services = response.data.data;
            this.$toast.success("services has been added.");
            this.serviceData.category_name = "";
            this.serviceData.service_id = "";
          }
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
        });
    },

    deleteService(item, service) {
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
            .delete(`/admin/items/${item.id}/services/${service.id}`)
            .then((response) => {
              if (response.status == 200) {
                this.fetchItems();
                this.editData.services = response.data.data;
                this.$toast.success("Service deleted");
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
    fetchAllServices() {
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

    fetchServiceCategories() {
      axios
        .get("/admin/services/getCategories")
        .then((response) => {
          this.service_categories = response.data.data;
        })
        .catch(({ response }) => {
          Swal.fire("Error ", "Could not fetch categories", "error");
        });
    },

    refreshTable() {
      this.fetchItems();
      // this.fetchMasterItems();
      // this.fetchUnites();
      this.fetchServiceCategories();
      this.fetchAllServices();
    },

    deleteItem(id) {
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
            .delete(`/admin/items/${id}`)
            .then((response) => {
              if (response.status == 200) {
                this.fetchItems();
                this.$toast.success("Item deleted");
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
    storeItem() {
      this.errors = {};
      topbar.show();
      this.loading = true;
      const formData = new FormData();
      formData.append("image", this.data.image);
      formData.append("name", this.data.name);
      formData.append("price", this.data.price);
      formData.append("cost", this.data.cost);
      formData.append("des", this.data.des || "");
      formData.append("discount", this.data.discount);
      formData.append("category", this.data.category);
      formData.append("modifiers", this.data.modifiers || "");
      formData.append("removable_ingredients", this.data.removable_ingredients || "");
      axios
        .post("/admin/items", formData)
        .then((response) => {
          this.fetchItems();
          this.resetForm();
          this.$toast.success("Item has been created.");
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
    storeCategory() {
      this.errors = {};
      topbar.show();
      this.loading = true;
      axios
        .post("/admin/categories", this.categoryData)
        .then((response) => {
          this.fetchCategories();
          this.categoryData.name = "";
          this.categoryData.sort_order = 1;
          this.$toast.success("Category added");
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
    updateItem(id) {
      this.errors = {};
      topbar.show();
      this.loading = true;
      const formData = new FormData();
      formData.append("image", this.editData.image);
      formData.append("name", this.editData.name);
      formData.append("price", this.editData.price);
      formData.append("cost", this.editData.cost);
      formData.append("slug", this.editData.slug);
      formData.append("des", this.editData.des || "");
      formData.append("discount", this.editData.discount);
      formData.append("category", this.editData.category);       
      formData.append("modifiers", this.editData.modifiers || ""); 
      formData.append("removable_ingredients", this.editData.removable_ingredients || ""); 
      formData.append("_method", "PUT");
      axios
        .post(`/admin/items/${id}`, formData)
        .then((response) => {
          this.fetchItems();
          this.$toast.success("Item updated");
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
    openEditModal(item) {
      this.editData.id = item.id;
      this.editData.name = item.name;
      this.editData.slug = item.slug;
      this.editData.image = item.image_url;
      this.editData.image = "";
      if (item.image_path) {
        this.editData.image_url = item.image_url;
        this.editData.image_path = item.image_path;
      } else {
        this.editData.image_url = null;
        this.editData.image_path = null;
      }
      this.editData.price = item.price;
      this.editData.cost = item.cost;
      this.editData.discount = item.discount;
      this.editData.des = item.des;
      this.editData.category = item.category.id;
      this.editData.ingredients = item.ingredients;
      this.editData.services = item.item_selection_option;
      this.editData.modifiers = item.modifiers;
      this.editData.removable_ingredients = item.removable_ingredients;
    },

    updateStatus(id) {
      topbar.show();
      axios
        .put(`/admin/items/status/${id}`)
        .then((response) => {
          this.fetchItems();
          this.$toast.success("Item updated");
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
    replicate(id) {
      Swal.fire({
        title: "Replicate this item?",
        text: "",
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
            .post(`/admin/items/replicate/${id}`, null)
            .then((response) => {
              this.fetchItems();
              this.$toast.success("Item replicated");
            })
            .catch(({ response }) => {
              Swal.fire(
                `Error ${response.status}`,
                response.statusText,
                "error"
              );
            })
            .finally(() => topbar.hide());
        }
      });
    },
    resetForm() {
      this.data.name = "";
      this.data.image = "";
      this.data.price = 0;
      this.data.cost = 0;
      this.data.des = "";
      this.data.discount = 0;
      this.data.category = "";
      this.data.modifiers = "";
      this.data.removable_ingredients = "";
      this.imageUrl = "";
    },
    copyLinkToClipBoard(item) {
      var input = document.createElement("textarea");
      input.innerHTML = item.url;
      document.body.appendChild(input);
      input.select();
      var result = document.execCommand("copy");
      document.body.removeChild(input);
      this.$toast.success("Copied to clipboard");
    },
    shareToFacebook(url) {
      window.open(
        `https://www.facebook.com/sharer/sharer.php?u=${url}`,
        "_blank"
      );
    },
    tweet(url) {
      window.open(`https://twitter.com/intent/tweet?text=${url}`, "_blank");
    },
    sendViaWhatsApp(url) {
      window.open(`https://wa.me/?text=${url}`, "_blank");
    },
  },
  created: function () {
    console.log(this.usdRateValue);
    this.fetchItems();
    this.fetchCategories();
    // this.fetchMasterItems();
    // this.fetchUnites();
    this.fetchServiceCategories();
    this.fetchAllServices();
  },
  computed: {
    itemList() {
      const search = this.search.toLowerCase();
      if (!search) return this.items;
      return this.items.filter((item) => {
        return (
          item.name.toLowerCase().includes(search) ||
          item.category.name.toLowerCase().includes(search)
        );
      });
    },
    pricePreview() {
      var discount = this.data.discount;
      var hasDiscount = discount > 0;
      var price = hasDiscount
        ? this.data.price - (discount / 100) * this.data.price
        : this.data.price;
      return blr_money_format(Number(price * this.usdRateValue));
    },
    costPreview() {
      return blr_money_format(Number(this.data.cost * this.usdRateValue));
    },
    pricePreviewEdit() {
      var discount = this.editData.discount;
      var hasDiscount = discount > 0;
      var price = hasDiscount
        ? this.editData.price - (discount / 100) * this.editData.price
        : this.editData.price;
      return blr_money_format(Number(price * this.usdRateValue));
    },
    costPreviewEdit() {
      return blr_money_format(Number(this.editData.cost * this.usdRateValue));
    },
  },
};
</script>
