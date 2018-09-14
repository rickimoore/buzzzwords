<template>
    <div class="side-panel--container">
        <div class="side-panel" :class="{'side-panel--active': state}">
            <div class="panel--plate">
                <button v-if="isScrollSidePanel || history.length > 0" class="bzz--btn clear-wBorder--btn" @click="togglePanel">
                    <img src="/image/icons/menu.svg" alt="menu">
                </button>
            </div>
            <transition name="fade">
                <div v-if="state" class="side-menu--container">
                    <ul>
                        <li>Home</li>
                        <li>About</li>
                        <li>Contact</li>
                    </ul>
                </div>
            </transition>
            <transition name="fade">
                <div v-if="history.length > 0 && state" class="history--container">
                    <div class="history--table">
                        <p>Search History:</p>
                        <ul>
                            <li v-for="(item, $index) in history" :key="$index"
                                class="clip-item" :data-clipboard-text="item.link"
                                @click="copyToBoard($index)"
                            >
                                <span>{{item.link}}</span>
                                <transition name="shortSlideUp">
                                    <span class="clip-item-note" v-if="isCopied && copiedTarget === $index">Copied!</span>
                                </transition>
                            </li>
                        </ul>
                    </div>
                </div>
            </transition>
        </div>
        <div v-if="state" class="splash-panel">
            <ul>
                <li>Home</li>
                <li>About</li>
                <li>Contact</li>
            </ul>
            <div v-if="history.length > 0 && state" class="history--container">
                <div class="history--table">
                    <p>Search History:</p>
                    <ul>
                        <li v-for="(item, $index) in history" :key="$index"
                            class="clip-item" :data-clipboard-text="item.link"
                            @click="copyToBoard($index)"
                        >
                            <span>{{item.link}}</span>
                            <transition name="shortSlideUp">
                                <span class="clip-item-note" v-if="isCopied && copiedTarget === $index">Copied!</span>
                            </transition>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    var ClipboardJS = require('clipboard');
    export default {
      props: ['history', 'state'],
      data: function () {
        return {
          isScrollSidePanel: false,
          isCopied: false,
          copiedTarget: null,
          clipBoard: ''
        }
      },
      mounted () {
        window.addEventListener('scroll', this.handleScroll);
        this.clipboard = new ClipboardJS('.clip-item');
      },
      methods: {
        handleScroll: function () {
          if(window.scrollY > 100) {
            return this.isScrollSidePanel = true;
          }
          this.isScrollSidePanel = false;
        },
        copyToBoard: function ($index) {
          this.copiedTarget = $index;
          this.isCopied = true;
          let self = this;
          setTimeout(function () {
            self.isCopied = false;
          }, 1500);
        },
        togglePanel: function () {
          this.$store.commit('togglePanel', !this.$store.state.isSidePanelActive);
        }
      }
    }
</script>