<template>
    <nav class="crawler--nav">
        <div class="nav--logo">
            <img src="/image/logo/buzzword.png" alt="buzzword.png">
        </div>
        <ul class="nav">
            <li><a href="/">Home</a></li>
            <li><a href="/about" @click.prevent="toggleModal('/about')">About</a></li>
            <li><a href="/contact" @click.prevent="toggleModal('/contact')">Contact</a></li>
        </ul>
        <div class="nav--mobile-btn">
            <img src="/image/icons/menu.svg" alt="menu" @click="toggleMenu">
        </div>
    </nav>
</template>
<script>
    export default {
      data: function () {
        return {
          popUps: ['/about', '/contact']
        }
      },
      mounted () {
        if(this.popUps.indexOf(window.location.pathname) > -1) {
          this.$store.commit('revealModal', {modal: window.location.pathname, type: 'info'});
        }
      },
      methods: {
        toggleMenu: function () {
          this.$store.commit('togglePanel', !this.$store.state.isSidePanelActive);
        },
        toggleModal: function ($location) {
          this.$store.commit('revealModal', {modal: $location, type: 'info'});
        }
      }
    }
</script>