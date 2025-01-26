<template>
  <div class="card mb-3 shadow-sm">
    <div class="card-body">
      <form @submit.prevent="updateUsdRate()">
        <div class="mb-3">
          <label for="about" class="form-label">
            US Dollar exchange rate
            <div class="fw-bold small">$1 = {{ usdRateValue }}</div>
          </label>
          <input
            type="number"
            class="form-control"
            v-model="usdRate.value"
            min="0"
            id="usd-rate"
            name="usd_rate"
            required
          />
        </div>
        <button
          type="submit"
          class="btn btn-primary px-4 shadow-sm"
          :disabled="loading"
        >
          Update
        </button>
      </form>
    </div>
  </div>
  <div class="card mb-3 shadow-sm">
    <div class="card-body">
      <form @submit.prevent="updateAbout()">
        <div class="mb-3">
          <label for="about" class="form-label">
            <a href="/about" class="link-primary" target="_blank"> About Us </a>
          </label>
          <ckeditor
            :editor="editor"
            v-model="aboutData.value"
            :config="editorConfig"
          ></ckeditor>
        </div>
        <button
          type="submit"
          class="btn btn-primary px-4 shadow-sm"
          :disabled="loading"
        >
          Save
        </button>
      </form>
    </div>
  </div>
  <div class="card mb-3 shadow-sm">
    <div class="card-body">
      <form @submit.prevent="updateGlobalAlert()">
        <div class="mb-3">
          <label for="about" class="form-label"
            >Global Alert
            <div class="text-info small">
              This alert will be shown on the homepage
            </div>
            <div class="text-muted small">Announcement, Events ...etc.</div>
          </label>
          <ckeditor
            :editor="editor"
            v-model="globalAlertData.value"
            :config="editorConfig"
          ></ckeditor>
        </div>
        <button
          type="submit"
          class="btn btn-primary px-4 shadow-sm"
          :disabled="loading"
        >
          Save
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { blr_money_format } from "@/services/utils";

export default {
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
      loading: false,
      usdRate: {
        value: "",
        _method: "PUT",
      },
      aboutData: {
        value: "",
        _method: "PUT",
      },
      globalAlertData: {
        value: "",
        _method: "PUT",
      },
    };
  },
  created() {
    this.fetchSettings();
  },
  methods: {
    fetchSettings() {
      topbar.show();
      axios
        .get("/admin/settings/all")
        .then((response) => {
          this.aboutData.value = response.data.about;
          this.usdRate.value = response.data.usd_rate;
          if (response.data.global_alert) {
            this.globalAlertData.value = response.data.global_alert;
          }
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        })
        .then(() => {
          topbar.hide();
        });
    },

    updateAbout() {
      topbar.show();
      this.loading = true;
      axios
        .post("/admin/settings/about", this.aboutData)
        .then((response) => {
          this.$toast.success("About Us has been updated");
        })
        .catch(({ response }) => {
          if (response.status === 422 || response.status === 429) {
            this.$toast.error(response.data.errors);
          } else {
            Swal.fire(`Error ${response.status}`, response.statusText, "error");
          }
        })
        .then(() => {
          topbar.hide();
          this.loading = false;
        });
    },
    updateUsdRate() {
      topbar.show();
      this.loading = true;
      axios
        .post("/admin/settings/usd-rate", this.usdRate)
        .then((response) => {
          this.$toast.success("USD Dollar exchange rate has been updated");
        })
        .catch(({ response }) => {
          if (response.status === 422 || response.status === 429) {
            this.$toast.error(`Error: ${response.data.errors}`);
          } else {
            Swal.fire(`Error ${response.status}`, response.statusText, "error");
          }
        })
        .then(() => {
          topbar.hide();
          this.loading = false;
        });
    },
    updateGlobalAlert() {
      topbar.show();
      this.loading = true;
      axios
        .post("/admin/settings/global_alert", this.globalAlertData)
        .then((response) => {
          this.$toast.success("Global Alert has been updated");
        })
        .catch(({ response }) => {
          if (response.status === 422 || response.status === 429) {
            this.$toast.error(response.data.errors);
          } else {
            Swal.fire(`Error ${response.status}`, response.statusText, "error");
          }
        })
        .then(() => {
          topbar.hide();
          this.loading = false;
        });
    },
  },
  mounted() {},
  computed: {
    usdRateValue() {
      return blr_money_format(Number(this.usdRate.value));
    },
  },
};
</script>
