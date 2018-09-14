<template>
    <nav class="crawler--nav">
        <div class="nav--logo">
            <img src="/image/logo/buzzword.png" alt="buzzword.png">
        </div>
        <ul class="nav">
            <li>Home</li>
            <li>About</li>
            <li>Contact</li>
        </ul>
        <div class="nav--mobile-btn">
            <img src="/image/icons/menu.svg" alt="menu" @click="toggleMenu">
        </div>
    </nav>
</template>
<script>
    export default {
      methods: {
        toggleMenu: function () {
          this.$store.commit('togglePanel', !this.$store.state.isSidePanelActive);
        }
      }
    }
</script>