<template>
  <form @submit.prevent="sendMessage">
    <div class="mb-3">
      <input
        type="email"
        class="form-control"
        v-model="data.email"
        id="email"
        :class="{ 'is-invalid': errors.hasOwnProperty('email') }"
        name="email"
        placeholder="Para:"
      />
      <div class="invalid-feedback" v-if="errors.hasOwnProperty('email')">
        {{ errors.email[0] }}
      </div>
    </div>
    <div class="mb-3">
      <input
        type="text"
        class="form-control"
        v-model="data.subject"
        id="subject"
        :class="{ 'is-invalid': errors.hasOwnProperty('subject') }"
        name="subject"
        placeholder="Sujeito:"
      />
      <div class="invalid-feedback" v-if="errors.hasOwnProperty('subject')">
        {{ errors.subject[0] }}
      </div>
    </div>

    <div class="mb-3">
      <ckeditor
        :editor="editor"
        v-model="data.message"
        :config="editorConfig"
      ></ckeditor>
      <div class="text-danger" v-if="errors.hasOwnProperty('message')">
        {{ errors.message[0] }}
      </div>
    </div>
    <button type="submit" class="btn btn-primary px-4" :disabled="loading">
      Mandar
    </button>
  </form>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

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
      data: {
        email: "",
        subject: "",
        message: "",
      },
      errors: {},
      loading: false,
    };
  },
  created() {},
  methods: {
    sendMessage() {
      this.errors = {};
      topbar.show();
      this.loading = true;
      axios
        .post("/admin/message/send", this.data)
        .then((response) => {
          Swal.fire("", "Mensagem enviada", "success");
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
          this.data.email = "";
          this.data.subject = "";
          this.data.message = "";
        });
    },
  },
  mounted() {},
};
</script>
