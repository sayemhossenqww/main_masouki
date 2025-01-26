<template>
  <ul class="nav nav-pills items-nav justify-content-md-between">
    <li
      class="item-content cursor-pointer"
      style="position: relative; display: block"
      v-for="category in menuList"
      :key="category.slug"
    >
      <a :href="category.url" class="text-decoration-none text-black">
        <img
          :alt="category.name"
          :data-src="category.menu_image_url"
          aria-hidden="true"
          class="lazy w-100"
        />
        <div
          class="text-break text-center py-2 item-name-content text-uppercase"
        >
          {{ category.name }}
        </div>
      </a>
    </li>
  </ul>
</template>

<script>
import ItemComponent from "./ItemComponent.vue";
import ItemModalComponent from "./ItemModalComponent";
import { Menu } from "@/services/menu";
import { delay, lazyLoadImages } from "@/services/utils";

export default {
  components: { ItemComponent, ItemModalComponent },
  data() {
    return {
      menu: Menu.get(),
      search: "",
      loading: true,
      selectedItem: "",
      itemStyle: "col-md-2 col-sm-4 col-lg-2 d-flex align-items-stretch p-3",
    };
  },
  mounted() {},
  methods: {
    fetchMenu() {
      axios
        .get("/api/v1/categories/items")
        .then((response) => {
          this.menu = response.data.data;
          console.log(this.menu);
          Menu.set(this.menu);
          delay(1).then(() => {
            lazyLoadImages();
          });
        })
        .finally(() => (this.loading = false));
    },
    openModal(item) {
      this.selectedItem = item;
    },
    scrollToCategory(slug) {
      var element = document.getElementById(slug);

      var headerOffset = 200;
      var elementPosition = element.getBoundingClientRect().top;
      var offsetPosition = elementPosition + window.pageYOffset - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });
    },
  },
  created: function () {
    this.fetchMenu();
  },
  computed: {
    menuList() {
      const search = this.search.toLowerCase();
      if (!search) return this.menu;
      return this.menu.map((category) => {
        return {
          ...category,
          items: category.items.filter((item) => {
            return item.search_name.toLowerCase().includes(search);
          }),
        };
      });
    },
    showImage() {
      const search = this.search.toLowerCase();
      if (!search) return this.menu.length == 0;
      let _items = [];
      this.menuList.forEach((category) => {
        _items = _items.concat(category.items);
      });
      return _items.length == 0;
    },

    popularItems() {
      const search = this.search.toLowerCase();
      if (search) return [];
      let _items = [];
      this.menu.forEach((category) => {
        category.items.forEach((item) => {
          if (item.is_popular) {
            _items.push(item);
          }
        });
      });
      return _items;
    },
    discountItems() {
      const search = this.search.toLowerCase();
      if (search) return [];
      let _items = [];
      this.menu.forEach((category) => {
        category.items.forEach((item) => {
          if (item.has_discount) {
            _items.push(item);
          }
        });
      });
      return _items;
    },

    newItems() {
      const search = this.search.toLowerCase();
      if (search) return [];
      let _items = [];
      this.menu.forEach((category) => {
        category.items.forEach((item) => {
          if (item.is_new) {
            _items.push(item);
          }
        });
      });
      return _items;
    },
  },
  watch: {
    search: function () {
      delay(1).then(() => {
        lazyLoadImages();
      });
    },
  },
};
</script>
