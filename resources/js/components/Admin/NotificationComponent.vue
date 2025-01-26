<template>
  <a
    class="nav-link"
    href="#"
    id="navbarDropdown"
    role="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
    @click="markAsRead"
  >
    <MtIcon icon="notifications"></MtIcon>
    <span
      v-if="notifications.length > 0"
      class="
        position-absolute
        top-0
        mt-2
        start-100
        translate-middle
        badge
        rounded-pill
        bg-danger
      "
      >{{ notifications.length }}
      <span class="visually-hidden">unread messages</span></span
    >
  </a>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    <li>
      <a
        class="dropdown-item"
        v-for="notification in notifications"
        :key="notification.id"
        href="/admin/orders/"
      >
        {{ notification.data }}
        <br />
        <small class="text-muted">{{ notification.created_at }} </small>
      </a>
    </li>

    <li>
      <a
        class="dropdown-item text-center"
        v-if="notifications.length == 0"
        href="#"
      >
        There are no notifications
      </a>
    </li>
  </ul>
</template>

<script>

export default {
  data() {
    return {
      notifications: [],
    };
  },
  created() {
    this.getNotifications();
  },
  methods: {
    getNotifications() {
      axios
        .get("/admin/notifications")
        .then((response) => {
          this.notifications = response.data.data;
        })
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        });
    },
    markAsRead() {
      axios
        .put("/admin/notifications/mark-as-read", null)
        .then((response) => {})
        .catch(({ response }) => {
          Swal.fire(`Error ${response.status}`, response.statusText, "error");
        });
    },
  },
  mounted() {},
};
</script>
