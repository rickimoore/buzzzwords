<template>
    <div v-if="state" class="modal--container">
        <transition name="fade">
            <div v-if="isOverlay" class="modal--overlay"></div>
        </transition>
        <div class="modal--screen" @click.self="closeModal">
            <transition name="shortSlideUp">
                <offer-entry v-if="data.type === 'entry' && isModal" :offer="data.modal"></offer-entry>
                <welcome-screen v-if="data.type === 'welcome' && isModal"></welcome-screen>
                <buzz-info v-if="data.type === 'info' && isModal" :type="data.modal"></buzz-info>
            </transition>
        </div>
    </div>
</template>
<script>
  Vue.component('offer-entry', require('../components/modals/offer-entry.vue'));
  Vue.component('welcome-screen', require('../components/modals/welcome'));
  Vue.component('buzz-info', require('../components/modals/info'));
    export default {
      props: ['data', 'state'],
      data: function () {
        return {
          isOverlay: false,
          isModal: false
        }
      },
      watch: {
        'state': function (nV) {
          document.body.style.overflow = nV ? 'hidden' : 'scroll';
          setTimeout(() =>{
            this[nV ? 'isOverlay' : 'isModal'] = nV
            setTimeout(() => this[nV ? 'isModal' : 'isOverlay'] = nV, 500)
          }, 300)
        }
      },
      methods: {
        closeModal: function () {
          this.$store.commit('destroyModal', null);
        }
      }
    }
</script>