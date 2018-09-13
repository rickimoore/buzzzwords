<template>
    <div v-if="state" class="modal--container">
        <div class="modal--overlay"></div>
        <div class="modal--screen" @click.self="closeModal">
            <div class="modal">
                <offer-entry :offer="data"></offer-entry>
            </div>
        </div>
    </div>
</template>
<script>
  Vue.component('offer-entry', require('../components/modals/offer-entry.vue'));
    export default {
      props: ['data', 'state'],
      methods: {
        closeModal: function () {
          this.$store.commit('destroyModal', null);
        }
      }
    }
</script>