<template>
  <header class="app-header navbar">
    <!-- mobile toggle -->
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button" @click="mobileSidebarToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- brand -->
    <b-link class="navbar-brand" to="#">EMPLUS</b-link>
    <!-- toggle -->
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" @click="sidebarToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <b-navbar-nav class="ml-auto">
      <b-nav-item-dropdown right no-caret>
        <template slot="button-content">
          <i class="icon-bell"></i>
        </template>
        <b-dropdown-header tag="div" class="text-center"><strong>Notifikasi</strong></b-dropdown-header>
        <b-dropdown-item>Belum ada notifikasi</b-dropdown-item>
      </b-nav-item-dropdown>
      <HeaderDropdown/>
    </b-navbar-nav>
  </header>
</template>
<script>
import HeaderDropdown from './HeaderDropdown.vue';

export default {
  name: 'c-header',
  components: {
    HeaderDropdown
  },
  methods: {
    sidebarToggle (e) {
      e.preventDefault();
      document.body.classList.toggle('sidebar-hidden');
    },
    sidebarMinimize (e) {
      e.preventDefault();
      document.body.classList.toggle('sidebar-minimized');
    },
    mobileSidebarToggle (e) {
      e.preventDefault();
      document.body.classList.toggle('sidebar-mobile-show');
    },
    asideToggle (e) {
      e.preventDefault();
      document.body.classList.toggle('aside-menu-hidden');
    }
  }
}
</script>
